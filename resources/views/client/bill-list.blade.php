@extends('client.layout')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <!-- breadcrumb area start -->
    <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
        <div class="container pt--0 pb--0">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-content">
                        <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Danh sách đơn hàng</h2>
                        <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Trang chủ</a></li>
                                <li class="breadcrumb-sep">//</li>
                                <li>Danh sách đơn hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <div class="wishlist-main-wrapper section-padding">
        <div class="container">
            <!-- Wishlist Page Content Start -->
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Wishlist Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái đơn hàng</th>
                                        <th>Loại thanh toán</th>
                                        <th>Trạng thái thanh toán</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bills as $item)
                                        <tr>
                                            <td>
                                                {{ $item->code }}
                                            </td>
                                            <td>
                                                {{ !empty($item->created_at) ? $item->created_at->format('d-m-Y') : '' }}
                                            </td>
                                            <td><span>{{ number_format($item->total_price, 0, '', '.') }} đ</span></td>
                                            <td>{{ $item->bill_status }}</td> 
                                            <td>{{ $item->payment_type }}</td> 
                                            <td>{{ $item->payment_status }}</td> 
                                            <td>
                                                <a href="" class="btn btn-primary">Xem</a>

                                                <a href="" class="btn btn-danger">Hủy</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Wishlist Page Content End -->
        </div>
    </div>
@endsection
