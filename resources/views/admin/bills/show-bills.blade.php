@extends('admin.layouts.master')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <style>
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
    </style>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Danh Sách Đơn Hàng</h4>
                </div>
                <div class="card-body">
                    <div class="listjs-table">
                        <form action="{{ route('bills.index') }}" method="GET">
                            <div class="row">
                                <!-- Tìm kiếm theo mã hóa đơn -->
                                <div class="form-group col-4">
                                    <label for="bill_code">Mã hóa đơn:</label>
                                    <input type="text" name="bill_code" id="bill_code" class="form-control"
                                        value="{{ request('bill_code') }}" placeholder="Nhập mã hóa đơn">
                                </div>
                        
                                <!-- Tìm kiếm theo ngày mua -->
                                <div class="form-group col-4">
                                    <label for="purchase_date">Ngày mua:</label>
                                    <input type="date" name="purchase_date" id="purchase_date" class="form-control"
                                        value="{{ request('purchase_date') }}">
                                </div>
                        
                                <!-- Lựa chọn trạng thái đơn hàng -->
                                <div class="form-group col-4">
                                    <label for="bill_status">Trạng thái:</label>
                                    <select name="bill_status" id="bill_status" class="form-control">
                                        <option value="all" {{ request('bill_status') == 'all' ? 'selected' : '' }}>Tất cả</option>
                                        <option value="pending" {{ request('bill_status') == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                        <option value="confirmed" {{ request('bill_status') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                        <option value="in_delivery" {{ request('bill_status') == 'in_delivery' ? 'selected' : '' }}>Đang giao</option>
                                        <option value="delivered" {{ request('bill_status') == 'delivered' ? 'selected' : '' }}>Giao thành công</option>
                                        <option value="failed" {{ request('bill_status') == 'failed' ? 'selected' : '' }}>Giao hàng thất bại</option>
                                        <option value="canceled" {{ request('bill_status') == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
                                        <option value="completed" {{ request('bill_status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                    </select>
                                </div>
                            </div>
                        
                            <button class="btn btn-sm btn-primary mt-3">Tìm kiếm</button>
                        </form>
                        

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">

                                <!-- Bộ lọc trạng thái -->
                                {{-- <div class="container-fluid text-center mb-4">
                                    @php
                                        $statusMapping = [
                                            'all' => 'Tất cả',
                                            'pending' => 'Chờ xác nhận',
                                            'confirmed' => 'Đã xác nhận',
                                            'in_delivery' => 'Đang giao',
                                            'delivered' => 'Giao thành công',
                                            'failed' => 'Thất bại',
                                            'canceled' => 'Đã hủy',
                                            'completed' => 'Hoàn thành',
                                        ];
                                        $currentStatus = request()->get('bill_status', 'all'); // Lấy trạng thái hiện tại
                                    @endphp

                                    @foreach ($statusMapping as $status => $label)
                                        <a href="{{ route('bills.index', ['bill_status' => $status]) }}"
                                            class="btn {{ $currentStatus === $status ? 'btn-primary' : 'btn-outline-primary' }}">
                                            {{ $label }}
                                        </a>
                                    @endforeach
                                </div> --}}
                                <thead class="table-light">
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Thời gian mua</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @php
                                        $statusMapping = [
                                            'pending' => ['text' => 'Chờ xác nhận', 'class' => 'badge bg-gray'],
                                            'confirmed' => ['text' => 'Đã xác nhận', 'class' => 'badge bg-blue'],
                                            'in_delivery' => ['text' => 'Đang giao', 'class' => 'badge bg-lightblue'],
                                            'delivered' => [
                                                'text' => 'Giao hàng thành công',
                                                'class' => 'badge bg-green',
                                            ],
                                            'failed' => ['text' => 'Giao hàng thất bại', 'class' => 'badge bg-red'],
                                            'canceled' => ['text' => 'Đã hủy', 'class' => 'badge bg-orange'],
                                            'completed' => ['text' => 'Hoàn thành', 'class' => 'badge bg-darkgray'],
                                        ];
                                    @endphp
                                    @foreach ($bills as $bill)
                                        <tr>
                                            <td>{{ $bill->code }}</td>
                                            <td>{{ \Carbon\Carbon::parse($bill->created_at)->format('d/m/Y H:i') }}</td>
                                            <td>{{ $bill->full_name }}</td>
                                            <td>{{ number_format($bill->total_price) }} đ</td>
                                            <td>
                                                <span class="{{ $statusMapping[$bill->bill_status]['class'] ?? '' }}">
                                                    {{ $statusMapping[$bill->bill_status]['text'] ?? $bill->bill_status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('bills.show', $bill->id) }}" class="btn btn-info">Xem chi
                                                    tiết</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                {{ $bills->appends(request()->input())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
