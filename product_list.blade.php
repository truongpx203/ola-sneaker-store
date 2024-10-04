@extends('client.layout')

@section('title', 'Sản phẩm')

@section('content')
<main class="main-content">
  <!--== Start Page Header Area Wrapper ==-->
  <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
    <div class="container pt--0 pb--0">
      <div class="row">
        <div class="col-12">
          <div class="page-header-content">
            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Sản phẩm</h2>
            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
              <ul class="breadcrumb">
                <li><a href="index.html">Trang chủ</a></li>
                <li class="breadcrumb-sep">//</li>
                <li>Sản Phẩm</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--== End Page Header Area Wrapper ==-->
  <div class="container">
    <div class="row">
      <!-- Filter Sidebar -->
      <div class="col-lg-3">
        <div class="filter-widget">
          <form method="GET" action="{{ route('product-list') }}">
          <!-- Filter by Category -->
          <div class="filter-group">
            <h4 style="border-bottom: 2px solid #000;">Danh mục</h4>
            <br>
            {{-- <ul style="border-bottom: 2px solid #000;">
              <li><input type="checkbox" name="category[]"value="Man"> Giày Nam</li>
              <li><input type="checkbox" name="category[]" value="women"> Giày Nữ</li>
            </ul> --}}
          </div>

          <!-- Filter by Price -->
          <div class="filter-group">
            <h4>Giá</h4>
            <ul style="border-bottom: 2px solid #000;">
              <li><input type="radio" name="price" value="150"> 0 - 150 USD</li>
              <li><input type="radio" name="price" value="300"> 150 - 300 USD</li>
              <li><input type="radio" name="price" value="500"> 300 - 500 USD</li>
            </ul>
          </div>

          <!-- Filter by Brand -->
          <div class="filter-group">
            <h4>Thương hiệu</h4>
            <ul>
              <li><input type="checkbox" name="brand[]" value="NIKE"> NIKE</li>
              <li><input type="checkbox" name="brand[]" value="Adidas"> Adidas</li>
              <li><input type="checkbox" name="brand[]" value="Puma"> Puma</li>
              <li><input type="checkbox" name="brand[]" value="Mlb"> Mlb</li>
              <li><input type="checkbox" name="brand[]" value="Vans"> Vans</li>
              <li><input type="checkbox" name="brand[]" value="Li-Ning">Li-Ning</li>
            </ul>
          </div>

          <!-- Filter Button -->
          <button type="submit" style="background-color: #eb3e32; color: white;border-radius: 25px;">Tìm kiếm</button>
        </form>
        </div>
      </div>
  <!--== Start Contact Area Wrapper ==-->
  <div class="col-lg-9">
    <div class="row">
        @if($products->count())
            @foreach($products as $product)
                <div class="col-sm-6 col-lg-3">
                    <!--== Start Product Item ==-->
                    <div class="product-item">
                        <div class="inner-content">
                            <div class="product-thumb">                                
                                <a href="{{ route('product-detail', $product->id) }}">
                                    <img src="{{ asset($product->name) }}" alt="{{ $product->name }}">

                                </a>
                                <div class="product-action">
                                    <a class="btn-product-wishlist" href="#"><i class="fa fa-heart"></i></a>
                                    <a class="btn-product-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="product-info">
                                <h4 class="title"><a href="{{ route('product-detail', $product->id) }}">{{ $product->brand }}</a></h4>
                                <div class="prices">
                                    <span class="price">${{ $product->price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--== End Product Item ==-->
                </div>
            @endforeach
        @else
            <p>Không có sản phẩm nào được tìm thấy.</p>
        @endif
    </div>
  
    
  </div>
@endsection

 

