<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BillItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showNewProducts()
    {
        $products = Product::with(['variants' => function ($query) {
            $query->where('is_show', 1) // Chỉ lấy biến thể có is_show bằng 1
                ->whereNotNull('sale_price') // Chỉ lấy biến thể có giá sale
                ->orderBy('sale_price', 'asc');
        }])->where('is_visible', 1)->orderBy('id', 'desc')->take(16)->get();

        // Lấy sản phẩm bán chạy nhất
        $topBanChayNhat = DB::table('products')
            ->join('variants', 'products.id', '=', 'variants.product_id') // Join với bảng variants
            ->join('bill_items', 'variants.id', '=', 'bill_items.variant_id') // Join với bảng bill_items
            ->join('bills', 'bill_items.bill_id', '=', 'bills.id') // Join với bảng bills
            ->select(
                'products.id as product_id',
                'products.name as product_name',
                'products.primary_image_url',
                DB::raw('SUM(bill_items.variant_quantity) as total_quantity'), // Tổng số lượng sản phẩm đã bán
                DB::raw('(SELECT MIN(v.sale_price) FROM variants v WHERE v.product_id = products.id AND v.is_show = 1 AND v.sale_price IS NOT NULL) as min_sale_price'), // Giá sale thấp nhất
                DB::raw('(SELECT listed_price FROM variants v WHERE v.product_id = products.id AND v.sale_price = (SELECT MIN(v2.sale_price) FROM variants v2 WHERE v2.product_id = products.id AND v2.is_show = 1 AND v2.sale_price IS NOT NULL) LIMIT 1) as listed_price') // Giá niêm yết của biến thể có giá sale thấp nhất
            )
            ->whereIn('bills.bill_status', ['delivered', 'completed']) // Lấy đơn hàng đã giao và hoàn thành
            ->where('products.is_visible', 1) 
            ->whereNotNull('variants.sale_price') // Chỉ lấy biến thể có giá sale
            ->groupBy('products.id', 'products.name', 'products.primary_image_url') // Nhóm theo sản phẩm
            ->orderBy('total_quantity', 'desc') // Sắp xếp theo tổng số lượng bán
            ->take(8) // Giới hạn số lượng sản phẩm
            ->get();


        return view('client.home', compact('products', 'topBanChayNhat'));
    }

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
