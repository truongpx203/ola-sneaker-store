<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'bill_status', 'payment_type', 'payment_status',
        'total_price', 'full_name', 'phone_number', 'address'
    ];

    public function items()
    {
        return $this->hasMany(BillItem::class);
    }

    public function histories()
    {
        return $this->hasMany(BillHistory::class);
    }
}
