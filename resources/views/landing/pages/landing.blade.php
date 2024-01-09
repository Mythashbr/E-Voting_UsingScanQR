@extends('landing.layout.main')

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="text-center justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <img src="{{ asset('admin/logo/logo-kesgi.png') }}" height="200px" width="200px" alt="">
            <div class="text-center m-4 ">
                <div class="text-center m-4 ">
                    <h1>Pemilu Raya</h1>
                    <h1>Himpunan Mahasiswa</h1>
                    <h1>Jurusan Kesehatan Gigi</h1>
                    <h1>Periode 2023/2024</h1>
                    <h2>Politeknik Kesehatan Kemenkes Surabaya</h2>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->

<section id="portfolio-details" class="portfolio-details">
    <div class="container" data-aos="fade-up">

        @foreach ($datapemilihan as $data )

        <div class="text-center section-title">
            <p>Kandidat {{ $data->name }}</p>
            <h2></h2>
        </div>

        <div class="row justify-content-center">

            <div class="col-lg-4 col-md-6">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <?php
                        $calon = DB::table('tb_calon')->where('id_pemilihan', $data->id)->get();
                        ?>

                        @foreach ($calon as $calon)

                        <div class="swiper-slide mb-5">
                            <img src="{{ asset('images/'. $calon->foto) }}" class="img-rounded" alt="">
                            <div class="text-center swiper-slide-info mt-3">
                                <h3>{{ $calon->no_urut }}</h3>
                                <h3>{{ $calon->name }}</h3>
                                <a href="/detail-calon/{{ $calon->id }}" class="btn btn-warning btn-sm">Detail Calon</a>
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


        @endforeach


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
