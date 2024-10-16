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
                        @if ($errors->has('cancelBill'))
                            <div class="alert alert-danger">
                                {{ $errors->first('cancelBill') }}
                            </div>
                        @endif
                        <div class="myaccount-content">
                            <h3>Thông tin vận chuyển</h3>
                            @if (Session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session('success') }}
                                </div>
                            @endif
                            <div class="account-details-form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single-input-item">
                                            <label for="fullname" class="required">Mã đơn hàng</label>
                                            <input type="text" id="fullname" value="{{ $bill->code }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <label for="fullname" class="required">Phương thức thanh toán</label>
                                            <input type="text" id="fullname" value="{{ $bill->payment_type }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <label for="email" class="required">Trạng thái thanh toán</label>
                                            <input type="email" id="email" value="{{ $bill->payment_status }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <label for="phone" class="required">Tên khách hàng</label>
                                            <input type="text" id="phone" value="{{ $bill->full_name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <label for="location" class="required">Số điện thoại</label>
                                            <input type="text" id="location" value="{{ $bill->phone_number }}"disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-input-item">
                                            <label for="location" class="required">Địa chỉ nhận hàng</label>
                                            <input type="text" id="location" value="{{ $bill->address }}"disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="myaccount-content">
                            <h3>Chi tiết đơn hàng</h3>
                            <div class="myaccount-table table-responsive text-center">
                                @php
                                    $tongTien = 0;
                                @endphp
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Biến thể</th>
                                            <th>Số lượng</th>
                                            <th>Giá bán</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bill->items as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->product_name }}</td>
                                                <td>{{ $item->variant->size->name }}</td>
                                                <td>{{ $item->variant_quantity }}</td>
                                                <td>{{ $item->listed_price }}</td>
                                                <td>{{ $item->import_price }}</td>
                                            </tr>
                                            @php
                                                $tongTien += $item->import_price;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="myaccount-content">
                                    {{-- <p class="saved-message">Giảm giá: <span class="text-danger">-$1000</span></p> --}}
                                    <p class="saved-message">Tiền ship: <span class="text-danger">30.000đ</span></p>
                                    <strong>
                                        <p class="saved-message">Tổng tiền hàng: <span class="text-danger"
                                                id="formattedTotal"></span></p>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="myaccount-content">
                            <h3>Trạng thái đơn hàng</h3>
                            <div class="myaccount-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>STT</th>
                                            <th>Trạng thái thay đổi</th>
                                            <th>Ghi chú</th>
                                            <th>Thời gian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bill->histories as $index => $history)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $history->to_status }}</td>
                                                @if ($history->note == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ $history->note }}</td>
                                                @endif
                                                <td>{{ $history->at_datetime }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="myaccount-content">
                            <div class="account-details-form">
                                <form action="{{ route('cancelOrder', $bill->id) }}" method="POST">
                                    @csrf
                                    <div class="single-input-item">
                                        <button type="submit" class="check-btn sqr-btn">Hủy đơn</button>
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
    <script>
        function FromatNumberVIE(val) {
            var sign = 1;
            if (val < 0) {
                sign = -1;
                val = -val;
            }
            let num = val?.toString().includes(".") ?
                val?.toString().split(".")[0] :
                val?.toString();
            let len = num?.toString().length;
            let result = "";
            let count = 1;

            for (let i = len - 1; i >= 0; i--) {
                result = num?.toString()[i] + result;
                if (count % 3 === 0 && count !== 0 && i !== 0) {
                    result = "." + result;
                }
                count++;
            }

            if (val?.toString().includes(".")) {
                result = result + "." + val?.toString().split(".")[1];
            }
            return sign < 0 ? "-" + result : result;
        }
        const total = {{ $tongTien + 30000 }};
        document.getElementById('formattedTotal').innerText = FromatNumberVIE(total) + "đ";
    </script>
@endsection
