<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $table = 'product_sizes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'name', 'created_at', 'updated_at'];
}
