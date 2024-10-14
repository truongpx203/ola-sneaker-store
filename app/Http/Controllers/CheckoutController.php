<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    //
    public function checkout(){
        $user = Auth::user();
        $bills = Bill::where('user_id', $user->id)->get();

        // Lấy các mục giỏ hàng của người dùng từ database
        $cartItems = Cart::where('user_id', $user->id)->get();

        // Tính tổng giá của các sản phẩm trong giỏ hàng
        $total_price = $cartItems->sum(function($item) {
            return $item->variants->sale_price * $item->variant_quantity;
        });

        // Lấy thông tin hóa đơn nếu cần
        $bills = Bill::where('user_id', $user->id)->get();

        // Trả về view kèm dữ liệu giỏ hàng và tổng giá
        return view('client.shop-checkout', [
            'cartItems' => $cartItems,
            'total_price' => $total_price,
            'user' => $user,
            'bills' => $bills
        ]);
        // return view('client.shop-checkout', compact('cartItems','user', 'bills'));
    }

    public function processCheckout(Request $request){
        $validateData = $request->validate([
            'full_name' => 'required|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            'email' => 'required|email',
            'address' => 'required',
            'payment_type' => 'required|in:COD,Online'
        ],
        [
            'full_name.required' => 'Tên không được bỏ trống',
            'phone_number.required' => 'Số điện thoại không được bỏ trống',
            'email.email' => 'Email không được bỏ trống',
            'address.required' => 'Địa chỉ không được bỏ trống',
            // 'payment_status.required' => 'Vui lòng chọn phương thức thanh toán'
            'payment_type.in' => 'Phương thức thanh toán không hợp lệ, vui lòng chọn COD hoặc Online.',
            'payment_type' => 'Phương thức thanh toán không hợp lệ, vui lòng chọn COD hoặc Online.'
        ]
    );
    $user = Auth::user();
    $user_id = Auth::id();

    $cartItems = Cart::where('user_id', $user_id)->get();
    
    // $cartItems = Cart::with('variants.product') // Giả sử có một quan hệ với model Product
    //     ->where('user_id', Auth::id())
    //     ->get();

    // $total_price = 0;

    // // foreach ($cartItems as $item) {
    // //         $total_price += $item->price * $item->quantity; // Tính tổng giá
    // // }

    // Tính tổng giá
    $total_price = $cartItems->sum(function($item) {
        return $item->variants->sale_price * $item->variant_quantity;
    });

    $code = 'BILL-' . strtoupper(uniqid()); // Tạo mã hóa đơn

    Bill::create([
        'user_id' =>$user_id,
        'code' => $code,
        'full_name' => $validateData['full_name'],
        'phone_number' => $validateData['phone_number'],
        'address' => $validateData['address'],
        'payment_type' => $validateData['payment_type'],
        'total_price' => $total_price // Gán giá trị cho trường total_price
    ]);

    return view('client.shop-checkout', compact('cartItems', 'total_price', 'user'));
    }


}
