@extends('client.layout')

@section('title', 'Đăng ký')

@section('content')
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-content">
                            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Đăng ký</h2>
                            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                                <ul class="breadcrumb">
                                    <li><a href="index.html">Trang chủ</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Đăng ký</li>
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
                            <h2 class="title">Đăng ký</h2>
                        </div>
                    </div>
                </div>
                @if (Session('error'))
                <div class="alert alert-danger" role="alert">
                    {{Session('error')}}
                </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="register-form-content">
                            <form action="{{ route('registerSubmit') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="username">Họ tên<span class="required">*</span></label>
                                            <input id="fullname" name="full_name" class="form-control" type="text"
                                                value="{{ old('full_name') }}">
                                            @error('full_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email">Email<span class="required">*</span></label>
                                            <input id="email" name="email" class="form-control" type="text"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="password">Mật khẩu<span class="required">*</span></label>
                                        <input id="password" name="password" class="form-control" type="password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="password">Nhập lại mật khẩu<span class="required">*</span></label>
                                        <input id="password_confirmation" name="password_confirmation" class="form-control"
                                            type="password">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Số điện thoại (có thể để trống)<span
                                                class="required">*</span></label>
                                        <input id="phone_number" name="phone_number" class="form-control" type="number"
                                            value="{{ old('phone_number') }}">
                                        @error('phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Địa chỉ (có thể để trống)<span
                                                class="required">*</span></label>
                                        <input id="address" name="address" class="form-control" type="text"
                                            value="{{ old('address') }}">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb--0">
                                            <button type="submit" class="btn-register">Đăng ký</button>
                                        </div>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <label>Bạn đã có tài khoản?</label>
                                        <a href="{{ route('login') }}"><span style="color: red">Đăng nhập tại
                                                đây.</span></a>
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
