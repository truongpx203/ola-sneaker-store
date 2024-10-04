<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======
    protected $table = 'product_sizes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'name', 'created_at', 'updated_at'];
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
}
