@extends('admin.layouts.master');

@section('title')
    Chi tiết sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Chi tiết sản phẩm</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <div class="mt-3">
                                    <label for="name" class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="code" class="form-label">Mã sản phẩm</label>
                                    <input type="text" class="form-control" value="{{ $product->code }}" disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="category_id" class="form-label">Danh mục</label>
                                    <input type="text" class="form-control" value="{{ $product->category->name }}"
                                        disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="primary_image_url" class="form-label">Hình ảnh</label>
                                    <br>
                                    <img src="{{ asset('storage/' . $product->primary_image_url) }}"
                                        alt="{{ $product->name }}" class="img-fluid" width="150px">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="mt-3">
                                        <label for="summary" class="form-label">Mô tả ngắn</label>
                                        <textarea class="form-control" name="summary" id="summary" rows="4" disabled>{{ $product->summary }}</textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label for="detailed_description" class="form-label">Mô tả chi tiết</label>
                                        {!! $product->detailed_description !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr class="text-center">
                                        <th>Size</th>
                                        <th>Số lượng</th>
                                        <th>Giá niêm yết</th>
                                        <th>Giá khuyến mãi</th>
                                        <th>Giá nhập</th>
                                        <th>Trạng thái</th>
                                    </tr>

                                    @foreach ($productSizes as $size)
                                        @foreach ($product->variants->where('product_size_id', $size->id) as $variant)
                                            <tr class="text-center">
                                                <td style="vertical-align: middle;">
                                                    <b>{{ $size->name }}</b>
                                                </td>
                                                <td>
                                                    {{ $variant->stock }}
                                                </td>
                                                <td>
                                                    {{ number_format($variant->listed_price, 0, ',', '.') }} VNĐ
                                                </td>
                                                <td>
                                                    {{ number_format($variant->sale_price, 0, ',', '.') }} VNĐ
                                                </td>
                                                <td>
                                                    {{ number_format($variant->import_price, 0, ',', '.') }} VNĐ
                                                </td>
                                                <td>
                                                    @if ($variant->is_show)
                                                        <span
                                                            class="badge bg-success-subtle text-success text-uppercase">Show</span>
                                                    @else
                                                        <span
                                                            class="badge bg-danger-subtle text-danger text-uppercase">Hide</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Album ảnh</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    @foreach ($product->productImages as $image)
                        <img src="{{ asset('storage/' . $image->image_url) }}" alt="Gallery Image" class="img-fluid"
                            width="150px">
                    @endforeach
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Quay lại danh sách</a>
                </div><!-- end card header -->
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
