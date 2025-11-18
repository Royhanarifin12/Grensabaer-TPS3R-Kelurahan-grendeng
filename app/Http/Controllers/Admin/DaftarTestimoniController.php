<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DaftarTestimoniController extends Controller
{
    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'Admin.pages.DaftarTestimoni.';
    }

    public function index()
    {
        $testimoni = Testimoni::orderBy('created_at', 'desc')
            ->get();

        return view($this->viewPath . 'index', compact('testimoni'));
    }

    public function reject($id)
    {
        Testimoni::where('id', $id)->update([
            'status' => 'ditolak'
        ]);
        return redirect()->route('admin.daftar-testimoni.index');
    }

    public function bulkDestroy(Request $request)
    {
        $selectedIdsString = $request->input('selected_ids');

        if (empty($selectedIdsString)) {
            return redirect()->route('admin.daftar-testimoni.index')
                ->with('error', 'Tidak ada data testimoni yang dipilih untuk dihapus.');
        }

        $idsToDelete = array_map('intval', explode(',', $selectedIdsString));

        try {
            $deletedCount = Testimoni::destroy($idsToDelete);

            return redirect()->route('admin.daftar-testimoni.index')
                ->with('success', "Berhasil menghapus {$deletedCount} data testimoni yang terpilih.");
        } catch (\Exception $e) {
            return redirect()->route('admin.daftar-testimoni.index')
                ->with('error', 'Gagal menghapus data testimoni. Terjadi kesalahan pada server: ' . $e->getMessage());
        }
    }

    public function approve($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->tampilkan_di_beranda = true;
        $testimoni->save();
        return redirect()->back()->with('success', 'Testimoni berhasil disetujui.');
    }

    public function unapprove($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->tampilkan_di_beranda = false;
        $testimoni->save();
        return redirect()->back()->with('success', 'Testimoni berhasil disembunyikan.');
    }
}
