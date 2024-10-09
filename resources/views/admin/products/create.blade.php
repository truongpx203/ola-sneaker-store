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
                                        <thead>
                                            <tr class="text-center">
                                                <th>Size</th>
                                                <th>Số lượng</th>
                                                <th>Giá niêm yết</th>
                                                <th>Giá khuyến mãi</th>
                                                <th>Giá nhập</th>
                                                <th>Hiển thị</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody id="variantRows">
                                            <tr class="text-center">
                                                <td style="vertical-align: middle;">
                                                    <select class="form-select" name="variants[0][size_id]" onchange="checkDuplicateSize(this)">
                                                        <option value="">Chọn kích thước</option>
                                                        @foreach ($productSizes as $size)
                                                            <option value="{{ $size->id }}" {{ old('variants.0.size_id') == $size->id ? 'selected' : '' }}>
                                                                {{ $size->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('variants.*.size_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="variants[0][stock]" placeholder="Số lượng" value="{{ old('variants.0.stock') }}">
                                                    @error('variants.*.stock')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="variants[0][listed_price]" placeholder="Giá niêm yết" value="{{ old('variants.0.listed_price') }}" oninput="checkPrice(this)">
                                                    @error('variants.*.listed_price')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="variants[0][sale_price]" placeholder="Giá khuyến mãi" value="{{ old('variants.0.sale_price') }}" oninput="checkPrice(this)">
                                                    @error('variants.*.sale_price')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="variants[0][import_price]" placeholder="Giá nhập" value="{{ old('variants.0.import_price') }}">
                                                    @error('variants.*.import_price')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <select class="form-select" name="variants[0][is_show]">
                                                        <option value="1" >Hiển thị</option>
                                                        <option value="0" >Ẩn</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-remove-variant" onclick="removeVariant(this)">Xóa</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-primary" id="addVariant">Thêm biến thể</button>
                                    
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
                        <h4 class="card-title mb-0 flex-grow-1">Ảnh phụ</h4>
                        <button type="button" class="btn btn-primary" onclick="addImageGallery()">Thêm ảnh</button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="gallery_list">
                                <div class="col-md-4" id="gallery_default_item">
                                    <label for="gallery_default" class="form-label">Ảnh sản phẩm</label>
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
                        <button class="btn btn-primary" type="submit">Lưu</button>
                    </div><!-- end card header -->
                </div>
            </div>
            <!--end col-->
        </div>
    </form>

    <script>
        let variantCount = 1; // Đếm số biến thể đã thêm
        let selectedSizes = []; // Mảng để lưu kích thước đã chọn
    
        document.getElementById('addVariant').addEventListener('click', function() {
            const variantRows = document.getElementById('variantRows');
            
            const newRow = `
                <tr class="text-center">
                    <td style="vertical-align: middle;">
                        <select class="form-select" name="variants[${variantCount}][size_id]" onchange="checkDuplicateSize(this)">
                            <option value="">Chọn kích thước</option>
                            @foreach ($productSizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="variants[${variantCount}][stock]" placeholder="Số lượng">
                    </td>
                    <td>
                        <input type="number" class="form-control" name="variants[${variantCount}][listed_price]" placeholder="Giá niêm yết" oninput="checkPrice(this)">
                    </td>
                    <td>
                        <input type="number" class="form-control" name="variants[${variantCount}][sale_price]" placeholder="Giá khuyến mãi" oninput="checkPrice(this)">
                    </td>
                    <td>
                        <input type="number" class="form-control" name="variants[${variantCount}][import_price]" placeholder="Giá nhập">
                    </td>
                    <td>
                        <select class="form-select" name="variants[${variantCount}][is_show]">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-remove-variant" onclick="removeVariant(this)">Xóa</button>
                    </td>
                </tr>
            `;
            variantRows.insertAdjacentHTML('beforeend', newRow);
            variantCount++; // Tăng biến đếm
        });
    
        function checkDuplicateSize(select) {
            const currentSize = select.value;
    
            // Kiểm tra kích thước đã chọn
            if (currentSize) {
                if (selectedSizes.includes(currentSize)) {
                    alert('Kích thước này đã được chọn. Vui lòng chọn kích thước khác.');
                    select.value = ''; // Đặt lại chọn
                } else {
                    // Thêm kích thước vào mảng đã chọn
                    selectedSizes.push(currentSize);
                }
            }
    
            // Cập nhật lại mảng kích thước đã chọn khi xóa
            const options = document.querySelectorAll('select[name*="[size_id]"]');
            selectedSizes = [];
            options.forEach(option => {
                if (option.value) {
                    selectedSizes.push(option.value);
                }
            });
        }
    
        function checkPrice(input) {
            const row = input.closest('tr');
            const listedPriceInput = row.querySelector('input[name*="[listed_price]"]');
            const salePriceInput = row.querySelector('input[name*="[sale_price]"]');
    
            const listedPrice = parseFloat(listedPriceInput.value) || 0;
            const salePrice = parseFloat(salePriceInput.value) || 0;
    
            if (salePrice >= listedPrice && listedPrice > 0) {
                alert('Giá khuyến mãi phải nhỏ hơn giá niêm yết.');
                salePriceInput.value = ''; // Đặt lại giá khuyến mãi
            }
        }
    
        function removeVariant(button) {
            button.closest('tr').remove();
            checkDuplicateSize({ value: '' }); // Cập nhật lại mảng khi xóa
        }
    </script>

    
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
