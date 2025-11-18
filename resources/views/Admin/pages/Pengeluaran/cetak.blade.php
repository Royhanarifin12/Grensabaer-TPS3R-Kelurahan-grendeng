<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengeluaran</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; }
        .container { width: 95%; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        .header p { margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .total-row th, .total-row td { font-weight: bold; }
        .filter-info {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .no-print { margin-bottom: 15px; }
        
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="no-print">
            <button onclick="window.print()">Cetak Halaman Ini</button>
            <a href="{{ route('admin.pengeluaran.index', $input ?? []) }}">Kembali ke Laporan</a>
        </div>

        <div class="header">
            <h1>Laporan Pengeluaran</h1>
            <p>TPS3R Kelurahan Grendeng</p>
        </div>

        <div class="filter-info">
            <strong>Filter Laporan:</strong><br>
            @php
                // Default ke 'tanggal' jika tidak ada input
                $filterType = $input['filter_type'] ?? 'tanggal';
            @endphp

            @if($filterType == 'bulan')
                Tipe: Per Bulan & Tahun <br>
                Bulan: {{ isset($input['bulan']) ? \Carbon\Carbon::create(null, $input['bulan'], 1)->translatedFormat('F') : 'Semua' }} <br>
                Tahun: {{ $input['tahun'] ?? date('Y') }}
            @else
                Tipe: Per Tanggal <br>
                Tanggal Mulai: {{ $input['tanggal_mulai'] ?? 'Semua' }} <br>
                Tanggal Selesai: {{ $input['tanggal_selesai'] ?? 'Semua' }}
            @endif
            <br>
            Kategori: {{ $kategoriTerpilih->nama ?? 'Semua Kategori' }}
        </div>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Kategori</th>
                    <th class="text-end">Jumlah (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataPengeluaran as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->kategoriPengeluaran->nama ?? '-' }}</td>
                        <td class="text-end">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            Tidak ada data pengeluaran untuk filter ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <th colspan="3" class="text-end">Total Pengeluaran:</th>
                    <th class="text-end">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>