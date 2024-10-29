@extends('admin.layouts.master')

@section('title')
    Cập nhật tài khoản
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">Cập nhật thông tin tài khoản</h5>
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                    onsubmit="return confirmChanges()">
                    @csrf
                    @method('PUT')


                    <div class="mb-3">
                        <label for="product_size_id" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" name="full_name" value="{{ $user->full_name }}">
                        @error('full_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ $user->email }}" disabled>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Số điện thoại</label>
                        <input type="number" class="form-control" name="phone_number" value="{{ $user->phone_number }}">
                        @error('phone_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Vai trò</label>
                        <select class="form-select" name="role" id="role">
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Người dùng</option>
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" name="status" id="status_user">
                            {{-- <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Chờ duyệt</option> --}}
                            <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Không hoạt động
                            </option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <textarea class="form-control" name="address">{{ $user->address }}</textarea>
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu (để trống nếu không thay đổi)</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fa fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <script>
                        document.getElementById('togglePassword').addEventListener('click', function() {
                            const passwordInput = document.getElementById('password');
                            const eyeIcon = document.getElementById('eyeIcon');

                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                eyeIcon.classList.remove('fa-eye');
                                eyeIcon.classList.add('fa-eye-slash');
                            } else {
                                passwordInput.type = 'password';
                                eyeIcon.classList.remove('fa-eye-slash');
                                eyeIcon.classList.add('fa-eye');
                            }
                        });

                        function confirmChanges() {
                            const roleSelect = document.getElementById('role');
                            const statusSelect = document.getElementById('status_user');
                            const currentRole = "{{ $user->role }}";
                            const currentStatus = "{{ $user->status }}";

                            let message = '';

                            if (roleSelect.value !== currentRole) {
                                message += `Bạn có chắc chắn muốn thay đổi vai trò từ "${currentRole}" sang "${roleSelect.value}"?\n`;
                            }

                            if (statusSelect.value !== currentStatus) {
                                message +=
                                `Bạn có chắc chắn muốn thay đổi trạng thái từ "${currentStatus}" sang "${statusSelect.value}"?\n`;
                            }

                            if (message) {
                                return confirm(message); // Hiển thị hộp thoại xác nhận với thông điệp tổng hợp
                            }

                            return true; // Cho phép form được gửi nếu không có thay đổi
                        }
                    </script>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('list.user') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>


    </div>
@endsection
