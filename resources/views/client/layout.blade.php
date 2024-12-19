<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from template.hasthemes.com/shome/shome/index-two.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 14 Jul 2024 15:33:23 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Shome - Shoes eCommerce Website Template"/>
    <meta name="keywords" content="footwear, shoes, modern, shop, store, ecommerce, responsive, e-commerce"/>
    <meta name="author" content="codecarnival"/>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield('title')</title>

    <!--== Favicon ==-->
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}" type="image/x-icon" />

    <!--== Google Fonts ==-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400;1,500&amp;display=swap" rel="stylesheet">

    <!--== Bootstrap CSS ==-->
    <link href="{{asset('assets\css\bootstrap.min.css')}}" rel="stylesheet" />
    <!--== Font Awesome Min Icon CSS ==-->
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!--== Pe7 Stroke Icon CSS ==-->
    <link href="{{asset('assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <!--== Swiper CSS ==-->
    <link href="{{asset('assets/css/swiper.min.css')}}" rel="stylesheet" />
    <!--== Fancybox Min CSS ==-->
    <link href="{{asset('assets/css/fancybox.min.css')}}" rel="stylesheet" />
    <!--== Aos Min CSS ==-->
    <link href="{{asset('assets/css/aos.min.css')}}" rel="stylesheet" />

    <!--== Main Style CSS ==-->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{-- @vite(['resources/js/app.js']) --}}


</head>

<body>

