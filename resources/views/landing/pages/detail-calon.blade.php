@extends('landing.layout.main')
@section('title', 'Detail Calon - ')

@section('content')

<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="text-center justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <img src="{{ asset('admin/logo/maritim.png') }}" height="200px" width="200px" alt="">
            <div class="text-center m-4 ">
                <h1>Pemilihan Duta Ekonomi Biru Indonesia</h1>
                <h2>Maritim Muda Nusantara</h2>
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
                <li>Calon Details</li>
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
                            <img src="{{ asset('images/'.$calon->foto) }}" alt="">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info mb-4">
                    <h3>Calon information</h3>
                    <ul>
                        <li><strong>Name</strong>: {{ $calon->name }}</li>
                        <li><strong>No Urut</strong>: {{ $calon->no_urut }}</li>
                    </ul>
                </div>
                <div class="portfolio-info">
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

                @if (Auth::check())

                <?php
                $cek = DB::table('tb_detail_pemilihan')->where('id_user', Auth::user()->id)->where('id_pemilihan', $calon->id_pemilihan)->count();
                ?>

                @if ($cek > 0)
                <div class="alert alert-warning alert-dismissible fade show mt-4">
                    <strong>Anda sudah memilih</strong> Terimakasih sudah menggunakan hak pilih anda.
                </div>

                @else


                <?php
                            $cekpemilihan = DB::table('tb_pemilihan')->where('id', $calon->id_pemilihan)->first();
                            ?>

                @if ($cekpemilihan->status == "aktif")

                <div class="alert alert-success alert-dismissible fade show mt-4">
                    <strong>Pastikan anda memilih calon yang sesuai dengan hati nurani anda!</strong> Silahkan pilih.
                </div>

                <div class="text-center">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pilihModal">
                        Pilih
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="pilihModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/pilih-calon" method="post">
                                @csrf
                                <div class="modal-body">
                                    <input hidden type="text" name="id_user" value="{{ Auth::user()->id }}">
                                    <input hidden type="text" name="id_calon" value="{{ $calon->id }}">
                                    <input hidden type="text" name="id_pemilihan" value="{{ $calon->id_pemilihan }}">
                                    <div class="modal-body">
                                        <p>Anda Yakin Akan Memilih {{ $calon->name }} ?</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Yes</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @else

                <div class="alert alert-danger alert-dismissible fade show mt-4">
                    <strong>Pemilihan tidak aktif!.</strong> Pemilihan telah dinonaktifkan.
                </div>

                @endif

                @endif

                @else

                <div class="alert alert-danger alert-dismissible fade show mt-4">
                    <strong>Anda belum login!</strong> Silahkan login terlebih dahulu untuk memilih calon.
                </div>

                @endif
            </div>
        </div>


    </div>
</section>

@endsection

@section('sweetalert')
@if (Session::get('error'))
<script>
    Swal.fire("Opps!", "Anda Sudah Memilih", "error");

</script>
@endif

@if (Session::get('success'))
<script>
    Swal.fire("Good!", "Anda Berhasil Memilih", "success");

</script>
@endif
@endsection
