<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'code', 'summary', 'detailed_description', 'average_rating', 'primary_image_url', 'category_id'];

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);  // Assuming CategoryModel has a 'id' field and 'products' table has 'category_id' field.  Change the model and field names as per your database schema.
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
