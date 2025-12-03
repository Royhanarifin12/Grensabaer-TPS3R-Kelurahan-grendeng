<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AturanPemilahan extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'contoh', 'icon', 'warna_class'];
}
