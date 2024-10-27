<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\client\Cart;
use App\Models\ProductSize;

class Variant extends Model
{

    // Trong model Variant.php
    public function productSize()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }

    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_size_id',
        'stock',
        'listed_price',
        'sale_price',
        'import_price',
        'is_show'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,);
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class,  'product_size_id');
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class, 'variant_id');
    }
    // ngày 14/10

    public function cart()
    {
        // return $this->hasMany(Cart::class);
        return $this->belongsTo(Cart::class);
    }
}
