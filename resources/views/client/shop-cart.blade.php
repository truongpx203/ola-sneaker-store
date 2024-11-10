@extends('client.layout')

@section('title', 'Giỏ hàng')

@section('content')
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-content">
                            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Giỏ hàng</h2>
                            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                                <ul class="breadcrumb">
                                    <li><a href="">Trang chủ</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Giỏ hàng</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Cart Area Wrapper ==-->
        <section class="shopping-cart-area">
            <div class="container">
                @if ($carts->isEmpty())
                    <div class="alert alert-info">
                        Giỏ hàng của bạn hiện đang trống.
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="shopping-cart-form table-responsive">
                                <form action="{{ route('cart.updateAll') }}" method="POST">
                                    @csrf
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumb">&nbsp;</th>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-size">Size</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Tổng cộng</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($carts as $cart)
                                            <tr class="cart-product-item">
                                                <input type="hidden" name="id[]" value="{{ $cart->id }}" />
                                                <input type="hidden" name="variant_id[]" value="{{ $cart->variant_id }}" />
                                                
                                                <td class="product-remove">
                                                    <a href="#/"><i class="fa fa-trash-o"></i></a>
                                                </td>                                                                                               
                                                <td class="product-thumb">
                                                    <a href="{{ route('cart.show', $cart->variant->product_id) }}"> 
                                                        <img src="{{ Storage::url($cart->variant->product->primary_image_url) }}" width="90" height="110" alt="{{ $cart->variant->product->name }}">
                                                    </a>
                                                </td>
                                                <td class="product-name">
                                                   <h4 class="title"> 
                                                    <a href="{{ route('cart.show', $cart->variant->product_id) }}">
                                                        {{  $cart->variant->product->name }}
                                                    </a>
                                                   </h4>
                                                </td>
                                                <td class="product-size">
                                                    <span>{{ $cart->variant->productSize->name }}</span>
                                                </td>
                                                <td class="product-price">
                                                    <span>{{ number_format($cart->variant->sale_price) }} VNĐ</span>
                                                </td>
                                                <td class="product-quantity">
                                                    <div class="pro-qty">
                                                        <div class="dec qty-btn">-</div>
                                                        <input type="number" class="quantity-input" name="variant_quantity[]" value="{{ $cart->variant_quantity }}" min="1" max="{{ $cart->variant->stock }}" data-price="{{ $cart->variant->sale_price }}" required>
                                                        <div class="inc qty-btn">+</div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal">
                                                    <span class="subtotal">{{ number_format($cart->variant->sale_price * $cart->variant_quantity) }} VNĐ</span>
                                                </td>                                                                                                                                               
                                            </tr>
                                        @endforeach
                                        <tr class="actions">
                                            <td class="border-0" colspan="7">
                                                <button type="submit" value="update" class="update-cart">Cập nhật Giỏ hàng</button>
                                            </form>
                                                <form action="{{ route('cart.clear') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="clear-cart"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng không?');">Xóa
                                                        toàn bộ giỏ hàng</button>
                                                </form>
                                                <a href="{{ route('shop.filter') }}" class="btn-theme btn-flat">Tiếp tục mua sắm</a>
                                            </td>
                                        </tr>

                                        @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
            
                                                @if (session('success'))
                                                    <div class="alert alert-success">
                                                        {{ session('success') }}
                                                    </div>
                                                @endif
            
                                                @if (session('error'))
                                                    <div class="alert alert-danger">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                    </tbody>
                                </table>
                           

                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-md-12 col-lg-4">
                            <div class="shipping-form-coupon">
                                <div class="section-title-cart">
                                    <h5 class="title">Mã giảm giá</h5>
                                    <div class="desc">
                                        <p>Nhập mã phiếu giảm giá nếu bạn có.</p>
                                    </div>
                                </div>
                                <form action="{{ route('cart.voucher') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="couponCode" class="visually-hidden">Coupon Code</label>
                                                <input type="text" id="couponCode" name="couponCode" class="form-control"
                                                    placeholder="Nhập mã phiếu giảm giá của bạn" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="coupon-btn">Áp dụng phiếu giảm giá</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <div class="shipping-form-cart-totals">
                                <div class="section-title-cart">
                                    <h5 class="title">Tổng giỏ hàng</h5>
                                </div>
                                <div class="cart-total-table">
                                    <table class="table">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <td>
                                                    <p class="value">Tạm tính</p>
                                                </td>
                                                <td>
                                                    <p class="price">{{ number_format($provisional) }} VNĐ</p>
                                                </td>
                                            </tr>
                                            <tr class="cart-subtotal">
                                                <td>
                                                    <p class="value">Giảm giá</p>
                                                </td>
                                                <td>
                                                    <p class="price">{{ isset($discount) ? $discount . '%' : '0%' }}</p>
                                                   
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <td>
                                                    <p class="value">Tổng tiền</p>
                                                </td>
                                                <td>
                                                    <p class="price">{{ number_format($cartTotal) }} VNĐ</p>
                                                    
                                                </td>
                                            </tr>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           <a class="btn-theme btn-flat" href="{{route('checkout.process')}}">Tiến hành thanh toán</a>
                        </div>
                    </div>
                @endif
               
            </div>
        </section>
        <!--== End Cart Area Wrapper ==-->
    </main>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Khi nhấn nút xóa
    $('.product-remove a').click(function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
        
        let row = $(this).closest('.cart-product-item');
        let productId = row.find('input[name="id[]"]').val();

        // Gửi yêu cầu AJAX để xóa sản phẩm khỏi cơ sở dữ liệu
        $.ajax({
            url: `/cart/remove/${productId}`,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.success); // Thông báo xóa thành công
                window.location.reload(); // Tải lại trang giỏ hàng
            },
            error: function(error) {
                console.error(error);
                alert('Có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    });

    // Hiển thị tổng tiền khi tăng giảm số lượng
    $('.inc.qty-btn').off('click').on('click', function() {
        let quantityInput = $(this).siblings('.quantity-input');
        let quantity = parseInt(quantityInput.val()) || 0;
        quantity += 1;
        quantityInput.val(quantity);
        updateSubtotal(quantityInput);
    });

    $('.dec.qty-btn').off('click').on('click', function() {
        let quantityInput = $(this).siblings('.quantity-input');
        let quantity = parseInt(quantityInput.val()) || 1;
        if (quantity > 1) {
            quantity -= 1; 
            quantityInput.val(quantity); 
            updateSubtotal(quantityInput);
        }
    });

    function updateSubtotal(input) {
        let quantity = parseInt(input.val()) || 0;
        let price = parseFloat(input.data('price'));
        let subtotal = price * quantity;
        input.closest('tr').find('.subtotal').text(new Intl.NumberFormat('vi-VN').format(subtotal) + ' VNĐ');
    }

    $('.quantity-input').on('input', function() {
        updateSubtotal($(this));
    });
});
</script>
