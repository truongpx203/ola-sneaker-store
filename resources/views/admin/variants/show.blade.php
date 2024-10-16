@extends('admin.layouts.master');

@section('title')
    Chi tiết sản phẩm biến thể
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Sản phẩm biến thể</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <h4 class="card-text">Tên sản phẩm: {{ $variantDetail->product_name }}</h4>
                    <p class="card-text"><strong>Kích thước:</strong> {{ $variantDetail->product_size }}</p>
                    <p class="card-text"><strong>Giá niêm yết:</strong>
                        {{ number_format($variantDetail->listed_price, 0, ',', '.') }} VNĐ</p>
                    <p class="card-text"><strong>Giá bán:</strong>
                        {{ number_format($variantDetail->sale_price, 0, ',', '.') }} VNĐ</p>
                    <p class="card-text"><strong>Giá nhập:</strong>
                        {{ number_format($variantDetail->import_price, 0, ',', '.') }} VNĐ</p>
                    <p class="card-text"><strong>Tồn kho:</strong> {{ $variantDetail->stock }}</p>
                    <p class="card-text"><strong>Trạng thái hiển thị:</strong>
                        {{ $variantDetail->is_show ? 'Có' : 'Không' }}</p>
                    <a href="{{ route('variants.index') }}" class="btn btn-primary">Quay lại danh sách</a>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection
