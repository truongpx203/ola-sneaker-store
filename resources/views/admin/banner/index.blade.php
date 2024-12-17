@extends('admin.layouts.master');

@section('title')
    Danh sách banner
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách banner</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Danh mục</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between ">
                    <h5 class="card-title mb-0 "> Danh Sách</h5>

                    <a href="{{ route('banners.create') }}" class="btn btn-primary mb-3">Thêm Mới </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" style="width:100%">

                        <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Ảnh</th>
                                <th>Hiển thị</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                                <tr>
                                    <td>{{ $banner->title }}</td>
                                    <td><img src="{{ asset('storage/' . $banner->image) }}" alt="" width="100">
                                    </td>
                                    <td>
                                        <form action="{{ route('banners.update',$banner->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            {{-- <input type="hidden" name="is_active" value="0"> --}}
                                            <!-- Checkbox -->
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                                {{ $banner->is_active ? 'checked' : '' }} onchange="this.form.submit();">
                                        </form>
                                    </td>
                                    <td>
                                        {{-- <a href="{{ route('banners.edit', $banner) }}">Sửa</a> --}}
                                        <form action="{{ route('banners.destroy', $banner) }}" method="POST"
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
            </div>
        </div><!--end col-->
    </div><!--end row-->
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
@section('scriptsToastr')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        console.log("Success message:", "{{ session('success') }}");
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
    </script>
@endsection
