<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

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
            $product->detailed_description = html_entity_decode(strip_tags($request->detailed_description));

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
                    $path = $gallery->store('product_galleries/' . $product->id, 'public');
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
        $product->load(['variants', 'productImages', 'category']);

        $productSizes = ProductSize::all();

        return view('admin.products.edit', compact('product', 'productSizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        DB::beginTransaction();
        try {
            // Cập nhật thông tin sản phẩm
            $product->update([
                'name' => $request->name,
                'summary' => $request->summary,
                'detailed_description' => html_entity_decode(strip_tags($request->detailed_description)),
                'category_id' => $request->category_id,
            ]);
    
            // Xử lý ảnh chính (primary image)
            if ($request->hasFile('primary_image_url')) {
                $imagePath = $request->file('primary_image_url')->store('products', 'public');
                Storage::disk('public')->delete($product->primary_image_url);
                $product->update(['primary_image_url' => $imagePath]);
            }
    
            // Lưu danh sách các biến thể hiện có
            $currentVariants = $product->variants()->pluck('product_size_id')->toArray();
    
            // Xử lý cập nhật và thêm mới các biến thể
            $updatedVariantIds = []; // Lưu các ID biến thể đã cập nhật
    
            foreach ($request->variants as $variantData) {
                if (isset($variantData['size_id'])) {
                    $updatedVariantIds[] = $variantData['size_id'];
    
                    // Cập nhật biến thể đã tồn tại
                    $variant = $product->variants()->where('product_size_id', $variantData['size_id'])->first();
                    if ($variant) {
                        $variant->update([
                            'stock' => $variantData['stock'],
                            'listed_price' => $variantData['listed_price'],
                            'sale_price' => $variantData['sale_price'],
                            'import_price' => $variantData['import_price'],
                            'is_show' => $variantData['is_show'],
                        ]);
                    } else {
                        // Thêm biến thể mới nếu chưa tồn tại
                        $product->variants()->create([
                            'product_size_id' => $variantData['size_id'],
                            'stock' => $variantData['stock'],
                            'listed_price' => $variantData['listed_price'],
                            'sale_price' => $variantData['sale_price'],
                            'import_price' => $variantData['import_price'],
                            'is_show' => $variantData['is_show'],
                        ]);
                    }
                }
            }
    
            // Xóa các biến thể không còn tồn tại trong request
            foreach ($currentVariants as $currentVariantId) {
                if (!in_array($currentVariantId, $updatedVariantIds)) {
                    $product->variants()->where('product_size_id', $currentVariantId)->delete();
                }
            }
    
            // Xử lý cập nhật thư viện ảnh (gallery)
            if ($request->hasFile('product_galleries')) {
                foreach ($request->file('product_galleries') as $file) {
                    $imagePath = $file->store('product_galleries/' . $product->id, 'public');
                    $product->productImages()->create([
                        'image_url' => $imagePath,
                        'product_id' => $product->id,
                        'image_order' => 1,
                    ]);
                }
            }
    
            // Xóa các ảnh từ thư viện nếu có
            if ($request->filled('delete_galleries')) {
                foreach ($request->delete_galleries as $image_id => $image_url) {
                    $image = $product->productImages()->find($image_id);
                    if ($image) {
                        Storage::disk('public')->delete($image_url);
                        $image->delete();
                    }
                }
            }
    
            DB::commit();
            return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Cập nhật sản phẩm thất bại. Vui lòng thử lại.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->variants()->delete();

        if ($product->primary_image_url && Storage::disk('public')->exists($product->primary_image_url)) {
            Storage::disk('public')->delete($product->primary_image_url);
        }

        $hinhAnhFolder = 'product_galleries/' . $product->id;
        if (Storage::disk('public')->exists($hinhAnhFolder)) {
            Storage::disk('public')->deleteDirectory($hinhAnhFolder);
        }

        $product->productImages()->delete();

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công.');
    }
    public function search(Request $request) {
        $query = $request->input('name');
    $products = Product::where('name', 'like', '%' . $query . '%')->with('variants')->get();

    return view('client.search', compact('products', 'query'));
    }
}
