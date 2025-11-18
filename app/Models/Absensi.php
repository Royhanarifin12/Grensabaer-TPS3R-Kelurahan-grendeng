<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'pegawai_id',
        'status',
    ];

    /**
     * Relasi ke Pegawai (Absensi dimiliki oleh satu Pegawai)
     * Ini harus 'belongsTo', bukan 'belongsToMany'.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }

    protected $casts = [
        'tanggal' => 'date',
    ];
}
