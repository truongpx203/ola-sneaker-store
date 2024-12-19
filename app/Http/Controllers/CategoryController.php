<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('categories')->latest('id');
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        $data = $query->paginate(10);
        return view('admin.categories.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =  $request->validate(
            [
                'name' => 'required|unique:categories,name|max:50|regex:/^[^\d]*$/'
            ],
            [
                'name.unique'   => 'Danh mục đã tồn tại, vui lòng chọn tên danh mục khác.',
                'name.required' => 'Tên danh mục không được để trống.',
                'name.max'      => 'Tên danh mục không được vượt quá 50 ký tự.',
                'name.regex'    => 'Tên danh mục không được chứa số.',
            ]
        );

        Category::create($data);

        return redirect()->route('categories.index')->with('message', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, $id)
    {
        //
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, $id)
    {
        //
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, $id)
    {
        //
        $data =  $request->validate(
            [
                'name' => 'required|max:50|regex:/^[^\d]*$/'
            ],
            [
                'name.required' => 'Tên danh mục không được để trống.',
                'name.max'      => 'Tên danh mục không được vượt quá 50 ký tự.',
                'name.regex'    => 'Tên danh mục không được chứa số.',
            ]
        );
        
        $category->where('id', $id)->update($data);
        return back()->with('message', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        // Kiểm tra xem danh mục có sản phẩm hay không
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Có sản phẩm trong danh mục này không thể xóa!');
        }

        $category->delete();
        return back()->with('message', 'Xóa danh mục thành công.');
    }
}
