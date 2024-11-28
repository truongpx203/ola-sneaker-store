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
use Carbon\Carbon;

class CartController extends Controller
{

    public function updateAll(Request $request)
    {
        $body = $request->all();
        $listId = $body['id'];
        $listQuantity = $body['variant_quantity'];
        $listVariantId = $body['variant_id'];

        $errors = [];
        for ($i = 0; $i < count($listId); $i++) {
            $variant = Variant::find($listVariantId[$i]);

            if (!$variant) {
                $errors[] = "Sản phẩm với ID {$listVariantId[$i]} không tồn tại.";
                continue;
            }
            $productName = $variant->product->name;

            if ($variant->stock < $listQuantity[$i]) {
                $errors[] = "Sản phẩm '{$productName}' không đủ số lượng trong kho (còn lại {$variant->stock}).";
            }
        }
        if (!empty($errors)) {
            return redirect()->back()->with('error', implode('<br>', $errors));
        }
        Cart::where('user_id', Auth::id())->delete();
        for ($i = 0; $i < count($listId); $i++) {
            Cart::create([
                'user_id' => Auth::id(),
                'variant_id' => $listVariantId[$i],
                'variant_quantity' => $listQuantity[$i],
            ]);
        }

        return redirect()->back()->with('success', 'Giỏ hàng được cập nhật thành công.');
    }

    public function showCart()
    {
        $productSizes = ProductSize::all();
        $carts = Cart::where('user_id', Auth::id())->with('variant.product')->get();
        $provisional = $carts->sum(function ($cart) {
            return $cart->variant->sale_price * $cart->variant_quantity;
        });

        $discount = 0;
        $cartTotal = $provisional;

        if (session()->has('coupon')) {
            $voucher = session('coupon');
            $discount = $voucher->value;
            $discountAmount = $provisional * ($discount / 100);

            //giới hạn số tiền giảm tối đa
            if ($discountAmount > $voucher->max_price) {
                $discountAmount = $voucher->max_price;
            }
            $cartTotal = $provisional - $discountAmount;
        }

        return view('client.shop-cart', compact('carts', 'discount', 'provisional', 'cartTotal'));
    }

    public function addToCart(Request $request)
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }

        // Validate dữ liệu từ request
        $request->validate([
            'variant_id' => 'required|exists:variants,id',
            'variant_quantity' => 'required|integer|min:1',
        ]);

        // Tìm variant từ cơ sở dữ liệu
        $variant = Variant::find($request->variant_id);

        // Kiểm tra số lượng tồn kho
        if ($variant->stock < $request->variant_quantity) {
            session()->flash('swal', [
                'icon' => 'warning',
                'text' => 'Số lượng sản phẩm trong kho không đủ.',
                'confirmButtonText' => 'OK',
            ]);
            return redirect()->back();
        }

        // Tìm sản phẩm đã có trong giỏ hàng của user
        $cart = Cart::where('user_id', Auth::id())
            ->where('variant_id', $request->variant_id)
            ->first();

        // Nếu sản phẩm đã có trong giỏ hàng thì cập nhật số lượng
        if ($cart) {
            // Kiểm tra nếu tổng số lượng không vượt quá tồn kho
            if (($cart->variant_quantity + $request->variant_quantity) > $variant->stock) {
                session()->flash('swal', [
                    'icon' => 'warning',
                    'text' => 'Sản phẩm này trong giỏ hàng của bạn đã có tối đa sản phẩm trong kho.',
                    'confirmButtonText' => 'OK',
                ]);
                return redirect()->back();
            }
            $cart->variant_quantity += $request->variant_quantity;
            $cart->save();
        } else {
            // Nếu chưa có thì tạo mới
            Cart::create([
                'user_id' => Auth::id(),
                'variant_id' => $request->variant_id,
                'variant_quantity' => $request->variant_quantity,
            ]);
        }

        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Sản phẩm đã được thêm vào giỏ hàng.',
            'confirmButtonText' => 'OK',
        ]);

        return redirect()->route('cart.show')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    // xóa từng sản phẩm trong giỏ hàng
    public function removeItem($id)
    {
        Cart::where('id', $id)->delete();
        return response()->json(['success' => 'Sản phẩm đã được xóa khỏi giỏ hàng.']);
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
        $forUserIds = json_decode($voucher->for_user_ids, true);
        $checkVoucher = false;
        foreach ($forUserIds as $forId) {
            if ($forId == Auth::user()->id) {
                $checkVoucher = true;
            }
        }
        if (!$checkVoucher) {
            session()->forget('coupon');
            return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ');
        }
        // Kiểm tra ngày giờ hiện tại so với ngày bắt đầu và ngày kết thúc của voucher
        $currentDateTime = now();
        // Kiểm tra ngày bắt đầu
        $startDateTime = Carbon::parse($voucher->start_datetime);  // Chuyển ngày bắt đầu của voucher sang đối tượng Carbon
        $endDateTime = Carbon::parse($voucher->end_datetime);  // Chuyển ngày kết thúc của voucher sang đối tượng Carbon

        // Nếu thời gian hiện tại trước ngày bắt đầu hoặc sau ngày kết thúc, không cho dùng voucher
        if ($currentDateTime->lt($startDateTime) || $currentDateTime->gt($endDateTime)) {
            session()->forget('coupon');
            return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ do thời gian không hợp lệ');
        }
        session(['coupon' => $voucher]);

        return redirect()->back()->with('success', 'Mã giảm giá đã được áp dụng');
    }
}
