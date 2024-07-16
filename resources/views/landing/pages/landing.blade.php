@extends('landing.layout.main')

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="text-center justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <img src="{{ asset('admin/logo/maritim.png') }}" height="200px" width="200px" alt="">
            <div class="text-center m-4 ">
                <h1>Pemilihan Duta Ekonomi Biru Indonesia </h1>
                <h2>Mariti Muda Nusantara</h2>

            </div>
        </div>
    </div>
</section><!-- End Hero -->

<section id="portfolio-details" class="portfolio-details">
    <div class="container" data-aos="fade-up">

        @foreach ($datapemilihan as $data)
        <div class="text-center section-title">
            <p>Kandidat {{ $data->name }}</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <?php $calonData = DB::table('tb_calon')->where('id_pemilihan', $data->id)->get(); ?>
                        @foreach ($calonData as $calon)
                        <?php
                            // Ambil jumlah suara untuk calon ini
                            $jumlahSuara = isset($jumlahsuara[$calon->id]) ? $jumlahsuara[$calon->id] : 0;
                        ?>
                        <div class="swiper-slide mb-5">
                            <img src="{{ asset('images/' . $calon->foto) }}" class="img-rounded" alt="">
                            <div class="text-center swiper-slide-info mt-3">
                                <h3>{{ $calon->no_urut }}</h3>
                                <h3>{{ $calon->name }}</h3>
                                <a href="/detail-calon/{{ $calon->id }}" class="btn btn-warning btn-sm">Detail Calon</a>
                                <!-- Tambahkan kolom hasil suara di sini -->
                                <div class="mt-3">
                                    <strong>Hasil Suara:</strong> {{ $jumlahSuara }}
                                </div>
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

{{-- @if (Session::get('pilihdulu'))
<script>
    Swal.fire("Oops!", "Silahkan Pilih Calon Terlebih Dahulu", "error");
</script>
@endif --}}
@endsection
