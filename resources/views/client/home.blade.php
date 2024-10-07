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
                            {{-- <p class="desc">Up To 30% Off</p> --}}
                          </div>
                          <div class="title-box">
                            <h2 class="title"><span class="font-weight-600">Phong cách mới, đẳng cấp mới</span></h2>
                            <h4 class="font-weight-400 text-white mb-4">Thiết kế đột phá cho bước đi tự tin</h4>
                          </div>
                          <div class="btn-box">
                            <a class="btn-slider" href="shop.html">Xem ngay</a>
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
                            <p class="desc">Up To 30% Off</p>
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
                    <h4 class="sub-title">Sale 50% Off</h4>
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
                    <h4 class="sub-title">Sale 50% Off</h4>
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
                    <h4 class="sub-title">Sale 50% Off</h4>
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
              <h3 class="title">Sản Phẩm Mới nhất</h3>
              <div class="desc">
                <p>Khám phá bộ sưu tập giày thể thao hàng đầu của chúng tôi.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($products as $product)
          <div class="col-sm-6 col-lg-3">
              <!--== Start Product Item ==-->
              <div class="product-item">
                  <div class="inner-content">
                      <div class="product-thumb">
                          <a href="{{ route('product-detail', ['id' => $product->id]) }}">
                              <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" style="height: 271px; object-fit: cover">
                          </a>
                          <div class="product-flag">
                              <ul>
                                  @if ($product->variants->isNotEmpty() && $product->variants->first()->sale_price)
                                      <li class="discount">-{{ round((($product->variants->first()->listed_price - $product->variants->first()->sale_price) / $product->variants->first()->listed_price) * 100) }}%</li>
                                  @endif
                              </ul>
                          </div>
                          <div class="product-action">
                              <a class="btn-product-wishlist" href=""><i class="fa fa-heart"></i></a>
                              <a class="btn-product-cart" href=""><i class="fa fa-shopping-cart"></i></a>
                              <button type="button" class="btn-product-quick-view-open">
                                  <i class="fa fa-arrows"></i>
                              </button>
                          </div>
                          <a class="banner-link-overlay" href="{{ route('product-detail', ['id' => $product->id]) }}"></a>
                      </div>
                      <div class="product-info">
                          <h4 class="title"><a href="{{ route('product-detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h4>
                          <div class="prices">
                            @if ($product->variants->isNotEmpty())
                                @php
                                    $variant = $product->variants->first();
                                @endphp
                                @if ($variant->sale_price)
                                    <span class="price-old">{{ number_format($variant->listed_price) }} VNĐ</span>
                                    <span class="sep">-</span>
                                    <span class="price">{{ number_format($variant->sale_price) }} VNĐ</span>
                                @else
                                    <span class="price">{{ number_format($variant->listed_price) }} VNĐ</span>
                                @endif
                            @else
                                <span class="price">{{ number_format($product->listed_price) }} VNĐ</span>
                            @endif
                        </div>
                      </div>
                  </div>
              </div>
              <!--== End Product Item ==-->
          </div>
          @endforeach

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
              {{-- <h4 class="sub-title">Saving 50%</h4> --}}
              <h2 class="title">Cảm nhận sự khác biệt</h2>
              <p class="desc">Giày thể thao thời trang cho phong cách sống năng động</p>
              <a class="btn-theme" href="shop.html">Xem ngay</a>
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
    {{-- <section class="product-area product-best-seller-area">
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
                   </div>
                          <a class="banner-link-overlay" href="shop.html"></a>
                        </div>
                        <div class="product-info">
                          <h4 class="title"><a href="single-product.html">Modern Smart Shoes</a></h4>
                          <div class="prices">
                            <span class="price-old">$200</span>
                            <span class="sep">-</span>
                            <span class="price">$240.00</span>
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
    </section> --}}
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
                    <h4 class="price">Chỉ từ 350.000</h4>
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
                    <h4 class="price">From $90.00</h4>
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
                    <h3 class="title"><a href="shop.html">Office Shoes</a></h3>
                    <h4 class="price">From $82.00</h4>
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
                        <p>Lorem ipsum dolor sit amel adipiscing elit, sed do eiusll tempor incididunt ut laborj et dolore magna.</p>
                        <div class="testi-author">
                          <div class="testi-info">
                            <span class="name"><a href="about-us.html">Jaren Hammer</a></span>
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
                        <p>Lorem ipsum dolor sit amel adipiscing elit, sed do eiusll tempor incididunt ut laborj et dolore magna.</p>
                        <div class="testi-author">
                          <div class="testi-info">
                            <span class="name"><a href="about-us.html">Dorian Cordova</a></span>
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