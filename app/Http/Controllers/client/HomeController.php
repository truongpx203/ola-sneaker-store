<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillHistory;
use App\Models\BillItem;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function detailBill($id)
    {
        $bill = Bill::query()->with(['items', 'histories'])->where('id', $id)->first();
        return view('client.order-details', compact('bill'));
    }
    public function cancelOrder($id)
    {
        $bill = Bill::query()->with(['items', 'histories'])->where('id', $id)->first();
        $latestHistory = BillHistory::query()
            ->where('bill_id', $id)
            ->orderBy('at_datetime', 'desc')
            ->first();
        if ($latestHistory->to_status != "Chờ xác nhận") {
            if ($latestHistory->to_status == "Đã hủy đơn hàng") {
                return redirect()->route('order-details', $id)
                    ->withErrors(['cancelBill' => 'Đơn hàng đã được bạn hủy từ trước']);
            }
            return redirect()->route('order-details', $id)
                ->withErrors(['cancelBill' => 'Đơn hàng đã xác nhận không được hủy']);
        }
        BillHistory::query()->create([
            'bill_id' => $bill->id,
            'by_user' => Auth::user()->id,
            'from_status' => $latestHistory->to_status,
            'to_status' => "Đã hủy đơn hàng",
            'note' => null,
            'at_datetime' => now()->format('Y-m-d H:i:s')
        ]);
        return redirect()->route('order-details', $id);
    }
}
