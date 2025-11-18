@extends('layout.LandingPage')

@section('content')
    <style>
        .page-title-section {
            background-color: #f8f9fa;
            padding: 50px 0;
            text-align: center;

        }

        .page-title-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .page-title-section p {
            font-size: 1.1rem;
            color: #666;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }


        .panduan-section {
            padding: 60px 0;
        }

        .panduan-container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            padding-bottom: 30px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
        }

        .pemilahan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }

        .pemilahan-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 30px;
            background-color: #ffffff;
        }

        .pemilahan-card h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .pemilahan-card h4 i {
            margin-right: 10px;
            font-size: 1.8rem;
            vertical-align: middle;
        }

        .icon-organik {
            color: #28a745;
        }

        .icon-anorganik {
            color: #007bff;
        }

        .icon-residu {
            color: #dc3545;
        }

        .pemilahan-card p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }

        .pemilahan-card ul {
            padding-left: 20px;
            margin: 0;
            color: #666;
        }

        .pemilahan-card li {
            margin-bottom: 8px;
        }

        .jadwal-table-container {
            overflow-x: auto;
            margin-top: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .jadwal-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 1rem;
        }

        .jadwal-table th,
        .jadwal-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
        }

        .jadwal-table th {
            background-color: #f9f9f9;
            font-weight: 700;
            color: #333;
        }

        .jadwal-table tr:last-child td {
            border-bottom: none;
        }

        .jadwal-table td strong {
            color: #333;
        }
    </style>

    <main id="main">

        

        <section id="aturan-pemilahan" class="page-title light-background">
            <div class="panduan-container">
                <div class="page-title-section">
                    <h2>Aturan Pemilahan Sampah</h2>
                    <p>Pemilahan sampah dari rumah adalah langkah awal terpenting untuk membantu proses daur
                        ulang dan pengomposan. Pastikan Anda memisahkan sampah ke dalam 3 kategori berikut:</p>
                </div>

                <div class="pemilahan-grid">
                    <div class="pemilahan-card">
                        <h4><i class="bi bi-apple icon-organik"></i> SAMPAH ORGANIK</h4>
                        <p>Sampah yang mudah membusuk dan akan kami olah menjadi kompos.</p>
                        <strong>Contoh:</strong>
                        <ul>
                            <li>Sisa nasi, sayur, dan buah</li>
                            <li>Cangkang telur</li>
                            <li>Daun kering, ranting, rumput</li>
                            <li>Ampas kopi/teh</li>
                        </ul>
                    </div>

                    <div class="pemilahan-card">
                        <h4><i class="bi bi-recycle icon-anorganik"></i> SAMPAH ANORGANIK</h4>
                        <p>Sampah yang bisa didaur ulang. Harap setorkan dalam keadaan bersih dan kering.
                        </p>
                        <strong>Contoh:</strong>
                        <ul>
                            <li>Botol & gelas plastik (bersih)</li>
                            <li>Kardus, kertas, koran</li>
                            <li>Kaleng minuman (bersih)</li>
                            <li>Pecahan kaca (dibungkus aman)</li>
                        </ul>
                    </div>

                    <div class="pemilahan-card">
                        <h4><i class="bi bi-exclamation-triangle-fill icon-residu"></i> RESIDU / B3</h4>
                        <p>Sampah yang tidak bisa didaur ulang maupun dikomposkan oleh kami.</p>
                        <strong>Contoh:</strong>
                        <ul>
                            <li>Popok bayi (diapers) & pembalut</li>
                            <li>Kemasan sachet (kopi, mie instan)</li>
                            <li>Stereofoam & plastik kresek</li>
                            <li>Baterai bekas & lampu</li>
                        </ul>
                    </div>

                </div>

            </div>
        </section>


        <section id="jadwal-layanan" class="panduan-section" style="background-color: #f9f9f9;">
            <div class="panduan-container">

                <div class="section-title">
                    <h2>Jadwal Layanan Kami</h2>
                    <p>Kami melayani pengambilan sampah terpilah sesuai jadwal berikut. Pastikan sampah sudah
                        diletakkan di depan rumah Anda sebelum jam penjemputan.</p>
                </div>

                <div class="jadwal-table-container">
                    <table class="jadwal-table">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Wilayah Penjemputan</th>
                                <th>Jam Operasional</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Senin & Kamis</strong></td>
                                <td>RW 01, RW 02, RW 03</td>
                                <td>08.00 - 12.00 WIB</td>
                            </tr>
                            <tr>
                                <td><strong>Selasa & Jumat</strong></td>
                                <td>RW 04, RW 05, RW 06</td>
                                <td>08.00 - 12.00 WIB</td>
                            </tr>
                            <tr>
                                <td><strong>Rabu & Sabtu</strong></td>
                                <td>RW 07, RW 08</td>
                                <td>08.00 - 12.00 WIB</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Setor Mandiri ke Lokasi TPS3R</strong>
                                </td>
                                <td><strong>08.00 - 16.00 WIB (Setiap Hari Kerja)</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </section>

    </main>
@endsection
