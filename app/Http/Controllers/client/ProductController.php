<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showNewProducts()
    {
        $products = Product::with(['variants' => function ($query) {
            $query->where('is_show', 1) // Chỉ lấy biến thể có is_show bằng 1
                ->whereNotNull('sale_price') // Chỉ lấy biến thể có giá sale
                ->orderBy('sale_price', 'asc');
        }])->orderBy('id', 'desc')->take(8)->get();

        return view('client.home', compact('products'));
    }
    public function show($id)
    {
        $product = Product::with(['variants' => function ($query) {
            $query->where('is_show', 1)
                ->join('product_sizes', 'variants.product_size_id', '=', 'product_sizes.id')
                ->select('variants.*', 'product_sizes.name as name')
                ->orderBy('product_sizes.name');
        }, 'productImages'])->findOrFail($id);

        // Tính toán và cập nhật average_rating nếu cần
        $product->average_rating = $product->calculateAverageRating();
        $product->save();


        $reviews = $product->reviews()
            ->where('is_hidden', false)
            ->where(function ($query) {
                $query->whereNotNull('comment')
                    ->orWhereNotNull('image_url');
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        // Tìm biến thể có giá sale thấp nhất
        $lowestSaleVariant = $product->variants->whereNotNull('sale_price')->sortBy('sale_price')->first();

        // Lấy sản phẩm liên quan (cùng danh mục) và sắp xếp theo giá sale từ bé đến lớn
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['variants' => function ($query) {
                $query->where('is_show', 1)
                    ->whereNotNull('sale_price')
                    ->orderBy('sale_price', 'asc');
            }])
            ->get()
            ->sortBy(function ($product) {
                return $product->variants->min('sale_price');
            })
            ->sortByDesc('id')
            ->take(6);

        return view('client.product-details', compact('product', 'relatedProducts', 'lowestSaleVariant', 'reviews'));
    }

    public function filterProducts(Request $request)
    {
        $categoryId = $request->input('category_id');

        $products = Product::with(['variants' => function ($query) {
            // Lọc chỉ lấy biến thể có is_show = 1 và có giá sale
            $query->where('is_show', 1)
                ->whereNotNull('sale_price')
                ->orderBy('sale_price', 'asc');
        }])
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->orderBy('id', direction: 'desc')
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
            $query->where('is_show', 1)
                ->whereNotNull('sale_price')
                ->orderBy('sale_price', 'asc');
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
            $query->where('is_show', 1)
                ->whereNotNull('sale_price')
                ->orderBy('sale_price', 'asc');
        }])
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            // Lọc sản phẩm có giá sale thấp nhất nằm trong khoảng giá
            ->whereHas('variants', function ($query) use ($minPrice, $maxPrice) {
                $query->where('is_show', 1)
                    ->whereNotNull('sale_price')
                    ->groupBy('product_id') // Nhóm theo product_id
                    ->havingRaw('MIN(sale_price) >= ?', [$minPrice])
                    ->havingRaw('MIN(sale_price) <= ?', [$maxPrice]);
            })
            ->orderBy('id', 'desc')
            ->paginate(12);

        if ($request->ajax()) {
            return view('client.partials.product-list', compact('products'))->render();
        }

        return view('client.shop', compact('products'));
    }
}
