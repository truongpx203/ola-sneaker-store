<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Các trường có thể lưu trữ
    protected $fillable = ['user_id', 'subject', 'message', 'is_resolved'];

    // Khai báo quan hệ giữa Contact và User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
