<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

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
        $categories = Category::all();

        $productSizes = ProductSize::all();

        return view('admin.products.create', compact('categories', 'productSizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        try {
            // Lưu sản phẩm
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->code = $request->code;
            $product->summary = $request->summary;
            $product->detailed_description = $request->detailed_description;

            // Xử lý upload ảnh
            if ($request->hasFile('primary_image_url')) {
                $image = $request->file('primary_image_url');
                $path = $image->store('products', 'public');
                $product->primary_image_url = $path;
            }
            $product->save();

            // Lưu các biến thể size
            foreach ($request->variants as $variant) {
                $product->variants()->create([
                    'product_id' => $product->id,
                    'product_size_id' => $variant['size_id'],
                    'stock' => $variant['stock'],
                    'listed_price' => $variant['listed_price'],
                    'sale_price' => $variant['sale_price'],
                    'import_price' => $variant['import_price'],
                    'is_show' => $variant['is_show'],
                ]);
            }

            // // Lưu gallery ảnh
            if ($request->hasFile('product_galleries')) {
                foreach ($request->file('product_galleries') as $gallery) {
                    $path = $gallery->store('product_galleries/'. $product->id, 'public');
                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image_url' => $path,
                        'image_order' => 1,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Sản phẩm được thêm thành công!');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm sản phẩm mới. Vui lòng thử lại sau.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['variants', 'productImages', 'category']);

        $productSizes = ProductSize::all();

        return view('admin.products.show', compact('product', 'productSizes'));
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
