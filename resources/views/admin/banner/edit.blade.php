@extends('admin.layouts.master')

@section('title')
    Danh mục Sản phẩm:
@endsection

@section('content')
    <style>
        .slider-content-area {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 100vh;
            /* Chiều cao toàn màn hình */
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slider-item {
            min-width: 100%;
            height: 100vh;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sửa danh mục</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Danh mục</a></li>
                        <li class="breadcrumb-item active">Sửa danh mục</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <div class="alert alert-danger" style="width: 100%;">
                            <ul>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="slider-container">
        <div class="slider-wrapper">
            @foreach ($banner as $item)
                <div class="slider-item" style="background-image: url('{{ asset('storage/' . $item->image) }}');">
                   
                </div>
            @endforeach

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sliderWrapper = document.querySelector('.slider-wrapper');
            const slides = document.querySelectorAll('.slider-item');
            let currentIndex = 0;

            function showNextSlide() {
                currentIndex = (currentIndex + 1) % slides.length; // Tăng chỉ số, quay lại 0 nếu vượt qua số slide
                updateSlidePosition();
            }

            function showPreviousSlide() {
                currentIndex = (currentIndex - 1 + slides.length) % slides
                .length; // Giảm chỉ số, quay về cuối nếu < 0
                updateSlidePosition();
            }

            function updateSlidePosition() {
                sliderWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
            }

            setInterval(showNextSlide, 3000);
        });
    </script>
@endsection
