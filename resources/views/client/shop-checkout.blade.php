@extends('client.layout')

@section('title', 'Thanh toán')

@section('content')
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-content">
                            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Thanh Toán</h2>
                            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                                <ul class="breadcrumb">
                                    <li><a href="index.html">Trang chủ</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Thanh toán</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Shopping Checkout Area Wrapper ==-->
        <section class="shopping-checkout-wrap">

            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                <form id="checkout-form" action="{{ route('checkout.process') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                    <div class="row">
                        <div class="col-lg-6">
                            <!--== Start Billing Accordion ==-->
                            <div class="checkout-billing-details-wrap">
                                <h2 class="title">Chi tiết thanh toán</h2>
                                <div class="billing-form-wrap">
                                    {{-- <form action="#" method="post"> --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="full_name">Họ tên<abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input id="full_name" type="text" name="full_name" class="form-control"
                                                    placeholder="Nhập họ tên người nhận"
                                                    value="{{ old('name', $user->full_name) }}">
                                                @error('full_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="phone_number">Số điện thoại<abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input id="phone_number" type="text" name="phone_number"
                                                    class="form-control" placeholder="Nhập số điện thoại người nhận"
                                                    value="{{ old('name', $user->phone_number) }}">
                                                @error('phone_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" data-margin-bottom="30">
                                                <label for="email">Email<abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input id="email" type="text" name="email" class="form-control"
                                                    placeholder="Nhập email người nhận"
                                                    value="{{ old('name', $user->email) }}" disabled>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="street-address">Địa chỉ <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input id="street-address" type="text" name="address"
                                                    class="form-control" placeholder="Nhập địa chỉ người nhận"
                                                    value="{{ old('name', $user->address) }}">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    {{-- </form> --}}
                                </div>
                            </div>
                            <!--== End Billing Accordion ==-->
                        </div>
                        <div class="col-lg-6">
                            <!--== Start Order Details Accordion ==-->
                            <div class="checkout-order-details-wrap">
                                <div class="order-details-table-wrap table-responsive">
                                    <h2 class="title mb-25">Đơn hàng của bạn</h2>
                                    {{-- @if (isset($cartItems) && count($cartItems) > 0) --}}
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Sản phẩm</th>
                                                <th class="product-total">Tạm tính</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-body">
                                            @foreach ($cartItems as $item)
                                                <tr class="cart-item">
                                                    <td class="product-name">{{ $item->variants->product->name }}<span
                                                            class="product-quantity">× {{ $item->variant_quantity }}</span>
                                                    </td>
                                                    <td class="product-total">
                                                        {{ number_format($item->variants->sale_price * $item->variant_quantity) }}
                                                        VNĐ</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot class="table-foot">

                                            <tr class="shipping">
                                                <th>Phí vận chuyển</th>
                                                <td>Miễn phí</td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Tổng cộng</th>
                                                {{-- 7/11/2024 --}}
                                                <td id="finalTotal">{{ number_format($total_price) }} VND</td> 
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div class="shop-payment-method">
                                        <div id="PaymentMethodAccordion">

                                            {{-- <div class="card">
                                                <div class="card-header" id="check_payments4">
                                                    <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemFour"
                                                        aria-controls="itemTwo" aria-expanded="false">Thanh toán nhanh
                                                        Vnpay <img src="assets/img/photos/Logo-VNPAY-QR.webp"
                                                            width="60" height="46" alt="Image-HasTech"></h5>
                                                </div>
                                                <div id="itemFour"  >
                                                    <div class="card-body">
                                                        <p>Thanh toán qua PayPal; bạn có thể thanh toán bằng thẻ tín dụng
                                                            nếu bạn không có tài khoản PayPal.</p>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            {{-- 7/11/2024 --}}
                                            <div>
                                                <!-- Các trường nhập thông tin đơn hàng khác -->

                                                <!-- Số điểm người dùng có -->
                                                <p>Bạn có {{ $userPoints }} điểm tích lũy</p>

                                                <!-- Ô nhập số điểm muốn sử dụng -->
                                                <label for="points_to_use">Số điểm muốn sử dụng:</label>
                                                <input type="number" id="points_to_use" name="points_to_use"
                                                    min="0" max="{{ $userPoints }}" value="0"
                                                    oninput="calculateDiscount()">
                                            </div>

                                            <div>
                                                <input type="radio" id="payment_cod" name="payment_type"
                                                    value="cod">
                                                <label for="payment_cod">Thanh toán khi nhận hàng (COD)</label>
                                            </div>

                                            <div>
                                                <input type="radio" id="payment_vnpay" name="payment_type"
                                                    value="online">
                                                <label for="payment_vnpay" aria-labelledby="check_payments4"
                                                    data-bs-parent="#PaymentMethodAccordion">Thanh toán với VNPAY</label>
                                            </div>

                                            {{-- <div id="bankSelectionModal" class="modal">
                                                <div class="modal-content">
                                                    <h4>Chọn ngân hàng</h4>
                                                    <div class="bank-options">
                                                        <label>
                                                            <input type="radio" name="bank_code" value="NCB">
                                                            <img src="/images/banks/ncb_logo.png" alt="NCB"
                                                                class="bank-logo"> Ngân hàng NCB
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="bank_code" value="VCB">
                                                            <img src="/images/banks/vcb_logo.png" alt="Vietcombank"
                                                                class="bank-logo"> Ngân hàng Vietcombank
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="bank_code" value="ACB">
                                                            <img src="/images/banks/acb_logo.png" alt="ACB"
                                                                class="bank-logo"> Ngân hàng ACB
                                                        </label>
                                                        <!-- Add other banks as needed -->
                                                    </div>
                                                    <button type="button" id="confirmBankButton" class="btn-theme">Xác
                                                        nhận</button>
                                                </div>
                                            </div> --}}
                                        </div>
                                        @error('payment_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <a href=""><button type="submit"class="btn-theme">Đặt hàng</button></a>
                                    </div>
                                </div>
                            </div>
                            <!--== End Order Details Accordion ==-->
                        </div>
                    </div>
                </form>
                {{-- 7/11/2024 --}}
                <script>
                    function calculateDiscount() {
                        const pointsToUse = parseInt(document.getElementById('points_to_use').value) || 0;
                        const pointValue = 10000; // Giá trị mỗi điểm là 10000 VND
                        const originalTotal = {{ $total_price }};

                        // Tính số tiền giảm giá
                        const discountAmount = pointsToUse * pointValue;

                        // Tính tổng giá trị sau khi giảm
                        const finalTotal = Math.max(0, originalTotal - discountAmount);

                        // Cập nhật giao diện
                        document.getElementById('finalTotal').innerText = new Intl.NumberFormat().format(finalTotal) + ' VND';
                    }
                </script>

                <script>
                    document.getElementById('checkout-form').addEventListener('submit', function(event) {
                        const paymentType = document.querySelector('input[name="payment_type"]:checked').value;
                        
                        // Đặt lại action của form dựa trên phương thức thanh toán được chọn
                        if (paymentType === 'online') {
                            this.action = "{{ route('checkout.vnpay') }}"; // Route thanh toán VNPAY
                        } else {
                            this.action = "{{ route('checkout.process') }}"; // Route thanh toán COD
                        }
                    });
                
                    // Thêm sự kiện để cập nhật action của form khi thay đổi phương thức thanh toán
                    document.querySelectorAll('input[name="payment_type"]').forEach(radio => {
                        radio.addEventListener('change', function() {
                            const paymentType = document.querySelector('input[name="payment_type"]:checked').value;
                
                            // Cập nhật action của form
                            if (paymentType === 'online') {
                                document.getElementById('checkout-form').action = "{{ route('checkout.vnpay') }}";
                            } else {
                                document.getElementById('checkout-form').action = "{{ route('checkout.process') }}";
                            }
                        });
                    });
                </script>
                
            </div>
        </section>
        <!--== End Shopping Checkout Area Wrapper ==-->
    </main>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutButton = document.getElementById('checkoutButton');
        const paymentVnpay = document.getElementById('payment_vnpay');
        const bankSelectionModal = document.getElementById('bankSelectionModal');
        const confirmBankButton = document.getElementById('confirmBankButton');
        const bankCodeSelect = document.getElementById('bankCode');

        checkoutButton.addEventListener('click', function() {
            if (paymentVnpay.checked) {
                // Show the bank selection modal if VNPAY is selected
                bankSelectionModal.style.display = 'block';
            } else {
                // If COD is selected, submit the form directly
                document.querySelector('form').submit();
            }
        });

        confirmBankButton.addEventListener('click', function() {
            const selectedBank = bankCodeSelect.value;

            if (selectedBank) {
                // Attach selected bank code to form and submit
                const form = document.querySelector('form');
                const bankInput = document.createElement('input');
                bankInput.type = 'hidden';
                bankInput.name = 'bank_code';
                bankInput.value = selectedBank;
                form.appendChild(bankInput);
                form.submit();
            }
        });

        // Close modal when clicked outside of it (optional)
        window.onclick = function(event) {
            if (event.target == bankSelectionModal) {
                bankSelectionModal.style.display = "none";
            }
        }
    });
</script>
