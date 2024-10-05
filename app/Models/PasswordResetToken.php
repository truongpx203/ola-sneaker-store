<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'token'];

    public function user(){
        return $this->hasOne(User::class, 'email', 'email');
    }
}
