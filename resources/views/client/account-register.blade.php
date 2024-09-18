@extends('client.layout')

@section('title', 'Register')

@section('content')
<main class="main-content">
  <!--== Start Page Header Area Wrapper ==-->
  <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
    <div class="container pt--0 pb--0">
      <div class="row">
        <div class="col-12">
          <div class="page-header-content">
            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Register</h2>
            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
              <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="breadcrumb-sep">//</li>
                <li>Register</li>
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
            <h2 class="title">Register</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="register-form-content">
            <form action="{{ route('registerSubmit')}}" method="post">
              @csrf
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="username">Full name <span class="required">*</span></label>
                    <input id="fullname" name="fullname" class="form-control" type="text" value="{{old('fullname')}}">
                    @error('fullname')
                <span class="text-danger">{{$message}}</span>
            @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="username">Username <span class="required">*</span></label>
                    <input id="username" name="username" class="form-control" type="text" value="{{old('username')}}">
                    @error('username')
                <span class="text-danger">{{$message}}</span>
            @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="email">Email<span class="required">*</span></label>
                    <input id="email" name="email" class="form-control" type="email" value="{{old('email')}}">
                    @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="password">Password <span class="required">*</span></label>
                    <input id="password" name="password" class="form-control" type="password">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="password">password_confirmation <span class="required">*</span></label>
                    <input id="password_confirmation" name="password_confirmation" class="form-control" type="password">
                    @error('password_confirmation')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group mb--0">
                    <button type="submit" class="btn-register">Register</button>
                  </div>
                </div>
                <div class="mt-5 text-center">
                  <label>Bạn đã có tài khoản?</label>
                    <a href="{{ route('login')}}"><span style="color: red">Đăng nhập tại đây.</span></a>
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