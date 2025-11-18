<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Warga;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWargaAktif = Warga::where('status_warga', 'Aktif')->count();
        
        $pengaduanBaru = Pengaduan::where('status', 'Menunggu')->count(); 
        
        $periodeIni = Carbon::now()->format('Y-m');
        $iuranBulanIni = Pembayaran::where('periode_bulan_tahun', $periodeIni)->sum('jumlah_bayar');
        
        $pengeluaranBulanIni = Pengeluaran::where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m')"), $periodeIni)->sum('jumlah');

        $wargaSudahBayar = Pembayaran::where('periode_bulan_tahun', $periodeIni)->count();
        $wargaBelumBayar = $totalWargaAktif - $wargaSudahBayar;
        
        $wargaBelumBayar = max(0, $wargaBelumBayar); 

        $statusIuranData = [
            'lunas' => $wargaSudahBayar,
            'menunggak' => $wargaBelumBayar,
        ];

        // Query untuk judul (Hanya hari ini)
        $pengaduanHariIni = Pengaduan::whereDate('created_at', today())->where('status', 'Menunggu')->count(); 
        
        $pengaduanTerbaru = Pengaduan::whereDate('created_at', today())
                                     ->where('status', 'Menunggu')
                                     ->orderBy('created_at', 'desc')
                                     ->get();

        // dd($pengaduanHariIni);
        

        $grafikData = $this->getGrafikKeuangan6Bulan();

        return view('Admin.pages.Dashboard.index', [ 
            'totalWargaAktif' => $totalWargaAktif,
            'pengaduanBaru' => $pengaduanBaru,
            'iuranBulanIni' => $iuranBulanIni,
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
            'statusIuranData' => $statusIuranData,
            'pengaduanTerbaru' => $pengaduanTerbaru,  
            'pengaduanHariIni' => $pengaduanHariIni,  
            'grafikData' => $grafikData,
        ]);
    }


    private function getGrafikKeuangan6Bulan()
    {
        $labels = [];
        $pemasukanData = [];
        $pengeluaranData = [];

        for ($i = 5; $i >= 0; $i--) {
            $carbonDate = Carbon::now()->subMonths($i);
            $bulanTahun = $carbonDate->format('Y-m');
            $labelBulan = $carbonDate->translatedFormat('M'); 

            $labels[] = $labelBulan;

            $pemasukan = Pembayaran::where('periode_bulan_tahun', $bulanTahun)->sum('jumlah_bayar');
            $pemasukanData[] = $pemasukan;

            $pengeluaran = Pengeluaran::where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m')"), $bulanTahun)->sum('jumlah');
            $pengeluaranData[] = $pengeluaran;
        }

        return [
            'labels' => $labels, 
            'pemasukan' => $pemasukanData,
            'pengeluaran' => $pengeluaranData,
        ];
    }
}