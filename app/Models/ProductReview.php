<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'variant_id',
        'user_id',
        'bill_id',
        'rating',
        'comment',
        'image_url',
        'review_date',
        'is_hidden',
    ];
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'variant_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
