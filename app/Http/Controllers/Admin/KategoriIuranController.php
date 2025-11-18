<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriIuran;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriIuranController extends Controller
{
    // Sesuaikan path view Anda
    protected $viewPath = 'Admin.pages.KategoriIuran.'; 
    
    // Saya ganti $kategoris menjadi $kategoriIuran agar konsisten dengan Model
    public function index()
    {
        $kategoriIuran = KategoriIuran::orderBy('tarif', 'asc')->get();
        // Menggunakan variabel $kategoriIuran sesuai dengan yang digunakan di index.blade.php
        return view($this->viewPath . 'index', compact('kategoriIuran')); 
    }

    public function create()
    {
        return view($this->viewPath . 'create');
    }

    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_iurans,nama_kategori',
            // Gunakan 'numeric' atau 'integer' di sini. Karena di Model Anda menggunakan 'decimal:2', 'numeric' lebih fleksibel.
            'tarif' => 'required|numeric|min:0', 
        ], [
            'nama_kategori.required' => 'Nama Kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama Kategori ini sudah terdaftar.',
            'tarif.required' => 'Tarif iuran wajib diisi.',
            'tarif.numeric' => 'Tarif harus berupa angka.',
            'tarif.min' => 'Tarif tidak boleh bernilai negatif.',
        ]);

        KategoriIuran::create($validatedData);
        return redirect()->route('admin.kategori-iuran.index')
                         ->with('success', 'Kategori Iuran "' . $validatedData['nama_kategori'] . '" berhasil ditambahkan!');
    }

    // Menggunakan type-hinting yang sama dengan route model binding pada function update
    public function edit(KategoriIuran $kategori_iuran) 
    {
        // Menggunakan nama variabel $kategori agar konsisten dengan update/destroy/index.blade.php
        return view($this->viewPath . 'edit', ['kategori' => $kategori_iuran]); 
    }

    public function update(Request $request, KategoriIuran $kategori_iuran)
    {
        $validated = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                // Rule unique yang mengabaikan ID model saat ini
                Rule::unique('kategori_iurans', 'nama_kategori')->ignore($kategori_iuran->id), 
            ],
            'tarif' => 'required|numeric|min:0',
        ]);

        $kategori_iuran->update($validated);
        return redirect()->route('admin.kategori-iuran.index')
                         ->with('success', 'Kategori iuran berhasil diperbarui.');
    }

    public function destroy(KategoriIuran $kategori_iuran)
    {
        // Pengamanan Relasi (Warga) - Bagian ini sudah sempurna!
        if ($kategori_iuran->wargas()->exists()) { // Menggunakan relasi wargas() dari Model
            return redirect()->back()->with('error', 'Tidak dapat menghapus kategori ini karena masih ada warga yang terikat.');
        }

        $kategori_iuran->delete();
        return redirect()->route('admin.kategori-iuran.index')->with('success', 'Kategori iuran berhasil dihapus.');
    }
}