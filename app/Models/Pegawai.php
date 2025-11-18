<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Absensi; // Wajib di-import jika Model Absensi ada di namespace ini

class Pegawai extends Model
{
    use HasFactory;
    
    // Pastikan semua kolom yang dikirim dari controller atau diisi default
    // ada di dalam array $fillable.
    protected $fillable = [
        'nik', 
        'nama', // Hasil mapping dari nama_lengkap
        'no_telp', // Hasil mapping dari nomor_hp
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_pernikahan',
        'alamat',
        'email',
        'posisi',
        'status',
        'hadir',
        'foto', // BARIS INI WAJIB ADA
    ];

    // --- FUNGSI RELASI UNTUK PERBAIKAN FOREIGN KEY ---
    /**
     * Get all of the absensi for the Pegawai.
     * Digunakan oleh PegawaiController->destroy() untuk menghapus data terkait.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function absensi()
    {
        // Asumsi foreign key di tabel absensis adalah 'pegawai_id'
        return $this->hasMany(Absensi::class, 'pegawai_id', 'id');
    }
    // -----------------------------------------------------

    /**
     * Tipe data untuk status
     */
    protected $casts = [
        'status' => 'boolean',
        'hadir' => 'boolean', // Asumsi kolom hadir adalah boolean
    ];
}
