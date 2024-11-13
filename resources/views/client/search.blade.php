@extends('client.layout')

@section('title', 'Tìm Kiếm Sản Phẩm')

@section('content')
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
            <div class="container pt--0 pb--0">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-content">
                            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Tìm Kiếm Sản Phẩm</h2>
                            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                                <ul class="breadcrumb">
                                    <li><a href="">Trang chủ</a></li>
                                    <li class="breadcrumb-sep">//</li>
                                    <li>Tìm Kiếm Sản Phẩm</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->
        <!-- resources/views/search.blade.php -->
        <br>
        <!-- Thêm vào trong phần <head> của layout -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <h2 style="font-family: 'Roboto', sans-serif; font-weight: 700; font-size: 24px; color: #333; margin-bottom: 20px;">
            Kết quả tìm kiếm cho: "{{ $query }}"
        </h2>
        <div class="row">
            @if($products->isEmpty())
            <p style="font-size: 20px; color: #666; font-weight: bold; text-align: center; margin-top: 20px;">
                Không tìm thấy sản phẩm nào.
            </p>
        @else
        
                @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-lg-2"> <!-- Giảm kích thước cột -->
                        <div class="product-item" style="padding: 10px; margin-bottom: 15px;"> <!-- Giảm padding và margin -->
                            <div class="inner-content">
                                <div class="product-thumb">
                                    <a href="{{ route('product-detail', ['id' => $product->id]) }}">
                                        <img src="{{ Storage::url($product->primary_image_url) }}" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;"> <!-- Giảm chiều cao ảnh -->
                                    </a>
                                    <div class="product-flag">
                                        <ul>
                                            @if ($product->variants->isNotEmpty() && $product->variants->first()->sale_price)
                                                <li class="discount" style="font-size: 12px;">-{{ round((($product->variants->first()->listed_price - $product->variants->first()->sale_price) / $product->variants->first()->listed_price) * 100) }}%</li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="product-action">
                                        <form action="{{ route('wishlist.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn-product-wishlist" style="font-size: 14px;"><i class="fa fa-heart"></i></button>
                                        </form>
                                        <a class="btn-product-cart" href="" style="font-size: 14px;"><i class="fa fa-shopping-cart"></i></a>
                                        <button type="button" class="btn-product-quick-view-open" style="font-size: 14px;">
                                            <i class="fa fa-arrows"></i>
                                        </button>
                                    </div>
                                    <a class="banner-link-overlay" href="{{ route('product-detail', ['id' => $product->id]) }}"></a>
                                </div>
                                <div class="product-info" style="padding: 5px;"> <!-- Giảm padding -->
                                    <h4 class="title" style="font-size: 14px; margin-bottom: 5px;">
                                        <a href="{{ route('product-detail', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                    </h4>
                                    <div class="prices" style="font-size: 14px;">
                                        @if ($product->variants->isNotEmpty())
                                            @php $variant = $product->variants->first(); @endphp
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
                    </div>
                @endforeach
            @endif
        </div>
        

        <!--== Start Cart Area Wrapper ==-->
        
        <!--== End Cart Area Wrapper ==-->
    </main>
@endsection