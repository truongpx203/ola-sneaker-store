<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showNewProducts()
    {
        $products = Product::with(['variants' => function ($query) {
            $query->whereNotNull('sale_price') // Chỉ lấy biến thể có giá sale
                ->orderBy('sale_price', 'asc');
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

        // Tìm biến thể có giá sale thấp nhất
        $lowestSaleVariant = $product->variants->whereNotNull('sale_price')->sortBy('sale_price')->first();

        // Lấy sản phẩm liên quan (cùng danh mục) và sắp xếp theo giá sale từ bé đến lớn
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['variants' => function ($query) {
                $query->whereNotNull('sale_price'); // Lọc chỉ lấy những biến thể có giá sale
            }])
            ->get()
            ->sortBy(function ($product) {
                return $product->variants->min('sale_price'); // Sắp xếp theo giá sale
            })
            ->sortByDesc('id') 
            ->take(6);

        return view('client.product-details', compact('product', 'relatedProducts', 'lowestSaleVariant'));
    }
}
