@extends('client.layout')

@section('title', 'Quên mật khẩu')

@section('content')
<main class="main-content">
  <!--== Start Page Header Area Wrapper ==-->
  <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
    <div class="container pt--0 pb--0">
      <div class="row">
        <div class="col-12">
          <div class="page-header-content">
            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Quên mật khẩu</h2>
            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
              <ul class="breadcrumb">
                <li><a href="index.html">Trang chủ</a></li>
                <li class="breadcrumb-sep">//</li>
                <li>Quên mật khẩu</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--== End Page Header Area Wrapper ==-->

  <!--== Start My Account Area Wrapper ==-->
  <section class="account-area">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 m-auto">
          <div class="section-title text-center">
            <h2 class="title">Quên mật khẩu</h2>
          </div>
        </div>
      </div>
      @if (Session('error'))
      <div class="alert alert-danger" role="alert">
          {{Session('error')}}
      </div>
      @endif
      @if (Session('message'))
      <div class="alert alert-success" role="alert">
          {{Session('message')}}
      </div>
      @endif
      <div class="row">
        <div class="col-12">
          <div class="login-form-content">
            <form action="" method="POST">
              @csrf
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="email">Email<span class="required">*</span></label>
                    <input id="email" name="email" class="form-control" type="text" value="{{ old('email') }}">
                    @error('email')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <button class="btn-login" type="submit">Gửi email</button>
                  </div>
                </div>
                <div class="mt-5 text-center">
                    <label>Bạn chưa đã có tài khoản?</label>
                      <a href="{{ route('login')}}"><span style="color: red">Đăng nhập tại đây.</span></a>
                    </div>
                <div class="mt-2 text-center">
                <label>Bạn chưa có tài khoản?</label>
                  <a href="{{ route('register')}}"><span style="color: red">Đăng ký tại đây.</span></a>
                </div>
             
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--== End My Account Area Wrapper ==-->
</main>
@endsection