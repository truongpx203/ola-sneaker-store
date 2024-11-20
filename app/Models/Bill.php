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
        'address',
        'note'
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
        $pointsToAward = floor($this->total_price / 400000); // Cộng 1 điểm cho mỗi 400000 VND

        // Cộng điểm vào tài khoản người dùng
        $this->user->points += $pointsToAward;
        $this->user->save();
    }

    public function returnPointsToUser()
    {
        $user = $this->user;
    
        // Kiểm tra nếu có điểm đã sử dụng
        if ($this->points_used > 0) {
            // Hoàn lại điểm cho người dùng
            $user->points += $this->points_used;
            $user->save();
    
            // Cập nhật lại số điểm đã sử dụng trong hóa đơn
            $this->points_used = 0;
            $this->save();
        }
    }
}
