<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\JadwalLayanan;
use App\Models\AturanPemilahan;
use Illuminate\Http\Request;

class PanduanWargaController extends Controller
{
    public function index()
    {
        $jadwal = JadwalLayanan::all();
        $aturan = AturanPemilahan::orderBy('id', 'asc')->get();

        return view('LandingPage.pages.PanduanWarga.index', compact('jadwal', 'aturan'));
    }

    public function storejadwal(Request $request)
    {
        $request->validate([
            'hari'            => 'required',
            'wilayah'         => 'required',
            'jam_operasional' => 'required',
        ]);

        JadwalLayanan::create($request->all());

        return redirect()->back()->with('success', 'jadwal berhasil ditambahkan!');
    }

    public function updateJadwal(Request $request, $id)
    {
        $jadwal = JadwalLayanan::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->back()->with('success', 'jadwal berhasil diperbarui!');
    }

    public function destroyJadwal($id)
    {
        JadwalLayanan::destroy($id);

        return redirect()->back()->with('success', 'Jadwal dihapus');
    }

    public function updateAturan(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'contoh'    => 'required|string',
        ]);

        $aturan = AturanPemilahan::findOrFail($id);
        
        $aturan->update([
            'deskripsi' => $request->deskripsi,
            'contoh'    => $request->contoh
        ]);

        return redirect()->back()->with('success', 'Info pemilahan berhasil diperbarui!');
    }
    public function destroyAturan($id)
    {
        AturanPemilahan::destroy($id);
        return redirect()->back()->with('success', 'Aturan dihapus!');
    }
}
