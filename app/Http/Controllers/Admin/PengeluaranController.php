<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use App\Models\KategoriPengeluaran;  
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengeluaranController extends Controller
{
    protected $viewPath = 'Admin.pages.Pengeluaran.';

    public function index(Request $request)
    {

        $query = Pengeluaran::with('kategoriPengeluaran');

        if ($request->filter_type == 'bulan') {

            if ($request->filled('bulan')) {
                $query->whereMonth('tanggal', $request->bulan);
            }
            $tahun = $request->filled('tahun') ? $request->tahun : date('Y');
            $query->whereYear('tanggal', $tahun);

        } else {

            if ($request->filled('tanggal_mulai')) {
                $query->where('tanggal', '>=', $request->tanggal_mulai);
            }
            if ($request->filled('tanggal_selesai')) {
                $query->where('tanggal', '<=', $request->tanggal_selesai);
            }
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_pengeluaran_id', $request->kategori_id);
        }

        $dataPengeluaran = $query->orderBy('tanggal', 'desc')->get();
        
        $totalPengeluaran = $dataPengeluaran->sum('jumlah');

        $kategoriOptions = KategoriPengeluaran::orderBy('nama', 'asc')->get();

        return view($this->viewPath . 'index', [
            'dataPengeluaran' => $dataPengeluaran,
            'totalPengeluaran' => $totalPengeluaran,
            'kategoriOptions' => $kategoriOptions 
        ]);
    }

    public function create()
    {
         
        $kategori = KategoriPengeluaran::orderBy('nama', 'asc')->get();

        return view($this->viewPath . 'create', [
            'kategori' => $kategori  
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'kategori_pengeluaran_id' => 'nullable|integer|exists:kategori_pengeluarans,id',
        ]);

        Pengeluaran::create($validated);

        return redirect()->route('admin.pengeluaran.index')
                         ->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        $kategori = KategoriPengeluaran::orderBy('nama', 'asc')->get();

        return view($this->viewPath . 'edit', [
            'pengeluaran' => $pengeluaran,
            'kategori' => $kategori  
        ]);
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'kategori_pengeluaran_id' => 'nullable|integer|exists:kategori_pengeluarans,id',
        ]);

        $pengeluaran->update($validated);

        return redirect()->route('admin.pengeluaran.index')
                         ->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->route('admin.pengeluaran.index')
                         ->with('success', 'Data pengeluaran berhasil dihapus.');
    }

    public function cetak(Request $request)
    {
        
        $query = Pengeluaran::with('kategoriPengeluaran');

        if ($request->filter_type == 'bulan') {
            if ($request->filled('bulan')) {
                $query->whereMonth('tanggal', $request->bulan);
            }
            $tahun = $request->filled('tahun') ? $request->tahun : date('Y');
            $query->whereYear('tanggal', $tahun);
        } else {
            if ($request->filled('tanggal_mulai')) {
                $query->where('tanggal', '>=', $request->tanggal_mulai);
            }
            if ($request->filled('tanggal_selesai')) {
                $query->where('tanggal', '<=', $request->tanggal_selesai);
            }
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_pengeluaran_id', $request->kategori_id);
        }

        $dataPengeluaran = $query->orderBy('tanggal', 'desc')->get();
        $totalPengeluaran = $dataPengeluaran->sum('jumlah');

        $kategoriTerpilih = null;
        if ($request->filled('kategori_id')) {
            $kategoriTerpilih = KategoriPengeluaran::find($request->kategori_id);
        }

        return view($this->viewPath . 'cetak', [
            'dataPengeluaran' => $dataPengeluaran,
            'totalPengeluaran' => $totalPengeluaran,
            'input' => $request->all(),
            'kategoriTerpilih' => $kategoriTerpilih
        ]);
    }
}
