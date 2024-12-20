<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateOrderStatus;
use App\Mail\OrderCanceledMail;
use App\Mail\OrderCompletedMail;
use App\Mail\OrderStatusUpdatedMail;
use App\Models\Bill;
use App\Models\VoucerHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $query = Bill::with('items')->orderBy('id', 'desc');

        if ($status = $request->get('bill_status')) {
            if ($status !== 'all') {
                $query->where('bill_status', $status);
            }
        }

        if ($request->filled('bill_code')) {
            $query->where('code', 'like', '%' . $request->bill_code . '%');
        }

        if ($request->filled('purchase_date')) {
            $query->whereDate('created_at', $request->purchase_date);
        }

        $bills = $query->paginate(10);

        return view('admin.bills.show-bills', compact('bills'));
    }



    public function show($id)
    {
        $bill = Bill::with(['items.variant', 'histories'])->findOrFail($id);
        $voucerHistory=VoucerHistory::query()->with('voucher')->where('bill_id',$id)->first();
        return view('admin.bills.show-bill-item', compact('bill','voucerHistory'));
    }

    public function updateStatus(Request $request, $id)
    {
        $statusList = ['pending', 'confirmed', 'in_delivery', 'delivered', 'failed', 'canceled'];

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
            'delivered' => [],
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

        // 24/11/2024

        // Hoàn lại điểm nếu đơn hàng bị hủy và người dùng đã sử dụng điểm để giảm giá
        if ($bill->bill_status === 'canceled') {
            if ($bill->points_used > 0) {
                $bill->returnPointsToUser();  // Gọi phương thức hoàn lại điểm 
            }

              // Hoàn lại số lượng tồn kho
              foreach ($bill->items as $item) {
                $variant = $item->variant;
                if ($variant) {
                    $variant->increment('stock', $item->variant_quantity); // Hoàn kho
                }
            }
        }

        // Cộng điểm cho người dùng khi đơn hàng hoàn thành
        if ($bill->bill_status === 'completed') {
            $bill->awardPointsToUser(); // Cộng điểm cho người dùng
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

        // 24/11/2024
        if ($bill->bill_status === 'canceled') {
            Mail::to($customerEmail)->send(new OrderCanceledMail($bill, $request->input('note'), $history->at_datetime));
        } else if ($bill->bill_status === 'completed') {
            Mail::to($customerEmail)->send(new OrderCompletedMail($bill));
        } else {
            Mail::to($customerEmail)->send(new OrderStatusUpdatedMail($bill, $history->note, $history->at_datetime));
        }

        if ($bill->bill_status === 'delivered' && $oldStatus !== 'completed') {
            UpdateOrderStatus::dispatch($bill->id)->delay(now()->addDays(3));
            // UpdateOrderStatus::dispatch($bill->id)->delay(now()->addMinutes(1));
            if ($bill->bill_status === 'completed') {
                $bill->awardPointsToUser(); 
            }
        }


        return redirect()->route('bills.show', $id)->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }
}
