<?php

namespace App\Models\client;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\VariantController;
use App\Models\Variant;
use App\Http\Controllers\client\CartController;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = ['user_id', 'variant_id', 'variant_quantity'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
    use HasFactory;
}
