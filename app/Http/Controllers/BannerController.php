<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();

        return view("admin.banner.index", compact("banners"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.banner.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('image')->store('banners', 'public');

        Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $path,
            'link' => $request->link,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('banners.index')->with('success', 'Banner đã được thêm.');
    }

    /**
     * Display the specified resource.
     */

    //  public function edit(Banner $banner)
    //  {
    //      return view('admin.banners.edit', compact('banner'));
    //  }

    public function update(Request $request,$id)
    {
        $banner = Banner::findOrFail($id);

        $banner->is_active = $request->has('is_active') ? true : false;

        $banner->save();
        return redirect()->back()->with('success', "Cập nhật trạng thái thành công !!");
    }
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner đã được xóa.');
    }
    public function showSlider()
    {
        $banner = Banner::where('is_active', true)->take(5)->get();
        // dd($banner);
        return view('client.home', compact('banner'));
    }
}
