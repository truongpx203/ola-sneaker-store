@extends('admin.layouts.master');

@section('title', 'Liên hệ')

@section('content')
    <style>
        .badge {
            padding: 0.5em 1em;
            border-radius: 0.25rem;
            color: #fff;
        }

        .bg-gray {
            background-color: #7d7d7d;
        }

        .bg-blue {
            background-color: #007bff;
        }

        .bg-lightblue {
            background-color: #5bc0de;
        }

        .bg-green {
            background-color: #28a745;
        }

        .bg-red {
            background-color: #dc3545;
        }

        .bg-orange {
            background-color: #fd7e14;
        }

        .bg-darkgray {
            background-color: #343a40;
        }
    </style>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Danh Sách Liên hệ</h4>
                </div>
                <div class="card-body">
                    <div class="listjs-table">
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">                           
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Tiêu đề</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày gửi</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->id }}</td>
                                            <td>{{ $contact->user->full_name }}</td>
                                            <td>{{ $contact->user->email }}</td>
                                            <td>{{ $contact->subject ?? 'Không có tiêu đề' }}</td>
                                            <td>
                                                @if($contact->is_resolved)
                                                    <span class="badge bg-success">Đã phản hồi</span>
                                                @else
                                                    <span class="badge bg-warning">Chưa phản hồi</span>
                                                @endif
                                            </td>
                                            <td>{{ $contact->created_at->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('contacts.show', $contact->id) }}"
                                                    class="btn btn-primary">Xem chi tiết</a>
                                                {{-- <form action="{{ route('contacts.destroy', $contact->id) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Xác nhận xóa?')">  
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
