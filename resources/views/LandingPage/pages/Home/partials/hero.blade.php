<section id="hero" class="hero section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                    <h1 class="text-tps mb-4">
                        Grensaber TPS3R<br>
                        <span class="text-dark">Kelurahan Grendeng</span>
                    </h1>
                    <p class="mb-4 mb-md-4">
                        Sistem informasi publik untuk transparansi data anggaran, pelaporan kinerja,
                        dan saluran pengaduan warga terkait layanan Grensaber TPS3R Kelurahan Grendeng.
                    </p>
                    <div class="hero-buttons">
                        <a href="{{ route('form-pengaduan') }}" class="btn btn-primary me-0 me-sm-2 mx-1">
                            <i class="bi bi-send me-1"></i>
                            Kirim Pengaduan
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                    <img src="{{ asset('landing/img/protecting-the-environment-bro.svg') }}" alt="Ilustrasi Pengelolaan Sampah"
                        class="img-fluid">
                </div>
            </div>
        </div>
        <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
            <div class="col-lg-4 col-md-6">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-content">
                        <h4>{{ $totalWarga }} Warga</h4>
                        <p class="mb-0">Telah Terlayani</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-recycle"></i>
                    </div>
                    <div class="stat-content">
                        <h4>{{ number_format($totalKinerjaBulanIni, 0, ',', '.') }} kg</h4>
                        <p class="mb-0">Sampah Terkelola (Bulan Ini)</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="stat-content">
                        <h4>{{ $totalPegawai }} Pegawai</h4>
                        <p class="mb-0">Bertugas Melayani</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
