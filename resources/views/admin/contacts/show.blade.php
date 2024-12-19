@extends('admin.layouts.master')

@section('title')
Chi tiết liên hệ
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Chi tiết liên hệ</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                {{-- <div class="card-header">
                                    Liên hệ #{{ $contact->id }}
                                </div> --}}
                                <div class="card-body">
                                    <p><strong>Họ và tên:</strong> {{ $contact->user->full_name }}</p>
                                    <p><strong>Email:</strong> {{ $contact->user->email }}</p>
                                    <p><strong>Tiêu đề:</strong> {{ $contact->subject ?? 'Không có tiêu đề' }}</p>
                                    <p><strong>Nội dung:</strong></p>
                                    <p>{{ $contact->message }}</p>
                                    <p><strong>Trạng thái:</strong>
                                        @if ($contact->is_resolved)
                                            <span class="badge bg-success">Đã phản hồi</span>
                                        @else
                                            <span class="badge bg-warning">Chưa phản hồi</span>
                                        @endif
                                    </p>
                                    <p><strong>Thời gian:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        @if (!$contact->is_resolved)
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0 flex-grow-1">Phản hồi liên hệ</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('contacts.reply', $contact->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="reply_message">Nội dung phản hồi:</label>
                                            <textarea class="form-control" name="reply_message" id="reply_message" rows="5" >{{ old('reply_message') }}</textarea>
                                            @error('reply_message')
                                                <small style="color: red;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-2">Gửi phản hồi</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-success">
                                Liên hệ này đã được phản hồi.
                            </div>
                        @endif
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
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary">Quay lại danh sách</a>
                </div><!-- end card header -->
            </div>
        </div>
        <!--end col-->
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
