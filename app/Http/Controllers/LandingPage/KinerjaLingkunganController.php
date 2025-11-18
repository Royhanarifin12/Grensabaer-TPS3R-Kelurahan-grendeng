<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;
use App\Models\VolumeSampah;
use App\Models\Warga;
use Carbon\Carbon;

class KinerjaLingkunganController
{
    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.KinerjaLingkungan.';
    }

    public function index()
    {
        $targetBulan = Carbon::now()->subMonth();

        $namaBulanLaporan = $targetBulan->translatedFormat('F Y');

        $totalOrganik = VolumeSampah::whereYear('tanggal', $targetBulan->year)
                                    ->whereMonth('tanggal', $targetBulan->month)
                                    ->sum('organik');

        $totalAnorganik = VolumeSampah::whereYear('tanggal', $targetBulan->year)
                                    ->whereMonth('tanggal', $targetBulan->month)
                                    ->sum('anorganik');

        $totalResidu = VolumeSampah::whereYear('tanggal', $targetBulan->year)
                                    ->whereMonth('tanggal', $targetBulan->month)
                                    ->sum('residu');

        $totalSampah = $totalOrganik + $totalAnorganik + $totalResidu;
        $totalDikelola = $totalOrganik + $totalAnorganik;

        if ($totalSampah > 0) {
            $persenOrganik = round(($totalOrganik / $totalSampah) * 100);
            $persenAnorganik = round(($totalAnorganik / $totalSampah) * 100);
            $persenResidu = 100 - $persenOrganik - $persenAnorganik;
            $persenDikelola = round(($totalDikelola / $totalSampah) * 100);
        } else {
            $persenOrganik = 0;
            $persenAnorganik = 0;
            $persenResidu = 0;
            $persenDikelola = 0;
        }

        $jumlahWargaAktif = Warga::count();
    
        $totalEkonomiRupiah = VolumeSampah::whereYear('tanggal', $targetBulan->year)
                                          ->whereMonth('tanggal', $targetBulan->month)
                                          ->sum('nilai_ekonomi');

        if ($totalEkonomiRupiah >= 1000000) {
            $nilaiEkonomiFormatted = round($totalEkonomiRupiah / 1000000, 1) . ' Jt';
        } elseif ($totalEkonomiRupiah > 0) {
            $nilaiEkonomiFormatted = round($totalEkonomiRupiah / 1000, 0) . ' Rb';
        } else {
            
            $nilaiEkonomiFormatted = '0';
        }

        return view($this->viewPath . 'index', compact(
            'namaBulanLaporan',
            'totalSampah',
            'totalOrganik',
            'totalAnorganik',
            'totalResidu',
            'totalDikelola',
            'persenOrganik',
            'persenAnorganik',
            'persenResidu',
            'persenDikelola',
            'jumlahWargaAktif',
            'nilaiEkonomiFormatted'
        ));
    }
}