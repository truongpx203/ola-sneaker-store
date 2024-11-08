<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    // Chỉ định các cột có thể được gán giá trị
    protected $fillable = [
        'code',
        'value',
        'description',
        'max_price',
        'start_datetime',
        'end_datetime',
        'quantity',
        'used_quantity',
        'for_user_ids',
        'user_use'
    ];

    // Kiểm tra mã voucher có hợp lệ hay không
    public function isValid()
    {
        return $this->start_datetime <= now() && $this->end_datetime >= now() && $this->quantity > $this->used_quantity;
    }

    // Tính toán mức giảm giá
    public function calculateDiscount($cartTotal)
    {
        $discountAmount = ($cartTotal * $this->value) / 100;

        if ($this->max_price && $discountAmount > $this->max_price) {
            return $this->max_price;
        }

        return $discountAmount;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'for_user_ids');
    }

}
