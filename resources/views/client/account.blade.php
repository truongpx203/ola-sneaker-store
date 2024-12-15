@extends('client.layout')

@section('title', 'Tài khoản')

@section('content')
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-content">
                            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Tài khoản</h2>
                            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                                <ul class="breadcrumb">
                                    <li><a href="index.html">Trang chủ</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Tài khoản</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start My Account Wrapper ==-->
        <section class="my-account-area">
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="myaccount-page-wrapper">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <nav>
                                        <div class="myaccount-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                                            @auth
                                                <button class="nav-link active" id="account-info-tab" data-bs-toggle="tab"
                                                    data-bs-target="#account-info" type="button" role="tab"
                                                    aria-controls="account-info" aria-selected="true">Tài khoản</button>
                                                <button class="nav-link" id="orders-tab" data-bs-toggle="tab"
                                                    data-bs-target="#orders" type="button" role="tab"
                                                    aria-controls="orders" aria-selected="false"> Đơn hàng</button>
                                                {{-- <button class="nav-link" id="download-tab" data-bs-toggle="tab" data-bs-target="#download" type="button" role="tab" aria-controls="download" aria-selected="false">Download</button> --}}
                                                <button class="nav-link" id="voucher-list-tab" data-bs-toggle="tab"
                                                    data-bs-target="#voucher-list" type="button" role="tab"
                                                    aria-controls="voucher-list" aria-selected="false">Mã giảm giá của bạn</button>
                                                {{-- 7/11/2024  --}}
                                                <button class="nav-link" id="points-tab" data-bs-toggle="tab"
                                                    data-bs-target="#points" type="button" role="tab"
                                                    aria-controls="points" aria-selected="false">Tích điểm</button>
                                                <button class="nav-link" onclick="window.location.href='{{ route('logout') }}'"
                                                    type="button">Đăng xuất</button>
                                            @endauth
                                        </div>
                                    </nav>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="account-info" role="tabpanel"
                                            aria-labelledby="account-info-tab">
                                            <div class="myaccount-content">
                                                <h3>Thông tin tài khoản</h3>
                                                @if (Session('success'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ Session('success') }}
                                                    </div>
                                                @endif
                                                <div class="account-details-form">

                                                    <form action="{{ route('your.route.name') }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="first-name" class="required">Họ tên</label>
                                                                    <input type="text" id="first-name" name="full_name"
                                                                        value="{{ Auth::user()->full_name }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="last-name" class="required">Số điện
                                                                        thoại</label>
                                                                    <input type="text" id="last-name" name="phone_number"
                                                                        value="{{ Auth::user()->phone_number }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">Email</label>
                                                            <input type="email" id="email" name="email"
                                                                value="{{ Auth::user()->email }}" disabled>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="display-name" class="required">Địa chỉ</label>
                                                            <input type="text" id="display-name" name="address"
                                                                value="{{ Auth::user()->address }}">
                                                        </div>
                                                        <div class="single-input-item">
                                                            <button type="submit" class="check-btn sqr-btn">Lưu thông
                                                                tin</button>
                                                        </div>

                                                    </form>
                                                    <form action="{{route('profile.update.password')}}" method="post">
                                                        @csrf
                                                        <fieldset>
                                                            <legend>Đổi mật khẩu</legend>
                                                            @if (Session('error'))
                                                                <div class="alert alert-danger" role="alert">
                                                                    {{ Session('error') }}
                                                                </div>
                                                            @endif
                                                            <div class="single-input-item">
                                                                <label for="current-pwd" class="required">Mật khẩu hiện
                                                                    tại</label>
                                                                <input type="password" class="form-control"
                                                                    id="current_password" name="current_password">
                                                                @error('current_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd" class="required">Mật khẩu
                                                                            mới</label>
                                                                        <input type="password" class="form-control"
                                                                            id="new_password" name="new_password">
                                                                        @error('new_password')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm-pwd" class="required">Xác nhận
                                                                            mật khẩu mới</label>
                                                                        <input type="password" class="form-control"
                                                                            id="new_password_confirmation"
                                                                            name="new_password_confirmation">
                                                                        @error('new_password_confirmation')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="single-input-item">

                                                            <button type="submit" class="check-btn sqr-btn">Lưu thông
                                                                tin</button>
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="orders" role="tabpanel"
                                            aria-labelledby="orders-tab">
                                            <div class="myaccount-content">
                                                <h3>Hóa Đơn của {{ Auth::user()->full_name }}</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    @if ($bills->isEmpty())
                                                        <div class="alert alert-info">Bạn chưa có hóa đơn nào.</div>
                                                    @else
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Mã đơn hàng</th>
                                                                    <th>Ngày</th>
                                                                    <th>Trạng thái</th>
                                                                    <th>Phương thức thanh toán</th>
                                                                    <th>Tổng cộng</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            @php
                                                                $statusMapping = [
                                                                    'pending' => 'Chờ xác nhận',
                                                                    'confirmed' => 'Đã xác nhận',
                                                                    'in_delivery' => 'Đang giao',
                                                                    'delivered' => 'Giao hàng thành công',
                                                                    'failed' => 'Giao hàng thất bại',
                                                                    'canceled' => 'Đã hủy',
                                                                    'completed' => 'Hoàn thành',
                                                                ];
                                                            @endphp
                                                            @php
                                                                $paymentTypeMapping = [
                                                                    'momo' => 'Thanh toán momo',
                                                                    'vnpay' => 'Thanh toán vnpay',
                                                                    'cod' => 'Thanh toán cod',
                                                                ];
                                                            @endphp

                                                            <tbody>
                                                                @foreach ($bills as $bill)
                                                                    <tr>
                                                                        <td>{{ $bill->code }}</td>
                                                                        <td>{{ $bill->created_at->format('d/m/Y') }}</td>
                                                                        <td>{{ $statusMapping[$bill->bill_status] }}</td>
                                                                        <td>{{ $paymentTypeMapping[$bill->payment_type] }}
                                                                        </td>
                                                                        <td>{{ number_format($bill->total_price, 0, ',', '.') }}
                                                                            VNĐ</td>
                                                                        <td>
                                                                            <a href="{{ route('order-details', $bill->id) }}"
                                                                                class="btn btn-info">Xem</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="d-flex justify-content-end">
                                                            <div class="pagination-wrap hstack gap-2">
                                                                {{ $bills->appends(request()->input())->links('pagination::bootstrap-4') }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="voucher-list" role="tabpanel"
                                            aria-labelledby="voucher-list">
                                            <div class="myaccount-content">
                                                <h3>Mã giảm giá của {{ Auth::user()->full_name }}</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    @if (count($listVouchers)<=0 )
                                                        <div class="alert alert-info">Bạn chưa có mã giảm giá nào.</div>
                                                    @else
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Mã đơn hàng</th>
                                                                    <th>Giảm(%)</th>
                                                                    <th>Số tiền tối đa</th>
                                                                    <th>Mô tả</th>
                                                                    <th>Ngày bắt đầu</th>
                                                                    <th>Ngày kết thúc</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($listVouchers as $listVoucher)
                                                                    <tr>
                                                                        <td>{{ $listVoucher->code }}</td>
                                                                        <td>{{ $listVoucher->value }}</td>
                                                                        <td>{{ number_format($listVoucher->max_price) }}</td>
                                                                        <td>{{ $listVoucher->description }}</td>
                                                                        <td>{{ $listVoucher->start_datetime }}</td>
                                                                        <td>{{ $listVoucher->end_datetime }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="d-flex justify-content-end">
                                                            {{-- <div class="pagination-wrap hstack gap-2">
                                                                {{ $listVouchers->appends(request()->input())->links('pagination::bootstrap-4') }}
                                                            </div> --}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- 7/11/2024 --}}

                                        <div class="tab-pane fade" id="points" role="tabpanel"
                                            aria-labelledby="points-tab">
                                            <div class="myaccount-content">
                                                <p>Điểm tích lũy hiện tại của bạn: <strong>{{ $user->points }}</strong></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End My Account Wrapper ==-->
    </main>
@endsection
