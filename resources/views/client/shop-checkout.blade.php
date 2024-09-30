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
      <div class="row">
        <div class="col-12">
          <div class="checkout-page-login-wrap">
            <!--== Start Checkout Login Accordion ==-->
            <div class="login-accordion" id="LoginAccordion">
              <div class="card">
                <h3>
                  <i class="fa fa-info-circle"></i>
                  Khách hàng quay lại ?
                  <a href="#/" data-bs-toggle="collapse" data-bs-target="#loginaccordion">Nhấp vào đây để đăng nhập</a>
                </h3>
                <div id="loginaccordion" class="collapse" data-bs-parent="#LoginAccordion">
                  <div class="card-body">
                    <div class="login-wrap">
                      {{-- <p>If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing & Shipping section.</p> --}}
                      <form action="#" method="post">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="logEmail">Email <span class="required">*</span></label>
                              <input id="logEmail" class="form-control" type="email">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group left-m">
                              <label for="logPass">Mật khẩu<span class="required">*</span></label>
                              <input id="logPass" class="form-control" type="password">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-30">
                              <button class="btn-login">Đăng nhập</button>
                              <a class="lost-password" href="#">Quên mật khẩu?</a>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--== End Checkout Login Accordion ==-->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="checkout-page-coupon-wrap">
            <!--== Start Checkout Coupon Accordion ==-->
            <div class="coupon-accordion" id="CouponAccordion">
              <div class="card">
                <h3>
                  <i class="fa fa-info-circle"></i>
                  Có phiếu giảm giá ? 
                  <a href="#/" data-bs-toggle="collapse" data-bs-target="#couponaccordion">Nhấp vào đây để nhập mã của bạn</a>
                </h3>
                <div id="couponaccordion" class="collapse" data-bs-parent="#CouponAccordion">
                  <div class="card-body">
                    <div class="apply-coupon-wrap mb-60">
                      <p>Nếu bạn có mã giảm giá, vui lòng áp dụng bên dưới.</p>
                      <form action="#" method="post">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <input class="form-control" type="text" placeholder="Mã giảm giá">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <button class="btn-coupon">Áp dụng</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--== End Checkout Coupon Accordion ==-->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <!--== Start Billing Accordion ==-->
          <div class="checkout-billing-details-wrap">
            <h2 class="title">Chi tiết thanh toán</h2>
            <div class="billing-form-wrap">
              <form action="#" method="post">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="f_name">Họ tên<abbr class="required" title="required">*</abbr></label>
                      <input id="f_name" type="text"  class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="phone">Số điện thoại<abbr class="required" title="required">*</abbr></label>
                      <input id="phone" type="text"  class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group" data-margin-bottom="30">
                      <label for="email">Email<abbr class="required" title="required">*</abbr></label>
                      <input id="email" type="text"  class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="street-address">Địa chỉ <abbr class="required" title="required">*</abbr></label>
                      <input id="street-address" type="text"  class="form-control" placeholder="House number and street name">
                    </div>
                  </div>
                  
                  <div class="col-md-12">
                    <div class="form-group mb--0">
                      <label for="order-notes">Ghi chú đơn hàng (tùy chọn)</label>
                      <textarea id="order-notes" class="form-control" placeholder="Ghi chú về đơn hàng của bạn, ví dụ ghi chú đặc biệt về việc giao hàng."></textarea>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!--== End Billing Accordion ==-->
        </div>
        <div class="col-lg-6">
          <!--== Start Order Details Accordion ==-->
          <div class="checkout-order-details-wrap">
            <div class="order-details-table-wrap table-responsive">
              <h2 class="title mb-25">Đơn hàng của bạn</h2>
              <table class="table">
                <thead>
                  <tr>
                    <th class="product-name">Sản phẩm</th>
                    <th class="product-total">Tạm tính</th>
                  </tr>
                </thead>
                <tbody class="table-body">
                  <tr class="cart-item">
                    <td class="product-name">Satin gown <span class="product-quantity">× 1</span></td>
                    <td class="product-total">£69.99</td>
                  </tr>
                  <tr class="cart-item">
                    <td class="product-name">Printed cotton t-shirt <span class="product-quantity">× 1</span></td>
                    <td class="product-total">£20.00</td>
                  </tr>
                </tbody>
                <tfoot class="table-foot">
                  {{-- <tr class="cart-subtotal">
                    <th>Subtotal</th>
                    <td>£89.99</td>
                  </tr> --}}
                  <tr class="shipping">
                    <th>Phí vận chuyển</th>
                    <td>Miễn phí</td>
                  </tr>
                  <tr class="order-total">
                    <th>Tổng cộng</th>
                    <td>£91.99</td>
                  </tr>
                </tfoot>
              </table>
              <div class="shop-payment-method">
                <div id="PaymentMethodAccordion">
                  <div class="card">
                    <div class="card-header" id="check_payments">
                      <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemOne" aria-controls="itemOne" aria-expanded="true">Chuyển khoản ngân hàng trực tiếp</h5>
                    </div>
                    <div id="itemOne" class="collapse show" aria-labelledby="check_payments" data-bs-parent="#PaymentMethodAccordion">
                      <div class="card-body">
                        <p>Thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng Mã đơn hàng của bạn làm tham chiếu thanh toán. Đơn hàng của bạn sẽ không được giao cho đến khi tiền được chuyển vào tài khoản của chúng tôi.</p>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="check_payments3">
                      <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemThree" aria-controls="itemTwo" aria-expanded="false">Thanh toán khi nhận hàng</h5>
                    </div>
                    <div id="itemThree" class="collapse" aria-labelledby="check_payments3" data-bs-parent="#PaymentMethodAccordion">
                      <div class="card-body">
                        <p>Bạn đặt hàng và thanh toán sau khi nhân viên bưu điện đưa hàng đến nơi và thu tiền tận nhà bạn.</p>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="check_payments4">
                      <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemFour" aria-controls="itemTwo" aria-expanded="false">Thanh toán nhanh Paypal<img src="assets/img/photos/paypal2.webp" width="40" height="26" alt="Image-HasTech"></h5>
                    </div>
                    <div id="itemFour" class="collapse" aria-labelledby="check_payments4" data-bs-parent="#PaymentMethodAccordion">
                      <div class="card-body">
                        <p>Thanh toán qua PayPal; bạn có thể thanh toán bằng thẻ tín dụng nếu bạn không có tài khoản PayPal.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="account-login.html" class="btn-theme">Đặt hàng</a>
              </div>
            </div>
          </div>
          <!--== End Order Details Accordion ==-->
        </div>
      </div>
    </div>
  </section>
  <!--== End Shopping Checkout Area Wrapper ==-->
</main>
@endsection