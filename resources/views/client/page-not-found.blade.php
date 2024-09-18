@extends('client.layout')

@section('title', 'Page not found')

@section('content')
<main class="main-content">
  <!--== Start Faq Area Wrapper ==-->
  <section class="page-not-found-area">
    <div class="container pt--0 pb--0">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
          <div class="page-not-found-wrap">
            <div class="page-not-found-content">
              <h3 class="not-found-text" data-aos="fade-down" data-aos-duration="1000">404</h3>
              <h3 class="title" data-aos="fade-down" data-aos-duration="1200">Page Cannot Be Found!</h3>
              <p class="desc" data-aos="fade-down" data-aos-duration="1400">Seems like nothing was found at this location. Try something else or you can go back to the homepage following the button below!</p>
              <a class="btn-theme-border" href="index.html" data-aos="fade-down" data-aos-duration="1600">Back to home</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--== End Faq Area Wrapper ==-->
</main>
@endsection