<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasManyThrough(ProductReview::class, Variant::class, 'product_id', 'variant_id');
    }

    public function calculateAverageRating(): float
    {
        $reviews = $this->reviews; 
        if ($reviews->count() > 0) {
            return $reviews->avg('rating');
        }
        return 0; 
    }
}
