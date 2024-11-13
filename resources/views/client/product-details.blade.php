@extends('client.layout')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area" data-bg-img="{{ asset('assets/img/photos/bg3.webp') }}">
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-content">
                            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Chi tiết sản phẩm</h2>
                            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                                <ul class="breadcrumb">
                                    <li><a href="{{ route('/') }}">Trang chủ</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Chi tiết sản phẩm</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Product Single Area Wrapper ==-->
        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <section class="product-area product-single-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-single-item">
                            <div class="row">
                                <div class="col-xl-6">
                                    <!--== Start Product Thumbnail Area ==-->
                                    <div class="product-single-thumb">
                                        <div class="swiper-container single-product-thumb single-product-thumb-slider">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <a class="lightbox-image" data-fancybox="gallery"
                                                        href="{{ Storage::url($product->primary_image_url) }}">
                                                        <img src="{{ Storage::url($product->primary_image_url) }}"
                                                            alt="{{ $product->name }}"
                                                            style="height: 541px; object-fit: cover">
                                                    </a>
                                                </div>
                                                @foreach ($product->productImages as $image)
                                                    <div class="swiper-slide">
                                                        <a class="lightbox-image" data-fancybox="gallery"
                                                            href="{{ Storage::url($image->image_url) }}">
                                                            <img src="{{ Storage::url($image->image_url) }}"
                                                                alt="{{ $product->name }}"
                                                                style="height: 541px; object-fit: cover">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="swiper-container single-product-nav single-product-nav-slider">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <img src="{{ Storage::url($product->primary_image_url) }}"
                                                        alt="{{ $product->name }}"
                                                        style="height: 127px; object-fit: cover">
                                                </div>
                                                @foreach ($product->productImages as $image)
                                                    <div class="swiper-slide">
                                                        <img src="{{ Storage::url($image->image_url) }}"
                                                            alt="{{ $product->name }}"
                                                            style="height: 127px; object-fit: cover">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!--== End Product Thumbnail Area ==-->
                                </div>
                                <div class="col-xl-6">
                                    <!--== Start Product Info Area ==-->
                                    <div class="product-single-info">
                                        <h3 class="main-title">{{ $product->name }}</h3>
                                        <div class="prices">
                                            <span id="price-old" class="price-old"
                                                style="text-decoration: line-through; font-weight: 400;">
                                                {{ number_format($lowestSaleVariant->listed_price) }} đ</span>
                                            <span class="sep" id="price-sep">-</span>
                                            <span id="price" class="price">
                                                {{ number_format($lowestSaleVariant->sale_price) }} đ
                                            </span>
                                        </div>

                                        <div class="rating-box-wrap">
                                            @if ($product->reviews->count() > 0)
                                                <div class="rating-box">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fa fa-star{{ $i <= $product->average_rating ? '' : '-o' }}"></i>
                                                    @endfor
                                                </div>
                                                <div class="review-status">
                                                    <a href="javascript:void(0)">({{ $product->reviews->count() }} Đánh giá
                                                        của khách hàng)</a>
                                                </div>
                                            @endif
                                        </div>

                                        <p>{{ $product->summary }}</p>

                                        <form action="{{ route('cart.add') }}" id="cart-form" method="POST">
                                            @csrf
                                            <div class="product-size">
                                                <h6 class="title">Kích thước</h6>
                                                <ul class="size-list">
                                                    @foreach ($product->variants as $variant)
                                                        <li class="size-item {{ $variant->stock == 0 ? 'out-of-stock' : '' }}"
                                                            data-stock="{{ $variant->stock }}"
                                                            data-variant-id="{{ $variant->id }}"
                                                            onclick="selectVariant(this)">
                                                            {{ $variant->size ? $variant->size->name : 'Không xác định' }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <div id="stock-info" class="stock-info mb-2"></div>

                                            <div class="product-quick-action">
                                                <input type="hidden" name="variant_id" id="selected-variant-id"
                                                    value="">
                                                <input type="hidden" name="action" id="action" value="add_to_cart">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                <div class="pro-qty">
                                                    <input type="number" id="cart-quantity-input" name="variant_quantity"
                                                        value="1" min="1">
                                                </div>

                                                <button type="submit" id="add-to-cart-btn" class="btn-theme"
                                                    onclick="handleSubmit(event, 'add_to_cart')">Thêm vào giỏ hàng</button>
                                                <button type="submit" class="btn-theme"
                                                    onclick="handleSubmit(event, 'buy_now')">Mua ngay</button>
                                            </div>
                                        </form>

                                        <script>
                                            let selectedVariant = null;
                                            const variants = @json($product->variants);

                                            function selectVariant(element) {
                                                // Làm nổi bật biến thể đã chọn
                                                document.querySelectorAll('.size-item').forEach(item => item.classList.remove('active'));
                                                element.classList.add('active');

                                                const variantId = element.dataset.variantId;
                                                const stock = element.dataset.stock;

                                                selectedVariant = {
                                                    id: variantId,
                                                    stock: stock
                                                };

                                                document.getElementById('selected-variant-id').value = variantId;
                                                updateStockInfo(stock);
                                                updatePrice(variantId);
                                            }

                                            function updateStockInfo(stock) {
                                                const stockInfo = document.getElementById('stock-info');
                                                stockInfo.innerHTML = stock > 0 ?
                                                    `Số lượng còn lại: ${stock}` :
                                                    '<span style="color: red;">Đã hết hàng</span>';

                                                toggleAddToCartButton(stock > 0);
                                            }

                                            function updatePrice(variantId) {
                                                const selectedVariant = variants.find(variant => variant.id == variantId);
                                                const priceOld = document.getElementById('price-old');
                                                const priceSep = document.getElementById('price-sep');
                                                const priceDisplay = document.getElementById('price');

                                                if (selectedVariant.sale_price) {
                                                    priceOld.style.display = 'inline';
                                                    priceSep.style.display = 'inline';
                                                    priceOld.innerHTML = `${formatNumber(selectedVariant.listed_price)} đ`;
                                                    priceDisplay.innerHTML = `${formatNumber(selectedVariant.sale_price)} đ`;
                                                } else {
                                                    priceOld.style.display = 'none';
                                                    priceSep.style.display = 'none';
                                                    priceDisplay.innerHTML = `${formatNumber(selectedVariant.listed_price)} đ`;
                                                }
                                            }

                                            function formatNumber(number) {
                                                return number.toLocaleString();
                                            }

                                            function toggleAddToCartButton(isEnabled) {
                                                const addToCartBtn = document.getElementById('add-to-cart-btn');
                                                addToCartBtn.classList.toggle('disabled', !isEnabled);
                                                addToCartBtn.onclick = isEnabled ? null : (e) => e.preventDefault();
                                            }

                                            function handleSubmit(event, actionType) {
                                                event.preventDefault(); // Ngừng form tự động gửi

                                                if (!selectedVariant || selectedVariant.stock == 0) {
                                                    alert('Bạn cần chọn kích thước trước khi thêm vào giỏ hàng!');
                                                    return;
                                                }

                                                const form = document.getElementById('cart-form');
                                                document.getElementById('action').value = actionType;

                                                // Cập nhật action của form dựa trên hành động
                                                form.action = actionType === 'buy_now' ? '{{ route('checkout.now') }}' : '{{ route('cart.add') }}';

                                                // Gửi form
                                                form.submit();
                                            }
                                        </script>




                                        <style>
                                            .btn-theme.disabled {
                                                background-color: #fff;
                                                color: #eb3e32;
                                                cursor: not-allowed;
                                            }
                                        </style>
                                        <div class="product-wishlist-compare">
                                            <a href="shop-wishlist.html"><i class="pe-7s-like"></i>Thêm vào sản phẩm yêu
                                                thích</a>
                                            {{-- <a href="shop-compare.html"><i class="pe-7s-shuffle"></i>Add to Compare</a> --}}
                                        </div>
                                        <div class="product-info-footer">
                                            <h6 class="code"><span>Code :</span>{{ $product->code }}</h6>
                                        </div>
                                    </div>

                                </div>
                                <!--== End Product Info Area ==-->
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="product-review-tabs-content">
                            <ul class="nav product-tab-nav" id="ReviewTab" role="tablist">
                                <li role="presentation">
                                    <a class="active" id="information-tab" data-bs-toggle="pill" href="#information"
                                        role="tab" aria-controls="information" aria-selected="true">Thông tin</a>
                                </li>

                                <li role="presentation">
                                    <a id="reviews-tab" data-bs-toggle="pill" href="#reviews" role="tab"
                                        aria-controls="reviews" aria-selected="false">Bình luận
                                        <span>({{ $product->reviews->filter(function ($review) {
                                                return ($review->comment || $review->image_url) && !$review->is_hidden; // Kiểm tra không bị ẩn
                                            })->count() }})</span></a>
                                </li>
                            </ul>
                            <div class="tab-content product-tab-content" id="ReviewTabContent">
                                <div class="tab-pane fade show active" id="information" role="tabpanel"
                                    aria-labelledby="information-tab">
                                    <div class="product-information">
                                        <p>{{ $product->detailed_description }}</p>
                                    </div>
                                </div>
                                {{-- <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                  <div class="product-description">
                    <p>Việc chăm sóc bệnh nhân là rất quan trọng, bệnh nhân sẽ được theo dõi, nhưng đồng thời chúng cũng gây ra rất nhiều công sức và đau đớn. Vì như tôi đã nói, chúng ta đừng tham gia vào bất kỳ loại công việc nào trừ khi chúng ta thu được lợi ích nào đó từ nó. Duis hoặc irure pain in tun tun khiển trách trong niềm vui anh ta muốn trở thành một chiếc lông trong nỗi đau eu chạy trốn không sinh. Trừ khi bị dục vọng làm cho mù quáng, nếu không họ sẽ không bước ra, đó là lỗi của người bỏ bê nhiệm vụ và làm mềm lòng, đó là công việc cực nhọc. Nhưng để bạn có thể thấy rằng tất cả những sai lầm bẩm sinh này là niềm vui của những người buộc tội và nỗi đau của những người khen ngợi, tôi sẽ mở đầu toàn bộ vấn đề và giải thích chính những điều mà người khám phá ra sự thật đó đã nói và, như nó là kiến ​​trúc sư của một cuộc sống hạnh phúc. Vì không ai khinh miệt, ghét bỏ hay chạy trốn khỏi niềm vui vì nó là niềm vui mà vì kết quả của nó.</p>
                  </div>
                </div> --}}
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    <div class="product-review-content">
                                        <div class="review-content-header">
                                            <h3>Đánh giá của khách hàng</h3>
                                            @if ($product->reviews->count() > 0)
                                                <div class="review-info">
                                                    <ul class="review-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li
                                                                class="fa fa-star{{ $i <= $product->average_rating ? '' : '-o' }}">
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                    <span class="review-caption">Dựa trên {{ $product->reviews->count() }}
                                                        đánh giá</span>
                                                    {{-- <span class="review-write-btn">Viết bài đánh giá</span> --}}
                                                </div>
                                            @endif
                                        </div>

                                        <!--== Start Reviews Form Item ==-->
                                        <div class="reviews-form-area">
                                            <h4 class="title">Viết bài đánh giá</h4>
                                            <div class="reviews-form-content">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="for_name">Tên</label>
                                                                <input id="for_name" class="form-control" type="text"
                                                                    placeholder="Enter your name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="for_email">Email</label>
                                                                <input id="for_email" class="form-control" type="email"
                                                                    placeholder="john.smith@example.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <span class="title">Xếp hạng</span>
                                                                <ul class="review-rating">
                                                                    <li class="fa fa-star-o"></li>
                                                                    <li class="fa fa-star-o"></li>
                                                                    <li class="fa fa-star-o"></li>
                                                                    <li class="fa fa-star-o"></li>
                                                                    <li class="fa fa-star-o"></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="for_review-title">Tiêu đề đánh giá</label>
                                                                <input id="for_review-title" class="form-control"
                                                                    type="text" placeholder="Give your review a title">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="for_comment">Nội dung đánh giá (1500)</label>
                                                                <textarea id="for_comment" class="form-control" placeholder="Write your comments here"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-submit-btn">
                                                                <button type="submit" class="btn-submit">Đăng bình
                                                                    luận</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!--== End Reviews Form Item ==-->

                                        <div class="reviews-content-body">
                                            <!--== Start Reviews Content Item ==-->
                                            <!-- Modal để hiển thị ảnh lớn -->
                                            <div id="imageModal" class="modal">
                                                <span class="close" onclick="closeModal()">&times;</span>
                                                <img class="modal-content" id="modalImage" alt="Large Review Image">
                                            </div>

                                            @forelse ($reviews as $review)
                                                @if ($review->image_url || $review->comment)
                                                    <div class="review-item">
                                                        <ul class="review-rating">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <li
                                                                    class="fa fa-star{{ $i <= $review->rating ? '' : '-o' }}">
                                                                </li>
                                                            @endfor
                                                        </ul>
                                                        <h3 class="title">{{ $review->user->full_name }}</h3>
                                                        <!-- Hiển thị nội dung đánh giá -->
                                                        <h5 class="sub-title">
                                                            <span>{{ $review->user->full_name }}</span> Đánh giá vào
                                                            <span>{{ \Carbon\Carbon::parse($review->review_date)->format('d/m/Y H:i') }}</span>
                                                        </h5>
                                                        <h5 class="sub-title">
                                                            Sản phẩm: <span
                                                                class="me-2">{{ $review->variant->product->name }}</span>
                                                            Kích thước: <span>{{ $review->variant->size->name }}</span>
                                                        </h5>
                                                        @if ($review->image_url)
                                                            <img src="{{ Storage::url($review->image_url) }}"
                                                                alt="Review Image" width="200"
                                                                onclick="openModal('{{ Storage::url($review->image_url) }}')">
                                                        @endif
                                                        <h5 class="sub-title mt-3">
                                                            Nội dung: <span>{{ $review->comment }}</span>
                                                        </h5>

                                                        {{-- <a href="#/">Report as Inappropriate</a> --}}
                                                    </div>
                                                @endif
                                            @empty
                                                <p>Chưa có bình luận nào cho sản phẩm này.</p>
                                            @endforelse

                                            <style>
                                                .modal {
                                                    display: none;
                                                    position: fixed;
                                                    z-index: 1000;
                                                    left: 0;
                                                    top: 0;
                                                    width: 100%;
                                                    height: 100%;
                                                    overflow: auto;
                                                    background-color: rgba(0, 0, 0, 0.8);
                                                }

                                                .modal-content {
                                                    margin: auto;
                                                    display: block;
                                                    width: 80%;
                                                    max-width: 700px;
                                                }

                                                .close {
                                                    position: absolute;
                                                    top: 10px;
                                                    right: 25px;
                                                    color: #fff;
                                                    font-size: 35px;
                                                    font-weight: bold;
                                                    cursor: pointer;
                                                }
                                            </style>

                                            <script>
                                                function openModal(imageUrl) {
                                                    var modal = document.getElementById("imageModal");
                                                    var modalImage = document.getElementById("modalImage");
                                                    modal.style.display = "block";
                                                    modalImage.src = imageUrl;
                                                }

                                                function closeModal() {
                                                    var modal = document.getElementById("imageModal");
                                                    modal.style.display = "none";
                                                }
                                            </script>
                                            <!--== End Reviews Content Item ==-->

                                        </div>

                                        <!--== Start Reviews Pagination Item ==-->
                                        <!-- Phân trang -->
                                        <div class="review-pagination">
                                            @if ($reviews->hasPages())

                                                <span class="pagination-prev">
                                                    @if ($reviews->currentPage() > 1)
                                                        <a href="{{ $reviews->previousPageUrl() }}">« Quay lại</a>
                                                    @endif
                                                </span>

                                                <span class="pagination-pag">Trang</span>
                                                @for ($i = 1; $i <= $reviews->lastPage(); $i++)
                                                    <span
                                                        class="pagination-pag {{ $i == $reviews->currentPage() ? 'active' : '' }}">
                                                        <a href="{{ $reviews->url($i) }}">{{ $i }}</a>
                                                    </span>
                                                @endfor

                                                <span class="pagination-next">
                                                    @if ($reviews->hasMorePages())
                                                        <a href="{{ $reviews->nextPageUrl() }}">Tiếp theo »</a>
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                        <style>
                                            .pagination-pag {
                                                display: inline-block;
                                                margin: 0 5px;
                                            }

                                            .pagination-pag.active a {
                                                font-weight: bold;
                                                color: red;
                                                text-decoration: underline;
                                            }

                                            .pagination-pag a {
                                                text-decoration: none;
                                                color: #000;
                                            }

                                            .pagination-prev {
                                                display: flex;
                                                margin-bottom: -25px;
                                            }

                                            .review-pagination {
                                                margin: auto;
                                            }
                                        </style>

                                        <!--== End Reviews Pagination Item ==-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            </div>
        </section>
        <!--== End Product Single Area Wrapper ==-->

        <!--== Start Product Area Wrapper ==-->
        <section class="product-area product-best-seller-area">
            <div class="container pt--0">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h3 class="title">Sản phẩm liên quan</h3>
                            <div class="desc">
                                <p>Các sản phẩm cho chung kiểu dáng và mẫu mã giống nhau</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-slider-wrap">
                            <div class="swiper-container product-slider-col4-container">
                                <div class="swiper-wrapper">
                                    @foreach ($relatedProducts as $relatedProduct)
                                        <div class="swiper-slide">
                                            <!--== Start Product Item ==-->
                                            <div class="product-item">
                                                <div class="inner-content">
                                                    <div class="product-thumb">
                                                        <a
                                                            href="{{ route('product-detail', ['id' => $relatedProduct->id]) }}">
                                                            <img src="{{ Storage::url($relatedProduct->primary_image_url) }}"
                                                                alt="{{ $relatedProduct->name }}"
                                                                style="height: 271px; object-fit: cover">
                                                        </a>
                                                        <div class="product-flag">
                                                            <ul>
                                                                @if ($relatedProduct->variants->isNotEmpty() && $relatedProduct->variants->first()->sale_price)
                                                                    <li class="discount">
                                                                        -{{ round((($relatedProduct->variants->first()->listed_price - $relatedProduct->variants->first()->sale_price) / $relatedProduct->variants->first()->listed_price) * 100) }}%
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="product-action">
                                                            <a class="btn-product-wishlist" href=""><i
                                                                    class="fa fa-heart"></i></a>
                                                            <a class="btn-product-cart" href=""><i
                                                                    class="fa fa-shopping-cart"></i></a>
                                                            <button type="button" class="btn-product-quick-view-open">
                                                                <i class="fa fa-arrows"></i>
                                                            </button>
                                                        </div>
                                                        <a class="banner-link-overlay"
                                                            href="{{ route('product-detail', ['id' => $relatedProduct->id]) }}"></a>
                                                    </div>
                                                    <div class="product-info">
                                                        <h4 class="title"><a
                                                                href="{{ route('product-detail', ['id' => $relatedProduct->id]) }}">{{ $relatedProduct->name }}</a>
                                                        </h4>
                                                        <div class="prices">
                                                            @if ($relatedProduct->variants->isNotEmpty())
                                                                @php
                                                                    // Tìm biến thể có giá sale thấp nhất
                                                                    $lowestSaleVariant = $relatedProduct->variants
                                                                        ->whereNotNull('sale_price')
                                                                        ->sortBy('sale_price')
                                                                        ->first();
                                                                @endphp
                                                                @if ($lowestSaleVariant)
                                                                    <span class="price-old"
                                                                        style="text-decoration: line-through;">
                                                                        {{ number_format($lowestSaleVariant->listed_price) }}
                                                                        đ</span>
                                                                    <span class="sep">-</span>
                                                                    <span class="price">
                                                                        {{ number_format($lowestSaleVariant->sale_price) }}
                                                                        đ
                                                                    </span>
                                                                @else
                                                                    <span
                                                                        class="price">{{ number_format($relatedProduct->listed_price) }}
                                                                        đ</span>
                                                                @endif
                                                            @else
                                                                <span
                                                                    class="price">{{ number_format($relatedProduct->listed_price) }}
                                                                    đ</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--== End prPduct Item ==-->
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <!--== Add Swiper Arrows ==-->
                            <div class="product-swiper-btn-wrap">
                                <div class="product-swiper-btn-prev">
                                    <i class="fa fa-arrow-left"></i>
                                </div>
                                <div class="product-swiper-btn-next">
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Product Area Wrapper ==-->
    </main>

@endsection
