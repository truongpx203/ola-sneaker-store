<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

    public function filterProducts(Request $request)
    {
        $categoryId = $request->input('category_id');

        $products = Product::with(['variants' => function ($query) {
            $query->whereNotNull('sale_price')->orderBy('sale_price', 'asc');
        }])
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->orderBy('id', 'desc')
            ->paginate(12);

        if ($request->ajax()) {
            return view('client.partials.product-list', compact('products'))->render();
        }

        return view('client.shop', compact('products'));
    }


    public function paginateProducts(Request $request)
    {
        $categoryId = $request->input('category_id');

        $products = Product::with(['variants' => function ($query) {
            $query->whereNotNull('sale_price')->orderBy('sale_price', 'asc');
        }])
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->orderBy('id', 'desc')
            ->paginate(12);

        if ($request->ajax()) {
            return view('client.partials.product-list', compact('products'))->render();
        }

        return view('client.shop', compact('products'));
    }

    public function filterByPrice(Request $request)
{
    $categoryId = $request->input('category_id');
    $minPrice = $request->input('min_price');
    $maxPrice = $request->input('max_price');

    $products = Product::with(['variants' => function ($query) {
        $query->whereNotNull('sale_price')->orderBy('sale_price', 'asc');
    }])
    ->when($categoryId, function ($query) use ($categoryId) {
        return $query->where('category_id', $categoryId);
    })
    ->when($minPrice, function ($query) use ($minPrice) {
        return $query->whereHas('variants', function ($q) use ($minPrice) {
            $q->where('sale_price', '>=', $minPrice);
        });
    })
    ->when($maxPrice, function ($query) use ($maxPrice) {
        return $query->whereHas('variants', function ($q) use ($maxPrice) {
            $q->where('sale_price', '<=', $maxPrice);
        });
    })
    ->orderBy('id', 'desc')
    ->paginate(12);

    if ($request->ajax()) {
        return view('client.partials.product-list', compact('products'))->render();
    }

    return view('client.shop', compact('products'));
}


}
