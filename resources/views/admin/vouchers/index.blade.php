@extends('admin.layouts.master')

@section('title')
    Danh sách mã giảm giá
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Danh sách mã giảm giá</h4>
                    <a href="{{ route('voucher.create') }}">
                        <button type="button" class="btn btn-success add-btn">
                            <i class="ri-add-line align-bottom me-1"></i> Thêm
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="listjs-table">
                        <form action="{{ route('voucher.index') }}" method="GET">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="value">Phần trăm giảm:</label>
                                    <input type="number" name="value" id="value" class="form-control" value="{{ request('value') }}" placeholder="Nhập % giảm">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="max_price">Số tiền tối đa giảm:</label>
                                    <input type="number" name="max_price" id="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="Nhập số tiền tối đa">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="start_date">Ngày bắt đầu:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="end_date">Ngày kết thúc:</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                            </div>

                            <button class="btn btn-sm btn-primary mt-3">Tìm kiếm</button>
                        </form>
                        

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Mã giảm giá</th>
                                        <th>Giảm(%)</th>
                                        <th>Số tiền tối đa</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Số lượng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($vouchers as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->value }}</td>
                                        <td>{{ $item->max_price }}</td>
                                        <td>{{ $item->start_datetime }}</td>
                                        <td>{{ $item->end_datetime }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>
                                            <a href="{{ route('voucher.detail', $item->id) }}" type="submit"
                                                class="btn btn-primary">Xem chi tiết</a>
                                            <a href="{{ route('voucher.edit', $item->id) }}" type="submit"
                                                class="btn btn-success">Sửa</a>
                                          
                                            <form action="{{ route('voucher.destroy', $item->id) }}" method="post" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Chắc chắn không?')" type="submit"
                                                    class="btn btn-danger">Xoá</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                {{ $vouchers->appends(request()->input())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptsToastr')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            toastr.options = {

                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000",
            };
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>
@endsection
