<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use App\Models\BillItem;
use App\Models\Cart;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderConfirmationMail;
use App\Models\Product;
use App\Models\VoucerHistory;
use App\Models\Voucher;
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

        // Kiểm tra nếu có voucher trong session
        if (session('voucher')) {
            $discountAmount = $total_price * (session('voucher.value') / 100);  // Tính giảm giá dựa trên tổng giỏ hàng
            // Giới hạn số tiền giảm tối đa
            if ($discountAmount > session('voucher.max_price')) {
                $discountAmount = session('voucher.max_price');
            }
            // Áp dụng giảm giá vào tổng giỏ hàng
            $total_price -= $discountAmount;
        }

        // Lấy số điểm của người dùng (7/11/2024)
        $userPoints = $user->points;

        // Lấy thông tin hóa đơn nếu cần
        $bills = Bill::where('user_id', $user->id)->get();

        // Trả về view kèm dữ liệu giỏ hàng và tổng giá
        return view('client.shop-checkout', [
            'cartItems' => $cartItems,
            'total_price' => $total_price,
            'user' => $user,
            'bills' => $bills,
            'userPoints' => $userPoints // Thêm số điểm vào view(7/11/2024)
        ]);
    }

    public function processCheckout(Request $request)
    {
        // Kiểm tra nếu giỏ hàng trống
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm trước khi thanh toán.']);
        }

        $validateData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            'address' => 'required|string|max:500',
            'payment_type' => 'required|in:cod,vnpay,momo',
            'points_to_use' => 'nullable|integer|min:0', // Validate số điểm(7/11/2024)
            'note' => 'nullable|string|max:1000',
        ], [
            'full_name.required' => 'Họ và tên là bắt buộc.',
            'full_name.string' => 'Họ và tên phải là chuỗi văn bản.',
            'full_name.max' => 'Họ và tên không được vượt quá :max ký tự.',

            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.regex' => 'Số điện thoại phải là chuỗi 10 chữ số hợp lệ.',

            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.string' => 'Địa chỉ phải là chuỗi văn bản.',
            'address.max' => 'Địa chỉ không được vượt quá :max ký tự.',

            'payment_type.required' => 'Phương thức thanh toán là bắt buộc.',
            'payment_type.in' => 'Phương thức thanh toán phải là "cod", "vnpay", "momo".',

            'note.string' => 'Ghi chú phải là chuỗi văn bản.',
            'note.max' => 'Ghi chú không được vượt quá :max ký tự.',
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user(); //7/11/2024
            $user_id = Auth::id();
            $cartItems = Cart::where('user_id', $user_id)->get();

            // Kiểm tra hàng tồn kho
            $outOfStockItems = [];
            foreach ($cartItems as $item) {
                if ($item->variant_quantity > $item->variants->stock) {
                    $outOfStockItems[] = [
                        'product_name' => $item->variants->product->name,
                        'size' => $item->variants->size->name,
                        'available_stock' => $item->variants->stock,
                        'requested_quantity' => $item->variant_quantity,
                    ];
                }
            }

            if (!empty($outOfStockItems)) {
                // Tạo chuỗi thông báo lỗi chi tiết bao gồm tên sản phẩm và kích thước
                $errorMessages = [];
                foreach ($outOfStockItems as $outOfStock) {
                    $errorMessages[] = "{$outOfStock['product_name']} (Size: {$outOfStock['size']})";
                }

                return redirect()->route('tt-that-bai')->withErrors([
                    'error' => 'Một số sản phẩm không còn hàng: ' . implode(', ', $errorMessages)
                ]);
            }

            // Tính toán tổng giá ban đầu
            $total_price = $cartItems->sum(function ($item) {
                return $item->variants->sale_price * $item->variant_quantity;
            });

            if ($request->voucher_id != null) {
                $voucher = Voucher::where('id', $request->voucher_id)->first();
                $discountAmount = $total_price * ($voucher->value / 100);  // Tính giảm giá dựa trên tổng giỏ hàng
                // Giới hạn số tiền giảm tối đa
                if ($discountAmount > $voucher->max_price) {
                    $discountAmount = $voucher->max_price;
                }
                // Áp dụng giảm giá vào tổng giỏ hàng
                $total_price -= $discountAmount;
            }
            // 7/11/2024
            /// Xác định điểm sử dụng và tính giảm giá
            $pointsToUse = $request->input('points_to_use', 0);
            if ($pointsToUse > $user->points) {
                return redirect()->back()->withErrors(['error' => 'Số điểm bạn nhập không hợp lệ.']);
            }
            $discountAmount = $pointsToUse * 10000;
            $finalPrice = max(0, $total_price - $discountAmount);

            // Tạo mã hóa đơn
            // $code = 'BILL-' . strtoupper(uniqid());
            $code = 'B-' . strtoupper(bin2hex(random_bytes(2))) . '-' . strtoupper(substr(uniqid(), -4));

            // Tạo hóa đơn
            $bill = Bill::create([
                'user_id' => $user_id,
                'code' => $code,
                'full_name' => $validateData['full_name'],
                'phone_number' => $validateData['phone_number'],
                'address' => $validateData['address'],
                'note' => $validateData['note'],
                'payment_type' => 'cod',
                // 'total_price' => $total_price,
                'total_price' => $finalPrice, //7/11/2024
                'bill_status' => 'pending',
                'payment_status' => 'pending',
                'discount_amount' => $discountAmount, //7/11/2024
                'points_used' => $pointsToUse, // Lưu số điểm đã sử dụng 7/11/2024
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

            // Trừ điểm đã sử dụng và xóa giỏ hàng (7/11/2024)
            $user->points -= $pointsToUse;
            $user->save();

            Cart::where('user_id', $user_id)->delete();
            if ($request->voucher_id != null) {
                $voucher->update([
                    "used_quantity" => $voucher->used_quantity + 1,
                ]);
                VoucerHistory::create([
                    'voucher_id' => $request->voucher_id,
                    'user_id' => $bill->user_id,
                    'bill_id' => $bill->id,
                    'at_datetime' => now()->format('Y-m-d H:m:i'),
                ]);
            }
            DB::commit();

            // Gửi email xác nhận đơn hàng đến email của khách hàng
            $userEmail = Auth::user()->email;
            Mail::to($userEmail)->send(new OrderConfirmationMail($bill));

            return redirect()->route('tt-thanh-cong', ['bill' => $bill->id])->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại sau.']);
        }
    }

    public function processVNPAY(Request $request)
    {
        // Kiểm tra nếu giỏ hàng trống
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm trước khi thanh toán.']);
        }

        $validateData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            'address' => 'required|string|max:500',
            'payment_type' => 'required|in:cod,vnpay,momo',
            'points_to_use' => 'nullable|integer|min:0', // Số điểm người dùng muốn sử dụng (7/11/2024)
            'note' => 'nullable|string|max:1000',
        ], [
            'full_name.required' => 'Họ và tên là bắt buộc.',
            'full_name.string' => 'Họ và tên phải là chuỗi văn bản.',
            'full_name.max' => 'Họ và tên không được vượt quá :max ký tự.',

            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.regex' => 'Số điện thoại phải là chuỗi 10 chữ số hợp lệ.',

            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.string' => 'Địa chỉ phải là chuỗi văn bản.',
            'address.max' => 'Địa chỉ không được vượt quá :max ký tự.',

            'payment_type.required' => 'Phương thức thanh toán là bắt buộc.',
            'payment_type.in' => 'Phương thức thanh toán phải là "cod", "vnpay", "momo".',

            'note.string' => 'Ghi chú phải là chuỗi văn bản.',
            'note.max' => 'Ghi chú không được vượt quá :max ký tự.',
        ]);

        // Lưu thông tin vào session
        session([
            'payment.full_name' => $validateData['full_name'],
            'payment.phone_number' => $validateData['phone_number'],
            'payment.address' => $validateData['address'],
            'payment.points_to_use' => $validateData['points_to_use'] ?? 0,
            'payment.note' => $validateData['note'],
        ]);


        // Kiểm tra hàng tồn kho
        $outOfStockItems = [];
        foreach ($cartItems as $item) {
            if ($item->variant_quantity > $item->variants->stock) {
                $outOfStockItems[] = [
                    'product_name' => $item->variants->product->name,
                    'size' => $item->variants->size->name,
                    'available_stock' => $item->variants->stock,
                    'requested_quantity' => $item->variant_quantity,
                ];
            }
        }

        if (!empty($outOfStockItems)) {
            // Tạo chuỗi thông báo lỗi chi tiết bao gồm tên sản phẩm và kích thước
            $errorMessages = [];
            foreach ($outOfStockItems as $outOfStock) {
                $errorMessages[] = "{$outOfStock['product_name']} (Size: {$outOfStock['size']})";
            }

            return redirect()->route('tt-that-bai')->withErrors([
                'error' => 'Một số sản phẩm không còn hàng: ' . implode(', ', $errorMessages)
            ]);
        }


        // 24/11/2024
        // Kiểm tra số điểm người dùng có
        $pointsToUse = $validateData['points_to_use'] ?? 0;
        $user = Auth::user();
        // Kiểm tra nếu số điểm người dùng nhập vượt quá số điểm hiện có
        if ($pointsToUse > $user->points) {
            return redirect()->back()->withErrors(['error' => 'Số điểm bạn nhập vượt quá số điểm hiện có.']);
        }

        // Tính tổng giá trị giỏ hàng
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->variants->sale_price * $item->variant_quantity;
        });

        if ($request->voucher_id != null) {
            $voucher = Voucher::where('id', $request->voucher_id)->first();
            $discountAmount = $totalPrice * ($voucher->value / 100);  // Tính giảm giá dựa trên tổng giỏ hàng
            // Giới hạn số tiền giảm tối đa
            if ($discountAmount > $voucher->max_price) {
                $discountAmount = $voucher->max_price;
            }
            // Áp dụng giảm giá vào tổng giỏ hàng
            $totalPrice -= $discountAmount;
        }

        // 24/11/2024
        // Tính số tiền giảm giá từ điểm
        $pointValue = 10000; // Giá trị mỗi điểm là 10,000 VND
        $discountAmount = $pointsToUse * $pointValue;
        $finalPrice = max(0, $totalPrice - $discountAmount); // Đảm bảo giá cuối không âm

        // Tạo mã đơn hàng duy nhất
        // $code = 'BILL-' . strtoupper(uniqid());
        $code = 'B-' . strtoupper(bin2hex(random_bytes(2))) . '-' . strtoupper(substr(uniqid(), -4));

        $vnp_TxnRef = $code;
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('checkout.vnpay.returnFrom', $request->voucher_id);
        $vnp_TmnCode = "KA1BV3N8";
        $vnp_HashSecret = "12GUKMUAGMQR4QW57D26MKG56RCYN9G8";

        $vnp_OrderInfo = "Thanh toán VNPAY - Mã đơn hàng: " . $vnp_TxnRef;
        // $vnp_Amount = $total_price * 100;
        $vnp_Amount = intval($finalPrice * 100); // Đơn vị tiền VNPAY là VND x 100 7/11/2024
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

        ksort($inputData);
        $hashdata = http_build_query($inputData);
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $query = $hashdata . '&vnp_SecureHash=' . $vnpSecureHash;

        return redirect($vnp_Url . "?" . $query);
    }


    public function returnFromVNPAY(Request $request, $voucher_id = null)
    {
        Log::info('VNPAY return response:', $request->all());
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $vnp_HashSecret = "12GUKMUAGMQR4QW57D26MKG56RCYN9G8";
        $inputData = $request->except('vnp_SecureHash');
        ksort($inputData);
        $hashdata = http_build_query($inputData);
        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        if ($vnp_ResponseCode == '00' && $secureHash == $vnp_SecureHash) {
            DB::beginTransaction();

            try {
                $user_id = Auth::id();
                $cartItems = Cart::where('user_id', $user_id)->get();

                $outOfStockItems = [];
                foreach ($cartItems as $item) {
                    if ($item->variant_quantity > $item->variants->stock) {
                        $outOfStockItems[] = [
                            'product_name' => $item->variants->product->name,
                            'size' => $item->variants->size->name,
                            'available_stock' => $item->variants->stock,
                            'requested_quantity' => $item->variant_quantity,
                        ];
                    }
                }

                if (!empty($outOfStockItems)) {
                    // Tạo chuỗi thông báo lỗi chi tiết bao gồm tên sản phẩm và kích thước
                    $errorMessages = [];
                    foreach ($outOfStockItems as $outOfStock) {
                        $errorMessages[] = "{$outOfStock['product_name']} (Size: {$outOfStock['size']})";
                    }

                    return redirect()->route('tt-that-bai')->withErrors([
                        'error' => 'Một số sản phẩm không còn hàng: ' . implode(', ', $errorMessages)
                    ]);
                }

                // 24/11/2024
                // Lấy số điểm đã sử dụng từ session
                $pointsToUse = session('payment.points_to_use', 0);
                $user = Auth::user();

                if ($pointsToUse > $user->points) {
                    DB::rollBack();
                    return redirect()->route('tt-that-bai')->withErrors(['error' => 'Số điểm sử dụng vượt quá số điểm bạn có.']);
                }

                // Lấy lại thông tin từ session
                $full_name = session('payment.full_name');
                $phone_number = session('payment.phone_number');
                $address = session('payment.address');
                $note = session('payment.note');

                // Tính tổng giá trị giỏ hàng
                $totalPrice = $cartItems->sum(function ($item) {
                    return $item->variants->sale_price * $item->variant_quantity;
                });

                if ($voucher_id) {
                    $voucher = Voucher::where('id', $request->voucher_id)->first();
                    $discountAmount = $totalPrice * ($voucher->value / 100);  // Tính giảm giá dựa trên tổng giỏ hàng
                    // Giới hạn số tiền giảm tối đa
                    if ($discountAmount > $voucher->max_price) {
                        $discountAmount = $voucher->max_price;
                    }
                    // Áp dụng giảm giá vào tổng giỏ hàng
                    $totalPrice -= $discountAmount;
                }

                // 24/11/2024
                // Tính số tiền giảm giá từ điểm
                $pointValue = 10000; // Giá trị mỗi điểm là 10,000 VND
                $discountAmount = $pointsToUse * $pointValue;
                $finalPrice = max(0, $totalPrice - $discountAmount); // Đảm bảo giá cuối không âm

                // Trừ điểm người dùng đã sử dụng
                $user->points -= $pointsToUse;
                $user->save();

                // Tạo hóa đơn
                $bill = Bill::create([
                    'user_id' => $user_id,
                    'code' => $vnp_TxnRef,
                    'full_name' => $full_name,
                    'phone_number' => $phone_number,
                    'address' => $address,
                    'note' => $note,
                    'payment_type' => 'vnpay',
                    // 'total_price' => $total_price,
                    'total_price' => $finalPrice, //29/11/2024
                    'bill_status' => 'pending',
                    'payment_status' => 'completed',
                    'discount_amount' => $discountAmount, //7/11/2024
                    'points_used' => $pointsToUse, // Lưu số điểm đã sử dụng 7/11/2024
                ]);

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

                Cart::where('user_id', $user_id)->delete();
                if ($voucher_id) {
                    $voucher->update([
                        "used_quantity" => $voucher->used_quantity + 1,
                    ]);
                    VoucerHistory::create([
                        'voucher_id' => $voucher_id,
                        'user_id' => $bill->user_id,
                        'bill_id' => $bill->id,
                        'at_datetime' => now()->format('Y-m-d H:m:i'),
                    ]);
                }
                DB::commit();

                $userEmail = Auth::user()->email;
                Mail::to($userEmail)->send(new OrderConfirmationMail($bill));

                return redirect()->route('tt-thanh-cong', ['bill' => $bill->id])->with('success', 'Đặt hàng thành công!');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error saving bill after VNPAY success: ' . $e->getMessage());
                return redirect()->route('tt-that-bai')->withErrors(['error' => 'Không thể lưu hóa đơn. Vui lòng thử lại sau.']);
            }
        } else {
            return redirect()->route('tt-that-bai')->withErrors(['error' => 'Thanh toán không thành công.']);
        }
    }


    // momo
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function paymentMOMO(Request $request)
    {
        // Kiểm tra nếu giỏ hàng trống
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm trước khi thanh toán.']);
        }
        // Kiểm tra hàng tồn kho
        $outOfStockItems = [];
        foreach ($cartItems as $item) {
            if ($item->variant_quantity > $item->variants->stock) {
                $outOfStockItems[] = [
                    'product_name' => $item->variants->product->name,
                    'size' => $item->variants->size->name,
                    'available_stock' => $item->variants->stock,
                    'requested_quantity' => $item->variant_quantity,
                ];
            }
        }

        if (!empty($outOfStockItems)) {
            // Tạo chuỗi thông báo lỗi chi tiết bao gồm tên sản phẩm và kích thước
            $errorMessages = [];
            foreach ($outOfStockItems as $outOfStock) {
                $errorMessages[] = "{$outOfStock['product_name']} (Size: {$outOfStock['size']})";
            }

            return redirect()->route('tt-that-bai')->withErrors([
                'error' => 'Một số sản phẩm không còn hàng: ' . implode(', ', $errorMessages)
            ]);
        }
        // Tính tổng giá trị giỏ hàng
        $total_price = $cartItems->sum(function ($item) {
            return $item->variants->sale_price * $item->variant_quantity;
        });
        if (session()->has('coupon')) {
            $voucher = session('coupon');
            $discount = $voucher->value;  // Phần trăm giảm giá từ voucher
            $discountAmount = $total_price * ($discount / 100);  // Tính giảm giá dựa trên tổng giỏ hàng

            // Giới hạn số tiền giảm tối đa
            if ($discountAmount > $voucher->max_price) {
                $discountAmount = $voucher->max_price;
            }

            // Áp dụng giảm giá vào tổng giỏ hàng
            $total_price -= $discountAmount;
        }
        // Tạo mã đơn hàng duy nhất
        $orderId = 'B-' . strtoupper(bin2hex(random_bytes(2))) . '-' . strtoupper(substr(uniqid(), -4));

        // Lưu hóa đơn vào database
        DB::beginTransaction();
        try {
            $userId = Auth::id();
            $bill = Bill::create([
                'user_id' => $userId,
                'code' => $orderId,
                'full_name' => $request->full_name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'note' => $request->note,
                'payment_type' => 'momo',
                'total_price' => $total_price,
                'bill_status' => 'pending',
                'payment_status' => 'completed', // Trạng thái chưa xác nhận
            ]);

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

            // Xóa giỏ hàng sau khi lưu hóa đơn
            Cart::where('user_id', $userId)->delete();

            // Gửi email xác nhận
            $userEmail = Auth::user()->email;
            Mail::to($userEmail)->send(new OrderConfirmationMail($bill));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving bill or sending email: ' . $e->getMessage());
            return redirect()->route('tt-that-bai')->withErrors(['error' => 'Không thể tạo hóa đơn. Vui lòng thử lại sau.']);
        }

        // Tiếp tục với việc xử lý thanh toán MoMo
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo - Mã đơn hàng: " . $orderId;
        $redirectUrl = route('tt-thanh-cong', ['bill' => $bill->id]);
        $ipnUrl = route('tt-thanh-cong', ['bill' => $bill->id]);
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";

        // Tạo chữ ký HMAC SHA256
        $rawHash = "accessKey=$accessKey&amount=$total_price&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            'storeId' => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $total_price,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,
        ];

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        if (isset($jsonResult['payUrl'])) {
            return redirect()->to($jsonResult['payUrl']);
        } else {
            return redirect()->route('tt-that-bai')->withErrors(['error' => 'Lỗi khi tạo yêu cầu thanh toán MoMo: ' . ($jsonResult['message'] ?? 'Không xác định')]);
        }
    }


    public function returnFromMOMO(Request $request)
    {
        Log::info('MoMo return response:', $request->all());

        $responseCode = $request->input('resultCode');
        $orderId = $request->input('orderId');
        $amount = $request->input('amount');
        $signature = $request->input('signature');

        // Kiểm tra chữ ký và mã trạng thái
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $dataToSign = "accessKey=klm05TvNBzhg7h7j&amount=$amount&orderId=$orderId&partnerCode=MOMOBKUN20180529&requestId=" . $request->input('requestId') . "&requestType=payWithATM";
        $expectedSignature = hash_hmac("sha256", $dataToSign, $secretKey);

        if ($responseCode == '0' && $signature == $expectedSignature) {
            // Cập nhật trạng thái thanh toán thành công
            $bill = Bill::where('code', $orderId)->first();
            if ($bill) {
                $bill->update([
                    'payment_status' => 'completed',
                    'bill_status' => 'pending',
                ]);
            }

            return redirect()->route('tt-thanh-cong', ['bill' => $bill->id])->with('success', 'Thanh toán thành công!');
        } else {
            return redirect()->route('tt-that-bai')->withErrors(['error' => 'Thanh toán không thành công.']);
        }
    }







    // mua ngay
    public function buyNow(Request $request)
    {
        if (!Auth::check()) {
            // Lưu thông báo vào session
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để mua hàng.');
        }

        $user = Auth::user();

        // Lấy thông tin sản phẩm từ request
        $variantId = $request->input('variant_id');
        $quantity = $request->input('variant_quantity');

        if (!is_numeric($quantity) || $quantity <= 0) {
            return redirect()->back()->withErrors('Số lượng không hợp lệ.');
        }

        $variant = Variant::find($variantId);
        if (!$variant) {
            return redirect()->back()->withErrors('Sản phẩm không tồn tại.');
        }

        // if ($quantity > $variant->stock) {
        //     return redirect()->back()->withErrors('Số lượng yêu cầu vượt quá số lượng sản phẩm có sẵn. Sản phẩm còn lại trong kho: ' . $variant->stock);
        // }

        // Tìm sản phẩm tương ứng

        $product = $variant->product;

        // Tính tổng giá trị sản phẩm 7/11/2024
        $totalPrice = $variant->sale_price * $quantity;
        //29/11/2024
        // $discount = 0; // Định nghĩa mặc định là 0
        // $discountAmount = 0; // Định nghĩa mặc định là 0
        if (session()->has('coupon')) {
            $voucher = session('coupon');
            $discount = $voucher->value;  // Phần trăm giảm giá từ voucher
            $discountAmount = $totalPrice * ($discount / 100);  // Tính giảm giá dựa trên tổng giỏ hàng

            // Giới hạn số tiền giảm tối đa
            if ($discountAmount > $voucher->max_price) {
                $discountAmount = $voucher->max_price;
            }

            // Áp dụng giảm giá vào tổng giỏ hàng
            $totalPrice -= $discountAmount;
        }
        return view('client.buy-now', [
            'user' => $user,
            'product' => $product,
            'variant' => $variant,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            // 'discount' => $discount, //29/11/2024
            // 'discount_amount' => $discountAmount, // Giá trị giảm giá cụ thể (tiền)
            'userPoints' => $user->points, // Điểm tích lũy của người dùng 7/11/2024
        ]);
    }



    // mua ngay 
    public function processBuyNow(Request $request)
    {
        // Xác thực dữ liệu từ form
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            'address' => 'required|string|max:500',
            'payment_type' => 'required|in:cod,vnpay,momo',
            'note' => 'nullable|string|max:1000',
            'variant_id' => 'required|exists:variants,id',
            'variant_quantity' => 'required|integer|min:1',
            'points_to_use' => 'nullable|integer|min:0', // Số điểm người dùng muốn sử dụng 7/11/2024
        ], [
            'full_name.required' => 'Họ và tên là bắt buộc.',
            'full_name.string' => 'Họ và tên phải là chuỗi văn bản.',
            'full_name.max' => 'Họ và tên không được vượt quá :max ký tự.',

            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.regex' => 'Số điện thoại phải là chuỗi 10 chữ số hợp lệ.',

            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.string' => 'Địa chỉ phải là chuỗi văn bản.',
            'address.max' => 'Địa chỉ không được vượt quá :max ký tự.',

            'payment_type.required' => 'Phương thức thanh toán là bắt buộc.',
            'payment_type.in' => 'Phương thức thanh toán phải là "cod", "vnpay", "momo".',

            'note.string' => 'Ghi chú phải là chuỗi văn bản.',
            'note.max' => 'Ghi chú không được vượt quá :max ký tự.',

            'variant_id.required' => 'ID biến thể là bắt buộc.',
            'variant_id.exists' => 'ID biến thể không tồn tại.',
            'variant_quantity.required' => 'Số lượng biến thể là bắt buộc.',
            'variant_quantity.integer' => 'Số lượng biến thể phải là một số nguyên.',
            'variant_quantity.min' => 'Số lượng biến thể phải lớn hơn hoặc bằng 1.',
        ]);

        DB::beginTransaction(); //7/11/2024

        try {
            $user = Auth::user(); //7/11/2024
            // Lấy thông tin sản phẩm
            $variant = Variant::find($validatedData['variant_id']);

            // Kiểm tra số lượng tồn kho
            if ($variant->stock < $validatedData['variant_quantity']) {
                return redirect()->route('tt-that-bai')->withErrors([
                    'error' => 'Sản phẩm ' . $variant->product->name . ' (Size: ' . $variant->size->name . ') không còn đủ hàng trong kho.'
                ]);
            }

            // Tính tổng giá trị sản phẩm
            $totalPrice = $variant->sale_price * $validatedData['variant_quantity'];

            if (session()->has('coupon')) {
                $voucher = session('coupon');
                $discount = $voucher->value;  // Phần trăm giảm giá từ voucher
                $discountAmount = $totalPrice * ($discount / 100);  // Tính giảm giá dựa trên tổng giỏ hàng

                // Giới hạn số tiền giảm tối đa
                if ($discountAmount > $voucher->max_price) {
                    $discountAmount = $voucher->max_price;
                }

                // Áp dụng giảm giá vào tổng giỏ hàng
                $totalPrice -= $discountAmount;
            }

            // Xử lý số điểm giảm giá(7/11/2024)
            $pointsToUse = $validatedData['points_to_use'] ?? 0;
            if ($pointsToUse > $user->points) {
                return redirect()->back()->withErrors(['error' => 'Số điểm bạn nhập vượt quá số điểm hiện có.']);
            }
            $pointValue = 10000; // Giá trị mỗi điểm là 10,000 VND
            $discountAmount = $pointsToUse * $pointValue;
            $finalPrice = max(0, $totalPrice - $discountAmount); // Không cho phép giá trị âm


            // Tạo mã đơn hàng
            // $billCode = 'BILL-' . strtoupper(uniqid());
            $billCode = 'B-' . strtoupper(bin2hex(random_bytes(2))) . '-' . strtoupper(substr(uniqid(), -4));

            // Xử lý thanh toán dựa trên phương thức đã chọn
            if ($validatedData['payment_type'] === 'vnpay') {
                return $this->paymentVNPAY($billCode, $totalPrice, $validatedData, $variant);
            }

            // Xử lý thanh toán MoMo
            if ($validatedData['payment_type'] === 'momo') {
                // Tạo hóa đơn với trạng thái "pending"
                $bill = Bill::create([
                    'user_id' => $user->id,
                    'code' => $billCode,
                    'bill_status' => 'pending',
                    'payment_type' => 'momo',
                    'payment_status' => 'completed',
                    'total_price' => $finalPrice,
                    'discount_amount' => $discountAmount,
                    'full_name' => $validatedData['full_name'],
                    'phone_number' => $validatedData['phone_number'],
                    'address' => $validatedData['address'],
                    'note' => $validatedData['note'],
                    'points_used' => $pointsToUse,
                ]);

                // Lưu thông tin vào bill_items
                BillItem::create([
                    'variant_id' => $variant->id,
                    'bill_id' => $bill->id,
                    'sale_price' => $variant->sale_price,
                    'listed_price' => $variant->listed_price,
                    'import_price' => $variant->import_price,
                    'variant_quantity' => $validatedData['variant_quantity'],
                    'product_name' => $variant->product->name,
                    'product_image_url' => $variant->product->primary_image_url,
                ]);


                // Xử lý API MoMo
                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                $orderInfo = "Thanh toán MoMo - Mã đơn hàng: " . $billCode;
                $redirectUrl = route('tt-thanh-cong', ['bill' => $bill->id]);
                $ipnUrl = route('tt-thanh-cong', ['bill' => $bill->id]);
                $extraData = "";
                $requestId = time() . "";
                $requestType = "payWithATM";

                $rawHash = "accessKey=$accessKey&amount=$finalPrice&extraData=&ipnUrl=$ipnUrl&orderId=$billCode&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
                $signature = hash_hmac("sha256", $rawHash, $secretKey);

                $data = [
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    'storeId' => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $finalPrice,
                    'orderId' => $billCode,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature,
                ];

                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);

                $variant->decrement('stock', $validatedData['variant_quantity']);

                $user->points -= $pointsToUse;
                $user->save();

                DB::commit();


                $userEmail = Auth::user()->email;
                Mail::to($userEmail)->send(new OrderConfirmationMail($bill));

                if (isset($jsonResult['payUrl'])) {
                    DB::commit();
                    return redirect()->to($jsonResult['payUrl']);
                } else {
                    throw new \Exception('Lỗi khi tạo yêu cầu thanh toán MoMo: ' . ($jsonResult['message'] ?? 'Không xác định'));
                }
            }

            // Thanh toán COD, lưu vào cơ sở dữ liệu
            $bill = Bill::create([
                'user_id' => Auth::id(),
                'code' => $billCode,
                'bill_status' => 'pending',
                'payment_type' => $validatedData['payment_type'],
                'payment_status' => 'pending',
                // 'total_price' => $totalPrice,
                'total_price' => $finalPrice, // Giá sau giảm giá (7/11/2024)
                'discount_amount' => $discountAmount, // Số tiền giảm giá (7/11/2024)
                'full_name' => $validatedData['full_name'],
                'phone_number' => $validatedData['phone_number'],
                'address' => $validatedData['address'],
                'note' => $validatedData['note'],
                'points_used' => $pointsToUse, // Lưu số điểm đã sử dụng vào hóa đơn(7/11/2024)
            ]);

            // Lưu thông tin vào bảng bill_items
            BillItem::create([
                'variant_id' => $variant->id,
                'bill_id' => $bill->id,
                'sale_price' => $variant->sale_price,
                'listed_price' => $variant->listed_price,
                'import_price' => $variant->import_price,
                'variant_quantity' => $validatedData['variant_quantity'],
                'product_name' => $variant->product->name,
                'product_image_url' => $variant->product->primary_image_url,
            ]);

            // Giảm số lượng hàng tồn kho
            $variant->decrement('stock', $validatedData['variant_quantity']);

            // Trừ điểm người dùng đã sử dụng(7/11/2024)
            $user->points -= $pointsToUse;
            $user->save();

            DB::commit();


            $userEmail = Auth::user()->email;
            Mail::to($userEmail)->send(new OrderConfirmationMail($bill));

            return redirect()->route('tt-thanh-cong', ['bill' => $bill->id])->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('BuyNow error: ' . $e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại sau.']);
        }
    }

    private function paymentVNPAY($billCode, $totalPrice, $validatedData, $variant)
    {
        $user = Auth::user(); //7/11/2024

        // Kiểm tra điểm tích lũy(7/11/2024)
        $pointsToUse = $validatedData['points_to_use'] ?? 0;
        $pointValue = 10000; // Mỗi điểm giảm giá 10,000 VND

        if ($pointsToUse > $user->points) {
            return redirect()->route('checkout')->withErrors(['error' => 'Bạn không có đủ điểm để sử dụng!']);
        }

        // Tính số tiền giảm giá(7/11/2024)
        $discountAmount = $pointsToUse * $pointValue;
        $finalPrice = max(0, $totalPrice - $discountAmount);

        // Kiểm tra lại tồn kho trước khi thực hiện thanh toán
        if ($variant->stock < $validatedData['variant_quantity']) {
            return redirect()->route('tt-that-bai')->withErrors([
                'error' => 'Sản phẩm ' . $variant->product->name . ' (Size: ' . $variant->size->name . ') không còn đủ hàng trong kho.'
            ]);
        }

        $vnp_TxnRef = $billCode;
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('checkout.vnpay.return');
        $vnp_TmnCode = "KA1BV3N8";
        $vnp_HashSecret = "12GUKMUAGMQR4QW57D26MKG56RCYN9G8";

        $vnp_OrderInfo = "Thanh toán VNPAY - Mã đơn hàng: " . $vnp_TxnRef;
        // $vnp_Amount = $totalPrice * 100;
        $vnp_Amount = $finalPrice * 100; //7/11/2024
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

        // Lưu thông tin tạm thời vào session
        session([
            'pending_order' => $validatedData,
            'points_used' => $pointsToUse, //7/11/2024
            'discount_amount' => $discountAmount //7/11/2024
        ]);


        // Chuyển hướng đến VNPAY
        return redirect($vnp_Url . "?" . $query);
    }

    public function vnpayReturn(Request $request)
    {
        // Xử lý kết quả trả về từ VNPAY
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $vnp_HashSecret = "12GUKMUAGMQR4QW57D26MKG56RCYN9G8";

        // Lấy dữ liệu không bao gồm mã bảo mật
        $inputData = $request->except('vnp_SecureHash');
        ksort($inputData);
        $hashdata = http_build_query($inputData);
        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        if ($vnp_SecureHash === $secureHash) {
            if ($vnp_ResponseCode === '00') {
                // Thanh toán thành công
                $validatedData = session('pending_order');
                $pointsToUse = session('points_used'); //7/11/2024
                $discountAmount = session('discount_amount'); //7/11/2024

                $variant = Variant::find($validatedData['variant_id']);

                // Kiểm tra tồn kho trước khi tạo hóa đơn
                if ($variant->stock < $validatedData['variant_quantity']) {
                    return redirect()->route('tt-that-bai')->withErrors([
                        'error' => 'Sản phẩm ' . $variant->product->name . ' (Size: ' . $variant->size->name . ') không còn đủ hàng trong kho.'
                    ]);
                }

                // 29/11/2024
                // Lấy số điểm đã sử dụng từ session
                $pointsToUse = session('payment.points_to_use', 0);
                $user = Auth::user();

                if ($pointsToUse > $user->points) {
                    DB::rollBack();
                    return redirect()->route('tt-that-bai')->withErrors(['error' => 'Số điểm sử dụng vượt quá số điểm bạn có.']);
                }

                $totalPrice = $variant->sale_price * $validatedData['variant_quantity'];

                if (session()->has('coupon')) {
                    $voucher = session('coupon');
                    $discount = $voucher->value;  // Phần trăm giảm giá từ voucher
                    $discountAmount = $totalPrice * ($discount / 100);  // Tính giảm giá dựa trên tổng giỏ hàng

                    // Giới hạn số tiền giảm tối đa
                    if ($discountAmount > $voucher->max_price) {
                        $discountAmount = $voucher->max_price;
                    }

                    // Áp dụng giảm giá vào tổng giỏ hàng
                    $totalPrice -= $discountAmount;
                }

                // 29/11/2024
                // Tính số tiền giảm giá từ điểm
                $pointValue = 10000; // Giá trị mỗi điểm là 10,000 VND
                $discountAmount = $pointsToUse * $pointValue;
                // Tính số tiền giảm giá từ điểm (24/11/2024)
                $finalPrice = max(0, $totalPrice - $discountAmount); // Đảm bảo giá cuối không âm

                // Trừ điểm của người dùng
                $user = Auth::user();
                // $user->decrement('points', $usedPoints);
                $user->points -= $pointsToUse;
                $user->save();

                // Tạo hóa đơn
                $bill = Bill::create([
                    'user_id' => Auth::id(),
                    'code' => $vnp_TxnRef,
                    'bill_status' => 'pending',
                    'payment_type' => 'vnpay',
                    'payment_status' => 'completed',
                    // 'total_price' => $totalPrice,
                    'total_price' => $finalPrice, //29/11/2024
                    'full_name' => $validatedData['full_name'],
                    'phone_number' => $validatedData['phone_number'],
                    'address' => $validatedData['address'],
                    'note' => $validatedData['note'],
                    'points_used' => $pointsToUse, // Số điểm đã sử dụng 7/11/2024
                    'discount_amount' => $discountAmount, // Số tiền giảm giá 7/11/2024
                ]);

                // Lưu chi tiết hóa đơn
                BillItem::create([
                    'variant_id' => $variant->id,
                    'bill_id' => $bill->id,
                    'sale_price' => $variant->sale_price,
                    'listed_price' => $variant->listed_price,
                    'import_price' => $variant->import_price,
                    'variant_quantity' => $validatedData['variant_quantity'],
                    'product_name' => $variant->product->name,
                    'product_image_url' => $variant->product->primary_image_url,
                ]);

                // Giảm số lượng hàng tồn kho
                $variant->decrement('stock', $validatedData['variant_quantity']);

                // Gửi email xác nhận
                $userEmail = Auth::user()->email;
                Mail::to($userEmail)->send(new OrderConfirmationMail($bill));

                session()->forget('pending_order');
                return redirect()->route('tt-thanh-cong', ['bill' => $bill->id])->with('success', 'Đặt hàng thành công!');
            } else {
                return redirect()->route('tt-that-bai')->with('error', 'Thanh toán thất bại!');
            }
        } else {
            return redirect()->route('tt-that-bai')->with('error', 'Thông tin không hợp lệ!');
        }
    }
}
