@extends('admin.layouts.master');

@section('title')
    Chi tiết liên hệ
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Chi tiết liên hệ</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <ul style="list-style-type: none; padding: 0;">
                                    <li><strong>Họ và tên:</strong> {{ $contact->name }}</li>
                                    <li><strong>Email:</strong> {{ $contact->email }}</li>
                                    <li><strong>Nội dung:</strong></li>
                                    <li>{{$contact->message}}</li>
                                </ul>
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
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary">Quay lại danh sách</a>
                </div><!-- end card header -->
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
