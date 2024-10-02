@extends('client.layout')

@section('title', 'Liên hệ')

@section('content')
<main class="main-content">
  <!--== Start Page Header Area Wrapper ==-->
  <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
    <div class="container pt--0 pb--0">
      <div class="row">
        <div class="col-12">
          <div class="page-header-content">
            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Liên hệ</h2>
            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
              <ul class="breadcrumb">
                <li><a href="index.html">Trang chủ</a></li>
                <li class="breadcrumb-sep">//</li>
                <li>Liên hệ</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--== End Page Header Area Wrapper ==-->

  <!--== Start Contact Area Wrapper ==-->
  <section class="contact-area contact-page-area">
    <div class="container">
      <div class="row contact-page-wrapper">
        <div class="col-xl-9">
          <div class="contact-form-wrap" data-aos="fade-right">
            <div class="contact-form-title">
              <h2 class="title">Chúng Tôi Luôn Sẵn Sàng!<br>Hãy gửi Thắc Mắc Của Bạn</h2>
            </div>
            <!--== Start Contact Form ==-->
            <div class="contact-form">
              <form id="contact-form" action="https://whizthemes.com/mail-php/raju/arden/mail.php" method="POST">
                <div class="row row-gutter-20">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" name="con_name" placeholder="Họ tên *">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="email" name="con_email" placeholder="Email *">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="Tiêu đề">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group mb--0">
                      <textarea class="form-control" name="con_message" placeholder="Nội dung"></textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group mb--0">
                      <button class="btn-theme" type="submit">Gửi tin nhắn</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!--== End Contact Form ==-->

            <!--== Message Notification ==-->
            <div class="form-message"></div>
            <div class="shape-group-style2">
              <div class="shape-group-one"><img src="assets/img/shape/13.webp" width="193" height="168" alt="Image-HasTech"></div>
              <div class="shape-group-two"><img src="assets/img/shape/15.webp" width="221" height="113" alt="Image-HasTech"></div>
              <div class="shape-group-three"><img src="assets/img/shape/16.webp" width="129" height="147" alt="Image-HasTech"></div>
              <div class="shape-group-four"><img src="assets/img/shape/17.webp" width="493" height="340" alt="Image-HasTech"></div>
            </div>
          </div>
        </div>
        <div class="col-xl-3">
          <div class="contact-info-wrap">
            <div class="contact-info">
              <div class="row">
                <div class="col-lg-4 col-xl-12">
                  <div class="info-item"  data-aos="fade-left">
                    <div class="icon">
                      <img src="assets/img/icons/c1.webp" width="69" height="65" alt="Image-HasTech">
                    </div>
                    <div class="info">
                      <h5 class="title">Địa chỉ</h5>
                      <p>Polytechnin Hà Nội, Trái Đất </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-xl-12">
                  <div class="info-item"  data-aos="fade-left" data-aos-delay="60">
                    <div class="icon">
                      <img src="assets/img/icons/c2.webp" width="65" height="65" alt="Image-HasTech">
                    </div>
                    <div class="info">
                      <h5 class="title">Số điện thoại</h5>
                      <p>
                        <a href="tel://+00123456789">0328902188</a><br>
                        {{-- <a href="tel://+00123456789">+00123456789</a> --}}
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-xl-12">
                  <div class="info-item"  data-aos="fade-left" data-aos-delay="120">
                    <div class="icon">
                      <img src="assets/img/icons/c3.webp" width="65" height="65" alt="Image-HasTech">
                    </div>
                    <div class="info">
                      <h5 class="title">Email</h5>
                      <p>
                        <a href="mailto://demo@example.com">adminDZ@gmail.com</a><br>
                        {{-- <a href="mailto://www.example.com">www.example.com</a> --}}
                      </p>
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
  <!--== End Contact Area Wrapper ==-->
</main>
@endsection