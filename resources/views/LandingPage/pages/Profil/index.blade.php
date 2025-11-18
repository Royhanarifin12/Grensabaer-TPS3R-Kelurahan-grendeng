@extends('layout.landingPage')
@section('content')
    <div class="page-title light-background">
        <div class="container">
            <h1>Profil</h1>
        </div>
    </div>

    <section class="features section">
        <div class="container" data-aos="fade-up">
            <div class="d-flex justify-content-center">
                <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
                    <li class="nav-item">
                        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                            <h4>Pengantar</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                            <h4>Visi dan Misi</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                            <h4>Filosofi Operasi</h4>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
                <div class="tab-pane fade active show" id="features-tab-1">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                            <h3>Pengantar</h3>
                            <p class="fw-bold text-tps fs-4 mb-2">"Dari Sampah Menjadi Berkah: Mewujudkan Grendeng Bersih
                                dan Mandiri."</p>
                            <p>
                                Grensaber TPS3R Kelurahan Grendeng adalah wujud nyata komitmen masyarakat dan pemerintah Kabupaten
                                Banyumas dalam mengatasi masalah sampah secara bertanggung jawab dan
                                berkelanjutan. Beroperasi sejak tahun 2019, kami tidak hanya berfokus
                                pada pembuangan, tetapi pada filosofi 3R (Reduce, Reuse, Recycle) untuk mengubah sampah
                                menjadi sumber daya bernilai ekonomi dan lingkungan. Kami adalah pusat transformasi
                                lingkungan, edukasi, dan pemberdayaan masyarakat.
                            </p>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center">
                            <img src="{{ asset('landing/img/features-illustration-1.webp') }}" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="features-tab-2">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                            <h3>Visi & Misi</h3>
                            <p class="fs-4 fw-bold mb-1">
                                Visi
                            </p>
                            <p>
                                Menjadi pelopor pengelolaan sampah berbasis masyarakat yang mandiri, berkelanjutan, dan
                                inspiratif di Kabupaten Banyumas, menciptakan lingkungan yang bersih, sehat, dan berdaya
                                ekonomi.
                            </p>
                            <p class="fs-4 fw-bold mb-1">
                                Misi
                            </p>
                            <ul>
                                <li><i class="bi bi-check2-all"></i> <span class="fw-bold">Mengurangi Beban TPA:</span>
                                    Mengolah 80% sampah rumah tangga di tingkat sumber (Grendeng) sehingga mengurangi volume
                                    sampah yang dibuang ke Tempat Pemrosesan Akhir (TPA).</li>
                                <li><i class="bi bi-check2-all"></i> <span class="fw-bold">Pemberdayaan Ekonomi:</span>
                                    Menciptakan produk bernilai jual (kompos, hasil daur ulang) yang dapat meningkatkan
                                    pendapatan dan menciptakan lapangan kerja bagi masyarakat setempat.</li>
                                <li><i class="bi bi-check2-all"></i> <span class="fw-bold">Edukasi dan Kesadaran:</span>
                                    Menjadi pusat pembelajaran (learning center) bagi masyarakat dan institusi dalam praktik
                                    pemilahan dan pengolahan sampah 3R yang benar dan efektif.</li>
                                <li><i class="bi bi-check2-all"></i> <span class="fw-bold">Tata Kelola Profesional:</span>
                                    Menyelenggarakan pengelolaan sampah dengan prinsip tata kelola yang baik (Good
                                    Governance): transparan, akuntabel, dan legal.</li>
                            </ul>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center">
                            <img src="{{ asset('landing/img/features-illustration-2.webp') }}" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="features-tab-3">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                            <h3>Filosofi Operasi</h3>
                            <p class="fs-4 fw-bold mb-1">
                                <i class="bi bi-check2-all text-tps"></i> Reduce (Kurangi)
                            </p>
                            <p class="mb-0">
                                Mendorong masyarakat untuk mengurangi timbulan sampah sejak dari rumah tangga melalui
                                sosialisasi dan edukasi.
                            </p>
                            <small class="mb-4">
                                <span class="fw-bold">Produk/Hasil Utama:</span> Penurunan volume sampah secara keseluruhan.
                            </small>

                            <p class="fs-4 fw-bold mb-1">
                                <i class="bi bi-check2-all text-tps"></i> Reuse (Gunakan Kembali)
                            </p>
                            <p class="mb-0">
                                Memilah material yang masih layak guna untuk dimanfaatkan kembali, mengurangi konsumsi
                                barang baru.
                            </p>
                            <small class="mb-4">
                                <span class="fw-bold">Produk/Hasil Utama:</span> Pemanfaatan botol/wadah, kerajinan dari
                                barang bekas.
                            </small>

                            <p class="fs-4 fw-bold mb-1">
                                <i class="bi bi-check2-all text-tps"></i> Recycle (Daur Ulang)
                            </p>
                            <p class="mb-0">
                                Mengolah sampah organik menjadi kompos berkualitas dan mengolah sampah anorganik menjadi
                                bahan baku daur ulang yang siap jual.
                            </p>
                            <small class="mb-4">
                                <span class="fw-bold">Produk/Hasil Utama:</span> Kompos Grendeng Super (atau sebutkan nama
                                produk), Sampah terpilah (Plastik, Kertas, Logam) siap jual.
                            </small>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center">
                            <img src="{{ asset('landing/img/features-illustration-3.webp') }}" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
