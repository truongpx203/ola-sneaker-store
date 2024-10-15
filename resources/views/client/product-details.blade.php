@extends('client.layout')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<main class="main-content">
  <!--== Start Page Header Area Wrapper ==-->
  <div class="page-header-area" data-bg-img="{{ asset('assets/img/photos/bg3.webp')}}">
    <div class="container pt--0 pb--0">
      <div class="row">
        <div class="col-12">
          <div class="page-header-content">
            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Chi tiết sản phẩm</h2>
            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
              <ul class="breadcrumb">
                <li><a href="{{route('/')}}">Trang chủ</a></li>
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
                        <a class="lightbox-image" data-fancybox="gallery" href="{{ Storage::url ($product->primary_image_url) }}">
                          <img src="{{ Storage::url ($product->primary_image_url) }}" alt="{{ $product->name }}" style="height: 541px; object-fit: cover">
                        </a>
                      </div>
                      @foreach ($product->productImages as $image)
                      <div class="swiper-slide">
                        <a class="lightbox-image" data-fancybox="gallery" href="{{ Storage::url ($image->image_url) }}">
                          <img src="{{ Storage::url ($image->image_url) }}" alt="{{ $product->name }}" style="height: 541px; object-fit: cover">
                        </a>
                      </div>
                      @endforeach
                    </div>
                  </div>
                  <div class="swiper-container single-product-nav single-product-nav-slider">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <img src="{{ Storage::url ($product->primary_image_url) }}" alt="{{ $product->name }}" style="height: 127px; object-fit: cover">
                      </div>
                      @foreach ($product->productImages as $image) 
                      <div class="swiper-slide">
                        <img src="{{ Storage::url ($image->image_url) }}" alt="{{ $product->name }}" style="height: 127px; object-fit: cover">
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <!--== End Product Thumbnail Area ==-->
              </div>
              <div class="col-xl-6">
                <!--== Start Product Info Area ==-->
                <div class="product-single-info">
                  <h3 class="main-title">{{ $product->name }}</h3>
                  <div class="prices">
                    <span id="price-old" class="price-old" style="text-decoration: line-through; font-weight: 400;">
                        {{ number_format($lowestSaleVariant->listed_price) }} đ</span>
                    <span class="sep" id="price-sep">-</span>
                    <span id="price" class="price">
                        {{ number_format($lowestSaleVariant->sale_price) }} đ
                    </span>
                </div>
                  {{-- <div class="rating-box-wrap">
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
                  </div> --}}
                  <p>{{ $product->summary }}</p>
                  {{-- <div class="product-color">
                    <h6 class="title">Color</h6>
                    <ul class="color-list">
                      <li  data-bg-color="#586882"></li>
                      <li class="active" data-bg-color="#505050"></li>
                      <li data-bg-color="#73707a"></li>
                      <li data-bg-color="#c7bb9b"></li>
                    </ul>
                  </div> --}}
                  
                  <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    
                    <!-- Hidden input để lưu variant_id đã chọn -->
                    <input type="hidden" name="variant_id" id="variant-id" value="{{ $product->variants->first()->id }}">
                
                    <div class="product-size">
                        <h6 class="title">Size</h6>
                        <ul class="size-list">
                            @foreach ($product->variants as $variant)
                                <li class="size-item {{ $variant->stock == 0 ? 'out-of-stock' : '' }}" 
                                    data-variant-id="{{ $variant->id }}" 
                                    data-stock="{{ $variant->stock }}" 
                                    onclick="selectSize(this)">
                                    {{ $variant->size ? $variant->size->name : 'Không xác định' }}
                                    {{-- ({{ $variant->stock > 0 ? 'Còn hàng' : 'Hết hàng' }}) --}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                
                    <div class="pro-qty">
                        <input type="number" title="Quantity" name="variant_quantity" value="1" min="1">
                    </div>
                    
                    <button type="submit" id="add-to-cart-btn" class="btn-theme"href="{{ 'shop.cart' }}" onclick="addToCart(event)">Thêm vào giỏ hàng</button>
                </form>                
                <br>
                <div class="product-info-footer">
                  <h6 class="code"><span>Mã số :</span>{{$product->code}}</h6>
                </div>
                <script>
                    function selectSize(element) {
                        // Xóa class 'selected' khỏi tất cả các size-item
                        document.querySelectorAll('.size-item').forEach(item => {
                            item.classList.remove('selected');
                        });
                        // Thêm class 'selected' cho size-item được chọn
                        element.classList.add('selected');
                
                        // Cập nhật giá trị variant_id của input hidden
                        const variantId = element.getAttribute('data-variant-id');
                        document.getElementById('variant-id').value = variantId;
                        const stockInfo = document.getElementById('stock-info');
      const stock = element.getAttribute('data-stock');
      selectedStock = stock; // Cập nhật số lượng đã chọn
  
      // Xóa lớp active khỏi tất cả các kích thước
      const sizeItems = document.querySelectorAll('.size-item');
      sizeItems.forEach(item => {
          item.classList.remove('active');
      });
  
      // Thêm lớp active cho kích thước đã chọn
      element.classList.add('active');
  
      // Cập nhật thông tin số lượng
      if (stock == 0) {
          stockInfo.innerHTML = '<span style="color: red;">Đã hết hàng</span>';
          disableAddToCart(); // Vô hiệu hóa nút thêm vào giỏ hàng
      } else {
          stockInfo.innerHTML = `Số lượng còn lại: ${stock}`;
          enableAddToCart(); // Kích hoạt nút thêm vào giỏ hàng
      }
                    }
                </script>
                
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
                {{-- <a id="reviews-tab" data-bs-toggle="pill" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá <span>(05)</span></a> --}}
              </li>
            </ul>
            <div class="tab-content product-tab-content" id="ReviewTabContent">
              <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                <div class="product-information">
                  <p>{{ $product->detailed_description }}</p>
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
                @foreach ($relatedProducts as $relatedProduct)   
                <div class="swiper-slide">
                  <!--== Start Product Item ==-->
                  <div class="product-item">
                    <div class="inner-content">
                        <div class="product-thumb">
                            <a href="{{ route('product-detail', ['id' => $relatedProduct->id]) }}">
                                <img src="{{ Storage::url ($relatedProduct->primary_image_url) }}" alt="{{ $relatedProduct->name }}" style="height: 271px; object-fit: cover">
                            </a>
                            <div class="product-flag">
                                <ul>
                                  @if ($relatedProduct->variants->isNotEmpty() && $relatedProduct->variants->first()->sale_price)
                                      <li class="discount">-{{ round((($relatedProduct->variants->first()->listed_price - $relatedProduct->variants->first()->sale_price) / $relatedProduct->variants->first()->listed_price) * 100) }}%</li>
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
                            <a class="banner-link-overlay" href="{{ route('product-detail', ['id' => $relatedProduct->id]) }}"></a>
                        </div>
                        <div class="product-info">
                            <h4 class="title"><a href="{{ route('product-detail', ['id' => $relatedProduct->id]) }}">{{ $relatedProduct->name }}</a></h4>
                            <div class="prices">
                              @if ($relatedProduct->variants->isNotEmpty())
                                  @php
                                      // Tìm biến thể có giá sale thấp nhất
                                      $lowestSaleVariant = $relatedProduct->variants->whereNotNull('sale_price')->sortBy('sale_price')->first();
                                  @endphp
                                  @if ($lowestSaleVariant)
                                      <span class="price-old" style="text-decoration: line-through;">
                                          {{ number_format($lowestSaleVariant->listed_price) }} đ</span>
                                      <span class="sep">-</span>
                                      <span class="price">
                                          {{ number_format($lowestSaleVariant->sale_price) }} đ
                                      </span>
                                  @else
                                      <span class="price">{{ number_format($relatedProduct->listed_price) }} đ</span>
                                  @endif
                              @else
                                  <span class="price">{{ number_format($relatedProduct->listed_price) }} đ</span>
                              @endif
                          </div>
                        </div>
                    </div>
                </div>
                  <!--== End prPduct Item ==-->
                </div>
                @endforeach

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
<script>
  let selectedStock = null; // Biến để lưu số lượng còn lại
  let variants = @json($product->variants); // Lưu trữ tất cả biến thể vào biến JavaScript

  function updateStockInfo(element, sizeName) {
      const stockInfo = document.getElementById('stock-info');
      const stock = element.getAttribute('data-stock');
      selectedStock = stock; // Cập nhật số lượng đã chọn

      // Xóa lớp active khỏi tất cả các kích thước
      const sizeItems = document.querySelectorAll('.size-item');
      sizeItems.forEach(item => {
          item.classList.remove('active');
      });

      // Thêm lớp active cho kích thước đã chọn
      element.classList.add('active');

      // Cập nhật thông tin số lượng
      if (stock == 0) {
          stockInfo.innerHTML = '<span style="color: red;">Đã hết hàng</span>';
          disableAddToCart(); // Vô hiệu hóa nút thêm vào giỏ hàng
      } else {
          stockInfo.innerHTML = `Số lượng còn lại: ${stock}`;
          enableAddToCart(); // Kích hoạt nút thêm vào giỏ hàng
      }

      // Cập nhật giá
      updatePrice(element);
  }

  function updatePrice(element) {
      const variantId = element.getAttribute('data-variant-id'); // Lấy ID của biến thể
      const selectedVariant = variants.find(variant => variant.id == variantId); // Tìm biến thể đã chọn

      if (selectedVariant) {
          const priceOld = document.getElementById('price-old');
          const priceSep = document.getElementById('price-sep');
          const priceDisplay = document.getElementById('price');

          // Cập nhật giá
          if (selectedVariant.sale_price) {
              priceOld.innerHTML = `${number_format(selectedVariant.listed_price)} đ`;
              priceOld.style.display = 'inline'; 
              priceSep.style.display = 'inline';
              priceDisplay.innerHTML = `${number_format(selectedVariant.sale_price)} đ`;
          } else {
              priceOld.style.display = 'none';
              priceSep.style.display = 'none';
              priceDisplay.innerHTML = `${number_format(selectedVariant.listed_price)} đ`;
          }
      }
  }

  function number_format(number) {
      return Math.floor(number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function enableAddToCart() {
      const addToCartBtn = document.getElementById('add-to-cart-btn');
      addToCartBtn.classList.remove('disabled');
      addToCartBtn.href = "{{ '/add-to-cart' }}"; // Khôi phục liên kết
      addToCartBtn.onclick = null; // Khôi phục hành vi click mặc định
  }

  function addToCart(event) {
      if (selectedStock === null || selectedStock == 0) {
          event.preventDefault(); // Ngăn không cho chuyển hướng nếu không có hàng
          alert('Bạn cần chọn kích thước!');
      } 
  }

  
</script>


@endsection