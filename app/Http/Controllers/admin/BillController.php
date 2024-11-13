<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateOrderStatus;
use App\Mail\OrderCanceledMail;
use App\Mail\OrderCompletedMail;
use App\Mail\OrderStatusUpdatedMail;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with('items')->orderBy('id', 'desc')->paginate(10);
        return view('admin.bills.show-bills', compact('bills'));
    }

    public function show($id)
    {
        $bill = Bill::with(['items.variant', 'histories'])->findOrFail($id);
        return view('admin.bills.show-bill-item', compact('bill'));
    }

    public function updateStatus(Request $request, $id)
    {
        $statusList = ['pending', 'confirmed', 'in_delivery', 'delivered', 'failed', 'canceled', 'completed'];

        // Xác thực yêu cầu đầu vào
        $request->validate([
            'status' => 'required|string|in:' . implode(',', $statusList),
            'note' => 'nullable|string|max:255',
        ]);

        // Kiểm tra nếu trạng thái được cập nhật thành "canceled" mà không có lý do
        if ($request->input('status') === 'canceled' && empty($request->input('note'))) {
            return redirect()->route('bills.show', $id)->with('error', 'Vui lòng nhập lý do hủy đơn hàng.');
        }

        // Tìm hóa đơn
        $bill = Bill::findOrFail($id);

        // Lưu trạng thái cũ
        $oldStatus = $bill->bill_status;

        // Định nghĩa quy tắc chuyển đổi trạng thái
        $validTransitions = [
            'pending' => ['confirmed', 'canceled'],
            'confirmed' => ['in_delivery'],
            'in_delivery' => ['delivered', 'failed'],
            'delivered' => ['completed'],
            'failed' => [],
            'canceled' => [],
            'completed' => []
        ];

        // Kiểm tra xem trạng thái mới có hợp lệ không
        if (!in_array($request->input('status'), $validTransitions[$oldStatus])) {
            return redirect()->route('bills.show', $id)->with('error', 'Chuyển đổi trạng thái không hợp lệ.');
        }

        // Cập nhật trạng thái hóa đơn
        $bill->bill_status = $request->input('status');

        // Nếu trạng thái được cập nhật thành "delivered", cập nhật trạng thái thanh toán
        if ($bill->bill_status === 'delivered') {
            $bill->payment_status = 'completed'; // Cập nhật trạng thái thanh toán
        }

        $bill->save();

        // Tạo một mục lịch sử mới
        $history = $bill->histories()->create([
            'from_status' => $oldStatus,
            'to_status' => $bill->bill_status,
            'note' => $request->input('note'),
            'by_user' => auth()->user()->id,
            'at_datetime' => now(),
        ]);

        // Gửi email thông báo cho khách hàng
        $customerEmail = $bill->user->email;

        if ($bill->bill_status === 'canceled') {
            Mail::to($customerEmail)->send(new OrderCanceledMail($bill, $request->input('note'), $history->at_datetime));
        } else if ($bill->bill_status === 'completed') {
            Mail::to($customerEmail)->send(new OrderCompletedMail($bill));
            // Cộng điểm cho người dùng khi đơn hàng hoàn thành (7/11/2024)
            $bill->awardPointsToUser(); // Cộng điểm cho người dùng
        } else {
            Mail::to($customerEmail)->send(new OrderStatusUpdatedMail($bill, $history->note, $history->at_datetime));
        }


        if ($bill->bill_status === 'delivered' && $oldStatus !== 'completed') {
            UpdateOrderStatus::dispatch($bill->id)->delay(now()->addDays(3));
            // UpdateOrderStatus::dispatch($bill->id)->delay(now()->addMinutes(1));
        }

        return redirect()->route('bills.show', $id)->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

}
