@extends('client.layout')

@section('title', 'Product Details')

@section('content')
<main class="main-content">
  <!--== Start Page Header Area Wrapper ==-->
  <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
    <div class="container pt--0 pb--0">
      <div class="row">
        <div class="col-12">
          <div class="page-header-content">
            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Chi tiết sản phẩm</h2>
            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
              <ul class="breadcrumb">
                <li><a href="index.html">Trang chủ</a></li>
                <li class="breadcrumb-sep">//</li>
                <li>Chi tiết sản phẩm</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--== End Page Header Area Wrapper ==-->

  <!--== Start Product Single Area Wrapper ==-->
  <section class="product-area product-single-area">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="product-single-item">
            <div class="row">
              <div class="col-xl-6">
                <!--== Start Product Thumbnail Area ==-->
                <div class="product-single-thumb">
                  <div class="swiper-container single-product-thumb single-product-thumb-slider">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <a class="lightbox-image" data-fancybox="gallery" href="assets/img/shop/product-single/1.webp">
                          <img src="assets/img/shop/product-single/1.webp" width="570" height="541" alt="Image-HasTech">
                        </a>
                      </div>
                      <div class="swiper-slide">
                        <a class="lightbox-image" data-fancybox="gallery" href="assets/img/shop/product-single/2.webp">
                          <img src="assets/img/shop/product-single/2.webp" width="570" height="541" alt="Image-HasTech">
                        </a>
                      </div>
                      <div class="swiper-slide">
                        <a class="lightbox-image" data-fancybox="gallery" href="assets/img/shop/product-single/3.webp">
                          <img src="assets/img/shop/product-single/3.webp" width="570" height="541" alt="Image-HasTech">
                        </a>
                      </div>
                      <div class="swiper-slide">
                        <a class="lightbox-image" data-fancybox="gallery" href="assets/img/shop/product-single/4.webp">
                          <img src="assets/img/shop/product-single/4.webp" width="570" height="541" alt="Image-HasTech">
                        </a>
                      </div>
                      <div class="swiper-slide">
                        <a class="lightbox-image" data-fancybox="gallery" href="assets/img/shop/product-single/5.webp">
                          <img src="assets/img/shop/product-single/5.webp" width="570" height="541" alt="Image-HasTech">
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-container single-product-nav single-product-nav-slider">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <img src="assets/img/shop/product-single/nav-1.webp" width="127" height="127" alt="Image-HasTech">
                      </div>
                      <div class="swiper-slide">
                        <img src="assets/img/shop/product-single/nav-2.webp" width="127" height="127" alt="Image-HasTech">
                      </div>
                      <div class="swiper-slide">
                        <img src="assets/img/shop/product-single/nav-3.webp" width="127" height="127" alt="Image-HasTech">
                      </div>
                      <div class="swiper-slide">
                        <img src="assets/img/shop/product-single/nav-4.webp" width="127" height="127" alt="Image-HasTech">
                      </div>
                      <div class="swiper-slide">
                        <img src="assets/img/shop/product-single/nav-5.webp" width="127" height="127" alt="Image-HasTech">
                      </div>
                    </div>
                  </div>
                </div>
                <!--== End Product Thumbnail Area ==-->
              </div>
              <div class="col-xl-6">
                <!--== Start Product Info Area ==-->
                <div class="product-single-info">
                  <h3 class="main-title">Leather Mens Slipper</h3>
                  <div class="prices">
                    <span class="price">$20.19</span>
                  </div>
                  <div class="rating-box-wrap">
                    <div class="rating-box">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <div class="review-status">
                      <a href="javascript:void(0)">(5 Đánh giá của khách hàng )</a>
                    </div>
                  </div>
                  <p>Điều rất quan trọng là phải chăm sóc bệnh nhân và kết quả là tăng cân, nhưng đồng thời chúng cũng gây ra nhiều công sức và đau đớn. Vì để đến được nhà máy, không ai nên thực hành bất kỳ loại công việc nào trừ khi nó có lợi ích gì đó. Đừng để nỗi đau biến mất</p>
                  {{-- <div class="product-color">
                    <h6 class="title">Color</h6>
                    <ul class="color-list">
                      <li  data-bg-color="#586882"></li>
                      <li class="active" data-bg-color="#505050"></li>
                      <li data-bg-color="#73707a"></li>
                      <li data-bg-color="#c7bb9b"></li>
                    </ul>
                  </div> --}}
                  <div class="product-size">
                    <h6 class="title">Size</h6>
                    <ul class="size-list">
                      <li>36</li>
                      <li class="active">37</li>
                      <li>38</li>
                      <li>39</li>
                      <li>40</li>
                      <li>41</li>
                      <li>42</li>
                      <li>43</li>
                    </ul>
                  </div>
                  <div class="product-quick-action">
                    <div class="qty-wrap">
                      <div class="pro-qty">
                        <input type="text" title="Quantity" value="1">
                      </div>
                    </div>
                    <a class="btn-theme" href="shop-cart.html">Thêm vào giỏ hàng</a>
                  </div>
                  <div class="product-wishlist-compare">
                    {{-- <a href="shop-wishlist.html"><i class="pe-7s-like"></i>Add to Wishlist</a>
                    <a href="shop-compare.html"><i class="pe-7s-shuffle"></i>Add to Compare</a> --}}
                  </div>
                  <div class="product-info-footer">
                    <h6 class="code"><span>Mã số :</span>Ch-256xl</h6>
                    {{-- <div class="social-icons">
                      <span>Chia sẻ</span>
                      <a href="#/"><i class="fa fa-facebook"></i></a>
                      <a href="#/"><i class="fa fa-dribbble"></i></a>
                      <a href="#/"><i class="fa fa-pinterest-p"></i></a>
                    </div> --}}
                  </div>
                </div>
                <!--== End Product Info Area ==-->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="product-review-tabs-content">
            <ul class="nav product-tab-nav" id="ReviewTab" role="tablist">
              <li role="presentation">
                <a class="active" id="information-tab" data-bs-toggle="pill" href="#information" role="tab" aria-controls="information" aria-selected="true">Thông tin</a>
              </li>
              {{-- <li role="presentation">
                <a id="description-tab" data-bs-toggle="pill" href="#description" role="tab" aria-controls="description" aria-selected="false">Sự miêu tả</a>
              </li> --}}
              <li role="presentation">
                <a id="reviews-tab" data-bs-toggle="pill" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá <span>(05)</span></a>
              </li>
            </ul>
            <div class="tab-content product-tab-content" id="ReviewTabContent">
              <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                <div class="product-information">
                  <p>Việc chăm sóc bệnh nhân là rất quan trọng, bệnh nhân sẽ được theo dõi, nhưng đồng thời chúng cũng gây ra rất nhiều công sức và đau đớn. Vì như tôi đã nói, chúng ta đừng tham gia vào bất kỳ loại công việc nào trừ khi chúng ta thu được lợi ích nào đó từ nó. Duis hoặc irure pain in tun tun khiển trách trong niềm vui anh ta muốn trở thành một chiếc lông trong nỗi đau eu chạy trốn không sinh. Trừ khi bị dục vọng làm cho mù quáng, nếu không họ sẽ không bước ra, đó là lỗi của người bỏ bê nhiệm vụ và làm mềm lòng, đó là công việc cực nhọc. Nhưng để bạn có thể thấy rằng tất cả những sai lầm bẩm sinh này là niềm vui của những người buộc tội và nỗi đau của những người khen ngợi, tôi sẽ mở đầu toàn bộ vấn đề và giải thích chính những điều mà người khám phá ra sự thật đó đã nói và, như nó là kiến ​​trúc sư của một cuộc sống hạnh phúc. Vì không ai khinh miệt, ghét bỏ hay chạy trốn khỏi niềm vui vì nó là niềm vui mà vì kết quả của nó.</p>
                </div>
              </div>
              {{-- <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                <div class="product-description">
                  <p>Việc chăm sóc bệnh nhân là rất quan trọng, bệnh nhân sẽ được theo dõi, nhưng đồng thời chúng cũng gây ra rất nhiều công sức và đau đớn. Vì như tôi đã nói, chúng ta đừng tham gia vào bất kỳ loại công việc nào trừ khi chúng ta thu được lợi ích nào đó từ nó. Duis hoặc irure pain in tun tun khiển trách trong niềm vui anh ta muốn trở thành một chiếc lông trong nỗi đau eu chạy trốn không sinh. Trừ khi bị dục vọng làm cho mù quáng, nếu không họ sẽ không bước ra, đó là lỗi của người bỏ bê nhiệm vụ và làm mềm lòng, đó là công việc cực nhọc. Nhưng để bạn có thể thấy rằng tất cả những sai lầm bẩm sinh này là niềm vui của những người buộc tội và nỗi đau của những người khen ngợi, tôi sẽ mở đầu toàn bộ vấn đề và giải thích chính những điều mà người khám phá ra sự thật đó đã nói và, như nó là kiến ​​trúc sư của một cuộc sống hạnh phúc. Vì không ai khinh miệt, ghét bỏ hay chạy trốn khỏi niềm vui vì nó là niềm vui mà vì kết quả của nó.</p>
                </div>
              </div> --}}
              <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <div class="product-review-content">
                  <div class="review-content-header">
                    <h3>Đánh giá của khách hàng</h3>
                    <div class="review-info">
                      <ul class="review-rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star-o"></li>
                      </ul>
                      <span class="review-caption">Dựa trên đánh giá</span>
                      <span class="review-write-btn">Viết bài đánh giá</span>
                    </div>
                  </div>

                  <!--== Start Reviews Form Item ==-->
                  <div class="reviews-form-area">
                    <h4 class="title">Viết bài đánh giá</h4>
                    <div class="reviews-form-content">
                      <form action="#">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="for_name">Tên</label>
                              <input id="for_name" class="form-control" type="text" placeholder="Enter your name">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="for_email">Email</label>
                              <input id="for_email" class="form-control" type="email" placeholder="john.smith@example.com">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <span class="title">Xếp hạng</span>
                              <ul class="review-rating">
                                <li class="fa fa-star-o"></li>
                                <li class="fa fa-star-o"></li>
                                <li class="fa fa-star-o"></li>
                                <li class="fa fa-star-o"></li>
                                <li class="fa fa-star-o"></li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="for_review-title">Tiêu đề đánh giá</label>
                              <input id="for_review-title" class="form-control" type="text" placeholder="Give your review a title">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="for_comment">Nội dung đánh giá (1500)</label>
                              <textarea id="for_comment" class="form-control" placeholder="Write your comments here"></textarea>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-submit-btn">
                              <button type="submit" class="btn-submit">Đăng bình luận</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!--== End Reviews Form Item ==-->

                  <div class="reviews-content-body">
                    <!--== Start Reviews Content Item ==-->
                    <div class="review-item">
                      <ul class="review-rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                      </ul>
                      <h3 class="title">Dịch vụ vận chuyển tuyệt vời!</h3>
                      <h5 class="sub-title"><span>Nantu Nayal</span> vào <span>ngày 30 tháng 9 năm 2022</span></h5>
                      <p>Nó không chỉ tồn tại qua năm thế kỷ mà còn vượt qua cả bước nhảy vọt vào sắp chữ điện tử, về cơ bản vẫn không thay đổi. Nó đã trở nên phổ biến vào những năm 1960 với việc phát hành các tờ Letraset chứa các đoạn văn Lorem Ipsum, và gần đây hơn là với phần mềm xuất bản trên máy tính để bàn như Aldus PageMaker bao gồm các phiên bản của Lorem Ipsum.</p>
                      <a href="#/">Report as Inappropriate</a>
                    </div>
                    <!--== End Reviews Content Item ==-->

                    <!--== Start Reviews Content Item ==-->
                    {{-- <div class="review-item">
                      <ul class="review-rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star-o"></li>
                        <li class="fa fa-star-o"></li>
                        <li class="fa fa-star-o"></li>
                        <li class="fa fa-star-o"></li>
                      </ul>
                      <h3 class="title">Low Quality</h3>
                      <h5 class="sub-title"><span>Oliv hala</span> no <span>Sep 30, 2022</span></h5>
                      <p>My Favorite White Sneakers From Splurge To Save the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                      <a href="#/">Report as Inappropriate</a>
                    </div> --}}
                    <!--== End Reviews Content Item ==-->

                    <!--== Start Reviews Content Item ==-->
                    {{-- <div class="review-item">
                      <ul class="review-rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                      </ul>
                      <h3 class="title">Excellent services!</h3>
                      <h5 class="sub-title"><span>Halk Marron</span> no <span>Sep 30, 2022</span></h5>
                      <p>The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                      <a href="#/">Report as Inappropriate</a>
                    </div>
                    <!--== End Reviews Content Item ==-->

                    <!--== Start Reviews Content Item ==-->
                    <div class="review-item">
                      <ul class="review-rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star-o"></li>
                        <li class="fa fa-star-o"></li>
                      </ul>
                      <h3 class="title">Price is very high</h3>
                      <h5 class="sub-title"><span>Musa</span> no <span>Sep 30, 2022</span></h5>
                      <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                      <a href="#/">Report as Inappropriate</a>
                    </div>
                    <!--== End Reviews Content Item ==-->

                    <!--== Start Reviews Content Item ==-->
                    <div class="review-item">
                      <ul class="review-rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star-o"></li>
                      </ul>
                      <h3 class="title">Normal</h3>
                      <h5 class="sub-title"><span>Muhammad</span> no <span>Sep 30, 2022</span></h5>
                      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
                      <a href="#/">Report as Inappropriate</a>
                    </div> --}}
                    <!--== End Reviews Content Item ==-->
                  </div>

                  <!--== Start Reviews Pagination Item ==-->
                  <div class="review-pagination">
                    <span class="pagination-pag">1</span>
                    <span class="pagination-pag">2</span>
                    <span class="pagination-next">Next »</span>
                  </div>
                  <!--== End Reviews Pagination Item ==-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--== End Product Single Area Wrapper ==-->

  <!--== Start Product Area Wrapper ==-->
  <section class="product-area product-best-seller-area">
    <div class="container pt--0">
      <div class="row">
        <div class="col-12">
          <div class="section-title text-center">
            <h3 class="title">Sản phẩm liên quan</h3>
            {{-- <div class="desc">
              <p>There are many variations of passages of Lorem Ipsum available</p>
            </div> --}}
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
                  <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                  <ul>
                    <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Modern Smart Shoes</a></h4>
                        <div class="prices">
                          <span class="price-old">$300</span>
                          <span class="sep">-</span>
                          <span class="price">$240.00</span>
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
                  <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                  <ul>
                    <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Quickiin Mens shoes</a></h4>
                        <div class="prices">
                          <span class="price">$240.00</span>
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
                  <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                  <ul>
                    <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Rexpo Womens shoes</a></h4>
                        <div class="prices">
                          <span class="price-old">$300</span>
                          <span class="sep">-</span>
                          <span class="price">$240.00</span>
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
                  <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                  <ul>
                    <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Leather Mens Slipper</a></h4>
                        <div class="prices">
                          <span class="price">$240.00</span>
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
                  <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                  <ul>
                    <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Primitive Mens shoes</a></h4>
                        <div class="prices">
                          <span class="price-old">$300</span>
                          <span class="sep">-</span>
                          <span class="price">$240.00</span>
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
                  <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                  <ul>
                    <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Simple Fabric Shoe</a></h4>
                        <div class="prices">
                          <span class="price-old">$300</span>
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
  </section>
  <!--== End Product Area Wrapper ==-->
</main>
@endsection