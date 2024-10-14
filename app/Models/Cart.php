<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    // viết vào ngày 14/10.
    protected $fillable = ['user_id', 'variant_id', 'variant_quantity'];

    // Quan hệ với model Product
    public function variants()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
        // return $this->hasMany(Variant::class);
    }
}
