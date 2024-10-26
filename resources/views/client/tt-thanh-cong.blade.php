@extends('client.layout')

@section('title', 'Thanh toán thành công')

@section('content')
<main class="main-content">
    <!--== Start Payment Success Area Wrapper ==-->
    <section class="payment-success-area">
        <div class="container pt-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <div class="payment-success-wrap">
                        <div class="payment-success-content">
                            <div class="success-icon mb-4">
                                <i class="bi bi-check-circle" style="font-size: 70px; color: green;"></i>
                            </div>
                            <h3 class="success-text" data-aos="fade-down" data-aos-duration="1000">Thanh Toán Thành Công!</h3>
                            <h3 class="title" data-aos="fade-down" data-aos-duration="1200">Cảm ơn bạn đã mua hàng!</h3>
                            {{-- <p class="desc" data-aos="fade-down" data-aos-duration="1400">Đơn hàng của bạn đã được xử lý thành công. Bạn có thể tiếp tục mua sắm hoặc xem chi tiết đơn hàng của mình bằng cách sử dụng các nút bên dưới.</p> --}}
                            <div class="btn-group mt-4">
                                <a class="btn btn-outline-success me-2 custom-btn" href="{{route('shop.filter')}}" data-aos="fade-down" data-aos-duration="1600">Tiếp tục mua hàng</a>
                                <a class="btn btn-outline-danger order-detail-btn" href="order-tracking.html" data-aos="fade-down" data-aos-duration="1600">Chi tiết đơn hàng</a>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </section>
    <!--== End Payment Success Area Wrapper ==-->
</main>
<style>
    .custom-btn {
        font-weight: 600; 
        border-width: 2px; 
    }
     .order-detail-btn {
        color: #eb3e32; 
        border: 2px solid #eb3e32;
        font-weight: 600;
    }
     .order-detail-btn:hover {
        background-color: #eb3e32; 
        color: white;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@endsection