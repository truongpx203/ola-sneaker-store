@extends('admin.layouts.master')

@section('title')
    Danh sách size
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Danh sách size</h4>
                    <a href="{{ route('productsize.create') }}">
                        <button type="button" class="btn btn-success add-btn">
                            <i class="ri-add-line align-bottom me-1"></i> Thêm
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="listjs-table">
                        <form action="{{ route('productsize.index') }}" method="GET">
                            <div class="row">
                                <!-- Tìm kiếm theo tên kích thước -->
                                <div class="form-group col-12">
                                    <label for="name">Tên kích thước:</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ request('name') }}" placeholder="Nhập tên kích thước">
                                </div>
                            </div>

                            <!-- Nút tìm kiếm -->
                            <button class="btn btn-sm btn-primary mt-3">Tìm kiếm</button>
                        </form>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên Size</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($productSizes as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <a href="{{ route('productsize.edit', $item->id) }}" type="submit"
                                                    class="btn btn-success">
                                                    Sửa
                                                </a>
                                                <form action="{{ route('productsize.destroy', $item->id) }}" method="post"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Chắc chắn không?')" type="submit"
                                                        class="btn btn-danger">
                                                        Xoá
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                {{ $productSizes->appends(request()->input())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptsToastr')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            toastr.options = {

                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000",
            };
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>
@endsection
