@extends('admin.layouts.master');

@section('title')
    Quản lý đánh giá
@endsection

@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .review-comment {
            word-wrap: break-word;
            max-width: 100%;
            margin: 0;
        }
    </style>
    <table class="table">
        @if (Session('success'))
            <div class="alert alert-success" role="alert">
                {{ Session('success') }}
            </div>
        @endif
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Họ tên</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Vai trò</th>
                <th scope="col">Trạng thái</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @php
                $role = [
                    'admin' => 'Quản trị viên',
                    'user' => 'Người dùng',
                ];

                $status = ['active' => 'Hoạt động', 'inactive' => 'Không hoạt động'];
            @endphp
            @foreach ($users as $index => $user)
                @if ($user->role == 'user')
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>

                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $role[$user->role] }}</td>
                        <td>
                            <a style="margin-right: 2px" href="{{ route('user.updateStatus', $user->id) }}"
                                class="btn btn-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                {{ $user->status === 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                data-target="#userModal{{ $user->id }}">
                                Xem Chi Tiết
                            </button>
                            <a href="{{ route('user.update', $user->id) }}"><button type="button" class="btn btn-warning"
                                    style="margin-right: 2px">Sửa</button></a>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel{{ $user->id }}">Chi Tiết user</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
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
                                    <p class="mt-3 review-comment"><strong>Địa chỉ:</strong> {{ $user->address }}
                                    <p class="mt-3 review-comment"><strong>Vai trò:</strong> {{ $role[$user->role] }}
                                    </p>

                                    <p class="mt-3 review-comment"><strong>Ngày đăng kí:</strong>
                                        {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}</p>

                                    <p class="mt-3 review-comment"><strong>Trạng thái tài khoản:</strong>
                                        {{ $status[$user->status] }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </tbody>

    </table>
    <div class="d-flex justify-content-end">
        <div class="pagination-wrap hstack gap-2">
            {{ $users->appends(request()->input())->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
