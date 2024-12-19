@extends('admin.layouts.master')

@section('title')
   Chi tiết đơn hàng
@endsection

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <div class="container">
        <h2 class="mb-4">Chi Tiết Đơn Hàng #{{ $bill->code }}</h2>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @php
            $paymentStatusMapping = [
                'pending' => 'Chưa thanh toán',
                'completed' => 'Đã thanh toán',
                // 'failed' => 'Thất bại',
            ];

            $paymentTypeMapping = [
                'momo' => 'Thanh toán MOMO',
                'vnpay' => 'Thanh toán VNPAY',
                'cod' => 'Thanh toán COD',
            ];
        @endphp
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="section-title">#1. Thông Tin Đơn Hàng</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="orderID" class="form-label">Mã Đơn Hàng</label>
                        <input type="text" class="form-control" id="orderID" value="{{ $bill->code }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="customerName" class="form-label">Tên Khách Hàng</label>
                        <input type="text" class="form-control" id="customerName" value="{{ $bill->full_name }}"
                            readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="paymentMethod" class="form-label">Phương Thức Thanh Toán</label>
                        <input type="text" class="form-control" id="paymentMethod"
                            value="{{ $paymentTypeMapping[$bill->payment_type] ?? ucfirst($bill->payment_type) }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Điện Thoại</label>
                        <input type="text" class="form-control" id="phone" value="{{ $bill->phone_number }}"
                            readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="paymentStatus" class="form-label">Trạng Thái Thanh Toán</label>
                        <input type="text" class="form-control" id="paymentStatus"
                            value="{{ $paymentStatusMapping[$bill->payment_status] ?? ucfirst($bill->payment_status) }}"
                            readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">Địa Chỉ</label>
                        <input type="text" class="form-control" id="address" value="{{ $bill->address }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="address" class="form-label">Thời gian mua</label>
                        <input type="text" class="form-control" id="address"
                            value="{{ \Carbon\Carbon::parse($bill->created_at)->format('d/m/Y H:i') }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="section-title">#2. Thông Tin Sản Phẩm</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-light">
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Ảnh</th>
                            <th>Size</th>
                            <th>Số Lượng</th>
                            <th>Giá Bán</th>
                            <th>Thành Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bill->items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td><img class="img-thumbnail" src="{{ Storage::url($item->product_image_url) }}"
                                        alt="" width="100px" height="100px"></td>
                                <td>{{ $item->variant->size->name ?? 'N/A' }}</td>
                                <td>{{ $item->variant_quantity }}</td>
                                <td>{{ number_format($item->sale_price, 0, ',', '.') }} đ</td>
                                <td>{{ number_format($item->sale_price * $item->variant_quantity, 0, ',', '.') }} đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="voucher">
                    {{-- 17/12/20224 --}}
                    @if ($bill->discount_amount > 0 && $bill->points_used > 0)
                        <p class="saved-message">
                            Số điểm đã sử dụng:
                            <span class="text-primary">{{ number_format($bill->points_used, 0, ',', '.') }} điểm</span>
                            (<span class="text-danger"> -{{ number_format($bill->discount_amount, 0, ',', '.') }} đ</span>)
                        </p>
                    @endif
                    @if (isset($voucerHistory))
                        <p class="saved-message">Mã giảm giá (Voucher): <span
                                class="text-danger">{{ $voucerHistory->voucher->value }}%</span></p>
                    @endif
                </div>
                {{-- <div class="voucher">Mã giảm giá (Voucher): -{{ number_format($bill->discount ?? 0, 0, ',', '.') }} đ
                </div> --}}
                <div class="total">Tổng: {{ number_format($bill->total_price, 0, ',', '.') }} đ</div>
            </div>
        </div>
        @php
            $statusMapping = [
                'pending' => ['text' => 'Chờ xác nhận', 'class' => 'badge bg-gray', 'icon' => 'fa-hourglass-half'],
                'confirmed' => ['text' => 'Đã xác nhận', 'class' => 'badge bg-blue', 'icon' => 'fa-check-circle'],
                'in_delivery' => ['text' => 'Đang giao', 'class' => 'badge bg-lightblue', 'icon' => 'fa-truck'],
                'delivered' => ['text' => 'Giao hàng thành công', 'class' => 'badge bg-green', 'icon' => 'fa-box-open'],
                'failed' => ['text' => 'Giao hàng thất bại', 'class' => 'badge bg-red', 'icon' => 'fa-times-circle'],
                'canceled' => ['text' => 'Đã hủy', 'class' => 'badge bg-orange', 'icon' => 'fa-ban'],
                'completed' => ['text' => 'Hoàn thành', 'class' => 'badge bg-darkgray', 'icon' => 'fa-trophy'],
            ];
        @endphp
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="section-title">#3. Lịch Sử Thay Đổi Trạng Thái</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-light">
                            <th>STT</th>
                            <th style="width: 400px">Trạng Thái Thay Đổi</th>
                            <th>Ghi Chú</th>
                            <th>Người Thay Đổi</th>
                            <th>Thời Gian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bill->histories as $index => $history)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="td-status d-flex justify-content-between align-items-center border-0">
                                    <span class="{{ $statusMapping[$history->from_status]['class'] ?? '' }}">
                                        <i
                                            class="fa me-2 {{ $statusMapping[$history->from_status]['icon'] ?? 'fa-question-circle' }}"></i>
                                        {{ $statusMapping[$history->from_status]['text'] ?? $history->from_status }}
                                    </span>
                                    &rarr; <!-- Mũi tên để chỉ hướng -->
                                    <span class="{{ $statusMapping[$history->to_status]['class'] ?? '' }}">
                                        <i
                                            class="fa me-2 {{ $statusMapping[$history->to_status]['icon'] ?? 'fa-question-circle' }}"></i>
                                        {{ $statusMapping[$history->to_status]['text'] ?? $history->to_status }}
                                    </span>
                                </td>
                                <td>{{ $history->note ?? '-' }}</td>
                                <td>
                                    @if ($history->user)
                                        {{ $history->user->full_name }}
                                    @else
                                        {{ 'Không tìm thấy người dùng' }}
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($history->at_datetime)->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="section-title">#4. Thay Đổi Trạng Thái Đơn Hàng</h5>

                <form action="{{ route('bills.updateStatus', $bill->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng Thái</label>
                        <select name="status" class="form-select" id="bill_status"
                            {{ in_array($bill->bill_status, ['completed', 'delivered', 'canceled', 'failed']) ? 'disabled' : '' }}>
                            <option value="pending" {{ $bill->bill_status == 'pending' ? 'selected' : '' }}>Chờ xác nhận
                            </option>
                            <option value="confirmed" {{ $bill->bill_status == 'confirmed' ? 'selected' : '' }}>Đã xác
                                nhận
                            </option>
                            <option value="in_delivery" {{ $bill->bill_status == 'in_delivery' ? 'selected' : '' }}>Đang
                                giao</option>
                            <option value="delivered" {{ $bill->bill_status == 'delivered' ? 'selected' : '' }}>Giao hàng
                                thành công</option>
                            <option value="failed" {{ $bill->bill_status == 'failed' ? 'selected' : '' }}>Giao hàng thất
                                bại</option>
                            <option value="canceled" {{ $bill->bill_status == 'canceled' ? 'selected' : '' }}>Đã hủy
                            </option>
                            <option class="d-none" value="completed"
                                {{ $bill->bill_status == 'completed' ? 'selected' : '' }}>Hoàn thành
                            </option>
                        </select>
                    </div>

                    @if ($bill->bill_status === 'delivered')
                        <div class="alert alert-success" role="alert">
                            Đơn hàng đã được giao thành công. Không thể tiếp tục thay đổi trạng thái.
                        </div>
                    @elseif ($bill->bill_status === 'completed')
                        <div class="alert alert-success" role="alert">
                            Đơn hàng đã hoàn thành. Không thể tiếp tục thay đổi trạng thái.
                        </div>
                    @elseif ($bill->bill_status === 'canceled')
                        <div class="alert alert-warning" role="alert">
                            Hóa đơn đã bị hủy. Không thể tiếp tục thay đổi trạng thái.
                        </div>
                    @elseif ($bill->bill_status === 'failed')
                        <div class="alert alert-warning" role="alert">
                            Giao hàng thất bại. Không thể tiếp tục thay đổi trạng thái.
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="note" class="form-label">Ghi chú</label>
                        <textarea name="note" class="form-control" id="note" rows="3"
                            {{ in_array($bill->bill_status, ['delivered', 'completed', 'canceled', 'failed']) ? 'disabled' : '' }}></textarea>
                    </div>
                    <a href="{{ route('bills.index') }}"><button type="button" class="btn btn-secondary">Quay
                            lại</button></a>
                    <button type="submit" class="btn btn-primary" id="submit-btn"
                        {{ in_array($bill->bill_status, ['delivered', 'completed', 'canceled', 'failed']) ? 'disabled' : '' }}>Lưu</button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const statusSelect = document.getElementById('bill_status');

                        const validTransitions = {
                            'pending': ['confirmed', 'canceled'],
                            'confirmed': ['in_delivery'],
                            'in_delivery': ['delivered', 'failed'],
                            'delivered': [],
                            'failed': [],
                            'canceled': [],
                            'completed': []
                        };

                        // Lấy trạng thái hiện tại
                        const currentStatus = "{{ $bill->bill_status }}";

                        // Disable các tùy chọn không hợp lệ
                        const options = statusSelect.options;
                        for (let i = 0; i < options.length; i++) {
                            const optionValue = options[i].value;
                            if (validTransitions[currentStatus].indexOf(optionValue) === -1) {
                                options[i].disabled = true; // Disable tùy chọn
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
