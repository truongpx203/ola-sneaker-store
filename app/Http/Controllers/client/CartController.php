<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VariantController;
use App\Models\Cart as ModelsCart;
use Illuminate\Http\Request;
use App\Models\Variant;
use App\Models\client\Cart;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class CartController extends Controller
{

    public function updateAll(Request $request){
        $body = $request->all();
        $listId = $body['id'];
        $listQuantity = $body['variant_quantity'];
        $listVariantId = $body['variant_id'];
        Cart::where('user_id', Auth::id())->delete();

        for ($i=0; $i < count($listId); $i++) { 
            // $cart = Cart::find(id: $listId[$i]);
            // // Cập nhật số lượng sản phẩm trong giỏ hàng
            // $cart->variant_quantity = $listQuantity[$i];
            // $cart->save();
            Cart::create([
                'user_id' => Auth::id(),
                'variant_id' => $listVariantId[$i],
                'variant_quantity' => $listQuantity[$i],
            ]);
        }
        return redirect()->back()->with('success', 'Giỏ hàng được cập nhật thành công');
    }

    public function showCart()
    {
        $productSizes = ProductSize::all();
        $carts = Cart::where('user_id', Auth::id())->with('variant')->get();

        // Tính tổng tiền giỏ hàng
        $provisional = $carts->sum(function ($cart) {
            return $cart->variant->sale_price * $cart->variant_quantity;
        });
    
        $discount = 0; 
        if (session()->has('coupon')) {
            $voucher = session('coupon');
            $discount =$voucher->value; 
            $discountAmount = $provisional * ($discount / 100); // Tính số tiền giảm giá
            // Nếu có giới hạn số tiền giảm tối đa
            if ($discountAmount >$voucher->max_price) {
                $discountAmount = $voucher->max_price;
            }
            //
            // Cập nhật tổng tiền sau khi trừ giảm giá
            $cartTotal = $provisional - $discountAmount;
        }
            return view('client.shop-cart', compact('carts', 'discount','provisional','cartTotal'));
    }
    public function addToCart(Request $request)
{
        $request->validate([
            'variant_id' => 'required|exists:variants,id',
            'variant_quantity' => 'required|integer|min:1',
        ]);
        $cart= Cart::where('user_id', Auth::id())
                        ->where('variant_id', $request->variant_id)
                        ->first();

        if ($cart) {
            $cart->variant_quantity += $request->variant_quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'variant_id' => $request->variant_id,
                'variant_quantity' => $request->variant_quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    } 

//  xóa toàn bộ giỏ hàng
public function clear()
{
    Cart::truncate(); 

    return redirect()->route('cart.show')->with('success', 'Giỏ hàng đã được xóa.');
}
 
public function applyVoucher(Request $request)
{
    $validatedData = $request->validate([
        'couponCode' => 'required|string|exists:vouchers,code',  // Kiểm tra xem mã giảm giá có tồn tại không
    ], [
        'couponCode.string' => 'Mã giảm giá phải là một chuỗi ký tự.',
        'couponCode.exists' => 'Mã giảm giá không hợp lệ.',
    ]);
    $voucher = Voucher::where('code', $validatedData['couponCode'])->first();
    if (!$voucher) {
        return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ');
    }
    session(['coupon' => $voucher]);

    return redirect()->back()->with('success', 'Mã giảm giá đã được áp dụng');
}
 
    
}