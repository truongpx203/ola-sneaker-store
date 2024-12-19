@extends('admin.layouts.master')

@section('title')
    Danh sách người dùng
@endsection

@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Danh sách người dùng</h4>
                </div>
                <div class="card-body">
                    <div class="listjs-table">
                        <form action="{{ route('list.user') }}" method="GET">
                            <div class="row">
                                <!-- Tìm kiếm theo email -->
                                <div class="form-group col-6">
                                    <label for="email">Email:</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        value="{{ request('email') }}" placeholder="Nhập email người dùng">
                                </div>

                                <!-- Tìm kiếm theo trạng thái user -->
                                <div class="form-group col-6">
                                    <label for="status">Trạng thái người dùng:</label>

                                    <select name="status" class="form-control">
                                        <option value="" {{ request('status') == '' ? 'selected' : '' }}>Tất cả
                                        </option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt
                                            động</option>
                                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                            Không hoạt động</option>
                                    </select>
                                </div>
                            </div>

                            <button class="btn btn-sm btn-primary mt-3">Tìm kiếm</button>
                        </form>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Họ tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Vai trò</th>
                                        <th scope="col">Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @php
                                        $role = [
                                            'admin' => 'Quản trị viên',
                                            'user' => 'Người dùng',
                                        ];

                                        $status = ['active' => 'Hoạt động', 'inactive' => 'Không hoạt động'];
                                    @endphp
                                    @foreach ($users as $index => $user)
                                        @if ($user->role == 'user' && in_array($user->status, ['active', 'inactive']))
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>

                                                <td>{{ $user->full_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $role[$user->role] }}</td>
                                                {{-- <td>
                                               <a style="margin-right: 2px" href="{{ route('user.updateStatus', $user->id) }}"
                                                   class="btn btn-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                                   {{ $user->status === 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                                               </a>
                                           </td> --}}
                                                <td>
                                                    <a style="margin-right: 2px"
                                                        href="{{ route('user.updateStatus', $user->id) }}"
                                                        class="btn btn-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                                        {{ $user->status === 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary edit-item-btn"
                                                        data-toggle="modal" data-target="#userModal{{ $user->id }}">
                                                        Xem chi tiết
                                                    </button>
                                                    <a href="{{ route('user.update', $user->id) }}"><button type="button"
                                                            class="btn btn-success"
                                                            style="margin-right: 2px">Sửa</button></a>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="userModalLabel{{ $user->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="userModalLabel{{ $user->id }}">
                                                                Chi Tiết người dùng</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Đóng">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="mt-3 review-comment"><strong>Họ tên</strong>
                                                                {{ $user->full_name }}</p>
                                                            <p class="mt-3 review-comment"><strong>Email</strong>
                                                                {{ $user->email }}</p>
                                                            <p class="mt-3 review-comment"><strong>Số điện thoại:</strong>
                                                                {{ $user->phone_number }}
                                                            <p class="mt-3 review-comment"><strong>Địa chỉ:</strong>
                                                                {{ $user->address }}
                                                            <p class="mt-3 review-comment"><strong>Vai trò:</strong>
                                                                {{ $role[$user->role] }}
                                                            </p>

                                                            <p class="mt-3 review-comment"><strong>Ngày đăng kí:</strong>
                                                                {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}
                                                            </p>

                                                            <p class="mt-3 review-comment"><strong>Trạng thái tài
                                                                    khoản:</strong>
                                                                {{ $status[$user->status] }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                {{ $users->appends(request()->input())->links('pagination::bootstrap-4') }}
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
