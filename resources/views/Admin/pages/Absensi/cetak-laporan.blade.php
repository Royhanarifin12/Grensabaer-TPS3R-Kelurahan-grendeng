<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi Pegawai</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; font-size: 10pt; }
        .container { width: 100%; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 3px double #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 16pt; }
        .header p { margin: 2px 0; font-size: 11pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-size: 11pt; }
        .footer { margin-top: 30px; text-align: right; }
        @media print {
            /* Sembunyikan elemen non-penting saat mencetak */
            .btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <p>Grensaber TPS3R Kelurahan Grendeng</p>
            <h1>LAPORAN ABSENSI PEGAWAI</h1>
            <p>Periode: {{ $periode->translatedFormat('F Y') }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Tanggal</th>
                    <th style="width: 15%; text-align: center;">Hadir</th>
                    <th style="width: 15%; text-align: center;">Sakit</th>
                    <th style="width: 15%; text-align: center;">Izin</th>
                    <th style="width: 15%; text-align: center;">Alpa</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataAbsensi as $data)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</td>
                    <td style="text-align: center;">{{ $data->jumlah_hadir }}</td>
                    <td style="text-align: center;">{{ $data->jumlah_sakit }}</td>
                    <td style="text-align: center;">{{ $data->jumlah_izin }}</td>
                    <td style="text-align: center;">{{ $data->jumlah_alpa }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data absensi pada periode ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <p>Total Pegawai Aktif: {{ $pegawais->count() }} Orang</p>
            <p>Purwokerto, {{ date('d F Y') }}</p>
            <br><br><br>
            <p>(_________________________)</p>
            <p>Kepala TPS3R Kelurahan Grendeng</p>
        </div>
    </div>
    <script>
        // Memicu dialog cetak secara otomatis saat halaman dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>