<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function productList(Request $request)
     {
         $categories = $request->input('category', []); 
         $minPrice = $request->input('min_price', 0); 
         $maxPrice = $request->input('max_price', 500); 
         $brands = $request->input('brand', []);
      
         // Khởi tạo query
         $query = DB::table('products');
     
         // Lọc theo danh mục
         if (!empty($categories)) {
             $query->whereIn('category', $categories);
         }
     
         // Lọc theo giá
         if ($minPrice !== null && $maxPrice !== null) {
             $query->whereBetween('price', [$minPrice, $maxPrice]);
         }
     
         // Lọc theo thương hiệu
         if (!empty($brands)) {
             $query->whereIn('brand', $brands);
         }
     
         // Paginate kết quả
        //  dd($query->toSql(), $query->getBindings());

         $products = $query->get();
     
         return view('client.product_list', compact('products'));
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
