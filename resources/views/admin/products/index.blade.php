@extends('admin.layouts.master');

@section('title')
    Danh Sách Sản phẩm
@endsection
@section('content')
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Danh Sách Sản phẩm</h4>
                    <a href="{{ route('products.create') }}">
                        <button type="button" class="btn btn-success add-btn">
                            <i class="ri-add-line align-bottom me-1"></i> Add
                        </button>
                    </a>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <form action="{{ route('products.index') }}" method="GET">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="product_name">Tên sản phẩm:</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control"
                                        value="{{ request('product_name') }}" placeholder="Nhập tên sản phẩm">
                                </div>

                                <div class="form-group col-6">
                                    <label for="category_id">Danh mục sản phẩm:</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">-- Chọn danh mục --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button class="btn btn-sm btn-primary mt-2">Tìm kiếm</button>
                        </form>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mb-xl-0" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Hình ảnh</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Danh mục</th>
                                        <th>Đánh giá</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($listProducts as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <img src="{{ Storage::url($item->primary_image_url) }}"
                                                    alt="{{ $item->name }}" class="img-thumbnail" width="100px" />

                                            </td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $item->average_rating)
                                                        <i class="ri-star-fill text-warning"></i> <!-- Sao đầy -->
                                                    @else
                                                        <i class="ri-star-line"></i> <!-- Sao rỗng -->
                                                    @endif
                                                @endfor
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="detail">
                                                        <a href="{{ route('products.show', $item->id) }}"
                                                            class="btn btn-sm btn-primary edit-item-btn">Xem</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{ route('products.edit', $item->id) }}"
                                                            class="btn btn-sm btn-success edit-item-btn">Sửa</a>
                                                    </div>
                                                    <div class="remove">
                                                        <form action="{{ route('products.destroy', $item->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Xác nhận xóa?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger remove-item-btn">Xóa</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                {{ $listProducts->appends(request()->input())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script>
    <!-- App js -->
    <script>
        new DataTable('#example', {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
