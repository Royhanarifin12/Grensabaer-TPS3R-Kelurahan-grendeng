@extends('layout.landingPage')

@section('pageTitle', 'Transparansi Anggaran')

@section('content')

    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('landing/images/bg_1.jpg') }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 pt-5 text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('root') }}">Home <i class="fa fa-chevron-right"></i></a></span> <span>Laporan Keuangan</span></p>
                    <h1 class="mb-0 bread">Laporan Keuangan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="card mb-5 shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">Pilih Periode Laporan</h3>
                    <form action="{{ route('transparansi') }}" method="GET" id="filterLaporanPublik">
                        <div class="row justify-content-center g-2">
                            
                            <div class="col-md-4 col-12">
                                <label for="filter_bulan" class="form-label">Pilih Bulan</label>
                                <select name="filter_bulan" id="filter_bulan" class="form-control" onchange="document.getElementById('filterLaporanPublik').submit();">
                                    @for ($b = 1; $b <= 12; $b++)
                                        <option value="{{ $b }}" {{ $filter_bulan_aktif == $b ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 col-12">
                                <label for="filter_tahun" class="form-label">Pilih Tahun</label>
                                <select name="filter_tahun" id="filter_tahun" class="form-control" onchange="document.getElementById('filterLaporanPublik').submit();">
                                    @for ($t = date('Y') + 1; $t >= date('Y') - 5; $t--)
                                        <option value="{{ $t }}" {{ $filter_tahun_aktif == $t ? 'selected' : '' }}>
                                            {{ $t }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <h3>Ringkasan Keuangan Periode: {{ $periode_aktif->translatedFormat('F Y') }}</h3>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3 shadow" style="border-radius: 10px;">
                        <div class="card-header text-center" style="font-size: 1.1rem; opacity: 0.8;">Pendapatan Iuran</div>
                        <div class="card-body text-center">
                            <h2 class="card-title">Rp {{ number_format($totalPemasukanIuran, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-white bg-info mb-3 shadow" style="border-radius: 10px;">
                        <div class="card-header text-center" style="font-size: 1.1rem; opacity: 0.8;">Pendapatan Lain</div>
                        <div class="card-body text-center">
                            <h2 class="card-title">Rp {{ number_format($totalPemasukanLain, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card text-white bg-danger mb-3 shadow" style="border-radius: 10px;">
                        <div class="card-header text-center" style="font-size: 1.1rem; opacity: 0.8;">Pengeluaran</div>
                        <div class="card-body text-center">
                            <h2 class="card-title">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card text-dark bg-light mb-3 shadow" style="border-radius: 10px;">
                        <div class="card-header text-center" style="font-size: 1.1rem; opacity: 0.8;">Saldo</div>
                        <div class="card-body text-center">
                            
                            <h2 class="card-title" style="color: {{ $saldoAkhir < 0 ? 'red' : 'black' }};">
                                Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection