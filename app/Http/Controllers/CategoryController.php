<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\DB;
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
<<<<<<< HEAD
=======
        $data = DB::table('categories')->latest('id')->paginate(10);
        return view('admin.categories.index', compact('data'));
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
<<<<<<< HEAD
=======
        return view('admin.categories.create');
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
<<<<<<< HEAD
=======
        DB::table('categories')->insert([
            'name' => $request->name
        ]);
        return redirect()->route('categories.index')->with('message', 'Thêm mới thành công');
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }

    /**
     * Display the specified resource.
     */
<<<<<<< HEAD
    public function show(Category $category)
    {
        //
=======
    public function show(Category $category, $id)
    {
        //
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.categories.show', compact('category'));
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }

    /**
     * Show the form for editing the specified resource.
     */
<<<<<<< HEAD
    public function edit(Category $category)
    {
        //
=======
    public function edit(Category $category, $id)
    {
        //
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.categories.edit', compact('category'));
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }

    /**
     * Update the specified resource in storage.
     */
<<<<<<< HEAD
    public function update(Request $request, Category $category)
    {
        //
=======
    public function update(Request $request, Category $category, $id)
    {
        //
        DB::table('categories')->where('id', $id)->update([
            'name'=>$request->name
        ]);
        return redirect()->route('categories.index')->with('message', 'Cập nhật thành công');
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }

    /**
     * Remove the specified resource from storage.
     */
<<<<<<< HEAD
    public function destroy(Category $category)
    {
        //
=======
    public function destroy(Category $category, $id)
    {
        //
        DB::table('categories')->where('id', $id)->delete();
        return back()->with('message', 'Xóa thành công');
>>>>>>> 4babb3bbeedede67b1ee8a0e1a8e338277a9f568
    }
}
