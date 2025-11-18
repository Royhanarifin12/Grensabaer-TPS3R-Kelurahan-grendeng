<?php

namespace App\Http\Controllers\Admin;

use App\Models\Warga;
use App\Models\Pembayaran; 
use Illuminate\Http\Request;
use Carbon\Carbon; 
use App\Http\Controllers\Controller; 

class IuranController extends Controller
{
    protected $viewPath = 'Admin.pages.Iuran.'; // Tambahkan titik (.) agar konsisten

    public function index(Request $request)
    {
        // 1. Ambil data filter
        $bulan = (int) $request->input('filter_bulan', Carbon::now()->month); 
        $tahun = (int) $request->input('filter_tahun', Carbon::now()->year);
        $filter_rw = $request->input('filter_rw');
        $filter_rt = $request->input('filter_rt');
        $filter_status = $request->input('filter_status');
        $filter_nama = $request->input('filter_nama'); // 🟢 FILTER NAMA DITAMBAHKAN
        
        $periode = Carbon::createFromDate($tahun, $bulan, 1)->format('Y-m'); 

        // 2. Ambil daftar RW & RT untuk dropdown
        $daftar_rw = Warga::select('rw')->distinct()->orderBy('rw', 'asc')->get();
        
        $daftar_rt_query = Warga::select('rt')->distinct();
        if ($filter_rw) {
            $daftar_rt_query->where('rw', $filter_rw);
        }
        $daftar_rt = $daftar_rt_query->orderBy('rt', 'asc')->get();

        // 3. Ambil data Warga dengan Eager Load 'kategori'
        $queryWarga = Warga::with('kategori')->where('status_warga', 'Aktif');
        
        // 4. Terapkan semua filter
        if ($filter_rw) {
            $queryWarga->where('rw', $filter_rw);
        }
        if ($filter_rt) {
            $queryWarga->where('rt', $filter_rt);
        }
        if ($filter_nama) { // 🟢 LOGIKA FILTER NAMA DITAMBAHKAN
            $queryWarga->where('nama_lengkap', 'like', '%' . $filter_nama . '%');
        }
        
        $wargaList = $queryWarga->orderBy('rw')->orderBy('rt')->orderBy('nama_lengkap')->get();

        // 5. Ambil data Pembayaran HANYA untuk periode ini
        $pembayaranPeriodeIni = Pembayaran::where('periode_bulan_tahun', $periode)
                                          ->get()
                                          ->keyBy('warga_id'); 

        // 6. Penggabungan data dengan tarif_iuran
        $dataIuran = $wargaList->map(function ($warga) use ($pembayaranPeriodeIni) {
            $warga->status_bayar = $pembayaranPeriodeIni->has($warga->id) ? 'Lunas' : 'Menunggak';
            $warga->pembayaran_id = $pembayaranPeriodeIni->has($warga->id) ? $pembayaranPeriodeIni[$warga->id]->id : null;
            $warga->tarif_iuran = optional($warga->kategori)->tarif ?? 0; 
            return $warga;
        });

        // 7. Terapkan filter Lunas/Menunggak (setelah mapping)
        if ($filter_status == 'Lunas') {
            $dataIuran = $dataIuran->filter(function ($warga) {
                return $warga->status_bayar == 'Lunas';
            });
        } elseif ($filter_status == 'Menunggak') {
            $dataIuran = $dataIuran->filter(function ($warga) {
                return $warga->status_bayar == 'Menunggak';
            });
        }
        
        // 8. Return view dengan semua data yang dibutuhkan
        return view($this->viewPath . 'index', [
            'dataIuran' => $dataIuran,
            'daftar_rw' => $daftar_rw,
            'daftar_rt' => $daftar_rt,
            'filter_bulan_aktif' => $bulan, 
            'filter_tahun_aktif' => $tahun, 
            'filter_rw_aktif' => $filter_rw,
            'filter_rt_aktif' => $filter_rt,
            'filter_status_aktif' => $filter_status,
            'filter_nama_aktif' => $filter_nama, // 🟢 KIRIM NAMA AKTIF KE VIEW
            'periode_aktif' => $periode,
        ]);
    } // <-- TUTUP public function index()

