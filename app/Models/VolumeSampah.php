<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolumeSampah extends Model
{
    use HasFactory;

    protected $table = 'volume_sampah_data'; 
    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal',
        'organik',
        'anorganik',
        'residu',
        'nilai_ekonomi'
    ];
}