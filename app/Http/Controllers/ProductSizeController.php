<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\ProductSize;
use Illuminate\Http\Request;
=======
use App\Http\Requests\ProductSizeRequest;
use App\Models\ProductSize;
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
        //
=======
        $productSizes = ProductSize::query()->get();
        return view('admin.productsizes.index', compact('productSizes'));
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        //
=======
        return view('admin.productsizes.create');
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }

    /**
     * Store a newly created resource in storage.
     */
<<<<<<< HEAD
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductSize $productSize)
    {
        //
=======
    public function store(ProductSizeRequest $request)
    {
        $productSizes = ProductSize::create($request->all());
        return redirect()->route('dashboard.size.index');
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }

    /**
     * Show the form for editing the specified resource.
     */
<<<<<<< HEAD
    public function edit(ProductSize $productSize)
    {
        //
=======
    public function edit($id)
    {
        $productSize = ProductSize::find($id);
        return view('admin.productsizes.edit', compact('productSize'));
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }

    /**
     * Update the specified resource in storage.
     */
<<<<<<< HEAD
    public function update(Request $request, ProductSize $productSize)
    {
        //
=======
    public function update(ProductSizeRequest $request, $id)
    {
        $productSize = ProductSize::find($id);
        $productSize->update([
            'name' => $request->name
        ]);
        return redirect()->route('dashboard.size.index');
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }

    /**
     * Remove the specified resource from storage.
     */
<<<<<<< HEAD
    public function destroy(ProductSize $productSize)
    {
        //
=======
    public function destroy($id)
    {
        $productSizes = ProductSize::find($id);
        $productSizes->delete();
        return redirect()->route('dashboard.size.index');
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }
}
