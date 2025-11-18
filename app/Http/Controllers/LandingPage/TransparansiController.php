<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran; 
use App\Models\Pengeluaran; 
use App\Models\PemasukanLain;
use Carbon\Carbon;

class TransparansiController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil filter bulan dan tahun (default: bulan/tahun sekarang)
        $bulan = (int) $request->input('filter_bulan', Carbon::now()->month);
        $tahun = (int) $request->input('filter_tahun', Carbon::now()->year);
        $periode = Carbon::createFromDate($tahun, $bulan, 1)->format('Y-m');

        $totalPemasukanIuran = Pembayaran::where('periode_bulan_tahun', $periode)->sum('jumlah_bayar');

        $queryPemasukanLain = PemasukanLain::whereYear('tanggal', $tahun)
                                          ->whereMonth('tanggal', $bulan);

        $totalPemasukanLain = $queryPemasukanLain->sum('jumlah');
        $detailPemasukanLain = $queryPemasukanLain->orderBy('tanggal', 'asc')->get(); // Ambil rinciannya

        $totalPengeluaran = Pengeluaran::whereYear('tanggal', $tahun)
                                        ->whereMonth('tanggal', $bulan)
                                        ->sum('jumlah');

        $detailPengeluaran = Pengeluaran::whereYear('tanggal', $tahun)
                                          ->whereMonth('tanggal', $bulan)
                                          ->orderBy('tanggal', 'asc')
                                          ->get();

        $totalPemasukan = $totalPemasukanIuran + $totalPemasukanLain; // Total Pemasukan
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        return view('LandingPage.pages.Transparansi.index', [
            'totalPemasukan' => $totalPemasukan,
            'totalPemasukanIuran' => $totalPemasukanIuran,
            'totalPemasukanLain' => $totalPemasukanLain,
            'totalPengeluaran' => $totalPengeluaran,
            'saldoAkhir' => $saldoAkhir,
            'detailPemasukanLain' => $detailPemasukanLain,
            'detailPengeluaran' => $detailPengeluaran,
            'filter_bulan_aktif' => $bulan,
            'filter_tahun_aktif' => $tahun,
            'periode_aktif' => Carbon::createFromDate($tahun, $bulan, 1) // Kirim objek Carbon
        ]);
    }
}