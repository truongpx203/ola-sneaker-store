<?php

namespace App\Http\Controllers;

use App\Models\ProductSize;
use Illuminate\Http\Request;
use App\Http\Requests\ProductSizeRequest;
use App\Models\Variant;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productSizes = ProductSize::query()->get();

        return view('admin.productsizes.index', compact('productSizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.productsizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductSizeRequest $request)
    {
        $productSizes = ProductSize::create($request->all());
        session()->flash('success', 'Thành công! Dữ liệu đã được lưu.');
        return redirect()->route('productsize.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productSize = ProductSize::find($id);
        $variants = Variant::query()->where('product_size_id', $id)->first();
        if ($variants) {
            return redirect()->route('productsize.index')
                ->withErrors(['error_size' => 'Kích thước ' . $productSize->name . ' đang được sử dụng không thể sửa']);
        }
        return view('admin.productsizes.edit', compact('productSize'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductSizeRequest $request, $id)
    {
        $productSize = ProductSize::find($id);
        $productSize->update([
            'name' => $request->name
        ]);
        return redirect()->route('productsize.index')->with('success', 'Thành công! Dữ liệu đã được thêm.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $productSizes = ProductSize::find($id);
        $variants = Variant::query()->where('product_size_id', $id)->first();

        if ($variants) {
            return redirect()->route('productsize.index')
                ->withErrors(['error_size' => 'Kích thước "' . $productSizes->name . '" đang được sử dụng không thể xóa']);
        }

        $productSizes->delete();
        //    dd(session()->all());
        return redirect()->route('productsize.index')
            ->with('success', 'Thành công! Dữ liệu đã được xóa.');

    }
}
