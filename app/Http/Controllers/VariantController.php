<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy tất cả sản phẩm
        $products = DB::table('products')->get();

        // Nếu có tìm kiếm theo product_id
        $productId = $request->input('product_id');

        // Lấy variants nếu có chọn sản phẩm
        $variants = DB::table('variants')
            ->join('products', 'variants.product_id', '=', 'products.id')
            ->join('product_sizes', 'variants.product_size_id', '=', 'product_sizes.id')
            ->select('variants.*', 'products.name as product_name', 'product_sizes.name as product_size');

        // Nếu có chọn sản phẩm
        if (!empty($productId)) {
            $variants = $variants->where('variants.product_id', $productId);
        }

        // Phân trang variants
        $variants = $variants->latest('variants.id')->paginate(10);

        return view('admin.variants.index', compact('variants', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Variant $variant)
    {
        $variantDetail = DB::table('variants')
            ->join('products', 'variants.product_id', '=', 'products.id')
            ->join('product_sizes', 'variants.product_size_id', '=', 'product_sizes.id')
            ->select('variants.*', 'products.name as product_name', 'product_sizes.name as product_size')
            ->where('variants.id', $variant->id)
            ->first();

        // Trả về view với dữ liệu variant
        return view('admin.variants.show', compact('variantDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Variant $variant)
    {
        // Lấy tất cả sản phẩm và kích thước để hiển thị trong form
        $products = DB::table('products')->pluck('name', 'id');
        $productSizes = DB::table('product_sizes')->pluck('name', 'id');

        return view('admin.variants.edit', compact('variant', 'products', 'productSizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variant $variant)
    {
        $request->validate([
            'stock' => 'required|integer',
            'listed_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'import_price' => 'required|numeric',
            'is_show' => 'required|boolean',
        ]);
        

        $data = $request->except('_token', '_method');

        DB::table('variants')->where('id', $variant->id)->update($data);

        return redirect()->route('variants.index')->with('success', 'Cập nhật sản phẩm biến thể thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variant $variant)
    {
        // Xóa variant
        DB::table('variants')->where('id', $variant->id)->delete();

        // Quay lại với thông báo thành công
        return redirect()->route('variants.index')->with('success', 'Xóa sản phẩm biến thể thành công!');
    }
}
