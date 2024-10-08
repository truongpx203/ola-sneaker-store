@extends('admin.layouts.master');

@section('title')
    Danh sách sản phẩm biến thể
@endsection

@section('content')
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Sản phẩm biến thể</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm">
                                <form action="{{ route('variants.index') }}" method="GET">
                                    <div class="form-group">
                                        <label for="product">Chọn Sản Phẩm:</label>
                                        <select name="product_id" id="product" class="form-control">
                                            <option value="">-- Chọn sản phẩm --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn btn-sm btn-primary mt-2">Tìm kiếm</button>
                                </form>
                            </div>
                        </div>

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
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th>Size</th>
                                        <th>Số lượng</th>
                                        <th>Giá niêm yết</th>
                                        <th>Giá khuyễn mãi</th>
                                        <th>Giá nhập</th>
                                        <th>Trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($variants as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->product_size }}</td>
                                            <td>{{ $item->stock }}</td>
                                            <td>{{ number_format($item->listed_price, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ number_format($item->sale_price, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ number_format($item->import_price, 0, ',', '.') }} VNĐ</td>
                                            <td>
                                                @if ($item->is_show)
                                                    <span
                                                        class="badge bg-success-subtle text-success text-uppercase">Show</span>
                                                @else
                                                    <span
                                                        class="badge bg-danger-subtle text-danger text-uppercase">Hide</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="detail">
                                                        <a href="{{ route('variants.show', $item->id) }}" class="btn btn-sm btn-primary edit-item-btn">Xem</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{ route('variants.edit', $item->id) }}" class="btn btn-sm btn-success edit-item-btn">Sửa</a>
                                                    </div>
                                                    {{-- <div class="remove">
                                                        <form action="{{ route('variants.destroy', $item->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Xác nhận xóa?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger remove-item-btn">Xóa</button>
                                                        </form>
                                                    </div> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a"
                                        style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not
                                        find any orders for you search.</p>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                {{ $variants->appends(request()->input())->links('pagination::bootstrap-4') }}
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
                [1, 'desc']
            ]
        });
    </script>
@endsection
