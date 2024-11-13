@extends('admin.layouts.master');

@section('title', 'Chi tiết đơn hàng')

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
    <div class="container">
        <h1>Danh sách hóa đơn</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Tên khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $statusMapping = [
                        'pending' => ['text' => 'Chờ xác nhận', 'class' => 'badge bg-gray'],
                        'confirmed' => ['text' => 'Đã xác nhận', 'class' => 'badge bg-blue'],
                        'in_delivery' => ['text' => 'Đang giao', 'class' => 'badge bg-lightblue'],
                        'delivered' => ['text' => 'Giao hàng thành công', 'class' => 'badge bg-green'],
                        'failed' => ['text' => 'Giao hàng thất bại', 'class' => 'badge bg-red'],
                        'canceled' => ['text' => 'Đã hủy', 'class' => 'badge bg-orange'],
                        'completed' => ['text' => 'Hoàn thành', 'class' => 'badge bg-darkgray'],
                    ];
                @endphp
                @foreach ($bills as $bill)
                    <tr>
                        <td>{{ $bill->code }}</td>
                        <td>{{ $bill->full_name }}</td>
                        <td>{{ number_format($bill->total_price) }} đ</td>
                        <td>
                            <span class="{{ $statusMapping[$bill->bill_status]['class'] ?? '' }}">
                                {{ $statusMapping[$bill->bill_status]['text'] ?? $bill->bill_status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('bills.show', $bill->id) }}" class="btn btn-info">Xem chi tiết</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <div class="pagination-wrap hstack gap-2">
                {{ $bills->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
