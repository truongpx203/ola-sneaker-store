@extends('client.layout')

@section('title', 'Sản phẩm yêu thích')

@section('content')
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-content">
                            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Sản phẩm yêu thích</h2>
                            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                                <ul class="breadcrumb">
                                    <li><a href="index.html">Trang chủ</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Sản phẩm yêu thích</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Wishlist Area Wrapper ==-->
        <section class="shopping-wishlist-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif(session('info'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ session('info') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="shopping-wishlist-table table-responsive">
                            @if ($wishlists->isEmpty())
                                <div class="text-center">
                                    <p>Chưa có sản phẩm yêu thích</p>
                                    <a class="btn-cart"
                                        href="{{ route('shop.filter') }}">
                                        -- Trang danh sách sản phẩm -- 
                                    </a>
                                </div>
                            @else
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumb">&nbsp;</th>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-action">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wishlists as $item)
                                            <tr class="cart-wishlist-item">
                                                <td class="product-remove">
                                                    <form action="{{ route('wishlist.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Bạn có thật sự muốn xóa không??')"
                                                            style="background: none; border: none; padding: 0; cursor: pointer;">
                                                            <i class="fa fa-trash-o"></i></button>
                                                    </form>
                                                </td>
                                                <td class="product-thumb">
                                                    <a href="single-product.html">
                                                        <img src="{{ Storage::url($item->product->primary_image_url) }}"
                                                            width="90" height="110" alt="{{ $item->product->name }}">
                                                    </a>
                                                </td>
                                                <td class="product-name">
                                                    <h4 class="title"><a
                                                            href="{{ route('product-detail', ['id' => $item->product->id]) }}">{{ $item->product->name }}</a>
                                                    </h4>
                                                </td>
                                                <td class="product-price">
                                                    <span class="prices">
                                                        @if ($item->product->variants->isNotEmpty())
                                                            @php
                                                                $variant = $item->product->variants->first();
                                                            @endphp
                                                            @if ($variant->sale_price)
                                                                <span
                                                                    class="text-decoration-line-through">{{ number_format($variant->listed_price) }}
                                                                    đ</span>
                                                                <span class="sep">-</span>
                                                                <span
                                                                    class="price">{{ number_format($variant->sale_price) }}
                                                                    đ</span>
                                                            @else
                                                                <span
                                                                    class="price">{{ number_format($variant->listed_price) }}
                                                                    đ</span>
                                                            @endif
                                                        @else
                                                            <span
                                                                class="price">{{ number_format($item->product->listed_price) }}
                                                                đ</span>
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="product-action">
                                                    <a class="btn-cart"
                                                        href="{{ route('product-detail', ['id' => $item->product->id]) }}">Chi
                                                        tiết sản phẩm</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Wishlist Area Wrapper ==-->
    </main>
@endsection
