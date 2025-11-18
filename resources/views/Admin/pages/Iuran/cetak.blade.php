<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @php
        $periodeObj = \Carbon\Carbon::createFromDate($filter_tahun_aktif, $filter_bulan_aktif, 1);
    @endphp
    
    <title>Laporan Iuran {{ $periodeObj->translatedFormat('F Y') }}</title>
    
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #666;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: 600;
        }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .badge {
            padding: 3px 6px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 10px;
        }
        .bg-success { background-color: #d1e7dd; color: #0a3622; }
        .bg-danger { background-color: #f8d7da; color: #58151c; }
        .badge-outline {
            background-color: transparent;
            border: 1px solid #6c757d;
            color: #6c757d;
        }
        .header-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-section h2 {
            margin-bottom: 5px;
            font-size: 1.5rem;
        }
        .header-section h3 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 500;
        }
        .info-cetak {
            font-size: 11px;
            margin-bottom: 10px;
            display: flex; /* Menggunakan flexbox */
            justify-content: space-between; /* Untuk membagi dua sisi */
        }
        .no-print {
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 1000;
        }
        .no-print button {
            padding: 8px 15px;
            font-size: 14px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        @media print {
            .no-print {
                display: none;
            }
            tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print">
        <button onclick="window.print()">Cetak Ulang</button>
    </div>

    <div class="header-section">
        <h2>Laporan Iuran Warga</h2>
        <h3>Periode: {{ $periodeObj->translatedFormat('F Y') }}</h3>
    </div>

    {{-- ⬅️ PERUBAHAN DI SINI ⬅️ --}}
    <div class="info-cetak">
        <div>
            <strong>Filter Aktif:</strong>
            Status: <span class="badge badge-outline">{{ $filter_status_aktif ? $filter_status_aktif : 'Semua' }}</span> |
            RW: <span class="badge badge-outline">{{ $filter_rw_aktif ? $filter_rw_aktif : 'Semua' }}</span> |
            RT: <span class="badge badge-outline">{{ $filter_rt_aktif ? $filter_rt_aktif : 'Semua' }}</span>
        </div>
        <div>
            <strong>Dicetak pada:</strong>
            {{ \Carbon\Carbon::now()->translatedFormat('d F Y \j\a\m H:i') }} WIB
        </div>
    </div>
    {{-- ⬅️ SELESAI PERUBAHAN ⬅️ --}}


    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th>Nama Warga</th>
                <th>Alamat</th>
                <th class="text-center">RT/RW</th>
                <th>Kategori</th>
                <th class="text-end">Tarif (Rp)</th>
                <th class="text-center" style="width: 10%;">Status</th>
                <th class="text-center" style="width: 12%;">Tgl. Bayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataIuran as $warga)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $warga->nama_lengkap }}</td>
                    <td>{{ $warga->alamat }}</td>
                    <td class="text-center">{{ $warga->rt }}/{{ $warga->rw }}</td>
                    <td>{{ optional($warga->kategori)->nama_kategori ?? '-' }}</td>
                    <td class="text-end">{{ number_format($warga->tarif_iuran, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if ($warga->status_bayar == 'Lunas')
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-danger">Menunggak</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($warga->tanggal_bayar)
                            {{ \Carbon\Carbon::parse($warga->tanggal_bayar)->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data untuk filter yang dipilih.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>