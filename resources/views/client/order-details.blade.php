@extends('client.layout')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area" data-bg-img="{{ asset('assets/img/photos/bg3.webp') }}">
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
                        @if (Session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session('error') }}
                            </div>
                        @endif
                        @error('note')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        @if (Session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session('success') }}
                            </div>
                        @endif
                        <div class="myaccount-content">
                            <h3>Thông tin vận chuyển</h3>
                            @php
                                $paymentTypeMapping = [
                                    'online' => 'Chuyển khoản trực tuyến',
                                    'cod' => 'Thanh toán khi nhận hàng',
                                ];
                                $paymentStatusMapping = [
                                    'pending' => 'Chưa thanh toán',
                                    'completed' => 'Đã thanh toán',
                                    // 'failed' => 'Thất bại',
                                ];
                            @endphp
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
                                            <input type="text" id="fullname"
                                                value="{{ $paymentTypeMapping[$bill->payment_type] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <label for="email" class="required">Trạng thái thanh toán</label>
                                            <input type="email" id="email"
                                                value="{{ $paymentStatusMapping[$bill->payment_status] }}" disabled>
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
                                            <th>Hình ảnh</th>
                                            <th>Size</th>
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
                                                <td> <img src="{{ Storage::url($item->product_image_url) }}" width="90" height="110" alt="img"></td>
                                                <td>{{ $item->variant->size->name }}</td>
                                                <td>{{ $item->variant_quantity }}</td>
                                                <td>{{ number_format($item->sale_price, 0, ',', '.') }}</td>
                                                <td>{{ number_format($bill->total_price, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="myaccount-content">
                                    {{-- <p class="saved-message">Giảm giá: <span class="text-danger">-$1000</span></p> --}}
                                    {{-- <p class="saved-message">Tiền ship: <span class="text-danger">30.000đ</span></p> --}}
                                    <strong>
                                        <p class="saved-message">Tổng tiền hàng:
                                            {{ number_format($bill->total_price, 0, ',', '.') }}<span class="text-danger"
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
                                            <th>Trạng thái</th>
                                            <th>Ghi chú</th>
                                            <th>Thời gian</th>
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

                                    <tbody>
                                        @foreach ($bill->histories as $index => $history)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $statusMapping[$history->to_status] }}</td>
                                                <td>{{ $history->note ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($history->at_datetime)->format('d/m/Y H:i') }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    @if ($bill->bill_status === 'completed')
                                        <div class="alert alert-success" role="alert">
                                            Hóa đơn đã hoàn thành.
                                        </div>
                                    @endif
                                </table>
                            </div>
                        </div>
                        <!-- Kiểm tra trạng thái để hiển thị form hoàn thành -->
                        @if ($bill->bill_status === 'delivered')
                            <div class="complete-order-form m-4 text-center">
                                <form action="{{ route('completeOrder', $bill->id) }}" method="POST">
                                    @csrf
                                    <div class="single-input-item">
                                        <button type="submit" class="btn btn-primary">Đánh dấu hoàn thành đơn hàng</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="myaccount-content">
                            <div class="account-details-form">
                                <form action="{{ route('cancelOrder', $bill->id) }}" method="POST">
                                    @csrf
                                    <div class="form-floating mb-4">
                                        <textarea class="form-control" name="note" placeholder="Nhập lý do hủy đơn hàng tại đây" id="floatingTextarea2"
                                            style="height: 100px" {{ $bill->bill_status !== 'pending' ? 'disabled' : '' }}></textarea>
                                        <label for="floatingTextarea2">Ghi chú</label>
                                    </div>
                                    <div class="single-input-item">
                                        <button type="submit" class="check-btn sqr-btn" {{ $bill->bill_status !== 'pending' ? 'disabled' : '' }}>Hủy đơn</button>
                                    </div>
                                </form>

                                <style>
                                    .form-control {
                                        border-radius: 0;
                                        border: 1px solid #ced4da;
                                    }
                                    .alert-success{
                                        border-radius: 0;
                                        border: 1px solid #ced4da;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End My Account Wrapper ==-->
    </main>
    {{-- <script>
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
    </script> --}}
@endsection
