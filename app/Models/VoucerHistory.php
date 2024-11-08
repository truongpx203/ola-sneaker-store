<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucerHistory extends Model
{
    use HasFactory;

    protected $table = 'voucer_histories';

    // Chỉ định các cột có thể được gán giá trị
    protected $fillable = [
        'voucher_id',
        'user_id',
        'bill_id ',
        'at_datetime',
    ];
}
