@extends('layout.adminPage')

@section('pageTitle', 'Dashboard')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    {{-- Warga Aktif Card --}}
                    <div class="col-6 col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Warga Aktif</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalWargaAktif }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Iuran Bulan Ini Card --}}
                    <div class="col-6 col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldWallet"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Iuran Bulan Ini</h6>
                                        <h6 class="font-extrabold mb-0">Rp {{ number_format($iuranBulanIni, 0, ',', '.') }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Pengeluaran Bulan Ini Card --}}
                    <div class="col-6 col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldWork"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pengeluaran Bulan Ini</h6>
                                        <h6 class="font-extrabold mb-0">Rp
                                            {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Pengaduan Baru Card --}}
                    <div class="col-6 col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="bi-megaphone-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pengaduan Baru</h6>
                                        <h6 class="font-extrabold mb-0">{{ $pengaduanBaru }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Grafik Keuangan --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Grafik Keuangan (6 Bulan Terakhir)</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-keuangan"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Kolom Kanan --}}
            <div class="col-12 col-lg-3">
                {{-- Status Iuran --}}
                <div class="card">
                    <div class="card-header">
                        <h4>Status Iuran Bulan Ini</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-status-iuran"></div>
                    </div>
                </div>
                {{-- Pengaduan Terbaru --}}
                <div class="card">
                    <div class="card-header bg-primary text-white py-3">
                        
                        {{-- START: PERBAIKAN ERROR VARIABEL --}}
                        <h5 class="card-title m-0">
                            <i class="bi bi-chat-left-dots"></i> {{ $pengaduanHariIni }} Pengaduan Baru Hari Ini
                        </h5>
                        {{-- END: PERBAIKAN ERROR VARIABEL --}}

                    </div>
                    <div class="card-content pb-4">
                        <div style="max-height: 400px; overflow-y: auto;">
                            @forelse ($pengaduanTerbaru as $pengaduan)
                                <div class="d-flex px-4 py-3 border-bottom">
                                    <div class="avatar avatar-lg">
                                        <span
                                            class="avatar-content bg-info rounded-circle">{{ substr($pengaduan->nama ?? 'W', 0, 1) }}</span>
                                    </div>
                                    <div class="name ms-4">
                                        <h6 class="mb-1 text-primary">{{ $pengaduan->nama ?? 'Warga Anonim' }}</h6>
                                        <p class="text-muted text-sm mb-0">{{ Str::limit($pengaduan->pengaduan, 50) }}</p>
                                        <small class="text-muted">{{ $pengaduan->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @empty
                                <div class="px-4 py-3 text-center">
                                    <p class="text-muted mb-0">🎉 Tidak ada pengaduan baru hari ini. Santai!</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="px-4 mt-3">
                            <a href="{{ route('admin.daftar-pengaduan') }}"
                                class='btn btn-block btn-outline-primary font-bold'>
                                Lihat Semua Pengaduan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- START: PERBAIKAN NAMA STACK (script -> scripts) --}}
@push('scripts')
    <script src="{{ asset('admin/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Memeriksa apakah elemen grafik ada sebelum me-render
            var chartKeuanganEl = document.querySelector("#chart-keuangan");
            if (chartKeuanganEl) {
                var optionsKeuangan = {
                    series: [{
                            name: "Pemasukan Iuran",
                            data: @json($grafikData['pemasukan'])
                        },
                        {
                            name: "Pengeluaran",
                            data: @json($grafikData['pengeluaran'])
                        }
                    ],
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: @json($grafikData['labels']),
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah (Rp)'
                        },
                        labels: {
                            formatter: function(val) {
                                return "Rp " + val.toLocaleString('id-ID');
                            }
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "Rp " + val.toLocaleString('id-ID')
                            }
                        }
                    },
                    colors: ['#435EBE', '#F3616D']
                };
                var chartKeuangan = new ApexCharts(chartKeuanganEl, optionsKeuangan);
                chartKeuangan.render();
            } else {
                console.error('Elemen #chart-keuangan tidak ditemukan.');
            }

            var chartStatusIuranEl = document.querySelector("#chart-status-iuran");
            if (chartStatusIuranEl) {
                var optionsStatusIuran = {
                    series: [@json($statusIuranData['lunas']), @json($statusIuranData['menunggak'])],
                    labels: ['Lunas', 'Menunggak'],
                    chart: {
                        type: 'donut',
                        height: 350
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        showAlways: true,
                                        show: true,
                                        label: ' Warga Aktif',
                                        formatter: function(w) {
                                            return @json($totalWargaAktif);
                                        }
                                    }
                                }
                            }
                        }
                    },
                    colors: ['#54B435', '#F3616D'],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };
                var chartStatusIuran = new ApexCharts(chartStatusIuranEl, optionsStatusIuran);
                chartStatusIuran.render();
            } else {
                console.error('Elemen #chart-status-iuran tidak ditemukan.');
            }
        });
    </script>
@endpush
{{-- END: PERBAIKAN NAMA STACK --}}