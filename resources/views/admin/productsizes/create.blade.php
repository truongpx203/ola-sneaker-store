@extends('admin.layouts.master')

@section('title')
    Thêm mới kích thước
@endsection

@section('content')
    @if ($errors->any())
        <div class="row">
            <div class="col-lg-12">
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    @endif
    <form action="{{ route('productsize.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm mới kích thước</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div>
                                        <label for="name" class="form-label">Tên kích thước</label>
                                        <input type="number" class="form-control" name="name" id="name">
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
                        <a href="{{ route('productsize.index') }}" class="btn btn-secondary" type="submit">Danh sách</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
