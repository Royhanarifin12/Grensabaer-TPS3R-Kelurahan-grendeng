<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluarans';

    protected $fillable = [
        'tanggal',
        'keterangan',
        'jumlah',
        'kategori_pengeluaran_id',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2',
    ];

    public function kategoriPengeluaran()
    {
        return $this->belongsTo(KategoriPengeluaran::class);
    }
}