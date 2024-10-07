<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy dữ liệu tìm kiếm từ request
        $query = Product::query();

        // Tìm kiếm theo tên sản phẩm
        if ($request->filled('product_name')) {
            $query->where('name', 'like', '%' . $request->product_name . '%');
        }

        // Tìm kiếm theo danh mục sản phẩm
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Lấy danh sách sản phẩm sau khi lọc
        $listProducts = $query->orderByDesc('id')->paginate(10);

        // Truyền danh sách danh mục sản phẩm để hiển thị trong form
        $categories = Category::all();

        return view('admin.products.index', compact('listProducts', 'categories'));
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
