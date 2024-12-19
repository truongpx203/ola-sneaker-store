@extends('admin.layouts.master')

@section('title')
    Thêm mới mã giảm giá
@endsection

@section('content')

    @if ($errors->any())
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger" style="width: 100%;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('voucher.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
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
                                        <input type="text" class="form-control" name="code"
                                            value="{{ strtoupper(\Str::random(8)) }}" id="code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="value" class="form-label">Phần trăm giảm giá</label>
                                        <input type="number" class="form-control" min="1" name="value"
                                            id="value">
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
                                        <label for="max_price" class="form-label">Số tiền tối đa</label>
                                        <input type="number" class="form-control" name="max_price" id="namax_priceme">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="description" class="form-label">Mô tả</label>
                                        <input type="text" class="form-control" name="description" id="description">
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
                                        <input type="datetime-local" class="form-control" name="start_datetime"
                                            id="start_datetime">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="end_datetime" class="form-label">Ngày kết thúc</label>
                                        <input type="datetime-local" class="form-control" name="end_datetime"
                                            id="end_datetime">
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
                                        <label for="for_user_ids" class="form-label">Chọn người được dùng được dùng mã(giữ
                                            Ctrl để chọn nhiều)</label>
                                        <select class="form-control" name="for_user_ids[]" id="for_user_ids" multiple>
                                            @foreach ($allUsers as $item)
                                                <option value="{{ $item->id }}">Email:{{ $item->email }} - Họ và
                                                    tên:{{ $item->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button class="btn btn-primary me-2" type="submit">Thêm</button>
                        <a href="{{ route('voucher.index') }}" class="btn btn-secondary" type="submit">Danh sách</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
