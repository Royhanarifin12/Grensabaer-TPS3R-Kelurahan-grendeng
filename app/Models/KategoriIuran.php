<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriIuran extends Model
{
    use HasFactory;

    protected $table = 'kategori_iurans';

    protected $fillable = [
        'nama_kategori',
        'tarif',
    ];

    protected $casts = [
        'tarif' => 'decimal:2',
    ];

    public function wargas()
    {
        return $this->hasMany(Warga::class, 'kategori_iuran_id');
    }
}