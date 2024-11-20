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
        }])->where('is_visible', 1)->orderBy('id', 'desc')->take(8)->get();

        return view('client.home', compact('products'));
    }

    // show sản phẩm bán chạy nhất

    // public function showTopSellingProducts(){
    //     $productsTopSelling = Product::with(['variants' => function ($query) {
    //         $query->where('is_show', 1) // Only variants that are visible
    //               ->whereNotNull('sale_price') // Only variants with a sale price
    //               ->orderBy('sale_price', 'asc');
    //     }])
    //     ->where('is_visible', 1) // Only products that are visible
    //     ->join('variants', 'products.id', '=', 'variants.product_id') // Join products with variants
    //     ->join('bill_items', 'variants.id', '=', 'bill_items.variant_id') // Join with bill items to count sales
    //     ->selectRaw('products.*, SUM(bill_items.variant_quantity) as total_quantity_sold') // Calculate total quantity sold
    //     ->groupBy('products.id') // Group by product ID
    //     ->orderByDesc('total_quantity_sold') // Order by total sales
    //     ->take(8) // Limit to 8 products
    //     ->get();
    
    //     return view('client.home', compact('productsTopSelling'));
    // }

    public function show($id)
    {
        $product = Product::with(['variants' => function ($query) {
            $query->where('is_show', 1)
                ->join('product_sizes', 'variants.product_size_id', '=', 'product_sizes.id')
                ->select('variants.*', 'product_sizes.name as name')
                ->orderBy('product_sizes.name');
        }, 'productImages'])->where('is_visible', 1)->findOrFail($id);

        // Tính toán và cập nhật average_rating 
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
            ->where('is_visible', 1)
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
            ->where('is_visible', 1)
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
            ->where('is_visible', 1)
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
            ->where('is_visible', 1)
            ->orderBy('id', 'desc')
            ->paginate(12);

        if ($request->ajax()) {
            return view('client.partials.product-list', compact('products'))->render();
        }

        return view('client.shop', compact('products'));
    }
}
