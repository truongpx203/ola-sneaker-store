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
          <div class="shopping-wishlist-table table-responsive">
            <table class="table text-center">
              <thead>
                <tr>
                  <th class="product-remove">&nbsp;</th>
                  <th class="product-thumb">&nbsp;</th>
                  <th class="product-name">Sản phẩm</th>
                  <th class="product-stock-status">Tình trạng kho</th>
                  <th class="product-price">Giá</th>
                  <th class="product-action">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <tr class="cart-wishlist-item">
                  <td class="product-remove">
                    <a href="#/"><i class="fa fa-trash-o"></i></a>
                  </td>
                  <td class="product-thumb">
                    <a href="single-product.html">
                      <img src="assets/img/shop/product-mini/1.webp" width="90" height="110" alt="Image-HasTech">
                    </a>
                  </td>
                  <td class="product-name">
                    <h4 class="title"><a href="single-product.html">Leather Mens Slipper</a></h4>
                  </td>
                  <td class="product-stock-status">
                    <span class="stock">Còn hàng</span>
                  </td>
                  <td class="product-price">
                    <span class="price">500.000</span>
                  </td>
                  <td class="product-action">
                    <a class="btn-cart" href="shop-cart.html">Thêm vào giỏ hàng</a>
                  </td>
                </tr>
                <tr class="cart-wishlist-item">
                  <td class="product-remove">
                    <a href="#/"><i class="fa fa-trash-o"></i></a>
                  </td>
                  <td class="product-thumb">
                    <a href="single-product.html">
                      <img src="assets/img/shop/product-mini/2.webp" width="90" height="110" alt="Image-HasTech">
                    </a>
                  </td>
                  <td class="product-name">
                    <h4 class="title"><a href="single-product.html">Quickiin Mens shoes</a></h4>
                  </td>
                  <td class="product-stock-status">
                    <span class="stock">Còn hàng</span>
                  </td>
                  <td class="product-price">
                    <span class="price">400.000</span>
                  </td>
                  <td class="product-action">
                    <a class="btn-cart" href="shop-cart.html">Thêm vào giỏ hàng</a>
                  </td>
                </tr>
                <tr class="cart-wishlist-item">
                  <td class="product-remove">
                    <a href="#/"><i class="fa fa-trash-o"></i></a>
                  </td>
                  <td class="product-thumb">
                    <a href="single-product.html">
                      <img src="assets/img/shop/product-mini/3.webp" width="90" height="110" alt="Image-HasTech">
                    </a>
                  </td>
                  <td class="product-name">
                    <h4 class="title"><a href="single-product.html">Rexpo Womens shoes</a></h4>
                  </td>
                  <td class="product-stock-status">
                    <span class="stock">Còn hàng</span>
                  </td>
                  <td class="product-price">
                    <span class="price">550.000</span>
                  </td>
                  <td class="product-action">
                    <a class="btn-cart" href="shop-cart.html">Thêm vào giỏ hàng</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--== End Wishlist Area Wrapper ==-->
</main>
@endsection