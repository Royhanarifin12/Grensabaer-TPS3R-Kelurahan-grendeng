<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\KategoriIuran;
use App\Models\Pembayaran;

class Warga extends Model
{
    use HasFactory;
    protected $table = 'wargas';

    protected $fillable = [
        'nama_lengkap', 
        'nik', 
        'no_telp',
        'alamat', 
        'rt', 
        'rw', 
        'status_warga', 
        'kategori_iuran_id'
    ];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'warga_id', 'id');
    }
    
    public function kategori()
    {
        return $this->belongsTo(KategoriIuran::class, 'kategori_iuran_id', 'id');
    }

    public function getAlamatLengkapAttribute()
    {
        return "{$this->alamat} RT {$this->rt}/RW {$this->rw}";
    }
}