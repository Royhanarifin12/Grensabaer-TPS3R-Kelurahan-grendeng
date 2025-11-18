<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PemasukanLain; // 1. Panggil Model yang kita buat
use Illuminate\Http\Request;
use Carbon\Carbon;

class PemasukanLainController extends Controller
{
    // Tentukan path view untuk file blade kita nanti
    protected $viewPath = 'Admin.pages.PemasukanLain.';

    /**
     * Menampilkan daftar semua pemasukan lain.
     */
    public function index()
    {
        // Ambil semua data, urutkan dari yang terbaru
        $dataPemasukan = PemasukanLain::latest()->get();
        
        // Hitung total
        $totalPemasukan = $dataPemasukan->sum('jumlah');

        return view($this->viewPath . 'index', [
            'dataPemasukan' => $dataPemasukan,
            'totalPemasukan' => $totalPemasukan
        ]);
    }

    /**
     * Menampilkan form untuk menambah data baru.
     */
    public function create()
    {
        // Hanya menampilkan form
        return view($this->viewPath . 'create');
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'kategori' => 'nullable|string|max:100',
        ]);

        // 2. Buat data baru
        PemasukanLain::create($validated);

        // 3. Kembali ke halaman index
        return redirect()->route('admin.pemasukan-lain.index')
                         ->with('success', 'Data pemasukan lain berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data.
     * (Route model binding: Laravel otomatis mencari data berdasarkan ID)
     */
    public function edit(PemasukanLain $pemasukanLain)
    {
        // Kirim data pemasukan yang mau diedit ke view
        return view($this->viewPath . 'edit', [
            'pemasukan' => $pemasukanLain
        ]);
    }

    /**
     * Memperbarui data di database.
     */
    public function update(Request $request, PemasukanLain $pemasukanLain)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'kategori' => 'nullable|string|max:100',
        ]);

        // 2. Update data
        $pemasukanLain->update($validated);

        // 3. Kembali ke halaman index
        return redirect()->route('admin.pemasukan-lain.index')
                         ->with('success', 'Data pemasukan lain berhasil diperbarui.');
    }

    /**
     * Menghapus data dari database.
     */
    public function destroy(PemasukanLain $pemasukanLain)
    {
        // Hapus data
        $pemasukanLain->delete();

        // Kembali ke halaman index
        return redirect()->route('admin.pemasukan-lain.index')
                         ->with('success', 'Data pemasukan lain berhasil dihapus.');
    }
}