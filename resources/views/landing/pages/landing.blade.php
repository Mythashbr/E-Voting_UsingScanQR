@extends('landing.layout.main')

@section('content')
<!-- ======= Hero Section ======= -->
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

<section id="portfolio-details" class="portfolio-details">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Kandidat</h2>
            <p>Calon Ketua Hima JKG</p>
        </div>

        <div class="row justify-content-center">

            <?php
            $no = 1;
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        @foreach ($calonketua as $calonketua)
                        <div class="swiper-slide mb-5">
                            <img src="{{ asset('images/'.$calonketua->foto) }}" class="img-rounded" alt="">
                            <div class="text-center swiper-slide-info mt-3">
                                <h3>{{ $calonketua->name }}</h3>
                                <a href="/detail-calon/{{ $calonketua->id }}" class="btn btn-warning btn-sm">Detail Calon</a>
                                <p hidden>
                                    testhahahha
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

        </div>

    </div>
</section>

<section id="portfolio-details" class="portfolio-details">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Kandidat</h2>
            <p>Calon Wakil Hima JKG</p>
        </div>

        <div class="row justify-content-center">

            <?php
            $no = 1;
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        @foreach ($calonwakil as $calonwakil)
                        <div class="swiper-slide mb-5">
                            <img src="{{ asset('images/'.$calonwakil->foto) }}" class="img-rounded" alt="">
                            <div class="text-center swiper-slide-info mt-3">
                                <h3>{{ $calonwakil->name }}</h3>
                                <a href="/detail-calon/{{ $calonwakil->id }}" class="btn btn-warning btn-sm">Detail Calon</a>
                                <p hidden>
                                    testhahahha
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

        </div>

    </div>
</section>



@endsection

@section('sweetalert')
@if (Session::get('login'))
<script>
    Swal.fire("Good", "Login Berhasil", "success");

</script>
@endif

@if (Session::get('logout'))
<script>
    Swal.fire("Good!", "Logout Berhasil", "success");

</script>
@endif
@if (Session::get('pilihdulu'))
<script>
    Swal.fire("Opps!", "Silahkan Pilih Calon Terlebih Dahulu", "error");

</script>
@endif
@endsection
