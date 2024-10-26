<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillHistory;
use App\Models\BillItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function detailBill($id)
    {
        $bill = Bill::query()->with(['items', 'histories'])->findOrFail($id);;
        return view('client.order-details', compact('bill'));
    }
    public function cancelOrder(Request $request, $id)
    {
        $bill = Bill::findOrFail($id);

        if ($bill->bill_status !== 'pending') {
            return redirect()->back()->with('error', 'Chỉ có thể hủy đơn hàng đang chờ xác nhận.');
        }

        $request->validate([
            'note' => 'required|string|max:255',
        ], [
            'note.required' => 'Vui lòng nhập lý do hủy đơn hàng.',
            'note.max' => 'Lý do hủy đơn hàng không quá 255 ký tự.'
        ]);

        // Cập nhật trạng thái hóa đơn
        $bill->bill_status = 'canceled';
        $bill->save();

        // Lưu vào lịch sử hủy đơn
        BillHistory::create([
            'bill_id' => $bill->id,
            'by_user' => Auth::id(),
            'from_status' => 'pending', // Trạng thái trước khi hủy
            'to_status' => 'canceled',
            'note' => $request->note,
            'at_datetime' => now(),
        ]);

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

        return redirect()->back()->with('success', 'Đơn hàng đã được hoàn thành.');
    }
}
