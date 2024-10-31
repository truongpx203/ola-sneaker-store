<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'product_id', 
        'is_available',
    ];

    // Định nghĩa quan hệ với model Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
