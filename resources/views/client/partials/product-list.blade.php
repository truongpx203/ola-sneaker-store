@foreach ($products as $product)
    <div class="col-sm-6 col-lg-4">
        <!--== Start Product Item ==-->
        <div class="product-item">
            <div class="inner-content">
                <div class="product-thumb">
                    <a href="{{ route('product-detail', ['id' => $product->id]) }}">
                        <img src="{{ Storage::url($product->primary_image_url) }}" alt="{{ $product->name }}"
                            style="height: 271px; object-fit: cover">
                    </a>
                    <div class="product-flag">
                        <ul>
                            @if ($product->variants->isNotEmpty() && $product->variants->first()->sale_price)
                                <li class="discount">
                                    -{{ round((($product->variants->first()->listed_price - $product->variants->first()->sale_price) / $product->variants->first()->listed_price) * 100) }}%
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="product-action">
                        <form action="{{ route('wishlist.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn-product-wishlist"><i class="fa fa-heart"></i></button>
                        </form>
                        <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                        <button type="button" class="btn-product-quick-view-open">
                            <i class="fa fa-arrows"></i>
                        </button>
                    </div>
                    <a class="banner-link-overlay" href="shop.html"></a>
                </div>
                <div class="product-info">
                    <h4 class="title"><a
                            href="{{ route('product-detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h4>
                    <div class="prices">
                        @if ($product->variants->isNotEmpty())
                            @php
                                $variant = $product->variants->first();
                            @endphp
                            @if ($variant->sale_price)
                                <span class="price-old">{{ number_format($variant->listed_price) }} đ</span>
                                <span class="sep">-</span>
                                <span class="price">{{ number_format($variant->sale_price) }} đ</span>
                            @else
                                <span class="price">{{ number_format($variant->listed_price) }} đ</span>
                            @endif
                        @else
                            <span class="price">{{ number_format($product->listed_price) }} đ</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--== End Product Item ==-->
    </div>
@endforeach

<div class="col-12">
    @if ($products->lastPage() > 1) <!-- Kiểm tra có nhiều hơn một trang không -->
        <div class="pagination-items">
            <ul class="pagination justify-content-end mb--0">
                @if ($products->onFirstPage())
                    <li class="disabled"><a href="#">&laquo;</a></li>
                @else
                    <li><a href="{{ $products->previousPageUrl() }}">&laquo;</a></li>
                @endif

                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <li class="{{ $i === $products->currentPage() ? 'active' : '' }}">
                        <a href="{{ $products->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($products->hasMorePages())
                    <li><a href="{{ $products->nextPageUrl() }}">&raquo;</a></li>
                @else
                    <li class="disabled"><a href="#">&raquo;</a></li>
                @endif
            </ul>
        </div>
    @endif
</div>

<style>
    .pagination li {
        margin: 0 5px;
    }

    .pagination li a {
        color: #000;
        /* Màu mặc định */
        text-decoration: none;
    }

    .pagination li.active a {
        color: #f6931f;
        /* Màu cho trang hiện tại */
        font-weight: bold;
        /* Đậm hơn */
    }

    .pagination li.disabled a {
        color: #ccc;
        /* Màu cho trang không khả dụng */
    }
</style>
