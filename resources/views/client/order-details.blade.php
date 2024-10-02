@extends('client.layout')

@section('title', 'Account')

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
                                                <label for="username" class="required">Tên đăng
                                                    nhập</label>
                                                <input type="text" id="username" value="Quỳnh" disabled>
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
                                    </div>
                                    <div class="single-input-item">
                                        <label for="location" class="required">Địa chỉ nhận hàng</label>
                                        <input type="text" id="location" value="Đình Thôn, Hà Nội">
                                    </div>
                                    <div class="single-input-item">
                                        <div class="myaccount-content">
                                            <h3>Chọn phương thức thành toán</h3>
                                            <p class="saved-message">Thêm phương thức ở đây</p>
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <button type="submit" class="check-btn sqr-btn">Đặt hàng</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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
                  <button class="nav-link" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="account-info" aria-selected="false">Chi tiết tài khoản</button>
                  <button class="nav-link active" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="true"> Đơn hàng</button>
                  <button class="nav-link" id="download-tab" data-bs-toggle="tab" data-bs-target="#download" type="button" role="tab" aria-controls="download" aria-selected="false">Tải về</button>
                  <button class="nav-link" id="payment-method-tab" data-bs-toggle="tab" data-bs-target="#payment-method" type="button" role="tab" aria-controls="payment-method" aria-selected="false">Phương thức thanh toán</button>
                  <button class="nav-link" id="address-edit-tab" data-bs-toggle="tab" data-bs-target="#address-edit" type="button" role="tab" aria-controls="address-edit" aria-selected="false">Địa chỉ</button>
                  <button class="nav-link" onclick="window.location.href='{{route('logout')}}'" type="button">Đăng xuất</button>
                  @endauth

                </div>
            </div>
        </section>
        <!--== End My Account Wrapper ==-->
    </main>
@endsection

            <div class="col-lg-9 col-md-8">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                  <div class="myaccount-content">
                    <h3>Chi tiết tài khoản</h3>
                    @if (Session('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session('success')}}
                    </div>
                    @endif
                    <div class="account-details-form">
                      <form action="" method="POST">
                        @csrf
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="single-input-item">
                              <label for="first-name" class="required">Họ và tên đầy đủ</label>
                              <input type="text" id="first-name" value="{{ Auth::user()->fullname}}" disabled>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="single-input-item">
                              <label for="last-name" class="required">Tên người dùng</label>
                              <input type="text" id="last-name" value="{{ Auth::user()->username}}">
                            </div>
                          </div>
                        </div>
                        <div class="single-input-item">
                          <label for="email" class="required">Email</label>
                          <input type="email" id="email" value="{{ Auth::user()->email}}">
                        </div>
                        <div class="single-input-item">
                          <label for="display-name" class="required">Hình đại diện(Không bắt buộc)</label>
                          <input type="text" id="display-name" disabled>
                        </div>
                       
                        <fieldset>
                          <legend>Đổi mật khẩu</legend>
                          @if (Session('error'))
                          <div class="alert alert-danger" role="alert">
                              {{Session('error')}}
                          </div>
                          @endif
                          <div class="single-input-item">
                            <label for="current-pwd" class="required">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                            @error('current_password')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="single-input-item">
                                <label for="new-pwd" class="required">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                                @error('new_password')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="single-input-item">
                                <label for="confirm-pwd" class="required">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                @error('new_password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                              </div>
                            </div>
                          </div>
                        </fieldset>
                        <div class="single-input-item">
                          <button type="submit" class="check-btn sqr-btn">Đổi mật khẩu</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                  <div class="myaccount-content">
                    <h3>Chi tiết đơn hàng</h3>
                    <div class="myaccount-table table-responsive text-center">
                      <table class="table table-bordered">
                        <thead class="thead-light">
                          <tr>
                            <th>Đặt hàng</th>
                            <th>Ngày</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Hoạt động</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Ngày 22 tháng 8 năm 2024</td>
                            <td>Chưa giải quyết</td>
                            <td>IMG</td>
                            <td>3000</td>
                            <td>3000</td>
                            <td>3000</td>
                            <td>Quay lại</td>
                            {{-- <td><a href="shop-cart.html" class="check-btn sqr-btn ">Xem</a></td> --}}
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="download" role="tabpanel" aria-labelledby="download-tab">
                  <div class="myaccount-content">
                    <h3>Tải xuống</h3>
                    <div class="myaccount-table table-responsive text-center">
                      <table class="table table-bordered">
                        <thead class="thead-light">
                          <tr>
                            <th>Sản phẩm</th>
                            <th>Ngày</th>
                            <th>Hết hạn</th>
                            <th>Tải về</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Ola</td>
                            <td>Ngày 22 tháng 8 năm 2024</td>
                            <td>Đúng</td>
                            <td><a href="#/" class="check-btn sqr-btn"><i class="fa fa-cloud-download"></i> Tải xuống tập tin</a></td>
                          </tr>
                          <tr>
                            <td>Ola</td>
                            <td>Ngày 12 tháng 9 năm 2024</td>
                            <td>Không bao giờ</td>
                            <td><a href="#/" class="check-btn sqr-btn"><i class="fa fa-cloud-download"></i> Tải xuống tập tin</a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="payment-method" role="tabpanel" aria-labelledby="payment-method-tab">
                  <div class="myaccount-content">
                    <h3>Phương thức thanh toán</h3>
                    <p class="saved-message">Bạn chưa thể lưu phương thức thanh toán của mình.</p>
                  </div>
                </div>
                <div class="tab-pane fade" id="address-edit" role="tabpanel" aria-labelledby="address-edit-tab">
                  <div class="myaccount-content">
                    <h3>Địa chỉ thanh toán</h3>
                    <address>
                      <p><strong>Nguyễn Văn Linh</strong></p>
                      <p>123 Trần Thái Tông<br>
                        Hà Nội</p>
                      <p>Di động: (84) 0865 356 423</p>
                    </address>
                    <a href="#/" class="check-btn sqr-btn"><i class="fa fa-edit"></i> Sửa Địa Chỉ</a>
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

