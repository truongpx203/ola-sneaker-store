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
            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Account</h2>
            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
              <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="breadcrumb-sep">//</li>
                <li>Account</li>
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
                  <button class="nav-link active" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="account-info" aria-selected="true">Account Details</button>
                  <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false"> Orders</button>
                  <button class="nav-link" id="download-tab" data-bs-toggle="tab" data-bs-target="#download" type="button" role="tab" aria-controls="download" aria-selected="false">Download</button>
                  <button class="nav-link" id="payment-method-tab" data-bs-toggle="tab" data-bs-target="#payment-method" type="button" role="tab" aria-controls="payment-method" aria-selected="false">Payment Method</button>
                  <button class="nav-link" id="address-edit-tab" data-bs-toggle="tab" data-bs-target="#address-edit" type="button" role="tab" aria-controls="address-edit" aria-selected="false">address</button>
                  <button class="nav-link" onclick="window.location.href='{{route('logout')}}'" type="button">Logout</button>
                  @endauth
                </div>
              </nav>
            </div>
            <div class="col-lg-9 col-md-8">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                  <div class="myaccount-content">
                    <h3>Account Details</h3>
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
                              <label for="first-name" class="required">Họ tên</label>
                              <input type="text" id="first-name" value="{{ Auth::user()->full_name}}" disabled>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="single-input-item">
                              <label for="last-name" class="required">Số điện thoại</label>
                              <input type="text" id="last-name" value="{{ Auth::user()->phone_number}}">
                            </div>
                          </div>
                        </div>
                        <div class="single-input-item">
                          <label for="email" class="required">Email</label>
                          <input type="email" id="email" value="{{ Auth::user()->email}}">
                        </div>
                        <div class="single-input-item">
                          <label for="display-name" class="required">Địa chỉ</label>
                          <input type="text" id="display-name" value="{{ Auth::user()->address}}">
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
                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                  <div class="myaccount-content">
                    <h3>Orders</h3>
                    <div class="myaccount-table table-responsive text-center">
                      <table class="table table-bordered">
                        <thead class="thead-light">
                          <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Aug 22, 2022</td>
                            <td>Pending</td>
                            <td>$3000</td>
                            <td><a href="{{route('order-details')}}" class="check-btn sqr-btn ">View</a></td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>July 22, 2022</td>
                            <td>Approved</td>
                            <td>$200</td>
                            <td><a href="{{route('order-details')}}" class="check-btn sqr-btn ">View</a></td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>June 12, 2022</td>
                            <td>On Hold</td>
                            <td>$990</td>
                            <td><a href="{{route('order-details')}}" class="check-btn sqr-btn ">View</a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="download" role="tabpanel" aria-labelledby="download-tab">
                  <div class="myaccount-content">
                    <h3>Downloads</h3>
                    <div class="myaccount-table table-responsive text-center">
                      <table class="table table-bordered">
                        <thead class="thead-light">
                          <tr>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Expire</th>
                            <th>Download</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Haven - Free Real Estate PSD Template</td>
                            <td>Aug 22, 2022</td>
                            <td>Yes</td>
                            <td><a href="#/" class="check-btn sqr-btn"><i class="fa fa-cloud-download"></i> Download File</a></td>
                          </tr>
                          <tr>
                            <td>HasTech - Profolio Business Template</td>
                            <td>Sep 12, 2022</td>
                            <td>Never</td>
                            <td><a href="#/" class="check-btn sqr-btn"><i class="fa fa-cloud-download"></i> Download File</a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="payment-method" role="tabpanel" aria-labelledby="payment-method-tab">
                  <div class="myaccount-content">
                    <h3>Payment Method</h3>
                    <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                  </div>
                </div>
                <div class="tab-pane fade" id="address-edit" role="tabpanel" aria-labelledby="address-edit-tab">
                  <div class="myaccount-content">
                    <h3>Billing Address</h3>
                    <address>
                      <p><strong>Alex Tuntuni</strong></p>
                      <p>1355 Market St, Suite 900 <br>
                        San Francisco, CA 94103</p>
                      <p>Mobile: (123) 456-7890</p>
                    </address>
                    <a href="#/" class="check-btn sqr-btn"><i class="fa fa-edit"></i> Edit Address</a>
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