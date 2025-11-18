<?php

namespace App\Http\Controllers\Admin;

use App\Models\Absensi;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AbsensiController extends Controller
{
    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'Admin.pages.Absensi.';
    }

    public function index()
    {
        $absensi = Absensi::select([
            'tanggal',
            DB::raw('COUNT(CASE WHEN status = "hadir" THEN 1 END) as jumlah_hadir'),
            DB::raw('COUNT(CASE WHEN status = "sakit" THEN 1 END) as jumlah_sakit'),
            DB::raw('COUNT(CASE WHEN status = "izin" THEN 1 END) as jumlah_izin'),
            DB::raw("SUM(CASE WHEN status = 'alpa' THEN 1 ELSE 0 END) as jumlah_alpa")
        ])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->get();
        return view($this->viewPath . 'index', ['dataAbsensi' => $absensi]);
    }

    public function create(Request $request)
    {
        $tanggalAbsensi = $request->input('tanggal', Carbon::today()->toDateString());

        $pegawaiSudahAbsenIds = Absensi::where('tanggal', $tanggalAbsensi)
            ->pluck('pegawai_id')
            ->toArray();

        $pegawai = Pegawai::where('status', 1)
            ->whereNotIn('id', $pegawaiSudahAbsenIds)
            ->orderBy('nama', 'asc')
            ->get();

        return view($this->viewPath . 'create', compact('tanggalAbsensi', 'pegawai'));
    }

    public function store(Request $request)
    {
        $absensiData = $request->input('status');
        $rules = [
            'tanggal' => 'required|date|before_or_equal:today',
            'status' => 'required|array',
        ];

        $messages = [
            'tanggal.required' => 'Tanggal absensi wajib diisi.',
            'status.required' => 'Mohon lengkapi data.',
        ];

        $request->validate($rules, $messages);
        $absensiRecords = [];
        $tanggalAbsensi = $request->input('tanggal');
        foreach ($absensiData as $pegawaiId => $status) {
            $absensiRecords[] = [
                'pegawai_id' => $pegawaiId,
                'tanggal' => $tanggalAbsensi,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Absensi::insert($absensiRecords);
        return redirect()->route('admin.absensi')->with('success', 'Data absensi berhasil disimpan.');
    }

   public function show($tanggal)
    {
        
        $detailAbsensi = Absensi::where('tanggal', $tanggal)
                            ->with('pegawai')
                            ->get();

        $summaryCounts = Absensi::where('tanggal', $tanggal)
            ->select([
                DB::raw('COUNT(CASE WHEN status = "hadir" THEN 1 END) as hadir'),
                DB::raw('COUNT(CASE WHEN status = "sakit" THEN 1 END) as sakit'),
                DB::raw('COUNT(CASE WHEN status = "izin" THEN 1 END) as izin'),
                DB::raw('COUNT(CASE WHEN status = "alpa" THEN 1 END) as alpa'),
            ])->first(); 

        return view($this->viewPath . 'show', compact('detailAbsensi', 'tanggal', 'summaryCounts'));
    }

    public function edit($tanggal)
    {
        $pegawais = Pegawai::orderBy('nama', 'asc')->get();
        $absensiSudahAda = Absensi::where('tanggal', $tanggal)
            ->pluck('status', 'pegawai_id')
            ->all();

        return view($this->viewPath . 'edit', compact('pegawais', 'absensiSudahAda', 'tanggal'));
    }

    public function update(Request $request, $tanggal)
    {
        $absensiData = $request->input('status');

        $rules = [
            'tanggal' => 'required|date|before_or_equal:today',
            'status' => 'required|array',
        ];
        $messages = [
            'tanggal.required' => 'Tanggal absensi wajib diisi.',
            'status.required' => 'Mohon lengkapi data.',
        ];

        $request->validate($rules, $messages);
        
        $tanggalAbsensi = $request->input('tanggal');

        Absensi::where('tanggal', $tanggal)->delete();

        $absensiRecords = [];

        foreach ($absensiData as $pegawaiId => $status) {
            $absensiRecords[] = [
                'pegawai_id' => $pegawaiId,
                'tanggal' => $tanggalAbsensi,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Absensi::insert($absensiRecords);

        return redirect()->route('admin.absensi')->with('success', 'Data absensi tanggal ' . \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') . ' berhasil diperbarui.');
    }

    /**
     * Menampilkan halaman cetak laporan.
     */
    public function cetak(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $periode = Carbon::createFromDate($tahun, $bulan, 1);
        $periodeStart = $periode->startOfMonth()->toDateString();
        $periodeEnd = $periode->endOfMonth()->toDateString();

        $pegawais = Pegawai::where('status', 1)->orderBy('nama', 'asc')->get();

        $dataAbsensi = Absensi::select([
                'tanggal',
                DB::raw('COUNT(CASE WHEN status = "hadir" THEN 1 END) as jumlah_hadir'),
                DB::raw('COUNT(CASE WHEN status = "sakit" THEN 1 END) as jumlah_sakit'),
                DB::raw('COUNT(CASE WHEN status = "izin" THEN 1 END) as jumlah_izin'),
                DB::raw('COUNT(CASE WHEN status = "alpa" THEN 1 END) as jumlah_alpa'),
            ])
            ->whereBetween('tanggal', [$periodeStart, $periodeEnd])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();
        
        // 4. Kirim data ke view cetak
        return view($this->viewPath . 'cetak-laporan', compact('dataAbsensi', 'pegawais', 'periode'));
    }
}
