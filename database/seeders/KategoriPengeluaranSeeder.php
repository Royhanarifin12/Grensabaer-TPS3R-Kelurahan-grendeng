<?php

namespace Database\Seeders;

use App\Models\KategoriPengeluaran; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPengeluaranSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Biaya Gaji/Upah',
            'Biaya ATK',
            'Biaya BBM',
            'Biaya BPJS',
            'Biaya Pajak/Retribusi',
            'Biaya Konsumsi',
            'Biaya Operasional Lain',
        ];

        foreach ($kategori as $nama) {
            KategoriPengeluaran::create(['nama' => $nama]);
        }
    }
}