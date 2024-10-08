@extends('admin.layouts.master')

@section('title')
    Cập nhật Sản phẩm: {{ $product->name }}
@endsection

@section('content')
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Cập nhật thông tin sản phẩm: {{ $product->name }}</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div class="mt-3">
                                        <label for="name" class="form-label">Tên sản phẩm</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" placeholder="Nhập tên sản phẩm"
                                            value="{{ $product->name }}">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="code" class="form-label">Mã sản phẩm</label>
                                        <input type="text" class="form-control" name="code" id="code"
                                            value="{{ $product->code }}" readonly>
                                    </div>
                                    <div class="mt-3">
                                        <label for="category_id" class="form-label">Danh mục</label>
                                        <select type="text"
                                            class="form-select @error('category_id') is-invalid @enderror"
                                            name="category_id" id="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
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
                                        <br>
                                        <img src="{{ asset('storage/' . $product->primary_image_url) }}"
                                            alt="{{ $product->name }}" class="img-fluid" width="150px">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="summary" class="form-label">Mô tả ngắn</label>
                                            <textarea class="form-control @error('summary') is-invalid @enderror" name="summary" id="summary" rows="2">{{ $product->summary }}</textarea>
                                            @error('summary')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="detailed_description" class="form-label">Mô tả chi tiết</label>
                                            <textarea class="form-control @error('detailed_description') is-invalid @enderror" name="detailed_description"
                                                id="detailed_description">{{ $product->detailed_description }}</textarea>
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
                                            @foreach ($product->variants->where('product_size_id', $size->id) as $variant)
                                                <tr class="text-center">
                                                    <td style="vertical-align: middle;">
                                                        <b>{{ $size->name }}</b>
                                                        <input type="hidden" name="variants[{{ $size->id }}][size_id]"
                                                            value="{{ $size->id }}">
                                                    </td>
                                                    <td>
                                                        <input type="number"
                                                            class="form-control @error('variants.' . $size->id . '.stock') is-invalid @enderror"
                                                            name="variants[{{ $size->id }}][stock]"
                                                            placeholder="Số lượng" value="{{ $variant->stock }}">
                                                        @error('variants.' . $size->id . '.stock')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number"
                                                            class="form-control @error('variants.' . $size->id . '.listed_price') is-invalid @enderror"
                                                            name="variants[{{ $size->id }}][listed_price]"
                                                            placeholder="Giá niêm yết"
                                                            value="{{ $variant->listed_price }}">
                                                        @error('variants.' . $size->id . '.listed_price')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control"
                                                            name="variants[{{ $size->id }}][sale_price]"
                                                            placeholder="Giá khuyến mãi" value="{{ $variant->sale_price }}">
                                                    </td>
                                                    <td>
                                                        <input type="number"
                                                            class="form-control @error('variants.' . $size->id . '.import_price') is-invalid @enderror"
                                                            name="variants[{{ $size->id }}][import_price]"
                                                            placeholder="Giá nhập"
                                                            value="{{ $variant->import_price }}">
                                                        @error('variants.' . $size->id . '.import_price')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <select class="form-select" id="is_show"
                                                            name="variants[{{ $size->id }}][is_show]">
                                                            <option value="1"
                                                                {{ $variant->is_show == 1 ? 'selected' : '' }}>Show
                                                            </option>
                                                            <option value="0"
                                                                {{ $variant->is_show == 0 ? 'selected' : '' }}>Hide
                                                            </option>
                                                        </select>
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
                        <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                        <button type="button" class="btn btn-primary" onclick="addImageGallery()">Thêm ảnh</button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="gallery_list">
                                @if (count($product->productImages) > 0)
                                    @foreach ($product->productImages as $item)
                                        <div class="col-md-4" id="storage_{{ $item->id }}_item">
                                            <img src="{{ asset('storage/' . $item->image_url) }}" width="100px"
                                                alt="">
                                            <div class="d-flex mt-2">
                                                <input type="file" class="form-control" name="product_galleries[]"
                                                    id="gallery_default">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeImageGallery('storage_{{ $item->id }}_item', '{{ $item->id }}', '{{ $item->image_url }}')">
                                                    <span class="bx bx-trash"></span>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-4" id="gallery_default_item">
                                        <label for="gallery_default" class="form-label">Image</label>
                                        <div class="d-flex">
                                            <input type="file" class="form-control" name="product_galleries[]"
                                                id="gallery_default">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Thằng này dùng để lưu ảnh xóa --}}
                            <div id="delete_galleries"></div>
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
                            <i class="bx bx-trash"></i>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id, galleryID, imagePath) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();

                let html = `<input type="hidden" class="form-control" name="delete_galleries[${galleryID}]" value="${imagePath}">`;
                $('#delete_galleries').append(html);
            }
        }
    </script>
@endsection
