<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengeluaran; 
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriPengeluaranController extends Controller 
{
    protected $viewPath = 'Admin.pages.KategoriPengeluaran.'; 
    
    public function index()
    {
        $KategoriPengeluaran = KategoriPengeluaran::orderBy('nama', 'asc')->get();
        return view($this->viewPath . 'index', compact('KategoriPengeluaran')); 
    }

    public function create()
    {
        return view($this->viewPath . 'create');
    }

    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'nama' => 'required|string|max:100|unique:kategori_pengeluarans,nama',
        ], [
            'nama.required' => 'Nama Kategori wajib diisi.',
            'nama.unique' => 'Nama Kategori ini sudah terdaftar.',
        ]);

        KategoriPengeluaran::create($validatedData);
        return redirect()->route('admin.kategori-pengeluaran.index') 
                         ->with('success', 'Kategori Pengeluaran "' . $validatedData['nama'] . '" berhasil ditambahkan!');
    }

    public function edit(KategoriPengeluaran $kategori_pengeluaran) 
    {
        return view($this->viewPath . 'edit', ['kategori' => $kategori_pengeluaran]); 
    }

    public function update(Request $request, KategoriPengeluaran $kategori_pengeluaran)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategori_pengeluarans', 'nama')->ignore($kategori_pengeluaran->id), 
            ],
        ]);

        $kategori_pengeluaran->update($validated);
        return redirect()->route('admin.kategori-pengeluaran.index') 
                         ->with('success', 'Kategori pengeluaran berhasil diperbarui.');
    }

    public function destroy(KategoriPengeluaran $kategori_pengeluaran)
    {
        $kategori_pengeluaran->delete();
        return redirect()->route('admin.kategori-pengeluaran.index')->with('success', 'Kategori pengeluaran berhasil dihapus.');
    }
}