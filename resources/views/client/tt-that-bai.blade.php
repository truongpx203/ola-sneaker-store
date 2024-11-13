@extends('client.layout')

@section('title', 'Thanh toán thất bại')

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
                                    <i class="bi bi-x-circle" style="font-size: 70px; color: red;"></i>
                                </div>
                                <h3 class="success-text" data-aos="fade-down" data-aos-duration="1000">Thanh Toán Thất bại!
                                </h3>
                                <h3 class="title" data-aos="fade-down" data-aos-duration="1200">Vui lòng kiểm tra lại quá
                                    trình thanh toán</h3>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="btn-group mt-4">
                                    <a class="btn btn-outline-success me-2 custom-btn" href="{{ route('shop.filter') }}"
                                        data-aos="fade-down" data-aos-duration="1600">Tiếp tục mua hàng</a>
                                    <a class="btn btn-outline-danger order-detail-btn" href="{{ route('cart.show') }}"
                                        data-aos="fade-down" data-aos-duration="1600">Giỏ hàng</a>
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
