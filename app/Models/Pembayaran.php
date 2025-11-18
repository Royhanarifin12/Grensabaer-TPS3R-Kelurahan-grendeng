<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans';

    protected $fillable = [
        'warga_id',
        'periode_bulan_tahun',
        'tanggal_bayar',
        'jumlah_bayar',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'id');
    }
}