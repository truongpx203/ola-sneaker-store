@extends('admin.layouts.master')

@section('title')
    Thêm mới Sản phẩm
@endsection

@section('style-libs')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm sản phẩm mới</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div class="mt-3">
                                        <label for="name" class="form-label">Tên sản phẩm</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" placeholder="Nhập tên sản phẩm"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="code" class="form-label">Mã sản phẩm</label>
                                        <input type="text" class="form-control @error('code') is-invalid @enderror"
                                            name="code" id="code" value="{{ strtoupper(\Str::random(8)) }}">
                                        @error('code')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="category_id" class="form-label">Danh mục</label>
                                        <select type="text"
                                            class="form-select @error('category_id') is-invalid @enderror"
                                            name="category_id" id="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="primary_image_url" class="form-label">Hình ảnh</label>
                                        <input type="file"
                                            class="form-control @error('primary_image_url') is-invalid @enderror"
                                            name="primary_image_url" id="primary_image_url">
                                        @error('primary_image_url')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="summary" class="form-label">Mô tả ngắn</label>
                                            <textarea class="form-control @error('summary') is-invalid @enderror" name="summary" id="summary" rows="2"
                                                value="{{ old('summary') }}"></textarea>
                                            @error('summary')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="detailed_description" class="form-label">Mô tả chi tiết</label>
                                            <textarea class="form-control @error('detailed_description') is-invalid @enderror" name="detailed_description"
                                                id="detailed_description"></textarea>
                                            @error('detailed_description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
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
                                            <tr class="text-center">
                                                <td style="vertical-align: middle;">
                                                    <b>{{ $size->name }}</b>
                                                    <input type="hidden" name="variants[{{ $size->id }}][size_id]"
                                                        value="{{ $size->id }}">
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        class="form-control @error('variants.' . $size->id . '.stock') is-invalid @enderror"
                                                        name="variants[{{ $size->id }}][stock]" placeholder="Số lượng"
                                                        value="{{ old('variants.' . $size->id . '.stock') }}">
                                                    @error('variants.' . $size->id . '.stock')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        class="form-control @error('variants.' . $size->id . '.listed_price') is-invalid @enderror"
                                                        name="variants[{{ $size->id }}][listed_price]"
                                                        placeholder="Giá niêm yết"
                                                        value="{{ old('variants.' . $size->id . '.listed_price') }}">
                                                    @error('variants.' . $size->id . '.listed_price')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control"
                                                        name="variants[{{ $size->id }}][sale_price]"
                                                        placeholder="Giá khuyến mãi">
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        class="form-control @error('variants.' . $size->id . '.import_price') is-invalid @enderror"
                                                        name="variants[{{ $size->id }}][import_price]"
                                                        placeholder="Giá nhập"
                                                        value="{{ old('variants.' . $size->id . '.import_price') }}">
                                                    @error('variants.' . $size->id . '.import_price')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <select class="form-select" id="is_show"
                                                        name="variants[{{ $size->id }}][is_show]">
                                                        <option value="1">Show</option>
                                                        <option value="0">Hide</option>
                                                    </select>
                                                </td>
                                            </tr>
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
                        <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                        <button type="button" class="btn btn-primary" onclick="addImageGallery()">Thêm ảnh</button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="gallery_list">
                                <div class="col-md-4" id="gallery_default_item">
                                    <label for="gallery_default" class="form-label">Image</label>
                                    <div class="d-flex">
                                        <input type="file" class="form-control" name="product_galleries[]"
                                            id="gallery_default">
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
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div><!-- end card header -->
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('detailed_description');

        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger ms-2" onclick="removeImageGallery('${id}_item')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection
