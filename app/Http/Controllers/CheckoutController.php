<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Cart;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    //
    public function checkout()
    {
        $user = Auth::user();
        $bills = Bill::where('user_id', $user->id)->get();

        // Lấy các mục giỏ hàng của người dùng từ database
        $cartItems = Cart::where('user_id', $user->id)->get();

        // Tính tổng giá của các sản phẩm trong giỏ hàng
        $total_price = $cartItems->sum(function ($item) {
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
    }

    public function processCheckout(Request $request)
    {

        $validateData = $request->validate([
            'full_name' => 'required|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            'email' => 'required|email',
            'address' => 'required',
            'payment_type' => 'required|in:cod,online',
        ]);

        DB::beginTransaction();

        try {
            $user_id = Auth::id();
            $cartItems = Cart::where('user_id', $user_id)->get();

            // Kiểm tra hàng tồn kho
            $outOfStockItems = [];
            foreach ($cartItems as $item) {
                if ($item->variant_quantity > $item->variants->stock) {
                    $outOfStockItems[] = [
                        'product_name' => $item->variants->product->name,
                        'available_stock' => $item->variants->stock,
                        'requested_quantity' => $item->variant_quantity,
                    ];
                }
            }

            if (!empty($outOfStockItems)) {
                return redirect()->route('tt-that-bai')->withErrors([
                    'error' => 'Một số sản phẩm không còn hàng: ' . implode(', ', array_column($outOfStockItems, 'product_name'))
                ]);
            }

            // Tính toán tổng giá
            $total_price = $cartItems->sum(function ($item) {
                return $item->variants->sale_price * $item->variant_quantity;
            });

            // // 7/11/2024
            // // Lấy số điểm hiện tại của người dùng
            // $user = Auth::user();
            // $userPoints = $user->points; // Điểm của người dùng

            // // Kiểm tra xem người dùng có chọn sử dụng điểm không
            // $discount = 0;
            // if ($request->has('points') && $request->points == '1') {
            //     // Lấy số điểm người dùng muốn sử dụng
            //     $pointsToUse = $request->input('points', 0);

            //     // Đảm bảo người dùng không sử dụng quá số điểm họ có
            //     $pointsToUse = min($pointsToUse, $userPoints);

            //     // Tính mức giảm giá
            //     $discount = $pointsToUse;
            //     $total_price -= $discount; // Trừ điểm vào tổng giá trị đơn hàng
            //     $user->points -= $discount; // Giảm số điểm của người dùng
            //     $user->save(); // Lưu lại số điểm mới
            // }

            // Tạo mã hóa đơn
            $code = 'BILL-' . strtoupper(uniqid());

            // Tạo hóa đơn
            $bill = Bill::create([
                'user_id' => $user_id,
                'code' => $code,
                'full_name' => $validateData['full_name'],
                'phone_number' => $validateData['phone_number'],
                'address' => $validateData['address'],
                'payment_type' => 'cod',
                'total_price' => $total_price,
                'bill_status' => 'pending',
                'payment_status' => 'pending',
            ]);

            // Lưu mỗi sản phẩm trong hóa đơn
            foreach ($cartItems as $item) {
                BillItem::create([
                    'variant_id' => $item->variant_id,
                    'bill_id' => $bill->id,
                    'sale_price' => $item->variants->sale_price,
                    'listed_price' => $item->variants->listed_price,
                    'import_price' => $item->variants->import_price,
                    'variant_quantity' => $item->variant_quantity,
                    'product_name' => $item->variants->product->name,
                    'product_image_url' => $item->variants->product->primary_image_url,
                ]);

                // Giảm số lượng hàng tồn kho
                $item->variants->decrement('stock', $item->variant_quantity);
            }

            Cart::where('user_id', $user_id)->delete();

            DB::commit();

            // Gửi email xác nhận đơn hàng đến email của khách hàng
            $userEmail = Auth::user()->email;
            Mail::to($userEmail)->send(new OrderConfirmationMail($bill));

            return view('client.tt-thanh-cong', compact('bill'));
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Checkout error: ' . $e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại sau.']);
        }
    }

    public function processVNPAY(Request $request)
    {

        $validateData = $request->validate([
            'full_name' => 'required|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            'email' => 'required|email',
            'address' => 'required',

            'payment_type' => 'required|in:online',
        ]);

        DB::beginTransaction();

        try {
            $user_id = Auth::id();
            $cartItems = Cart::where('user_id', $user_id)->get();

            // Kiểm tra hàng tồn kho
            $outOfStockItems = [];
            foreach ($cartItems as $item) {
                if ($item->variant_quantity > $item->variants->stock) {
                    $outOfStockItems[] = [
                        'product_name' => $item->variants->product->name,
                        'available_stock' => $item->variants->stock,
                        'requested_quantity' => $item->variant_quantity,
                    ];
                }
            }

            if (!empty($outOfStockItems)) {
                return redirect()->route('tt-that-bai')->withErrors([
                    'error' => 'Một số sản phẩm không còn hàng: ' . implode(', ', array_column($outOfStockItems, 'product_name'))
                ]);
            }

            // Tính tổng giá
            $total_price = $cartItems->sum(function ($item) {
                return $item->variants->sale_price * $item->variant_quantity;
            });

            $code = 'BILL-' . strtoupper(uniqid());

            // Tạo hóa đơn
            $bill = Bill::create([
                'user_id' => $user_id,
                'code' => $code,
                'full_name' => $validateData['full_name'],
                'phone_number' => $validateData['phone_number'],
                'address' => $validateData['address'],
                'payment_type' => 'online',
                'total_price' => $total_price,
                'bill_status' => 'pending',
                'payment_status' => 'pending',
            ]);
            Log::info('Created bill:', [
                'bill_code' => $bill->code,
                'user_id' => $user_id,
                'total_price' => $total_price,
            ]);

            Cart::where('user_id', $user_id)->delete();
            DB::commit();

            foreach ($cartItems as $item) {
                BillItem::create([
                    'variant_id' => $item->variant_id,
                    'bill_id' => $bill->id,
                    'sale_price' => $item->variants->sale_price,
                    'listed_price' => $item->variants->listed_price,
                    'import_price' => $item->variants->import_price,
                    'variant_quantity' => $item->variant_quantity,
                    'product_name' => $item->variants->product->name,
                    'product_image_url' => $item->variants->product->primary_image_url,
                ]);


                $item->variants->decrement('stock', $item->variant_quantity);
            }


            $vnp_TxnRef = $code;
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('checkout.vnpay.return');
            $vnp_TmnCode = "KA1BV3N8";
            $vnp_HashSecret = "12GUKMUAGMQR4QW57D26MKG56RCYN9G8";

            $vnp_OrderInfo = "Thanh toán VNPAY - Mã đơn hàng: " . $vnp_TxnRef;
            $vnp_Amount = $total_price * 100;
            $vnp_Locale = "VN";
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            // Chuẩn bị dữ liệu gửi đến VNPAY
            $inputData = [
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => 'billpayment',
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            ];

            // Sắp xếp và tạo chuỗi truy vấn
            ksort($inputData);
            $hashdata = http_build_query($inputData);
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $query = $hashdata . '&vnp_SecureHash=' . $vnpSecureHash;

            // Ghi log thông tin trước khi gửi đến VNPAY
            Log::info('Preparing data for VNPAY', [
                'vnp_TxnRef' => $vnp_TxnRef,
                'vnp_Amount' => $vnp_Amount,
                'vnp_OrderInfo' => $vnp_OrderInfo,
                'vnp_ReturnUrl' => $vnp_Returnurl,
                'vnp_IpAddr' => $vnp_IpAddr,
            ]);

            // Chuyển hướng đến VNPAY
            return redirect($vnp_Url . "?" . $query);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('VNPAY transaction error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại sau.']);
        }
    }


    public function returnFromVNPAY(Request $request)
    {
        Log::info('VNPAY return response:', $request->all());

        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        $vnp_SecureHash = $request->input('vnp_SecureHash');

        // Kiểm tra mã bảo mật
        $vnp_HashSecret = "12GUKMUAGMQR4QW57D26MKG56RCYN9G8";
        $inputData = $request->except('vnp_SecureHash');
        ksort($inputData);
        $hashdata = http_build_query($inputData);
        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        // Ghi log kiểm tra hóa đơn
        Log::info('Checking bill for TxnRef:', [
            'txn_ref' => $vnp_TxnRef,
            'bill_check' => Bill::where('code', $vnp_TxnRef)->first(), // Kiểm tra hóa đơn
        ]);

        // Kiểm tra mã giao dịch và mã bảo mật
        if ($vnp_ResponseCode == '00' && $secureHash == $vnp_SecureHash) {
            // Kiểm tra hóa đơn
            $bill = Bill::where('code', $vnp_TxnRef)->first();
            if ($bill) {
                // Cập nhật trạng thái hóa đơn
                $bill->payment_status = 'completed';
                $bill->bill_status = 'pending';
                $bill->save();

                $userEmail = Auth::user()->email;
                Mail::to($userEmail)->send(new OrderConfirmationMail($bill));

                return view('client.tt-thanh-cong', compact('bill'));
            } else {
                Log::error('Bill not found for TxnRef: ' . $vnp_TxnRef);
                return redirect()->route('tt-that-bai')->withErrors(['error' => 'Không tìm thấy hóa đơn.']);
            }
        } else {
            return redirect()->route('tt-that-bai')->withErrors(['error' => 'Thanh toán không thành công.']);
        }
    }
}
