<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

        // Các trường có thể lưu trữ
        protected $fillable = ['name', 'email', 'subject', 'message', 'is_resolved'];
}
