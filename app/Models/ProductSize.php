<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSize extends Model
{
    use HasFactory;
    protected $table = 'product_sizes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'name', 'created_at', 'updated_at'];

    public function variants()
    {
        return $this->hasMany(Variant::class, 'product_size_id', 'id');
    }
}
