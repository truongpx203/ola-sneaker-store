<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showNewProducts()
    {
        $products = Product::with(['variants' => function($query) {
            // $query->orderBy('listed_price', 'asc'); // Lấy biến thể có giá thấp nhất
        }])->orderBy('id', 'desc')->take(8)->get();
    
        return view('client.home', compact('products'));
    }

    public function show($id)
{
    // Lấy sản phẩm cùng với các biến thể và ảnh
    $product = Product::with(['variants', 'productImages'])->findOrFail($id);

    // Sắp xếp các biến thể theo kích thước từ bé đến lớn
    $product->variants = $product->variants->sortBy(function ($variant) {
        return $variant->size->name;
    });
    
    // Lấy sản phẩm liên quan (cùng danh mục)
    $relatedProducts = Product::where('category_id', $product->category_id)
                               ->where('id', '!=', $product->id)
                               ->orderBy('id', 'desc')
                               ->take(6)
                               ->get();

    return view('client.product-details', compact('product', 'relatedProducts'));
}
}
