@extends('client.layout')

@section('title', 'Shop Wishlist')

@section('content')
<main class="main-content">
  <!--== Start Page Header Area Wrapper ==-->
  <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
    <div class="container pt--0 pb--0">
      <div class="row">
        <div class="col-12">
          <div class="page-header-content">
            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Wishlist</h2>
            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
              <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="breadcrumb-sep">//</li>
                <li>Wishlist</li>
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
                  <th class="product-name">Product</th>
                  <th class="product-stock-status">Stock Status</th>
                  <th class="product-price">Price</th>
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
                    <span class="stock">In Stock</span>
                  </td>
                  <td class="product-price">
                    <span class="price">£25.99</span>
                  </td>
                  <td class="product-action">
                    <a class="btn-cart" href="shop-cart.html">Add to cart</a>
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
                    <span class="stock">In Stock</span>
                  </td>
                  <td class="product-price">
                    <span class="price">£69.99</span>
                  </td>
                  <td class="product-action">
                    <a class="btn-cart" href="shop-cart.html">Add to cart</a>
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
                    <span class="stock">In Stock</span>
                  </td>
                  <td class="product-price">
                    <span class="price">£39.99</span>
                  </td>
                  <td class="product-action">
                    <a class="btn-cart" href="shop-cart.html">Add to cart</a>
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