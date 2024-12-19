@extends('admin.layouts.master')

@section('title')
    Thêm mới danh mục
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

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm mới danh mục</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div>
                                        <label for="name" class="form-label">Tên danh mục</label>
                                        <input type="text" class="form-control" name="name" id="name">
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
                        {{-- <a href="{{ route('dashboard.size.index') }}" class="btn btn-primary mx-3" type="submit">Quay
                            lại</a> --}}
                        <button class="btn btn-primary me-2" type="submit">Thêm</button>
                        <a href="{{route('categories.index')}}" class="btn btn-secondary">Danh sách</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <label for="" class="form-label">Tên:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div> --}}

        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
    </form>
@endsection