    public function tandaiLunas(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'periode' => 'required|string',
        ]);

        $warga = Warga::with('kategori')->find($validated['warga_id']);
        
        if (!$warga) {
            return redirect()->back()->with('error', 'Warga tidak ditemukan.');
        }

        if (!$warga->kategori) {
            return redirect()->back()->with('error', 'Warga ini belum memiliki Kategori Iuran yang terdaftar.');
        }
        
        $tarif = $warga->kategori->tarif;

        $pembayaranSudahAda = Pembayaran::where('warga_id', $validated['warga_id'])
                                        ->where('periode_bulan_tahun', $validated['periode'])
                                        ->exists();
        
        if ($pembayaranSudahAda) {
            return redirect()->back()->with('error', 'Pembayaran untuk periode ini sudah lunas.');
        }
        
        Pembayaran::create([
            'warga_id' => $validated['warga_id'],
            'periode_bulan_tahun' => $validated['periode'],
            'tanggal_bayar' => Carbon::now(),
            'jumlah_bayar' => $tarif, 
        ]);

        $tarif_formatted = number_format($tarif, 0, ',', '.');
        return redirect()->back()->with('success', 'Iuran berhasil ditandai LUNAS dengan tarif Rp ' . $tarif_formatted . '.');
    }

    public function batalkanLunas(Request $request)
    {
        $request->validate([
            'pembayaran_id' => 'required|exists:pembayarans,id',
        ]);

        $pembayaran = Pembayaran::find($request->pembayaran_id);
        if ($pembayaran) {
            $pembayaran->delete();
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil dibatalkan.');
    }

    /**
     * METODE CETAK
     */
    public function cetak(Request $request)
    {
        // 1. Ambil data filter
        $bulan = (int) $request->input('filter_bulan', Carbon::now()->month); 
        $tahun = (int) $request->input('filter_tahun', Carbon::now()->year);
        $filter_rw = $request->input('filter_rw');
        $filter_rt = $request->input('filter_rt');
        $filter_status = $request->input('filter_status');
        $filter_nama = $request->input('filter_nama'); // 🟢 FILTER NAMA DITAMBAHKAN
        
        $periode = Carbon::createFromDate($tahun, $bulan, 1)->format('Y-m');
        
        // 2. Ambil data Warga
        $queryWarga = Warga::with('kategori')->where('status_warga', 'Aktif');
        if ($filter_rw) {
            $queryWarga->where('rw', $filter_rw);
        }
        if ($filter_rt) {
            $queryWarga->where('rt', $filter_rt);
        }
        if ($filter_nama) { // 🟢 LOGIKA FILTER NAMA DITAMBAHKAN
            $queryWarga->where('nama_lengkap', 'like', '%' . $filter_nama . '%');
        }
        $wargaList = $queryWarga->orderBy('rw')->orderBy('rt')->orderBy('nama_lengkap')->get();

        // 3. Ambil data Pembayaran
        $pembayaranPeriodeIni = Pembayaran::where('periode_bulan_tahun', $periode)
                                          ->get()
                                          ->keyBy('warga_id'); 

        // 4. Gabungkan data
        $dataIuran = $wargaList->map(function ($warga) use ($pembayaranPeriodeIni) {
            $warga->status_bayar = $pembayaranPeriodeIni->has($warga->id) ? 'Lunas' : 'Menunggak';
            $warga->pembayaran_id = $pembayaranPeriodeIni->has($warga->id) ? $pembayaranPeriodeIni[$warga->id]->id : null;
            $warga->tarif_iuran = optional($warga->kategori)->tarif ?? 0;
            
            // Tambahkan tanggal bayar untuk cetak
            if ($warga->status_bayar == 'Lunas') {
                 $warga->tanggal_bayar = $pembayaranPeriodeIni[$warga->id]->tanggal_bayar;
            } else {
                 $warga->tanggal_bayar = null;
            }
            
            return $warga;
        });

        // 5. Terapkan filter status
        if ($filter_status == 'Lunas') {
            $dataIuran = $dataIuran->filter(function ($warga) {
                return $warga->status_bayar == 'Lunas';
            });
        } elseif ($filter_status == 'Menunggak') {
            $dataIuran = $dataIuran->filter(function ($warga) {
                return $warga->status_bayar == 'Menunggak';
            });
        }
        
        // 6. Tampilkan view khusus cetak
        return view($this->viewPath . 'cetak', [
            'dataIuran' => $dataIuran,
            'filter_bulan_aktif' => $bulan, 
            'filter_tahun_aktif' => $tahun, 
            'filter_rw_aktif' => $filter_rw,
            'filter_rt_aktif' => $filter_rt,
            'filter_status_aktif' => $filter_status,
            'filter_nama_aktif' => $filter_nama, // 🟢 KIRIM NAMA AKTIF KE VIEW CETAK
            'periode_aktif' => $periode,
        ]);
    }
}