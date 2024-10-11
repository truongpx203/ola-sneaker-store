<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'variant_id', 'bill_id', 'sale_price', 'listed_price',
        'import_price', 'variant_quantity', 'product_name', 'product_image_url'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
