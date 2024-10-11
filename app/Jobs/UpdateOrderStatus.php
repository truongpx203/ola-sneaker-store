<?php

namespace App\Jobs;

use App\Models\Bill;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateOrderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $billId;

    public function __construct($billId)
    {
        $this->billId = $billId;
    }

    public function handle(): void
    {
        try {
            // Tìm hóa đơn
            $bill = Bill::find($this->billId);
    
            if ($bill && $bill->bill_status === 'delivered') {
                $oldStatus = $bill->bill_status;

                $bill->bill_status = 'completed';
                $bill->save();

                $bill->histories()->create([
                    'from_status' => $oldStatus,
                    'to_status' => $bill->bill_status,
                    'note' => 'Tự động cập nhật từ giao hàng thành công sang hoàn thành',
                    'by_user' => null,
                    'at_datetime' => now(),
                ]);
    
                \Log::info("Bill ID {$this->billId} đã được cập nhật trạng thái từ 'delivered' sang 'completed'.");
            }
        } catch (\Exception $e) {
            // Ghi lại lỗi vào log
            \Log::error('Job UpdateOrderStatus failed: ' . $e->getMessage());
        }
    }
}