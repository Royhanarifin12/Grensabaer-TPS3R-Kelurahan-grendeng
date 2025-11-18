<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasukanLain extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'pemasukan_lains';

    /**
     * Kolom yang boleh diisi
     */
    protected $fillable = [
        'tanggal',
        'keterangan',
        'jumlah',
        'kategori',
    ];

    /**
     * Cast (ubah tipe data) otomatis
     */
    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2',
    ];
}