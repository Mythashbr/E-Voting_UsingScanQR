@extends('landing.layout.main')
@section('title', 'Detail Calon - ')

@section('content')

<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="text-center justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <img src="{{ asset('admin/logo/logo-kesgi.png') }}" height="200px" width="200px" alt="">
            <div class="text-center m-4 ">
                <h1>Pemira Himpunan Jurusan Kesehatan Gigi</h1>
                <h2>Politeknik Kesehatan Kemenkes Surabaya</h2>
            </div>
        </div>



    </div>
</section><!-- End Hero -->

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Detail Calon</h2>
            <ol>
                <li><a href="/">Home</a></li>
                <li>Portfolio Details</li>
            </ol>
        </div>

    </div>
</section>

<section id="portfolio-details" class="portfolio-details">
    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-7">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <div class="swiper-slide">
                            <img src="{{ asset('landing/assets/img/portfolio/portfolio-1.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info">
                    <h3>Calon information</h3>
                    <ul>
                        <li><strong>Name</strong>: {{ $calon->name }}</li>
                        <li><strong>Client</strong>: ASU Company</li>
                        <li><strong>Project date</strong>: 01 March, 2020</li>
                        <li><strong>Project URL</strong>: <a href="#">www.example.com</a></li>
                    </ul>
                </div>
                <div class="portfolio-description">
                    <h2>Visi</h2>
                    <p>
                        {{ $calon->visi  }}
                    </p>
                </div>
                <div class="portfolio-description">
                    <h2>Misi</h2>
                    <p>
                        {{ $calon->misi  }}
                    </p>
                </div>

            </div>


        </div>

    </div>
</section>

@endsection
