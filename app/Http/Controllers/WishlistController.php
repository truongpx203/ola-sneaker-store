<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hiển thị danh sách yêu thích của người dùng
        $wishlists = Wishlist::where('user_id', Auth::id())->with('product')->get();

        return view('client.shop-wishlist', compact('wishlists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào yêu thích.');
        }

        $user = Auth::user();
        $product_id = $request->input('product_id');

        // Kiểm tra xem sản phẩm có tồn tại không
        $product = Product::find($product_id);
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        // Kiểm tra xem sản phẩm đã có trong wishlist chưa
        $wishlist = Wishlist::where('user_id', $user->id)->where('product_id', $product_id)->first();

        if ($wishlist) {
            return redirect()->route('wishlist.index')->with('info', 'Sản phẩm đã có trong danh sách yêu thích.');
        }

        // Thêm sản phẩm vào wishlist
        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $product_id,
            'is_available' => true,
        ]);

        return redirect()->route('wishlist.index')->with('success', 'Đã thêm sản phẩm vào danh sách yêu thích.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        // Xóa mục khỏi danh sách yêu thích
        $wishlist->delete();

        // Chuyển hướng về trang danh sách yêu thích với thông báo thành công
        return redirect()->route('wishlist.index')->with('success', 'Đã xóa sản phẩm khỏi danh sách yêu thích.');
    }
}
