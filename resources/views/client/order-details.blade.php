@extends('client.layout')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <style>
        /* .container {
                                                            padding: 20px;
                                                        } */
        .section-title {
            font-weight: bold;
            margin-top: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }

        .voucher {
            text-align: right;
        }

        .badge {
            padding: 0.5em 1em;
            border-radius: 0.25rem;
            color: #fff;
        }

        .bg-gray {
            background-color: #7d7d7d;
        }

        .bg-blue {
            background-color: #007bff;
        }

        .bg-lightblue {
            background-color: #5bc0de;
        }

        .bg-green {
            background-color: #28a745;
        }

        .bg-red {
            background-color: #dc3545;
        }

        .bg-orange {
            background-color: #fd7e14;
        }

        .bg-darkgray {
            background-color: #343a40;
        }

        .td-status {
            max-width: 400px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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

                        {{-- @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                        @error('note')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        @if (Session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session('error') }}
                            </div>
                        @endif
                        @if (Session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session('success') }}
                            </div>
                        @endif
                        <div class="myaccount-content">
                            <h3>Thông tin vận chuyển</h3>
                            @php
                                $paymentTypeMapping = [
                                    'momo' => 'Thanh toán momo',
                                    'vnpay' => 'Thanh toán vnpay',
                                    'cod' => 'Thanh toán cod',
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
                                            {{-- <th>Tổng tiền</th> --}}
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bill->items as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->product_name }}</td>
                                                <td> <img src="{{ Storage::url($item->product_image_url) }}" width="90"
                                                        height="110" alt="img"></td>
                                                <td>{{ $item->variant->size->name }}</td>
                                                <td>{{ $item->variant_quantity }}</td>
                                                <td>{{ number_format($item->sale_price, 0, ',', '.') }} đ</td>
                                                {{-- <td>{{ number_format($bill->total_price, 0, ',', '.') }}</td> --}}
                                                <td>
                                                    @if ($item->has_reviewed)
                                                        <span class="badge bg-success" style="border-radius: 0">Đã đánh
                                                            giá</span>
                                                    @else
                                                        @if ($bill->bill_status === 'completed')
                                                            <button class="btn btn-outline-danger" style="border-radius: 0"
                                                                onclick="toggleReviewForm({{ $item->variant->id }})">Đánh
                                                                giá</button>
                                                        @else
                                                            <button class="btn btn-outline-danger btn-sm alert-button"
                                                                style="border-radius: 0"
                                                                onclick="alert('Trạng thái sang hoàn thành thì mới có thể đánh giá.');">Đánh
                                                                giá</button>
                                                        @endif
                                                    @endif
                                                </td>
                                                <style>
                                                    .btn-outline-danger.alert-button {
                                                        cursor: not-allowed;
                                                    }
                                                </style>
                                            </tr>
                                            <tr>
                                                <td colspan="8">
                                                    <div id="review-form-{{ $item->variant->id }}"
                                                        class="reviews-form-area" style="display: none;">
                                                        <h4 class="title p-3">Viết bài đánh giá</h4>
                                                        <div class="reviews-form-content">
                                                            <form action="{{ route('product.reviews.store') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="variant_id"
                                                                    value="{{ $item->variant->id }}">
                                                                <input type="hidden" name="bill_id"
                                                                    value="{{ $bill->id }}">

                                                                <div class="row">
                                                                    <div class="mt-3">
                                                                        <div class="form-group">
                                                                            <span class="title">Xếp hạng</span>
                                                                            <ul class="review-rating"
                                                                                style="color: #f5c61a"
                                                                                id="rating-{{ $item->variant->id }}">
                                                                                @for ($i = 1; $i <= 5; $i++)
                                                                                    <li class="fa fa-star-o"
                                                                                        onclick="setRating({{ $item->variant->id }}, {{ $i }})">
                                                                                    </li>
                                                                                @endfor
                                                                            </ul>
                                                                            <input type="hidden" name="rating"
                                                                                id="input-rating-{{ $item->variant->id }}"
                                                                                value="0">
                                                                            @error('rating')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <div class="form-group">
                                                                            <label class="d-flex"
                                                                                for="for_review-title">Ảnh sản phẩm</label>
                                                                            <input type="file" class="form-control"
                                                                                name="image_url" accept="image/*">
                                                                            @error('image_url')
                                                                                <span
                                                                                    class="text-danger mt-3">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-2">
                                                                        <div class="form-group">
                                                                            <label class="d-flex" for="for_comment">Nội
                                                                                dung đánh giá (1500)</label>
                                                                            <textarea id="for_comment" name="comment" rows="5" class="form-control" placeholder="Bình luận ..."></textarea>
                                                                            @error('comment')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="p-3">
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                onclick="return confirm('Bạn chỉ có thể đánh giá 1 lần bạn chắc với đánh giá hiện tại chứ!')"
                                                                                class="btn btn-outline-danger"
                                                                                style="margin-left: 87%; border-radius: 0">Đăng
                                                                                bình luận</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{-- js đánh giá --}}
                                <script>
                                    function toggleReviewForm(itemId) {
                                        const reviewForm = document.getElementById(`review-form-${itemId}`);
                                        reviewForm.style.display = reviewForm.style.display === 'none' ? 'block' : 'none';
                                    }

                                    function setRating(itemId, rating) {
                                        const stars = document.querySelectorAll(`#rating-${itemId} .fa`);
                                        stars.forEach((star, index) => {
                                            star.classList.toggle('fa-star', index < rating);
                                            star.classList.toggle('fa-star-o', index >= rating);
                                        });
                                        document.getElementById(`input-rating-${itemId}`).value = rating;
                                    }
                                </script>


                                <div class="myaccount-content">
                                    {{-- 17/12/20224 --}}
                                    @if ($bill->discount_amount > 0 && $bill->points_used > 0)
                                        <p class="saved-message">
                                            Số điểm đã sử dụng:
                                            <span
                                                class="text-primary">{{ number_format($bill->points_used, 0, ',', '.') }}
                                                điểm</span>
                                            (
                                            <span
                                                class="text-danger"> -{{ number_format($bill->discount_amount, 0, ',', '.') }}
                                                đ</span>)
                                        </p>
                                    @endif
                                    @if (isset($voucerHistory))
                                        <p class="saved-message">Giảm giá từ voucher: <span
                                                class="text-danger">{{ $voucerHistory->voucher->value }}%</span></p>
                                    @endif
                                    {{-- <p class="saved-message">Tiền ship: <span class="text-danger">30.000đ</span></p> --}}
                                    <strong>
                                        <p class="saved-message">Tổng tiền hàng:
                                            {{ number_format($bill->total_price, 0, ',', '.') }} đ<span
                                                class="text-danger" id="formattedTotal"></span></p>
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
                                            <th style="width: 450px">Trạng thái</th>
                                            <th>Ghi chú</th>
                                            <th>Thời gian</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $statusMapping = [
                                            'pending' => [
                                                'text' => 'Chờ xác nhận',
                                                'class' => 'badge bg-gray',
                                                'icon' => 'bi-hourglass',
                                            ],
                                            'confirmed' => [
                                                'text' => 'Đã xác nhận',
                                                'class' => 'badge bg-blue',
                                                'icon' => 'bi-check-circle',
                                            ],
                                            'in_delivery' => [
                                                'text' => 'Đang giao',
                                                'class' => 'badge bg-lightblue',
                                                'icon' => 'bi-truck',
                                            ],
                                            'delivered' => [
                                                'text' => 'Giao hàng thành công',
                                                'class' => 'badge bg-green',
                                                'icon' => 'bi-box',
                                            ],
                                            'failed' => [
                                                'text' => 'Giao hàng thất bại',
                                                'class' => 'badge bg-red',
                                                'icon' => 'bi-x-circle',
                                            ],
                                            'canceled' => [
                                                'text' => 'Đã hủy',
                                                'class' => 'badge bg-orange',
                                                'icon' => 'bi-x-octagon',
                                            ],
                                            'completed' => [
                                                'text' => 'Hoàn thành',
                                                'class' => 'badge bg-darkgray',
                                                'icon' => 'bi-trophy',
                                            ],
                                        ];
                                    @endphp

                                    <tbody>
                                        @foreach ($bill->histories as $index => $history)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td class="td-status d-flex justify-content-between align-items-center border-0"
                                                    style="padding-left: 40px;">
                                                    <span
                                                        class="{{ $statusMapping[$history->from_status]['class'] ?? '' }}">
                                                        <i
                                                            class="fa me-2 {{ $statusMapping[$history->from_status]['icon'] ?? 'fa-question-circle' }}"></i>
                                                        {{ $statusMapping[$history->from_status]['text'] ?? $history->from_status }}
                                                    </span>
                                                    &rarr; <!-- Mũi tên để chỉ hướng -->
                                                    <span
                                                        class="{{ $statusMapping[$history->to_status]['class'] ?? '' }}">
                                                        <i
                                                            class="fa me-2 {{ $statusMapping[$history->to_status]['icon'] ?? 'fa-question-circle' }}"></i>
                                                        {{ $statusMapping[$history->to_status]['text'] ?? $history->to_status }}
                                                    </span>
                                                </td>
                                                <td>{{ $history->note ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($history->at_datetime)->format('d/m/Y H:i') }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    @if ($bill->bill_status === 'completed')
                                        <div class="alert alert-success" role="alert">
                                            Đơn hàng đã hoàn thành.
                                        </div>
                                    @elseif ($bill->bill_status === 'pending')
                                        <div class="alert alert-info" role="alert">
                                            Đơn hàng đang chờ xác nhận.
                                        </div>
                                    @elseif ($bill->bill_status === 'confirmed')
                                        <div class="alert alert-warning" role="alert">
                                            Đơn hàng đã được xác nhận.
                                        </div>
                                    @elseif ($bill->bill_status === 'in_delivery')
                                        <div class="alert alert-primary" role="alert">
                                            Đơn hàng đang được giao.
                                        </div>
                                    @elseif ($bill->bill_status === 'delivered')
                                        <div class="alert alert-success" role="alert">
                                            Đơn hàng đã được giao thành công.
                                        </div>
                                    @elseif ($bill->bill_status === 'failed')
                                        <div class="alert alert-danger" role="alert">
                                            Đơn hàng giao thất bại.
                                        </div>
                                    @elseif ($bill->bill_status === 'canceled')
                                        <div class="alert alert-danger" role="alert">
                                            Đơn hàng đã bị hủy.
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
                                        <button type="submit" class="btn btn-primary">Đánh dấu hoàn thành đơn
                                            hàng</button>
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
                                        <button type="submit" class="btn btn-light" style="border-radius: 0"
                                            {{ $bill->bill_status !== 'pending' ? 'disabled' : '' }}
                                            onclick="return confirm('Bạn chắc chắn muốn hủy đơn chứ!')">Hủy đơn</button>
                                    </div>
                                </form>

                                <style>
                                    .form-control {
                                        border-radius: 0;
                                        border: 1px solid #ced4da;
                                    }

                                    .alert {
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
