@extends('admin.layouts.master')

@section('title')
    Danh mục sản phẩm
@endsection

@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Danh mục sản phẩm</h4>
                    <a href="{{ route('categories.create') }}">
                        <button type="button" class="btn btn-success add-btn">
                            <i class="ri-add-line align-bottom me-1"></i> Thêm
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="listjs-table">
                        <form action="{{ route('categories.index') }}" method="GET">
                            <div class="row">
                                <!-- Tìm kiếm theo tên danh mục -->
                                <div class="form-group col-12">
                                    <label for="name">Tên danh mục:</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ request('name') }}" placeholder="Nhập tên danh mục">
                                </div>
                            </div>
                            <button class="btn btn-sm btn-primary mt-3">Tìm kiếm</button>
                        </form>


                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên danh mục</th>
                                        <th>Hàng động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($data as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                {{-- <a href="{{ route('categories.show', $item->id) }}" class="btn btn-primary ">Xem</a> --}}
                                                <a href="{{ route('categories.edit', $item->id) }}"
                                                    class="btn btn-success">Sửa</a>
                                                <form action="{{ route('categories.destroy', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Bạn có thật sự muốn xóa không??')"
                                                        class="btn btn-danger">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                {{ $data->appends(request()->input())->links('pagination::bootstrap-4') }}
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
            @if (session('message'))
                toastr.success("{{ session('message') }}");
            @endif

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>
@endsection
