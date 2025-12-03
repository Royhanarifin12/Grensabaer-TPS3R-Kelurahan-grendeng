@extends('layout.LandingPage')

@section('content')
    <style>
        

        .page-title h3 {
            font-size: 42px;
            font-weight: 700;
            color: #2d465e;
            margin-bottom: 10px;
            font-family: var(--heading-font);
        }

        .sejarah-section {
            padding: 80px 0;
            background-color: #ffffff;
        }

        .hero-image {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            margin-bottom: 30px;
        }

        .hero-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .hero-image:hover img {
            transform: scale(1.03);
        }

        .sejarah-content {
            padding-left: 20px;
        }

        .sejarah-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
            text-align: justify;
            margin-bottom: 20px;
        }

        @media (max-width: 991px) {
            .sejarah-content {
                padding-left: 0;
                margin-top: 30px;
            }
        }
    </style>

    <div class="page-title light-background" id="features-tab-1">
        <div class="container">
            <div class="col-lg-12 text-center mt-3 mt-lg-0 d-flex flex-column justify-content-center align-items-center">
                <h3>Latar Belakang</h3>
            </div>
        </div>
    </div>

    <section id="starter-section" class="sejarah-section section">
        <div class="container" data-aos="fade-up">
            <div class="row align-items-center">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="sejarah-content">
                        <p class="sejarah-text">
                            Permasalahan sampah merupakan tantangan nyata yang kita hadapi bersama. Seiring dengan
                            pertumbuhan penduduk Kelurahan Grendeng yang mencapai lebih dari 6.900 jiwa, volume sampah rumah
                            tangga terus meningkat setiap harinya. Tanpa pengelolaan yang tepat, hal ini dapat berdampak
                            buruk bagi lingkungan dan kesehatan kita.
                        </p>
                        <p class="sejarah-text">
                            Berangkat dari kesadaran tersebut dan mendukung program 'Sampah Menjadi Berkah' dari Pemerintah
                            Kabupaten Banyumas, KSM Grensaber hadir dengan konsep TPS 3R (Reduce, Reuse, Recycle). Kami
                            berkomitmen untuk tidak sekadar membuang, tetapi mengelola sampah secara bertanggung jawab,
                            memilah organik dan anorganik, serta mengubah residu menjadi sesuatu yang bernilai.
                        </p>
                        <p class="sejarah-text">
                            Kini, Grensaber bertransformasi ke arah digital. Website ini kami luncurkan sebagai wujud
                            transparansi pengelolaan, kemudahan akses informasi, dan peningkatan layanan bagi seluruh warga
                            Grendeng. Bersama Grensaber, mari wujudkan lingkungan yang bersih, sehat, dan mandiri.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="100">
                    <div class="hero-image">
                        <img src="{{ asset('landing/img/gambar-1.jpg') }}" alt="Ilustrasi Pengelolaan Sampah"
                            class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
