<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', //Mới thêm user_id vào đây (14/10/2024)
        'code',
        'bill_status',
        'payment_type',
        'payment_status',
        'total_price',
        'full_name',
        'phone_number',
        'address'
    ];

    public function items()
    {
        return $this->hasMany(BillItem::class);
    }

    public function histories()
    {
        return $this->hasMany(BillHistory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 7/11/2024
    public function awardPointsToUser()
    {
        $pointsToAward = floor($this->total_price / 1000); // Cộng 1 điểm cho mỗi 1000 VND

        // Cộng điểm vào tài khoản người dùng
        $this->user->points += $pointsToAward;
        $this->user->save();
    }
}
