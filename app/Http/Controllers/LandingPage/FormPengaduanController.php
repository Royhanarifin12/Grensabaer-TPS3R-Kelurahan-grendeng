<?php

namespace App\Http\Controllers\LandingPage;

use App\Models\Pengaduan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormPengaduanController extends Controller
{

    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.FormPengaduan.';
    }

    public function index()
    {
        $hasilPencarian = session('hasilPencarian');
        $keyword = session('keyword');

        $sevenDaysAgo = Carbon::now()->subDays(7);

        $pengaduan = Pengaduan::where('created_at', '>=', $sevenDaysAgo)
            ->where('created_at', '>=', $sevenDaysAgo)
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();
        
        $hasilPencarian = session('hasilPencarian');
        $keyword = session('keyword');

        return view($this->viewPath . 'index', compact('pengaduan', 'hasilPencarian', 'keyword'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'      => ['required'],
            'no_telp'   => ['required'],
            'alamat'    => ['required'],
            'pengaduan' => ['required'],
        ]);

        Pengaduan::create([
            'nama'      => $request->nama,
            'no_telp'   => $request->no_telp,
            'alamat'    => $request->alamat,
            'pengaduan' => $request->pengaduan,
            'status'    => 'menunggu',
            'tampilkan_di_beranda'  => false,
        ]);

        return redirect('/form-pengaduan')->with('pengaduanSuccess', 'true');
    }

    public function cari(Request $request)
    {
        $request->validate([
            'no_telp' => 'required|string'
        ]);

        $keyword = $request->input('no_telp');

        $hasilPencarian = Pengaduan::where('no_telp', $keyword)
            ->orderBy('created_at', 'desc')
            ->get();

        return redirect()->route('form-pengaduan')
            ->with('hasilPencarian', $hasilPencarian)
            ->with('keyword', $keyword);
    }
}
