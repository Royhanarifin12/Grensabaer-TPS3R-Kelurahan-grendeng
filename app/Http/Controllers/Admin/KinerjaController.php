<?php

namespace App\Http\Controllers\Admin;

use App\Models\VolumeSampah; 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class KinerjaController 
{
    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'Admin.pages.Kinerja.';
    }

    public function index()
    {
        $kinerja = VolumeSampah::orderBy('tanggal', 'desc')->get();
        return view($this->viewPath . 'index', compact('kinerja'));
    }

    public function store(Request $request)
    {
        $rules = [
            'tanggal' => 'required|date|unique:volume_sampah_data,tanggal', 
            'organik' => 'required|integer|min:0', 
            'anorganik' => 'required|integer|min:0', 
            'residu' => 'required|integer|min:0',
            'nilai_ekonomi' => 'required|integer|min:0',
        ];

        $messages = [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.unique' => 'Data kinerja untuk tanggal ini sudah ada.',
            'organik.required' => 'Volume organik wajib diisi.',
            'anorganik.required' => 'Volume anorganik wajib diisi.',
            'residu.required' => 'Volume residu wajib diisi.',
            'integer' => 'Volume harus berupa angka bulat.',
            'min' => 'Volume tidak boleh negatif.',
            'nilai_ekonomi.required' => 'Nilai ekonomi wajib diisi.',
            'integer' => 'Input harus berupa angka bulat.',
            'min' => 'Input tidak boleh negatif.',
        ];

        $validatedData = $request->validate($rules, $messages);

        VolumeSampah::create($validatedData);

        return redirect()->route('admin.kinerja')->with('success', 'Data kinerja harian berhasil dicatat.');
    }

    public function destroy(VolumeSampah $kinerja)
    {
        $kinerja->delete();

        return redirect()->route('admin.kinerja')->with('success', 'Data kinerja berhasil dihapus.');
    }
}