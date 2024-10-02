@extends('client.layout')

@section('title', 'Trang chủ')

@section('content')
<main class="main-content">
    <!--== Start Hero Area Wrapper ==-->
    <section class="home-slider-area">
      <div class="swiper-container home-slider-container default-slider-container">
        <div class="swiper-wrapper home-slider-wrapper slider-default">
          <div class="swiper-slide">
            <div class="slider-content-area slider-content-area-two" data-bg-img="assets/img/slider/slider-02.webp">
              <div class="container">
                <div class="slider-container">
                  <div class="row justify-content-between align-items-center">
                    <div class="col-lg-5">
                      <div class="slider-content">
                        <div class="content">
                          <div class="desc-box">
                            <p class="desc">Sale đến  30% </p>
                          </div>
                          <div class="title-box">
                            <h2 class="title"><span class="font-weight-400">Độc Quyền <br> </span>New</h2>
                          </div>
                          <div class="btn-box">
                            <a class="btn-slider" href="shop.html">Mua Ngay</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="slider-content-area slider-content-area-two" data-bg-img="assets/img/slider/slider-04.webp">
              <div class="container">
                <div class="slider-container">
                  <div class="row justify-content-between align-items-center">
                    <div class="col-lg-5">
                      <div class="slider-content">
                        <div class="content">
                          <div class="desc-box">
                            <p class="desc">Up To 30% </p>
                          </div>
                          <div class="title-box">
                            <h2 class="title"><span class="font-weight-400">Exclusive<br> </span>New Shoes</h2>
                          </div>
                          <div class="btn-box">
                            <a class="btn-slider" href="shop.html">Shop Now</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--== Add Swiper Arrows ==-->
        <div class="swiper-btn-wrap">
          <div class="swiper-btn-prev">
            <i class="pe-7s-angle-left"></i>
          </div>
          <div class="swiper-btn-next">
            <i class="pe-7s-angle-right"></i>
          </div>
        </div>
      </div>
    </section>
    <!--== End Hero Area Wrapper ==-->

    <!--== Start Product Category Area Wrapper ==-->
    <section class="product-area product-category-area">
      {{-- <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 col-lg-4">
            <!--== Start Product Category Item ==-->
            <div class="product-category">
              <div class="inner-content">
                <div class="product-category-content">
                  <div class="content">
                    <h4 class="sub-title">Sale 50% </h4>
                    <h3 class="title"><a href="shop.html">Giày thể thao</a></h3>
                  </div>
                </div>
                <div class="product-category-thumb" data-bg-img="assets/img/shop/category/1.webp"></div>
                <a class="banner-link-overlay" href="shop.html"></a>
              </div>
            </div>
            <!--== End Product Category Item ==-->
          </div>
          <div class="col-sm-6 col-lg-4">
            <!--== Start Product Category Item ==-->
            <div class="product-category mt-xs-30">
              <div class="inner-content">
                <div class="product-category-content">
                  <div class="content">
                    <h4 class="sub-title">Sale 50% </h4>
                    <h3 class="title"><a href="shop.html">Giày mới nhập</a></h3>
                  </div>
                </div>
                <div class="product-category-thumb" data-bg-img="assets/img/shop/category/2.webp"></div>
                <a class="banner-link-overlay" href="shop.html"></a>
              </div>
            </div>
            <!--== End Product Category Item ==-->
          </div>
          <div class="col-sm-6 col-lg-4">
            <!--== Start Product Category Item ==-->
            <div class="product-category mt-md-30">
              <div class="inner-content">
                <div class="product-category-content">
                  <div class="content">
                    <h4 class="sub-title">Sale 50% </h4>
                    <h3 class="title"><a href="shop.html">Giày thể thao mới</a></h3>
                  </div>
                </div>
                <div class="product-category-thumb" data-bg-img="assets/img/shop/category/3.webp"></div>
                <a class="banner-link-overlay" href="shop.html"></a>
              </div>
            </div>
            <!--== End Product Category Item ==-->
          </div>
        </div>
      </div> --}}
    </section>
    <!--== End Product Category Area Wrapper ==-->

    <!--== Start Product Area Wrapper ==-->
    <section class="product-area product-default-area product-featured-area">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title text-center">
              <h3 class="title">Sản Phẩm Nổi Bật</h3>
              <div class="desc">
                <p>Khám phá bộ sưu tập giày thể thao hàng đầu của chúng tôi.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="inner-content">
                <div class="product-thumb">
                  <a href="{{route('product-detail')}}">
                    <img src="assets/img/shop/1.webp" width="270" height="274" alt="Image-HasTech">
                  </a>
                  <div class="product-flag">
                    <ul>
                      <li class="discount">-10%</li>
                    </ul>
                  </div>
                  <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                  <a class="banner-link-overlay" href="shop.html"></a>
                </div>
                <div class="product-info">
                  <h4 class="title"><a href="single-product.html">Leather Mens Slipper</a></h4>
                  <div class="prices">
                    <span class="price-old">350.000đ<span>
                    <span class="sep">-</span>
                    <span class="price">200.000đ</span>
                  </div>
                </div>
              </div>
            </div>
            <!--== End prPduct Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="inner-content">
                <div class="product-thumb">
                  <a href="{{route('product-detail')}}">
                    <img src="assets/img/shop/2.webp" width="270" height="274" alt="Image-HasTech">
                  </a>
                  <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                  <a class="banner-link-overlay" href="shop.html"></a>
                </div>
                <div class="product-info">

                 
                  <h4 class="title"><a href="single-product.html">Nike Zoom Vomero 5</a></h4>

                  <div class="prices">
                    <span class="price">350.000đ</span>
                  </div>
                </div>
              </div>
            </div>
            <!--== End prPduct Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="inner-content">
                <div class="product-thumb">
                  <a href="{{route('product-detail')}}">
                    <img src="assets/img/shop/3.webp" width="270" height="274" alt="Image-HasTech">
                  </a>
                  <div class="product-flag">
                    <ul>
                      <li class="discount">-10%</li>
                    </ul>
                  </div>
                  <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                  <a class="banner-link-overlay" href="shop.html"></a>
                </div>
                <div class="product-info">

                 
                  <h4 class="title"><a href="single-product.html">Nike Zoom Vomero 5</a></h4>
                  <div class="prices">
                    <pan class="price-old">350.000đ</pan>
                    <span class="sep">-</span>
                    <span class="price">260.000đ</span>
                  </div>
                </div>
              </div>
            </div>
            <!--== End prPduct Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="inner-content">
                <div class="product-thumb">
                  <a href="single-product.html">
                    <img src="assets/img/shop/4.webp" width="270" height="274" alt="Image-HasTech">
                  </a>
                  <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                  <a class="banner-link-overlay" href="shop.html"></a>
                </div>
                <div class="product-info">

                 
                  <h4 class="title"><a href="single-product.html">Nike Zoom Vomero 5</a></h4>
                  <div class="prices">
                    <span class="price">350.000đ</span>
                  </div>
                </div>
              </div>
            </div>
            <!--== End prPduct Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="inner-content">
                <div class="product-thumb">
                  <a href="single-product.html">
                    <img src="assets/img/shop/5.webp" width="270" height="274" alt="Image-HasTech">
                  </a>
                  <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                  <a class="banner-link-overlay" href="shop.html"></a>
                </div>
                <div class="product-info">
                 
                  <h4 class="title"><a href="single-product.html">Nike Zoom Vomero 5</a></h4>
                  <div class="prices">
                    <span class="price">350.000đ</span>
                  </div>
                </div>
              </div>
            </div>
            <!--== End prPduct Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="inner-content">
                <div class="product-thumb">
                  <a href="single-product.html">
                    <img src="assets/img/shop/6.webp" width="270" height="274" alt="Image-HasTech">
                  </a>
                  <div class="product-flag">
                    <ul>
                      <li class="discount">-10%</li>
                    </ul>
                  </div>
                  <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                  <a class="banner-link-overlay" href="shop.html"></a>
                </div>
                <div class="product-info">

                 
                  <h4 class="title"><a href="single-product.html">Nike Zoom Vomero 5</a></h4>

                  <div class="prices">
                    <span class="price-old">350.000đ<span>
                    <span class="sep">-</span>
                    <span class="price">300.000đ</span>
                  </div>
                </div>
              </div>
            </div>
            <!--== End prPduct Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="inner-content">
                <div class="product-thumb">
                  <a href="single-product.html">
                    <img src="assets/img/shop/7.webp" width="270" height="274" alt="Image-HasTech">
                  </a>
                  <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                  <a class="banner-link-overlay" href="shop.html"></a>
                </div>
                <div class="product-info">

                 
                  <h4 class="title"><a href="single-product.html">Nike Zoom Vomero 5</a></h4>
                  <div class="prices">
                    <span class="price">350.000đ</span>
                  </div>
                </div>
              </div>
            </div>
            <!--== End prPduct Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start Product Item ==-->
            <div class="product-item">
              <div class="inner-content">
                <div class="product-thumb">
                  <a href="single-product.html">
                    <img src="assets/img/shop/8.webp" width="270" height="274" alt="Image-HasTech">
                  </a>
                  <div class="product-flag">
                    <ul>
                      <li class="discount">-10%</li>
                    </ul>
                  </div>
                  <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                  <a class="banner-link-overlay" href="shop.html"></a>
                </div>
                <div class="product-info">

                 
                  <h4 class="title"><a href="single-product.html">Nike Zoom Vomero 5</a></h4>

                  <div class="prices">
                    <span class="price-old">350.000đ<span>
                    <span class="sep">-</span>
                    <span class="price">310.000đ</span>
                  </div>
                </div>
              </div>
            </div>
            <!--== End prPduct Item ==-->
          </div>
        </div>
      </div>
    </section>
    <!--== End Product Area Wrapper ==-->

    <!--== Start Divider Area Wrapper ==-->
    <section class="parallax" data-speed="1.08" data-bg-img="assets/img/photos/bg2.webp">
      <div class="container pt--0 pb--0">
        <div class="row divider-wrap divider-style3">
          <div class="col-lg-6">
            <div class="divider-thumb mousemove">
              <div class="shape-one scene">
                <span class="scene-layer" data-depth=".5">
                  <img src="assets/img/photos/divider1.webp" width="377" height="243" alt="Image-HasTech">
                </span>
              </div>
              <div class="shape-two mousemove-layer" data-speed="1"><img src="assets/img/shape/4.webp" width="532" height="326" alt="Image-HasTech"></div>
              <div class="shape-three"><img src="assets/img/shape/5.webp" width="280" height="339" alt="Image-HasTech"></div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="divider-content">
              <h4 class="sub-title">Tiết Kiệm Đến 50%</h4>
              <h2 class="title">Áp Dụng Cho Tất Cả Các Sản Phẩm </h2>
              {{-- <p class="desc">Áp Dụng Cho Tất Cả Các Sản Phẩm</p> --}}
              <a class="btn-theme" href="shop.html">Mua Ngay</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Divider Area Wrapper ==-->

    <!--== Start Feature Area Wrapper ==-->
    <div class="feature-area">
      <div class="container pb--0">
        <div class="row">
          <div class="col-12">
            <div class="feature-content-box">
              <div class="feature-box-wrap">
                <div class="col-item">
                  <div class="feature-icon-box">
                    <div class="inner-content">
                      <div class="icon-box">
                        <img class="icon-img" src="assets/img/icons/1.webp" width="55" height="41" alt="Icon-HasTech">
                      </div>
                      <div class="content">
                        <h5 class="title">Giao hàng tận nhà miễn phí</h5>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-item">
                  <div class="feature-icon-box">
                    <div class="inner-content">
                      <div class="icon-box">
                        <img class="icon-img" src="assets/img/icons/2.webp" width="35" height="41" alt="Icon-HasTech">
                      </div>
                      <div class="content">
                        <h5 class="title">Thanh toán an toàn</h5>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-item">
                  <div class="feature-icon-box">
                    <div class="inner-content">
                      <div class="icon-box">
                        <img class="icon-img" src="assets/img/icons/3.webp" width="33" height="41" alt="Icon-HasTech">
                      </div>
                      <div class="content">
                        <h5 class="title">Đặt hàng giảm giá</h5>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-item">
                  <div class="feature-icon-box">
                    <div class="inner-content">
                      <div class="icon-box">
                        <img class="icon-img" src="assets/img/icons/4.webp" width="43" height="41" alt="Icon-HasTech">
                      </div>
                      <div class="content">
                        <h5 class="title">Hỗ trợ trực tuyến 24/7</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="shape-group-style1">
                <div class="shape-group-one"><img src="assets/img/shape/6.webp" width="214" height="58" alt="Image-HasTech"></div>
                <div class="shape-group-two"><img src="assets/img/shape/7.webp" width="136" height="88" alt="Image-HasTech"></div>
                <div class="shape-group-three"><img src="assets/img/shape/8.webp" width="108" height="74" alt="Image-HasTech"></div>
                <div class="shape-group-four"><img src="assets/img/shape/9.webp" width="239" height="69" alt="Image-HasTech"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Feature Area Wrapper ==-->

    <!--== Start Product Area Wrapper ==-->
    <section class="product-area product-best-seller-area">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title text-center">
              <h3 class="title">Sản Phẩm Bán Chạy</h3>
              <div class="desc">
                <p>Khám phá những mẫu giày thể thao được yêu thích nhất từ khách hàng.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="product-slider-wrap">
              <div class="swiper-container product-slider-col4-container">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <!--== Start Product Item ==-->
                    <div class="product-item">
                      <div class="inner-content">
                        <div class="product-thumb">
                          <a href="single-product.html">
                            <img src="assets/img/shop/1.webp" width="270" height="274" alt="Image-HasTech">
                          </a>
                          <div class="product-flag">
                            <ul>
                              <li class="discount">-10%</li>
                            </ul>
                          </div>
                          <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                          <a class="banner-link-overlay" href="shop.html"></a>
                        </div>
                        <div class="product-info">

                          <div class="category">
                    <ul>
                      <li><a href="shop.html">Men</a></li>
                              <li class="sep">/</li>
                              <li><a href="shop.html">Nữ</a></li>
                            </ul>
                          </div>
                          <h4 class="title"><a href="single-product.html">Nike Revolution 7 EasyOn</a></h4>

                          <div class="prices">
                            <span class="price-old">450.000đ<span>
                            <span class="sep">-</span>
                            <span class="price">400.000đ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--== End prPduct Item ==-->
                  </div>
                  <div class="swiper-slide">
                    <!--== Start Product Item ==-->
                    <div class="product-item">
                      <div class="inner-content">
                        <div class="product-thumb">
                          <a href="single-product.html">
                            <img src="assets/img/shop/7.webp" width="270" height="274" alt="Image-HasTech">
                          </a>
                          <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                          <a class="banner-link-overlay" href="shop.html"></a>
                        </div>
                        <div class="product-info">

                          <div class="category">
                    <ul>
                      <li><a href="shop.html">Nam</a></li>
                              <li class="sep">/</li>
                              <li><a href="shop.html">Nữ</a></li>
                            </ul>
                          </div>
                          <h4 class="title"><a href="single-product.html">Nike Revolution 7 EasyOn</a></h4>

                          <div class="prices">
                            <span class="price">400.000đ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--== End prPduct Item ==-->
                  </div>
                  <div class="swiper-slide">
                    <!--== Start Product Item ==-->
                    <div class="product-item">
                      <div class="inner-content">
                        <div class="product-thumb">
                          <a href="single-product.html">
                            <img src="assets/img/shop/3.webp" width="270" height="274" alt="Image-HasTech">
                          </a>
                          <div class="product-flag">
                            <ul>
                              <li class="discount">-10%</li>
                            </ul>
                          </div>
                          <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                          <a class="banner-link-overlay" href="shop.html"></a>
                        </div>
                        <div class="product-info">

                          <div class="category">
                    <ul>
                      <li><a href="shop.html">Nam</a></li>
                              <li class="sep">/</li>
                              <li><a href="shop.html">Nữ</a></li>
                            </ul>
                          </div>
                          <h4 class="title"><a href="single-product.html">Nike Revolution 7 EasyOn</a></h4>

                          <div class="prices">
                            <span class="price-old">450.000đ<span>
                            <span class="sep">-</span>
                            <span class="price">350.000đ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--== End prPduct Item ==-->
                  </div>
                  <div class="swiper-slide">
                    <!--== Start Product Item ==-->
                    <div class="product-item">
                      <div class="inner-content">
                        <div class="product-thumb">
                          <a href="single-product.html">
                            <img src="assets/img/shop/4.webp" width="270" height="274" alt="Image-HasTech">
                          </a>
                          <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                          <a class="banner-link-overlay" href="shop.html"></a>
                        </div>
                        <div class="product-info">

                          <div class="category">
                    <ul>
                      <li><a href="shop.html">Nam</a></li>
                              <li class="sep">/</li>
                              <li><a href="shop.html">Nữ</a></li>
                            </ul>
                          </div>
                          <h4 class="title"><a href="single-product.html">Nike Revolution 7 EasyOn</a></h4>

                          <div class="prices">
                            <span class="price">450.000đ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--== End prPduct Item ==-->
                  </div>
                  <div class="swiper-slide">
                    <!--== Start Product Item ==-->
                    <div class="product-item">
                      <div class="inner-content">
                        <div class="product-thumb">
                          <a href="single-product.html">
                            <img src="assets/img/shop/5.webp" width="270" height="274" alt="Image-HasTech">
                          </a>
                          <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                          <a class="banner-link-overlay" href="shop.html"></a>
                        </div>
                        <div class="product-info">

                          <div class="category">
                    <ul>
                      <li><a href="shop.html">Nam</a></li>
                              <li class="sep">/</li>
                              <li><a href="shop.html">Nữ</a></li>
                            </ul>
                          </div>
                          <h4 class="title"><a href="single-product.html">Nike Revolution 7 EasyOn</a></h4>

                          <div class="prices">
                            <pan class="price-old">450.000đ</pan>
                            <span class="sep">-</span>
                            <span class="price">250.000đ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--== End prPduct Item ==-->
                  </div>
                  <div class="swiper-slide">
                    <!--== Start Product Item ==-->
                    <div class="product-item">
                      <div class="inner-content">
                        <div class="product-thumb">
                          <a href="single-product.html">
                            <img src="assets/img/shop/6.webp" width="270" height="274" alt="Image-HasTech">
                          </a>
                          <div class="product-flag">
                            <ul>
                              <li class="discount">-10%</li>
                            </ul>
                          </div>
                          <div class="product-action">
                    <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <button type="button" class="btn-product-quick-view-open">
                      <i class="fa fa-arrows"></i>
                    </button>
                    {{-- <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a> --}}
                  </div>
                          <a class="banner-link-overlay" href="shop.html"></a>
                        </div>
                        <div class="product-info">

                          <div class="category">
                    <ul>
                      <li><a href="shop.html">Nam</a></li>
                              <li class="sep">/</li>
                              <li><a href="shop.html">Nữ</a></li>
                            </ul>
                          </div>
                          <h4 class="title"><a href="single-product.html">Nike Revolution 7 EasyOn</a></h4>

                          <div class="prices">
                            <span class="price-old">450.000đ<span>
                            <span class="sep">-</span>
                            <span class="price">350.000đ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--== End prPduct Item ==-->
                  </div>
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

    <!--== Start Product Collection Area Wrapper ==-->
    {{-- <section class="product-area product-collection-area">
      <div class="container pt--0">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <!--== Start Product Collection Item ==-->
            <div class="product-collection">
              <div class="inner-content">
                <div class="product-collection-content">
                  <div class="content">
                    <h3 class="title"><a href="shop.html">Giày thể thao</a></h3>
                    <h4 class="price">Chỉ từ 350.000đ</h4>
                  </div>
                </div>
                <div class="product-collection-thumb" data-bg-img="assets/img/shop/collection/1.webp"></div>
                <a class="banner-link-overlay" href="shop.html"></a>
              </div>
            </div>
            <!--== End Product Collection Item ==-->
          </div>
          <div class="col-lg-4 col-md-6">
            <!--== Start Product Collection Item ==-->
            <div class="product-collection">
              <div class="inner-content">
                <div class="product-collection-content">
                  <div class="content">
                    <h3 class="title"><a href="shop.html">Giày mới nhất</a></h3>
                    <h4 class="price">Chỉ từ  300.000đ</h4>
                  </div>
                </div>
                <div class="product-collection-thumb" data-bg-img="assets/img/shop/collection/2.webp"></div>
                <a class="banner-link-overlay" href="shop.html"></a>
              </div>
            </div>
            <!--== End Product Collection Item ==-->
          </div>
          <div class="col-lg-4 col-md-6">
            <!--== Start Product Collection Item ==-->
            <div class="product-collection">
              <div class="inner-content">
                <div class="product-collection-content">
                  <div class="content">
                    <h3 class="title"><a href="shop.html">Sản Phẩm Ưu Thích</a></h3>
                    <h4 class="price">Chỉ từ 350.000đ</h4>
                  </div>
                </div>
                <div class="product-collection-thumb" data-bg-img="assets/img/shop/collection/3.webp"></div>
                <a class="banner-link-overlay" href="shop.html"></a>
              </div>
            </div>
            <!--== End Product Collection Item ==-->
          </div>
        </div>
      </div>
    </section> --}}
    <!--== End Product Collection Area Wrapper ==-->

    <!--== Start Testimonial Area Wrapper ==-->
    {{-- <section class="testimonial-area">
      <div class="container pt--0">
        <div class="row">
          <div class="col-12">
            <div class="section-title text-center">
              <h3 class="title">Đánh Giá Khách Hàng</h3>
              <div class="desc">
                <p>Khách hàng của chúng tôi luôn hài lòng với sản phẩm giày thể thao chất lượng và dịch vụ tận tâm.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="swiper-container testimonial-slider-container">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <!--== Start Testimonial Item ==-->
                  <div class="testimonial-item">
                    <div class="testi-inner-content">
                      <div class="testi-thumb">
                        <img src="assets/img/testimonial/1.webp" width="90" height="90" alt="Image-HasTech">
                      </div>
                      <div class="testi-content">
                        <p>Giày rất tốt không có gì để chê</p>
                        <div class="testi-author">
                          <div class="testi-info">
                            <span class="name"><a href="about-us.html">Thiết </a></span>
                          </div>
                        </div>
                        <div class="testi-quote"><img src="assets/img/icons/quote1.webp" width="62" height="44" alt="Image-HasTech"></div>
                      </div>
                    </div>
                  </div>
                  <!--== End Testimonial Item ==-->
                </div>
                <div class="swiper-slide">
                  <!--== Start Testimonial Item ==-->
                  <div class="testimonial-item">
                    <div class="testi-inner-content">
                      <div class="testi-thumb">
                        <img src="assets/img/testimonial/2.webp" width="90" height="90" alt="Image-HasTech">
                      </div>
                      <div class="testi-content">
                        <p>Giày tốt khỏi bàn , xứng đáng cho 5 sao .</p>
                        <div class="testi-author">
                          <div class="testi-info">
                            <span class="name"><a href="about-us.html">Anh Thanh</a></span>
                          </div>
                        </div>
                        <div class="testi-quote"><img src="assets/img/icons/quote1.webp" width="62" height="44" alt="Image-HasTech"></div>
                      </div>
                    </div>
                  </div>
                  <!--== End Testimonial Item ==-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    <!--== End Testimonial Area Wrapper ==-->
  </main>
@endsection