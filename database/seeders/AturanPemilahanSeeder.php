<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AturanPemilahan;

class AturanPemilahanSeeder extends Seeder
{
    public function run(): void
    {
        AturanPemilahan::truncate();

        $data = [
            [
                'judul'       => 'SAMPAH ORGANIK',
                'deskripsi'   => 'Sampah yang mudah membusuk dan akan kami olah menjadi kompos',
                'contoh'      => "Sisa nasi, sayur, dan buah\nCangkang telur\nDaun kering, ranting, rumput\nAmpas kopi/teh",
                'icon'        => 'bi-apple',
                'warna_class' => 'icon-organik'
            ],
            [
                'judul'       => 'SAMPAH ANORGANIK',
                'deskripsi'   => 'Sampah yang bisa didaur ulang. Harap setorkan dalam keadaan bersih dan kering',
                'contoh'      => "Botol & gelas plastik (bersih)\nKardus, kertas, koran\nKaleng minuman (bersih)\nPecahan kaca (dibungkus aman)",
                'icon'        => 'bi-recycle',
                'warna_class' => 'icon-anorganik'
            ],
            [
                'judul'       => 'SAMPAH RESIDU',
                'deskripsi'   => 'Sampah yang tidak bisa didaur ulang maupun dikomposkan oleh kamin',
                'contoh'      => "Popok bayi (diapers) & pembalut\nKemasan sachet (kopi, mie instan)\nStereofoam & plastik kresek\nBaterai bekas & lampu",
                'icon'        => 'bi-exclamation-triangle-fill',
                'warna_class' => 'icon-residu'
            ]
        ];

        foreach ($data as $item) {
            AturanPemilahan::create($item);
        }
    }
}
