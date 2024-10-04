<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSizeRequest;
use App\Models\ProductSize;

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
        return redirect()->route('dashboard.size.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productSize = ProductSize::find($id);
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
        return redirect()->route('dashboard.size.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $productSizes = ProductSize::find($id);
        $productSizes->delete();
        return redirect()->route('dashboard.size.index');
    }
}
