<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Cart;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        // return view('client.shop-checkout', compact('cartItems','user', 'bills'));
    }

    public function processCheckout(Request $request)
    {
        // Validate the request data
        $validateData = $request->validate(
            [
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
                'payment_type.in' => 'Phương thức thanh toán không hợp lệ, vui lòng chọn COD hoặc Online.'
            ]
        );
        DB::beginTransaction();

        try {


            $user_id = Auth::id();

            $cartItems = Cart::where('user_id', $user_id)->get();
            // foreach ($cartItems as $item) {
            //     $variant = Variant::lockForUpdate()->find($item->variant_id); 
            //     if ($variant->stock < $item->variant_quantity) {
            //         
            //         DB::rollBack();
            //         return redirect()->back()->withErrors(['stock' => 'Sản phẩm ' . $variant->product->name . ' đã hết hàng hoặc không đủ số lượng.']);
            //     }
            // }
          
            $total_price = $cartItems->sum(function ($item) {
                return $item->variants->sale_price * $item->variant_quantity;
            });

            $code = 'BILL-' . strtoupper(uniqid()); // Generate bill code

            // Create the bill (pending status initially)
            $bill = Bill::create([
                'user_id' => $user_id,
                'code' => $code,
                'full_name' => $validateData['full_name'],
                'phone_number' => $validateData['phone_number'],
                'address' => $validateData['address'],
                'payment_type' => $validateData['payment_type'],
                'total_price' => $total_price,
                'bill_status' => 'pending',
                'payment_status' => 'pending',
            ]);

            // Process payment based on payment type (COD or Online)
            if ($validateData['payment_type'] === 'COD') {
                // Return success page if COD is selected
                return view('client.tt-thanh-cong');
            } elseif ($validateData['payment_type'] === 'Online') {
                // Handle VNPAY online payment
                $vnp_TxnRef = $code; // Use the generated bill code as transaction reference
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = "http://127.0.0.1:8000/tt-thanh-cong ";
                $vnp_TmnCode = "KA1BV3N8"; // Your VNPAY website code
                $vnp_HashSecret = "12GUKMUAGMQR4QW57D26MKG56RCYN9G8"; // Your VNPAY secret key

                $vnp_OrderInfo = "Thanh toán VNPAY - Mã đơn hàng: " . $vnp_TxnRef;
                $vnp_OrderType = 'billpayment';
                $vnp_Amount = $total_price * 100; // Amount in VND (multiplied by 100 for VNPAY)
                $vnp_Locale = "VN";
                $vnp_BankCode = "NCB"; // Bank code
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // User's IP address

                // Prepare data for VNPAY
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
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,
                ];

                // Include bank code if available
                if (!empty($vnp_BankCode)) {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }

                // Sort data and create a query string
                ksort($inputData);
                $query = "";
                $hashdata = "";
                $i = 0;
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                // Generate secure hash for VNPAY
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                    $query .= 'vnp_SecureHash=' . $vnpSecureHash;
                }

                // Redirect to VNPAY payment URL
                $vnp_Url .= "?" . $query;
                return redirect($vnp_Url);
            }

            // Default return (though it should never reach this point if logic is handled correctly)
            return redirect()->route('checkout.success');
        } catch (\Exception $e) {
            // Rollback the transaction on any error
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại sau.']);
        }
        // $user = Auth::user();

    }

}
