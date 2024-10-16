@extends('admin.layouts.master')

@section('title')
    Cập nhật sản phẩm biến thể
@endsection

@section('content')
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">Cập nhật thông tin sản phẩm biến thể</h5>
            <div class="card-body">
                <form action="{{ route('variants.update', $variant) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="product_id" class="form-label">Sản phẩm</label>
                        <select class="form-select" id="product_id" name="product_id" disabled>
                            <option value="">Chọn sản phẩm</option>
                            @foreach ($products as $id => $name)
                                <option value="{{ $id }}" {{ $variant->product_id == $id ? 'selected' : '' }}>
                                    {{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="product_size_id" class="form-label">Kích thước</label>
                        <select class="form-select" id="product_size_id" name="product_size_id" disabled>
                            <option value="">Chọn kích thước</option>
                            @foreach ($productSizes as $id => $size)
                                <option value="{{ $id }}"
                                    {{ $variant->product_size_id == $id ? 'selected' : '' }}>
                                    {{ $size }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Tồn kho</label>
                        <input type="number" class="form-control" id="stock" name="stock"
                            value="{{ $variant->stock }}">
                        @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="listed_price" class="form-label">Giá niêm yết</label>
                        <input type="text" class="form-control" id="listed_price" name="listed_price"
                            value="{{ $variant->listed_price }}">
                        @error('listed_price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sale_price" class="form-label">Giá bán</label>
                        <input type="text" class="form-control" id="sale_price" name="sale_price"
                            value="{{ $variant->sale_price }}">
                        @error('sale_price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="import_price" class="form-label">Giá nhập</label>
                        <input type="text" class="form-control" id="import_price" name="import_price"
                            value="{{ $variant->import_price }}">
                        @error('import_price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_show" class="form-label">Hiển thị</label>
                        <select class="form-select" id="is_show" name="is_show" required>
                            <option value="1" {{ $variant->is_show ? 'selected' : '' }}>Có</option>
                            <option value="0" {{ !$variant->is_show ? 'selected' : '' }}>Không</option>
                        </select>
                        @error('is_show')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('variants.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>


    </div>
@endsection
