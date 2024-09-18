@extends('client.layout')

@section('title', 'Shop Compare')

@section('content')
<main class="main-content">
  <!--== Start Page Header Area Wrapper ==-->
  <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
    <div class="container pt--0 pb--0">
      <div class="row">
        <div class="col-12">
          <div class="page-header-content">
            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Compare</h2>
            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
              <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="breadcrumb-sep">//</li>
                <li>Compare</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--== End Page Header Area Wrapper ==-->

  <!--== Start Shopping Compare Area Wrapper ==-->
  <section class="shopping-compare-area">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="shopping-compare-form table-responsive">

            <table class="table">
              <tbody>
                <tr>
                  <th class="fz-13">Product Info</th>
                  <td>
                    <div class="product-remove">
                      <a href="#/"><i class="fa fa-times"></i>Remove</a>
                    </div>
                    <div class="product-thumb">
                      <a href="single-product.html">
                        <img src="assets/img/shop/product-mini/1.webp" width="90" height="110" alt="Image-HasTech">
                      </a>
                    </div>
                    <div class="product-name">
                      <h4 class="title"><a href="single-product.html">Leather Mens Slipper</a></h4>
                    </div>
                    <a href="shop-cart.html" class="btn-cart">Add to cart</a>
                  </td>
                  <td>
                    <div class="product-remove">
                      <a href="#/"><i class="fa fa-times"></i>Remove</a>
                    </div>
                    <div class="product-thumb">
                      <a href="single-product.html">
                        <img src="assets/img/shop/product-mini/2.webp" width="90" height="110" alt="Image-HasTech">
                      </a>
                    </div>
                    <div class="product-name">
                      <h4 class="title"><a href="single-product.html">Quickiin Mens shoes</a></h4>
                    </div>
                    <a href="shop-cart.html" class="btn-cart">Add to cart</a>
                  </td>
                  <td>
                    <div class="product-remove">
                      <a href="#/"><i class="fa fa-times"></i>Remove</a>
                    </div>
                    <div class="product-thumb">
                      <a href="single-product.html">
                        <img src="assets/img/shop/product-mini/3.webp" width="90" height="110" alt="Image-HasTech">
                      </a>
                    </div>
                    <div class="product-name">
                      <h4 class="title"><a href="single-product.html">Rexpo Womens shoes</a></h4>
                    </div>
                    <a href="shop-cart.html" class="btn-cart">Add to cart</a>
                  </td>
                </tr>

                <tr>
                  <th>Price</th>
                  <td class="price">£69.99</td>
                  <td class="price">£69.99</td>
                  <td class="price">£69.99</td>
                </tr>

                <tr>
                  <th>Sku</th>
                  <td class="product-sku">REF. LA-791</td>
                  <td class="product-sku">REF. LA-779</td>
                  <td class="product-sku">REF. LA-788</td>
                </tr>

                <tr>
                  <th>Description</th>
                  <td class="product-desc">Class aptent taciti sociosqu ad litora torquent per conubia nostra,…</td>
                  <td class="product-desc">Class aptent taciti sociosqu ad litora torquent per conubia nostra,…</td>
                  <td class="product-desc">Class aptent taciti sociosqu ad litora torquent per conubia nostra,…</td>
                </tr>

                <tr>
                  <th>Availability</th>
                  <td><span class="product-stock">In stock</span></td>
                  <td><span class="product-stock">In stock</span></td>
                  <td><span class="product-stock">In stock</span></td>
                </tr>

                <tr>
                  <th>Weight</th>
                  <td class="product-weight">N/A</td>
                  <td class="product-weight">N/A</td>
                  <td class="product-weight">N/A</td>
                </tr>

                <tr>
                  <th>Dimensions</th>
                  <td class="product-dimensions">N/A</td>
                  <td class="product-dimensions">N/A</td>
                  <td class="product-dimensions">N/A</td>
                </tr>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!--== End Shopping Compare Area Wrapper ==-->
</main>
@endsection