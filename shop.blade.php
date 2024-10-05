@extends('client.layout')

@section('title', 'sản phẩm')

@section('content')
<main class="main-content">
  <!-- Page Header -->
  <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="page-header-content">
            <h2 class="title">Sản phẩm</h2>
            <nav class="breadcrumb-area">
              <ul class="breadcrumb">
                <li><a href="/">Trang chủ</a></li>
                <li>Sản phẩm</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Product Filter and List -->
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
      <!-- Product Listing -->
      <div class="col-lg-9">
        <div class="row">
            
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
                            <h4 class="title"><a href="single-product.html" name="brand">NIKE</a></h4>
                            <div class="prices">
                              <span class="price-old" name="name">$100</span>
                              <span class="sep">-</span>
                              <span class="price" name="price">$240.00</span>
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
                            <h4 class="title"><a href="single-product.html" name="brand">Adidas</a></h4>
                            <div class="prices">
                              <span class="price" name="price">$140.00</span>
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
                            <h4 class="title"><a href="single-product.html" name="brand">Rexpo Womens shoes</a></h4>
                            <div class="prices">
                              <span class="price-old">$60</span>
                              <span class="sep">-</span>
                              <span class="price" name="price">$260.00</span>
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
                            <h4 class="title"><a href="single-product.html">Hollister V-Neck Knit</a></h4>
                            <div class="prices">
                              <span class="price">$880.00</span>
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
                            <h4 class="title"><a href="single-product.html">Primitive Mens shoes</a></h4>
                            <div class="prices">
                              <span class="price">$500.00</span>
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
                            <h4 class="title"><a href="single-product.html">New Womens High Hills</a></h4>
                            <div class="prices">
                              <span class="price-old">$300</span>
                              <span class="sep">-</span>
                              <span class="price">$333.00</span>
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
                            <h4 class="title"><a href="single-product.html">Simple Fabric Shoe</a></h4>
                            <div class="prices">
                              <span class="price">$133.00</span>
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
                            <h4 class="title"><a href="single-product.html">exclusive mens shoe</a></h4>
                            <div class="prices">
                              <span class="price-old">$300</span>
                              <span class="sep">-</span>
                              <span class="price">$420.00</span>
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
            
               
    </div>
  </div>
</main>
@endsection