<!--wrapper start-->
<div class="wrapper">

  <!--== Start Header Wrapper ==-->
  <header class="main-header-wrapper position-relative">
    <div class="header-top">
      <div class="container pt--0 pb--0">
        <div class="row">
          <div class="col-12">
            <div class="header-top-align">
              <div class="header-top-align-start">
                <div class="desc">
                  <p>Đổi trả và giao hàng miễn phí.</p>
                </div>
              </div>
              <div class="header-top-align-end">
                <div class="header-info-items">
                  <div class="info-items">
                    <ul>
                      <li class="number"><i class="fa fa-phone"></i><a href="tel://0123456789">0328902188</a></li>
                      <li class="email"><i class="fa fa-envelope"></i><a href="mailto://datn@gmail.com">datn@gmail.com</a></li>
                      <li class="account">
                        <i class="fa fa-user"></i>
                        @if (Auth::check())
                        <a href="{{ route('account') }}">{{ Auth::user()->full_name }}</a>
                        @else
                            <a href="{{ route('login') }}">Tài khoản</a>
                        @endif
                    </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-middle">
      <div class="container pt--0 pb--0">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="header-middle-align">
              <div class="header-middle-align-start">
                <div class="header-logo-area">
                  <a href="{{route('/')}}">
                    <img class="logo-main" src="{{asset('assets/img/OLASNEAKER.png')}}" width="200" style="" alt="Logo" />
                    {{-- <img class="logo-light" src="{{asset('assets/img/logo-light.webp')}}" width="131" height="34" alt="Logo" /> --}}
                  </a>
                </div>
              </div>
              <div class="header-middle-align-center">
                <div class="header-search-area">
                    <form class="header-searchbox" method="GET" action="{{ route('search') }}">
                        <input type="search" name="name" class="form-control" placeholder="Tìm kiếm">
                        <button class="btn-submit" type="submit"><i class="pe-7s-search"></i></button>
                    </form>
                </div>
            </div>
              <div class="header-middle-align-end">
                <div class="header-action-area">
                  <div class="shopping-search">
                    <button class="shopping-search-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasSearch" aria-controls="AsideOffcanvasSearch"><i class="pe-7s-search icon"></i></button>
                  </div>
                  <div class="shopping-wishlist">
                    <a class="shopping-wishlist-btn" href="{{ route('wishlist.index') }}">
                      <i class="pe-7s-like icon"></i>
                    </a>
                  </div>
                  <div class="shopping-cart">
                    <a class="shopping-cart-btn" href="{{route('cart.show')}}">
                    <button class="shopping-cart-btn" type="button">
                      <i class="pe-7s-shopbag icon"></i>
                      {{-- <sup class="shop-count"></sup> --}}
                    </button></a>
                  </div>
                  <button class="btn-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasMenu" aria-controls="AsideOffcanvasMenu">
                    <i class="pe-7s-menu"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-area header-default">
      <div class="container">
        <div class="row no-gutter align-items-center position-relative">
          <div class="col-12">
            <div class="header-align">
              <div class="header-navigation-area position-relative">
                <ul class="main-menu nav">
                    <li><a href="{{route('/')}}"><span>TRANG CHỦ</span></a></li>
                  {{-- <li class="has-submenu"><a href="#/"><span>Home</span></a>
                    <ul class="submenu-nav">
                      <li><a href="index.html"><span>Home One</span></a></li>
                      <li><a href="index-two.html"><span>Home Two</span></a></li>
                    </ul>
                  </li> --}}
                  {{-- <li><a href="#"><span>GIỚI THIỆU</span></a></li> --}}
                  <li><a href="{{route('shop.filter')}}"><span>SẢN PHẨM</span></a></li>
                  {{-- <li><a href="{{route('/blog')}}"><span>Blog</span></a></li> --}}
                  <li><a href="{{route('contact.form')}}"><span>LIÊN HỆ</span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!--== End Header Wrapper ==-->
  <article>
    <div class="row" id="productContainer"></div>

  <script>
      document.getElementById('searchForm').addEventListener('submit', function(e) {
          e.preventDefault(); // Ngăn chặn reload trang

          const query = document.getElementById('searchInput').value;
          const productContainer = document.getElementById('productContainer');

          // Xóa nội dung cũ
          productContainer.innerHTML = '';

          // Gửi yêu cầu AJAX
          fetch(`/api/search?name=${encodeURIComponent(query)}`)
              .then(response => response.json())
              .then(products => {
                  if (products.length > 0) {
                      // Nếu có sản phẩm, hiển thị chúng
                      products.forEach(product => {
                          const productElement = document.createElement('div');
                          productElement.classList.add('col-sm-6', 'col-lg-3');
                          productElement.innerHTML = `
                              <div class="product-item">
                                  <div class="inner-content">
                                      <div class="product-thumb">
                                          <a href="/product-detail/${product.id}">
                                              <img src="${product.primary_image_url}" alt="${product.name}" style="height: 271px; object-fit: cover">
                                          </a>
                                      </div>
                                      <div class="product-info">
                                          <h4 class="title"><a href="/product-detail/${product.id}">${product.name}</a></h4>
                                          <div class="prices">
                                              ${product.variants.length > 0 && product.variants[0].sale_price
                                                  ? `<span class="price-old">${new Intl.NumberFormat().format(product.variants[0].listed_price)} đ</span> -
                                                     <span class="price">${new Intl.NumberFormat().format(product.variants[0].sale_price)} đ</span>`
                                                  : `<span class="price">${new Intl.NumberFormat().format(product.listed_price)} đ</span>`
                                              }
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          `;
                          productContainer.appendChild(productElement);
                      });
                  } else {
                      // Nếu không có sản phẩm, hiển thị thông báo
                      productContainer.innerHTML = '<p>Không tìm thấy sản phẩm nào.</p>';
                  }
              })
              .catch(error => {
                  console.error('Lỗi khi tìm kiếm:', error);
                  productContainer.innerHTML = '<p>Có lỗi xảy ra khi tìm kiếm sản phẩm.</p>';
              });
      });
  </script>
   @yield('scriptsToastr')

    @yield('content')
  </article>
  <!--== Start Footer Area Wrapper ==-->
  <footer class="footer-area">
    <!--== Start Footer Main ==-->
    <div class="footer-main">
      <div class="container pt--0 pb--0">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <!--== Start widget Item ==-->
            <div class="widget-item">
              <div class="about-widget-wrap">
                <div class="widget-logo-area">
                  <a href="index.html">
                    <img class="logo-main" src="{{asset('assets/img/logo-light.webp')}}" width="131" height="34" alt="Logo" />
                  </a>
                </div>
                <p class="desc">Khám phá bộ sưu tập giày thể thao đa dạng, phong cách và chất lượng. Mang đến sự thoải mái và tự tin cho từng bước đi của bạn.
                  </p>
                <div class="social-icons">
                  <a href="https://www.facebook.com/" target="_blank" rel="noopener"><i class="fa fa-facebook"></i></a>
                  <a href="https://dribbble.com/" target="_blank" rel="noopener"><i class="fa fa-dribbble"></i></a>
                  <a href="https://www.pinterest.com/" target="_blank" rel="noopener"><i class="fa fa-pinterest-p"></i></a>
                  <a href="https://twitter.com/" target="_blank" rel="noopener"><i class="fa fa-twitter"></i></a>
                </div>
              </div>
            </div>
            <!--== End widget Item ==-->
          </div>
          <div class="col-md-6 col-lg-3">
            <!--== Start widget Item ==-->
            <div class="widget-item widget-services-item">
              <h4 class="widget-title">Dịch vụ</h4>
              <h4 class="widget-collapsed-title collapsed" data-bs-toggle="collapse" data-bs-target="#widgetId-1">Services</h4>
              <div id="widgetId-1" class="collapse widget-collapse-body">
                <div class="collapse-body">
                  <div class="widget-menu-wrap">
                    <ul class="nav-menu">
                      <li><p>Tư vấn giày thể thao</p></li>
                      <li><p>Giao hàng tận nơi</p></li>
                      <li><p>Đổi trả dễ dàng</p></li>
                      <li><p>Hỗ trợ khách hàng</p></li>
                      <li><p>Chương trình khuyến mãi</p></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!--== End widget Item ==-->
          </div>
          <div class="col-md-6 col-lg-3">
            <!--== Start widget Item ==-->
            <div class="widget-item widget-account-item">
              <h4 class="widget-title">Tài khoản</h4>
              <h4 class="widget-collapsed-title collapsed" data-bs-toggle="collapse" data-bs-target="#widgetId-2">My Account</h4>
              <div id="widgetId-2" class="collapse widget-collapse-body">
                <div class="collapse-body">
                  <div class="widget-menu-wrap">
                    <ul class="nav-menu">
                      <li><a href="{{route('account')}}">Tài khoản của tôi</a></li>
                      <li><a href="{{route('contact.form')}}">Liên hệ</a></li>
                      <li><a href="{{route('cart.show')}}">Giỏ hàng</a></li>
                      {{-- <li><a href="shop.html">Cửa hàng</a></li> --}}
                      {{-- <li><a href="account-login.html">Services Login</a></li> --}}
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!--== End widget Item ==-->
          </div>
          <div class="col-md-6 col-lg-3">
            <!--== Start widget Item ==-->
            <div class="widget-item">
              <h4 class="widget-title">Thông tin liên hệ</h4>
              <h4 class="widget-collapsed-title collapsed" data-bs-toggle="collapse" data-bs-target="#widgetId-3">Contact Info</h4>
              <div id="widgetId-3" class="collapse widget-collapse-body">
                <div class="collapse-body">
                  <div class="widget-contact-wrap">
                    <ul>
                      <li><span>Địa chỉ: </span>Nam Từ Liêm - Hà Nội.</li>
                      <li><span>Điện thoại:</span> <a href="tel://0123456789">0328902188</a></li>
                      <li><span>Email:</span> <a href="mailto://demo@example.com">datn@gmail.com</a></li>
                      <li><a target="_blank" href="https://www.hasthemes.com/">OlaSneaker.vn</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!--== End widget Item ==-->
          </div>
        </div>
      </div>
    </div>
    <!--== End Footer Main ==-->

    <!--== Start Footer Bottom ==-->
    {{-- <div class="footer-bottom">
      <div class="container pt--0 pb--0">
        <div class="row">
          <div class="col-md-7 col-lg-6">
            <p class="copyright">© 2021 Shome. Made with <i class="fa fa-heart"></i> by <a target="_blank" href="https://themeforest.net/user/codecarnival/portfolio">Codecarnival.</a></p>
          </div>
          <div class="col-md-5 col-lg-6">
            <div class="payment">
              <a href="account-login.html"><img src="assets/img/photos/payment-card.webp" width="192" height="21" alt="Payment Logo"></a>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    <!--== End Footer Bottom ==-->
  </footer>
  <!--== End Footer Area Wrapper ==-->

  <!--== Scroll Top Button ==-->
  <div id="scroll-to-top" class="scroll-to-top"><span class="fa fa-angle-up"></span></div>

  <!--== Start Quick View Menu ==-->
  <aside class="product-quick-view-modal">
    <div class="product-quick-view-inner">
      <div class="product-quick-view-content">
        <button type="button" class="btn-close">
          <span class="close-icon"><i class="fa fa-close"></i></span>
        </button>
        <div class="row align-items-center">
          <div class="col-lg-6 col-md-6 col-12">
            <div class="thumb">
              <img src="assets/img/shop/product-single/1.webp" width="570" height="541" alt="Alan-Shop">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-12">
            <div class="content">
              <h4 class="title">Space X Bag For Office</h4>
              <div class="prices">
                <del class="price-old">$85.00</del>
                <span class="price">$70.00</span>
              </div>
              <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
              <div class="quick-view-select">
                <div class="quick-view-select-item">
                  <label for="forSize" class="form-label">Size:</label>
                  <select class="form-select" id="forSize" required>
                    <option selected value="">40</option>
                    <option>41</option>
                    <option>42</option>
                    <option>43</option>
                  </select>
                </div>
              </div>
              <div class="action-top">
                <div class="pro-qty">
                  <input type="text" id="quantity20" title="Quantity" value="1" />
                </div>
                <button class="btn btn-black">Thêm vào giỏ hàng</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="canvas-overlay"></div>
  </aside>
  <!--== End Quick View Menu ==-->

  <!--== Start Aside Cart Menu ==-->
  <div class="aside-cart-wrapper offcanvas offcanvas-end" tabindex="-1" id="AsideOffcanvasCart" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h1 id="offcanvasRightLabel"></h1>
      <button class="btn-aside-cart-close" data-bs-dismiss="offcanvas" aria-label="Close">Giỏ hàng <i class="fa fa-chevron-right"></i></button>
    </div>
    <div class="offcanvas-body">
      <ul class="aside-cart-product-list">
        <li class="product-list-item">
          <a href="#/" class="remove">×</a>
          <a href="single-product.html">
            <img src="assets/img/shop/product-mini/1.webp" width="90" height="110" alt="Image-HasTech">
            <span class="product-title">Leather Mens Slipper</span>
          </a>
          <span class="product-price">1 × £69.99</span>
        </li>
        <li class="product-list-item">
          <a href="#/" class="remove">×</a>
          <a href="single-product.html">
            <img src="assets/img/shop/product-mini/2.webp" width="90" height="110" alt="Image-HasTech">
            <span class="product-title">Quickiin Mens shoes</span>
          </a>
          <span class="product-price">1 × £20.00</span>
        </li>
      </ul>
      <p class="cart-total"><span>Tổng cộng:</span><span class="amount">£89.99</span></p>
      <a class="btn-theme" data-margin-bottom="10" href="shop-cart.html">Xem giỏ hàng</a>
      <a class="btn-theme" href="shop-checkout.html">Thanh toán</a>
      <a class="d-block text-end lh-1" href="shop-checkout.html"><img src="assets/img/photos/paypal.webp" width="133" height="26" alt="Has-image"></a>
    </div>
  </div>
  <!--== End Aside Cart Menu ==-->

  <!--== Start Aside Search Menu ==-->
  <aside class="aside-search-box-wrapper offcanvas offcanvas-top" tabindex="-1" id="AsideOffcanvasSearch" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
      <h5 class="d-none" id="offcanvasTopLabel">Aside Search</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="pe-7s-close"></i></button>
    </div>
    <div class="offcanvas-body">
      <div class="container pt--0 pb--0">
        <div class="search-box-form-wrap">
          <div class="search-note">
            <p>Start typing and press Enter to search</p>
          </div>
          <form action="#" method="post">
            <div class="search-form position-relative">
              <label for="search-input" class="visually-hidden">Search</label>
              <input id="search-input" type="search" class="form-control" placeholder="Search entire store…">
              <button class="search-button"><i class="fa fa-search"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </aside>
  <!--== End Aside Search Menu ==-->
  <!--== Start Side Menu ==-->
  <div class="off-canvas-wrapper offcanvas offcanvas-start" tabindex="-1" id="AsideOffcanvasMenu" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h1 id="offcanvasExampleLabel"></h1>
      <button class="btn-menu-close" data-bs-dismiss="offcanvas" aria-label="Close">menu <i class="fa fa-chevron-left"></i></button>
    </div>
    <div class="offcanvas-body">
      <div class="info-items">
        <ul>
          <li class="number"><a href="tel://0123456789"><i class="fa fa-phone"></i>+00 123 456 789</a></li>
          <li class="email"><a href="mailto://demo@example.com"><i class="fa fa-envelope"></i>demo@example.com</a></li>
          <li class="account"><a href="account-login.html"><i class="fa fa-user"></i>Account</a></li>
        </ul>
      </div>
      <!-- Mobile Menu Start -->
      <div class="mobile-menu-items">
        <ul class="nav-menu">
          <li><a href="#">Home</a>
            <ul class="sub-menu">
              <li><a href="index.html">Home One</a></li>
              <li><a href="index-two.html">Home Two</a></li>
            </ul>
          </li>
          <li><a href="about-us.html">About</a></li>
          <li><a href="#">Pages</a>
            <ul class="sub-menu">
              <li><a href="account.html">Account</a></li>
              <li><a href="account-login.html">Login</a></li>
              <li><a href="account-register.html">Register</a></li>
              <li><a href="page-not-found.html">Page Not Found</a></li>
            </ul>
          </li>
          <li><a href="#">Shop</a>
            <ul class="sub-menu">
              <li><a href="#">Shop Layout</a>
                <ul class="sub-menu">
                  <li><a href="shop-three-columns.html">Shop 3 Column</a></li>
                  <li><a href="shop-four-columns.html">Shop 4 Column</a></li>
                  <li><a href="shop.html">Shop Left Sidebar</a></li>
                  <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                </ul>
              </li>
              <li><a href="#">Single Product</a>
                <ul class="sub-menu">
                  <li><a href="single-normal-product.html">Single Product Normal</a></li>
                  <li><a href="single-product.html">Single Product Variable</a></li>
                  <li><a href="single-group-product.html">Single Product Group</a></li>
                  <li><a href="single-affiliate-product.html">Single Product Affiliate</a></li>
                </ul>
              </li>
              <li><a href="#">Others Pages</a>
                <ul class="sub-menu">
                  <li><a href="shop-cart.html">Shopping Cart</a></li>
                  <li><a href="shop-checkout.html">Checkout</a></li>
                  <li><a href="shop-wishlist.html">Wishlist</a></li>
                  <li><a href="shop-compare.html">Compare</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#">Blog</a>
            <ul class="sub-menu">
              <li><a href="#">Blog Layout</a>
                <ul class="sub-menu">
                  <li><a href="blog.html">Blog Grid</a></li>
                  <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                  <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                </ul>
              </li>
              <li><a href="#">Single Blog</a>
                <ul class="sub-menu">
                  <li><a href="blog-details-no-sidebar.html">Blog Details</a></li>
                  <li><a href="blog-details-left-sidebar.html">Blog Details Left Sidebar</a></li>
                  <li><a href="blog-details.html">Blog Details Right Sidebar</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </div>
      <!-- Mobile Menu End -->
    </div>
  </div>
  <!--== End Side Menu ==-->
</div>

<!--=======================Javascript============================-->

<!--=== jQuery Modernizr Min Js ===-->
<script src="{{asset('assets/js/modernizr.js')}}"></script>
<!--=== jQuery Min Js ===-->
<script src="{{asset('assets/js/jquery-main.js')}}"></script>
<!--=== jQuery Migration Min Js ===-->
<script src="{{asset('assets/js/jquery-migrate.js')}}"></script>
<!--=== jQuery Popper Min Js ===-->
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<!--=== jQuery Bootstrap Min Js ===-->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!--=== jQuery Ui Min Js ===-->
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<!--=== jQuery Swiper Min Js ===-->
<script src="{{asset('assets/js/swiper.min.js')}}"></script>
<!--=== jQuery Fancybox Min Js ===-->
<script src="{{asset('assets/js/fancybox.min.js')}}"></script>
<!--=== jQuery Waypoint Js ===-->
<script src="{{asset('assets/js/waypoint.js')}}"></script>
<!--=== jQuery Parallax Min Js ===-->
<script src="{{asset('assets/js/parallax.min.js')}}"></script>
<!--=== jQuery Aos Min Js ===-->
<script src="{{asset('assets/js/aos.min.js')}}"></script>

<!--=== jQuery Custom Js ===-->
<script src="{{asset('assets/js/custom.js')}}"></script>

</body>


<!-- Mirrored from template.hasthemes.com/shome/shome/index-two.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 14 Jul 2024 15:33:39 GMT -->
</html>
