<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class DaftarPengaduan extends Controller 
{
    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'Admin.pages.DaftarPengaduan.';
    }

    public function index()
    {
        $pengaduan = Pengaduan::orderBy('created_at', 'desc')
            ->get();
        return view($this->viewPath . 'index', compact('pengaduan'));
    }

    public function tanggapi(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->update([
            'tanggapan' => $request->tanggapan,
            'status'    => 'proses', 
        ]);

        return redirect()->route('admin.daftar-pengaduan')
            ->with('success', 'Tanggapan berhasil dikirim dan status telah diperbarui.');
    }

    public function proses($id)
    {
        Pengaduan::where('id', $id)->update([
            'status' => 'proses'
        ]);
        return redirect()->route('admin.daftar-pengaduan');
    }

    public function tolak($id)
    {
        Pengaduan::where('id', $id)->update([
            'status' => 'ditolak'
        ]);
        return redirect()->route('admin.daftar-pengaduan');
    }

    public function selesai($id)
    {
        Pengaduan::where('id', $id)->update([
            'status' => 'selesai'
        ]);
        return redirect()->route('admin.daftar-pengaduan');
    }

    public function bulkDestroy(Request $request)
    {
        $selectedIdsString = $request->input('selected_ids');

        if (empty($selectedIdsString)) {
            return redirect()->route('admin.daftar-pengaduan')
                             ->with('error', 'Tidak ada data pengaduan yang dipilih untuk dihapus.');
        }

        $idsToDelete = array_map('intval', explode(',', $selectedIdsString));

        try {
            $deletedCount = Pengaduan::destroy($idsToDelete);

            return redirect()->route('admin.daftar-pengaduan')
                             ->with('success', "Berhasil menghapus {$deletedCount} data pengaduan yang terpilih.");

        } catch (\Exception $e) {
            return redirect()->route('admin.daftar-pengaduan')
                             ->with('error', 'Gagal menghapus data pengaduan. Terjadi kesalahan pada server: ' . $e->getMessage());
        }
    }
}