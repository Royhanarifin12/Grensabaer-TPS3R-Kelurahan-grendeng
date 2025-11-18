<?php

namespace App\Http\Controllers\LandingPage;

use App\Models\Pengaduan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FormPengaduanController
{

    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.FormPengaduan.';
    }

    public function index()
    {
        $sevenDaysAgo = Carbon::now()->subDays(7);

        $pengaduan = Pengaduan::where('created_at', '>=', $sevenDaysAgo)
            ->orderBy('created_at', 'desc')
            ->get();

        return view($this->viewPath . 'index', compact('pengaduan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required'],
            'no_telp' => ['required'],
            'alamat' => ['required'],
            'pengaduan' => ['required'],
        ]);

        Pengaduan::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'pengaduan' => $request->pengaduan,
            'status' => 'menunggu',
        ]);


        return redirect('/form-pengaduan')->with('pengaduanSuccess', 'true');
    }
}
