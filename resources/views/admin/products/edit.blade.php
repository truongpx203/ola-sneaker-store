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
                                            @foreach ($product->variants as $index => $variant)
                                                <tr class="text-center">
                                                    <td style="vertical-align: middle;">
                                                        <select class="form-select" name="variants[{{ $index }}][size_id]" onchange="checkDuplicateSize(this)">
                                                            <option value="">Chọn kích thước</option>
                                                            @foreach ($productSizes as $size)
                                                                <option value="{{ $size->id }}" {{ $size->id == $variant->product_size_id ? 'selected' : '' }}>
                                                                    {{ $size->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('variants.' . $index . '.size_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="variants[{{ $index }}][stock]" placeholder="Số lượng" value="{{ $variant->stock }}">
                                                        @error('variants.' . $index . '.stock')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="variants[{{ $index }}][listed_price]" placeholder="Giá niêm yết" value="{{ $variant->listed_price }}" oninput="checkPrice(this)">
                                                        @error('variants.' . $index . '.listed_price')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="variants[{{ $index }}][sale_price]" placeholder="Giá khuyến mãi" value="{{ $variant->sale_price }}" oninput="checkPrice(this)">
                                                        @error('variants.' . $index . '.sale_price')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="variants[{{ $index }}][import_price]" placeholder="Giá nhập" value="{{ $variant->import_price }}">
                                                        @error('variants.' . $index . '.import_price')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <select class="form-select" name="variants[{{ $index }}][is_show]">
                                                            <option value="1" {{ $variant->is_show == 1 ? 'selected' : '' }}>Hiển thị</option>
                                                            <option value="0" {{ $variant->is_show == 0 ? 'selected' : '' }}>Ẩn</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-remove-variant" onclick="removeVariant(this)">Xóa</button>
                                                    </td>
                                                </tr>
                                            @endforeach
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


    <script>
        let variantCount = {{ count($product->variants) }}; // Đếm số biến thể đã thêm
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
