@extends('admin.layouts.master')

@section('title')
    Chi tiết mã giảm giá
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Chi tiết mã giảm giá</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Mã giảm giá</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <div class="alert alert-danger" style="width: 100%;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div>
                                        <label for="code" class="form-label">Mã giảm giá</label>
                                        <input type="text" class="form-control" value="{{ $voucher->code }}" disabled
                                            id="code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="value" class="form-label">Phần trăm giảm giá</label>
                                        <input type="number" class="form-control" min="1"
                                            value="{{ $voucher->value }}" disabled id="value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div>
                                        <label for="quantity" class="form-label">Số lượng mã</label>
                                        <input type="number" class="form-control" value="{{ $voucher->quantity }}" disabled
                                            id="quantity">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="max_price" class="form-label">Số tiền tối đa</label>
                                        <input type="number" class="form-control" value="{{ $voucher->max_price }}"
                                            disabled id="namax_priceme">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div>
                                        <label for="start_datetime" class="form-label">Ngày bắt đầu</label>
                                        <input type="datetime-local" class="form-control"
                                            value="{{ $voucher->start_datetime }}" disabled id="start_datetime">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="end_datetime" class="form-label">Ngày kết thúc</label>
                                        <input type="datetime-local" class="form-control"
                                            value="{{ $voucher->end_datetime }}" disabled id="end_datetime">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div>
                                        <label for="description" class="form-label">Mô tả</label>
                                        <input type="text" class="form-control" value="{{ $voucher->description }}"
                                            disabled id="description">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title flex-grow-1">Thông tin người dùng được sử dụng mã</h4>
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Điểm tích lũy</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->points }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <a href="{{ route('voucher.index') }}" class="btn btn-primary mx-3" type="submit">Quay
                            lại</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
