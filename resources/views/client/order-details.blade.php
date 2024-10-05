@extends('client.layout')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-content">
                            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Chi tiết đơn hàng</h2>
                            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                                <ul class="breadcrumb">
                                    <li><a href="index.html">Trang chủ</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Chi tiết đơn hàng</li>
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
                    <div class="col-lg-12 col-md-12">
                        <div class="myaccount-content">
                            <h3>Chi tiết đơn hàng</h3>
                            <div class="myaccount-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Thuộc tính</th>
                                            <th>Hình ảnh</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Sản phẩm 1</td>
                                            <td>Màu: kem, Kích thước: 35</td>
                                            <td>Pending</td>
                                            <td>$3000</td>
                                            <td><input class="w-25 border-0 text-center" type="number" name="" id="" min="1"
                                                    value="2"></td>
                                            <td>$6000</td>
                                            <td><a href="">X</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="myaccount-content">
                                    <strong><p class="saved-message">Tổng tiền hàng: <span class="text-danger">$6000</span></p></strong>
                                </div>
                            </div>
                        </div>
                        <div class="myaccount-content">
                            <h3>Thông tin vận chuyển</h3>
                            @if (Session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session('success') }}
                                </div>
                            @endif
                            <div class="account-details-form">
                                <form action="" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <label for="fullname" class="required">Họ và
                                                    tên</label>
                                                <input type="text" id="fullname" value="Bùi Lệ Quỳnh" disabled>
                                            </div>
                                        </div>         
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <label for="email" class="required">Email</label>
                                                <input type="email" id="email" value="Quynh@gmail.com" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <label for="phone" class="required">Số điện thoại</label>
                                                <input type="text" id="phone" value="099999999" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <label for="location" class="required">Địa chỉ nhận hàng</label>
                                                <input type="text" id="location" value="Đình Thôn, Hà Nội">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <label for="location" class="required">Ghi chú đơn hàng</label>
                                        <input type="text" id="location" value="Anh đẹp zai giao nhớ cẩn thận giúp em :))">
                                    </div>
                                    <div class="single-input-item">
                                        <div class="myaccount-content">
                                            <h3>Phương thức đã thanh toán</h3>
                                            <p class="saved-message">Thanh toán khi nhận hàng</p>
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <button type="submit" class="check-btn sqr-btn">Trang chủ</button>
                                        <button type="submit" class="check-btn sqr-btn">Quay lại</button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End My Account Wrapper ==-->
    </main>
@endsection
