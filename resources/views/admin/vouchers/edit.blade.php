@extends('admin.layouts.master')

@section('title')
    Sửa mã giảm giá
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sửa mã giảm giá</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Mã giảm giá</a></li>
                        <li class="breadcrumb-item active">Sửa</li>
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

    <form action="{{ route('voucher.update', $voucher->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                                            value="{{ $voucher->code }}" id="code" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="value" class="form-label">Phần trăm giảm giá</label>
                                        <input type="number" class="form-control" min="1"
                                            value="{{ $voucher->value }}" name="value" id="value">
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
                                        <input type="number" class="form-control" value="{{ $voucher->quantity }}"
                                            name="quantity" id="quantity">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="max_price" class="form-label">Số tiền tối đa</label>
                                        <input type="number" class="form-control" value="{{ $voucher->max_price }}"
                                            name="max_price" id="namax_priceme">
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
                                            value="{{ $voucher->start_datetime }}" name="start_datetime"
                                            id="start_datetime">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="end_datetime" class="form-label">Ngày kết thúc</label>
                                        <input type="datetime-local" class="form-control"
                                            value="{{ $voucher->end_datetime }}" name="end_datetime" id="end_datetime">
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
                                        <label for="for_user_ids" class="form-label">Chọn người được dùng riêng có thể bỏ
                                            qua</label>
                                        <select class="form-control" name="for_user_ids" id="for_user_ids">
                                            @if (is_null($voucher->for_user_ids))
                                                <option value="" disabled selected>Chọn người dùng</option>
                                                @foreach ($allUsers as $item)
                                                    <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                                @endforeach
                                            @else
                                                @foreach ($allUsers as $item)
                                                    @if ($voucher->for_user_ids == $item->id)
                                                        <option value="{{ $item->id }}" selected>
                                                            {{ $item->full_name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->full_name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="user_use" class="form-label">Chọn khối người được dùng</label>
                                        <select class="form-control" name="user_use" id="user_use">
                                            @if (is_null($voucher->user_use))
                                                <option value="" disabled selected>Chọn khối người dùng</option>
                                                <option value="everybody">1) Ai cũng có thể dùng</option>
                                                <option value="male">2) Chỉ nam được dùng</option>
                                                <option value="female">3) Chỉ nữ được dùng</option>
                                            @else
                                                @switch($voucher->user_use)
                                                    @case('everybody')
                                                        <option value="everybody" selected>1) Ai cũng có thể dùng</option>
                                                        <option value="male">2) Chỉ nam được dùng</option>
                                                        <option value="female">3) Chỉ nữ được dùng</option>
                                                    @break

                                                    @case('male')
                                                        <option value="everybody">1) Ai cũng có thể dùng</option>
                                                        <option value="male" selected>2) Chỉ nam được dùng</option>
                                                        <option value="female">3) Chỉ nữ được dùng</option>
                                                    @break

                                                    @case('female')
                                                        <option value="everybody">1) Ai cũng có thể dùng</option>
                                                        <option value="male">2) Chỉ nam được dùng</option>
                                                        <option value="female" selected>3) Chỉ nữ được dùng</option>
                                                    @break
                                                @endswitch
                                            @endif
                                        </select>
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
                                            name="description" id="description">
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
                        <a href="{{ route('voucher.index') }}" class="btn btn-primary mx-3" type="submit">Quay
                            lại</a>
                        <button class="btn btn-primary" type="submit">Sửa</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
