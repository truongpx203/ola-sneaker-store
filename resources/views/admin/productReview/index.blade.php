@extends('admin.layouts.master');

@section('title')
    Quản lý đánh giá
@endsection

@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .review-rating {
            color: gold;
        }

        .review-rating .fa-star {
            font-size: 20px;
        }

        .review-comment {
            word-wrap: break-word;
            max-width: 100%;
            margin: 0;
        }
    </style>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Đánh giá</th>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Size</th>
                <th scope="col">Ngày đánh giá</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productReview as $index => $review)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>
                        <div class="review-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="fa fa-star{{ $i <= $review->rating ? '' : '-o' }}"></span>
                            @endfor
                        </div>
                    </td>
                    <td>{{ $review->variant->product->name }}</td>
                    <td>{{ $review->variant->size->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($review->review_date)->format('d/m/Y H:i') }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal"
                            data-target="#reviewModal{{ $review->id }}">
                            Xem Chi Tiết
                        </button>
                        <a style="margin-right: 2px" href="review/{{ $review->id }}"
                            class="btn btn-{{ $review->is_hidden ? 'success' : 'danger' }}">
                            {{ $review->is_hidden ? 'Hiển thị' : 'Ẩn' }}
                        </a>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="reviewModal{{ $review->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="reviewModalLabel{{ $review->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reviewModalLabel{{ $review->id }}">Chi Tiết Đánh Giá</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="mt-3 review-comment"><strong>Tên Người Đánh Giá:</strong>
                                    {{ $review->user->full_name }}</p>
                                <p class="mt-3 review-comment"><strong>Sản Phẩm:</strong>
                                    {{ $review->variant->product->name }}</p>
                                <p class="mt-3 review-comment"><strong>Size:</strong> {{ $review->variant->size->name }}
                                </p>
                                <p class="mt-3 review-comment"><strong>Đánh Giá:</strong><a class="review-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="fa fa-star{{ $i <= $review->rating ? '' : '-o' }}"></span>
                                        @endfor
                                    </a></p>
                                @if ($review->image_url)
                                    <p class="mt-3 review-comment">
                                        <strong>Hình ảnh:</strong>
                                        <img src="{{ Storage::url($review->image_url) }}" width="150" height="150">
                                    </p>
                                @endif
                                @if ($review->comment)
                                    <p class="mt-3 review-comment">
                                        <strong>Bình Luận:</strong> {{ $review->comment }}
                                    </p>
                                @endif
                                <p class="mt-3 review-comment"><strong>Ngày Đánh Giá:</strong>
                                    {{ \Carbon\Carbon::parse($review->review_date)->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </tbody>

    </table>
    <div class="d-flex justify-content-end">
        <div class="pagination-wrap hstack gap-2">
            {{ $productReview->appends(request()->input())->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
