<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\OrderCanceledMail;
use App\Mail\OrderCompletedMail;
use App\Models\Bill;
use App\Models\BillHistory;
use App\Models\BillItem;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function detailBill($id)
    {
        $bill = Bill::query()
            ->with(['items.variant', 'items.variant.productReviews'])
            ->findOrFail($id);

        // Lấy ID của người dùng đã đăng nhập
        $userId = auth()->id();

        foreach ($bill->items as $item) {
            // Kiểm tra xem người dùng đã đánh giá sản phẩm này trong đơn hàng này chưa
            $item->has_reviewed = ProductReview::where('variant_id', $item->variant->id)
                ->where('user_id', $userId)
                ->where('bill_id', $bill->id)
                ->exists();
        }

        return view('client.order-details', compact('bill'));
    }

    public function cancelOrder(Request $request, $id)
    {
        $bill = Bill::findOrFail($id);

        if ($bill->bill_status !== 'pending') {
            return redirect()->back()->with('error', 'Bạn không thể hủy đơn hàng vì đơn hàng đang được xử lý.');
        }

        $request->validate([
            'note' => 'required|string|max:255',
        ], [
            'note.required' => 'Vui lòng nhập lý do hủy đơn hàng.',
            'note.max' => 'Lý do hủy đơn hàng không quá 255 ký tự.'
        ]);

        $bill->bill_status = 'canceled';
        $bill->save();

        $atDatetime = now();
        // Lưu vào lịch sử hủy đơn
        BillHistory::create([
            'bill_id' => $bill->id,
            'by_user' => Auth::id(),
            'from_status' => 'pending', // Trạng thái trước khi hủy
            'to_status' => 'canceled',
            'note' => $request->note,
            'at_datetime' => $atDatetime,
        ]);

        // Gửi email thông báo cho khách hàng
        $customerEmail = $bill->user->email;
        Mail::to($customerEmail)->send(new OrderCanceledMail($bill, $request->note, $atDatetime));

        return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công.');
    }

    public function completeOrder(Request $request, $id)
    {

        $bill = Bill::findOrFail($id);

        if ($bill->bill_status !== 'delivered') {
            return redirect()->back()->with('error', 'Chỉ có thể đánh dấu đơn hàng là hoàn thành khi nó đã được giao hàng thành công.');
        }

        $bill->bill_status = 'completed';
        $bill->save();

        BillHistory::create([
            'bill_id' => $bill->id,
            'by_user' => Auth::id(),
            'from_status' => 'delivered',
            'to_status' => 'completed',
            'note' => 'Đơn hàng đã được hoàn thành.',
            'at_datetime' => now(),
        ]);

        // Gửi email thông báo cho khách hàng
        $customerEmail = $bill->user->email;
        Mail::to($customerEmail)->send(new OrderCompletedMail($bill));

        return redirect()->back()->with('success', 'Đơn hàng đã được hoàn thành.');
    }
}
