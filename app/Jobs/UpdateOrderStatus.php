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
        $bill = Bill::find($this->billId);

        if (!$bill || $bill->bill_status !== 'delivered') {
            return; 
        }

        $bill->bill_status = 'completed';
        $bill->save();

 
        $bill->awardPointsToUser();
        // $customerEmail = $bill->user->email;
        // Mail::to($customerEmail)->send(new OrderCompletedMail($bill));
    }
}
