@extends('admin.layouts.master');

@section('title')
    Them moi san pham
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới danh mục</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Danh mục</a></li>
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
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <h1>{{ isset($banner) ? 'Sửa Banner' : 'Thêm Banner' }}</h1>
    <form action="{{ isset($banner) ? route('banners.update', $banner->id) : route('banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($banner))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ $banner->title ?? '' }}">
        </div>
        <div class="form-group">
            <label for="subtitle">Phụ đề</label>
            <input type="text" name="subtitle" class="form-control" value="{{ $banner->subtitle ?? '' }}">
        </div>
        <div class="form-group">
            <label for="link">Đường dẫn</label>
            <input type="url" name="link" class="form-control" value="{{ $banner->link ?? '' }}">
        </div>
        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="file" name="image" class="form-control">
            @if (isset($banner) && $banner->image)
                <img src="{{ asset('storage/' . $banner->image) }}" width="100" alt="banner">
            @endif
        </div>
        <button type="submit" class="btn btn-success">{{ isset($banner) ? 'Cập nhật' : 'Thêm' }}</button>
    </form>
@endsection
