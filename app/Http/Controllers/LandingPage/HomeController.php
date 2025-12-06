<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Pegawai;
use App\Models\VolumeSampah;
use App\Models\Artikel;
use App\Models\Pengaduan;
use App\Models\Testimoni;
use App\Models\Proyek;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $totalWarga = Warga::where('status_warga', 'Aktif')->count();
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;
        $totalKinerjaBulanIni = VolumeSampah::whereYear('tanggal', $tahunIni)
            ->whereMonth('tanggal', $bulanIni)
            ->sum(DB::raw('organik + anorganik + residu'));

        $totalPegawai = Pegawai::count();

        $testimonis = Testimoni::where('tampilkan_di_beranda', true)
            ->latest()
            ->limit(6)
            ->get();

        $pegawai = Pegawai::select('nama', 'foto', 'posisi')->orderBy('posisi')->get();

        $artikels = Artikel::latest()->take(6)->get();

        $proyeks = Proyek::latest()->get();

        return view('LandingPage.pages.Home.index', compact(
            'totalWarga',
            'totalKinerjaBulanIni',
            'totalPegawai',
            'pegawai',
            'testimonis',
            'artikels',
            'proyeks'
        ));
    }
}
