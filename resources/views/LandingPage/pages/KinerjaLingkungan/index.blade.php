@extends('layout.landingPage') 
@section('content')

    <style>
        .metric-container-v2 {
            display: flex;
            justify-content: space-around;
            gap: 20px;
            padding: 20px 0;
            flex-wrap: wrap;
        }

        .metric-card-v2 {
            flex: 1;
            min-width: 300px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 25px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .metric-card-v2:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header .icon-bg {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            margin-right: 15px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.3em;
            color: #333;
        }

        .card-volume .icon-bg {
            background-color: #e0f2f1;
            color: #00796b;
        }

        .main-value {
            font-size: 2.0em;
            font-weight: bold;
            color: #1a202c;
        }

        .stacked-bar-container {
            width: 100%;
            height: 12px;
            background-color: #e0e0e0;
            border-radius: 6px;
            display: flex;
            overflow: hidden;
            margin: 10px 0;
        }

        .bar-segment {
            height: 100%;
            transition: width 0.5s ease;
        }

        .bar-organik {
            background-color: #38a169;
        }

        .bar-anorganik {
            background-color: #4299e1;
        }

        .bar-residu {
            background-color: #e53e3e;
        }

        .legend-list {
            list-style: none;
            padding: 0;
            margin-top: 15px;
            font-size: 0.9em;
        }

        .legend-list li {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            color: #555;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .card-processing .icon-bg {
            background-color: #e3f2fd;
            color: #1e88e5;
        }

        .dual-metric {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            text-align: center;
        }

        .dual-metric div {
            flex-basis: 48%;
        }

        .dual-metric .value-sub {
            font-size: 1.6em;
            font-weight: 600;
            color: #1e88e5;
        }

        .dual-metric .label-sub {
            font-size: 0.9em;
            color: #777;
        }

        .card-impact .icon-bg {
            background-color: #fff3e0;
            color: #f57c00;
        }

        .impact-chart-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .impact-chart {
            position: relative;
            width: 110px;
            height: 95px;
            border-radius: 50%;
            transition: background 0.5s ease;
        }

        .impact-percentage {
            position: absolute;
            width: 50px;
            height: 50px;
            background: #fff;
            border-radius: 50%;
            top: 22px;
            left: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2em;
            font-weight: bold;
            color: #38a169;
            z-index: 2; 
        }
        
        #impactDoughnutChart {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;  
            height: 100% !important; 
            z-index: 1;
        }
      
        .impact-details {
            list-style: none;
            padding: 0;
        }

        .impact-details li {
            font-size: 1.0em;
            color: #444;
            margin-bottom: 8px;
        }

        .no-data-container {
            text-align: center;
            padding: 50px 20px;
            background-color: #f9f9f9;
            border-radius: 12px;
            border: 1px dashed #ccc;
        }

        .no-data-container h3 {
            color: #777;
            font-size: 1.5em;
        }

        .no-data-container p {
            color: #999;
            font-size: 1.1em;
        }
    </style>

    <div class="page-title light-background">
        <div class="container">
            <h1 class="mb-3">Kinerja Lingkungan TPS3R Grendeng</h1>
                <h3 style="color: #555;">Laporan Bulan: {{ $namaBulanLaporan }}</h3>
        </div>
    </div>

 <section class="section">
    <div class="container my-5">
        <div class="row mt-4">
            <div class="col-12">

                @if ($totalSampah > 0)
                    <div class="metric-container-v2">
                        <div class="metric-card-v2 card-volume">
                            <div class="card-header">
                                <div class="icon-bg">🗑️</div>
                                <h3>Volume Sampah Masuk</h3>
                            </div>

                            <div class="main-value">{{ number_format($totalSampah, 0, ',', '.') }} Kg</div>
                            <p style="font-size: 0.9em; color: #777;">Total sampah yang diterima bulan ini</p>

                            <div class="stacked-bar-container">
                                <div class="bar-segment bar-organik" style="width: {{ $persenOrganik }}%;"
                                    title="Organik {{ $persenOrganik }}%"></div>
                                <div class="bar-segment bar-anorganik" style="width: {{ $persenAnorganik }}%;"
                                    title="Anorganik {{ $persenAnorganik }}%"></div>
                                <div class="bar-segment bar-residu" style="width: {{ $persenResidu }}%;"
                                    title="Residu {{ $persenResidu }}%"></div>
                            </div>
                            <ul class="legend-list">
                                <li><span class="legend-dot" style="background-color: #38a169;"></span> Organik
                                    ({{ $persenOrganik }}%) - {{ number_format($totalOrganik, 0, ',', '.') }} Kg</li>
                                <li><span class="legend-dot" style="background-color: #4299e1;"></span> Anorganik
                                    ({{ $persenAnorganik }}%) - {{ number_format($totalAnorganik, 0, ',', '.') }} Kg</li>
                                <li><span class="legend-dot" style="background-color: #e53e3e;"></span> Residu ke TPA
                                    ({{ $persenResidu }}%) - {{ number_format($totalResidu, 0, ',', '.') }} Kg</li>
                            </ul>
                        </div>

                        <div class="metric-card-v2 card-processing">
                            <div class="card-header">
                                <div class="icon-bg">♻️</div>
                                <h3>Hasil Pengelolaan</h3>
                            </div>
                            <p style="font-size: 0.9em; color: #777;">Total material yang berhasil diolah dan memiliki
                                nilai.</p>

                            <div class="dual-metric">
                                <div>
                                    <div class="value-sub">{{ number_format($totalDikelola, 0, ',', '.') }} Kg</div>
                                    <div class="label-sub">Material Dikelola</div>
                                </div>
                                <div>
                                    <div class="value-sub">{{ $nilaiEkonomiFormatted }}*</div>
                                    <div class="label-sub">Estimasi Nilai Ekonomi</div>
                                </div>
                            </div>
                            <p style="font-size: 0.9em; color: #777; margin-top: 20px;">
                            </p>
                        </div>

                        <div class="metric-card-v2 card-impact">
                            <div class="card-header">
                                <div class="icon-bg">🎯</div>
                                <h3>Dampak & Efisiensi</h3>
                            </div>
                            <div class="impact-chart-container">
                                <div class="impact-chart">
                                    <canvas id="impactDoughnutChart"></canvas>
                                    <div class="impact-percentage">{{ $persenDikelola }}%</div>
                                </div>

                                <ul class="impact-details">
                                    <li><strong style="color: #38a169;">Efisiensi Pengalihan</strong> (Sampah tidak ke TPA)
                                    </li>
                                    <li style="margin-top: 15px;">💨 Mengurangi Gas Metana</li>
                                    <li>👨‍👩‍👧‍👦 {{ $jumlahWargaAktif }} KK Warga Aktif</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="no-data-container">
                        <h3>Data Kinerja Bulan {{ $namaBulanLaporan }} Belum Tersedia</h3>
                        <p>Admin belum melakukan input data operasional untuk bulan lalu. Silakan periksa kembali nanti.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            
            @if ($totalSampah > 0)
                
                const persenDikelola = {{ $persenDikelola }};
                const persenSisa = 100 - persenDikelola;

                const data = {
                    datasets: [{
                        data: [persenDikelola, persenSisa],
                        backgroundColor: [
                            '#38a169', 
                            '#e9ecef' 
                        ],
                        borderColor: [
                            '#ffffff', 
                            '#ffffff'
                        ],
                        borderWidth: 2, 
                        cutout: '65%'
                    }]
                };

                const options = {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false 
                        },
                        tooltip: {
                            enabled: false 
                        }
                    },
                    events: [] 
                };

                const ctx = document.getElementById('impactDoughnutChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: data,
                    options: options
                });

            @endif
        });
    </script>
@endsection