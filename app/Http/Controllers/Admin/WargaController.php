<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\WargasImport;
use App\Models\Warga;
use App\Models\KategoriIuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class WargaController extends Controller
{
    protected $viewPath = 'Admin.pages.Warga.'; 

    public function index(Request $request) 
    {
        $filter_nama = $request->input('filter_nama');
        $filter_rw = $request->input('filter_rw');
        $filter_rt = $request->input('filter_rt');
        $filter_status_warga = $request->input('filter_status_warga');
        $filter_kategori_id = $request->input('filter_kategori_id'); 

        $daftar_rw = Warga::select('rw')->distinct()->orderBy('rw', 'asc')->get();
        
        $daftar_rt_query = Warga::select('rt')->distinct();
        if ($filter_rw) {
            $daftar_rt_query->where('rw', $filter_rw);
        }
        $daftar_rt = $daftar_rt_query->orderBy('rt', 'asc')->get();
        
        $daftar_kategori = KategoriIuran::orderBy('nama_kategori', 'asc')->get(); 

        $queryWarga = Warga::with('kategori')->orderBy('rw')->orderBy('rt');

        if ($filter_nama) {
            $queryWarga->where('nama_lengkap', 'like', '%' . $filter_nama . '%');
        }
        if ($filter_rw) {
            $queryWarga->where('rw', $filter_rw);
        }
        if ($filter_rt) {
            $queryWarga->where('rt', $filter_rt);
        }
        if ($filter_status_warga) {
            $queryWarga->where('status_warga', $filter_status_warga);
        }
        if ($filter_kategori_id) { // 🟢 BARIS 3: TERAPKAN FILTER KATEGORI
            $queryWarga->where('kategori_iuran_id', $filter_kategori_id);
        }

        $wargas = $queryWarga->get(); 
        
        return view($this->viewPath . 'index', [
            'wargas' => $wargas,
            'daftar_rw' => $daftar_rw,
            'daftar_rt' => $daftar_rt,
            'daftar_kategori' => $daftar_kategori, 
            'filter_nama_aktif' => $filter_nama,
            'filter_rw_aktif' => $filter_rw,
            'filter_rt_aktif' => $filter_rt,
            'filter_status_warga_aktif' => $filter_status_warga,
            'filter_kategori_id_aktif' => $filter_kategori_id, 
        ]);
    }

    public function create()
    {
        $kategoriIurans = KategoriIuran::orderBy('tarif', 'asc')->get();
        return view($this->viewPath . 'create', compact('kategoriIurans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|unique:wargas,nik|max:16',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'status_warga' => 'required|string|in:Aktif,Nonaktif,Pindah', 
            'kategori_iuran_id' => 'required|exists:kategori_iurans,id',
        ]);

        Warga::create($validatedData);

        return redirect()->route('admin.warga.index')->with('success', 'Data Warga berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        $kategoriIurans = KategoriIuran::orderBy('tarif', 'asc')->get();
        return view($this->viewPath . 'edit', compact('warga', 'kategoriIurans'));
    }
    
    public function update(Request $request, Warga $warga)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => ['required', 'string', 'max:16', Rule::unique('wargas', 'nik')->ignore($warga->id)],
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'status_warga' => 'required|string|in:Aktif,Nonaktif,Pindah', 
            'kategori_iuran_id' => 'required|exists:kategori_iurans,id', 
        ]);

        $warga->update($validatedData);

        return redirect()->route('admin.warga.index')->with('success', 'Data Warga berhasil diperbarui.');
    }
    
    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('admin.warga.index')->with('success', 'Data Warga berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = $file->hashName();

        $path = $file->storeAs('public/excel/',$nama_file);

        $import = Excel::import(new WargasImport(), storage_path('app/private/public/excel/'.$nama_file));

        // Storage::delete('app/private' . $path);
        
        return redirect()->route('admin.warga.index');
    }
}