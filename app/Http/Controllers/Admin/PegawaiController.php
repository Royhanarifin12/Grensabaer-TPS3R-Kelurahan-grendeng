<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage; 

class PegawaiController
{
    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'Admin.pages.Pegawai.';
    }

    public function index()
    {
        $pegawai = Pegawai::latest()->get();

        return view($this->viewPath . 'index', compact('pegawai'));
    }

    public function create()
    {
        return view($this->viewPath . 'create'); 
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|unique:pegawais,nik|digits:16', 
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'status_pernikahan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string|max:15',
            'email' => 'nullable|email|unique:pegawais,email', 
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
            'posisi' => 'required|string|max:100',
        ];

        $messages = [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'Nomor KTP/NIK wajib diisi.',
            'nik.unique' => 'Nomor KTP/NIK sudah terdaftar.',
            'nik.digits' => 'Nomor KTP/NIK harus 16 digit.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'agama.required' => 'Agama wajib dipilih.',
            'status_pernikahan.required' => 'Status pernikahan wajib dipilih.',
            'alamat.required' => 'Alamat wajib diisi.',
            'nomor_hp.required' => 'Nomor telepon wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
            'posisi.required' => 'Posisi wajib dipilih.'
        ];

        $validatedData = $request->validate($rules, $messages);
                
        $dataToStore = $validatedData;
        
        if ($request->hasFile('foto')) {
            $dataToStore['foto'] = $request->file('foto')->store('pegawai_photos', 'public');
        } else {
            $dataToStore['foto'] = null; 
        }
        
        $dataToStore['nama'] = $validatedData['nama_lengkap'];
        $dataToStore['no_telp'] = $validatedData['nomor_hp'];

        $dataToStore['status'] = 1; 
        $dataToStore['hadir'] = 0; 

        unset($dataToStore['nama_lengkap']);
        unset($dataToStore['nomor_hp']);

        Pegawai::create($dataToStore);

        return redirect()->route('admin.pegawai')->with('success', 'Data Pegawai berhasil ditambahkan!');
    }

    public function edit(Pegawai $pegawai)
    {
        return view($this->viewPath . 'edit', compact('pegawai')); 
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        // Aturan validasi untuk proses pembaruan data (Update)
        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'nik' => [
                'required',
                'string',
                'digits:16',
                Rule::unique('pegawais', 'nik')->ignore($pegawai->id),
            ],
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'status_pernikahan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string|max:15',
            // Validasi unik email: Abaikan email milik pegawai yang sedang di-edit
            'email' => [
                'nullable',
                'email',
                Rule::unique('pegawais', 'email')->ignore($pegawai->id),
            ],
            'status' => 'required|integer|in:0,1',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|integer|in:0,1',
        ];

        // Pesan validasi
        $messages = [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'Nomor KTP/NIK wajib diisi.',
            'nik.unique' => 'Nomor KTP/NIK sudah terdaftar.',
            'nik.digits' => 'Nomor KTP/NIK harus 16 digit.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'agama.required' => 'Agama wajib dipilih.',
            'status_pernikahan.required' => 'Status pernikahan wajib dipilih.',
            'alamat.required' => 'Alamat wajib diisi.',
            'nomor_hp.required' => 'Nomor telepon wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'status.required' => 'Status wajib dipilih.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ];

        $validatedData = $request->validate($rules, $messages);
                
        $dataToUpdate = $validatedData;
        
        if ($request->hasFile('foto')) {
            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $dataToUpdate['foto'] = $request->file('foto')->store('pegawai_photos', 'public');
        } elseif ($request->input('hapus_foto')) { 
             if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $dataToUpdate['foto'] = null;
        } else {
             unset($dataToUpdate['foto']);
        }

        $dataToUpdate['nama'] = $validatedData['nama_lengkap'];
        $dataToUpdate['no_telp'] = $validatedData['nomor_hp'];

        unset($dataToUpdate['nama_lengkap']);
        unset($dataToUpdate['nomor_hp']);
        
        $pegawai->update($dataToUpdate);

        return redirect()->route('admin.pegawai')->with('success', 'Data Pegawai berhasil diperbarui!');
    }
    
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->absensi()->delete(); 
        
        if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        $pegawai->delete();

        return redirect()->route('admin.pegawai')->with('success', 'Data Pegawai berhasil dihapus!');
    }
}
