@extends('landing.layout.main')

@section('hero')
<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container" data-aos="fade-up" data-aos-delay="150">
        <h1>Pemira Hima Jurusan Kesehatan Gigi</h1>
        <h2>Poltekkes Kemenkes Surabaya</h2>
        {{-- <div class="m-4 mb-2 mt-2">
            <a href="#team1" class="btn-get-started scrollto">Lihat Calon Ketua</a>
            <a href="#team2" class="btn-get-started scrollto">Lihat Calon Wakil</a>
            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
        </div> --}}

    </div>
</section><!-- End Hero -->
@endsection

@section('content')

<!-- ======= Calon Ketua ======= -->
<section id="team1" class="team section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Kandidat</h2>
            <p>Calon Ketua Hima Jurusan Kesehatan Gigi</p>
        </div>

        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="member" data-aos="fade-up" data-aos-delay="100">
                    <div class="pic"><img src="{{ asset('landing/assets/img/team/team-1.jpg') }}" class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>Walter White</h4>
                        <span>Chief Executive Officer</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="member">
                    <div class="pic"><img src="{{ asset('landing/assets/img/team/team-2.jpg') }}" class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>Sarah Jhonson</h4>
                        <span>Product Manager</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                    <div class="pic"><img src="{{ asset('landing/assets/img/team/team-3.jpg') }}" class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>William Anderson</h4>
                        <span>CTO</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ======= Calon Wakil ======= -->
<section id="team2" class="team section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Kandidat</h2>
            <p>Calon Wakil Hima Jurusan Kesehatan Gigi</p>
        </div>

        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="member" data-aos="fade-up" data-aos-delay="100">
                    <div class="pic"><img src="{{ asset('landing/assets/img/team/team-1.jpg') }}" class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>Walter White</h4>
                        <span>Chief Executive Officer</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="member">
                    <div class="pic"><img src="{{ asset('landing/assets/img/team/team-2.jpg') }}" class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>Sarah Jhonson</h4>
                        <span>Product Manager</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                    <div class="pic"><img src="{{ asset('landing/assets/img/team/team-3.jpg') }}" class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>William Anderson</h4>
                        <span>CTO</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>


@endsection
