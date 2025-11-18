<?php

namespace App\Imports;

use App\Models\KategoriIuran;
use App\Models\Warga;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


class WargasImport implements ToModel, WithHeadingRow
{    
    public function model(array $row)
    {
        if (empty($row['nama_lengkap'])) {
            return null;
        }

        $kategori = KategoriIuran::first()->id;

        return new Warga([
            'nama_lengkap' => $row['nama_lengkap'],
            'nik' => $row['nik'], 
            'no_telp' => $row['no_hp'],
            'alamat' => $row['alamat'], 
            'rt' => $row['rt'], 
            'rw' => $row['rw'], 
            'status_warga' => $row['status'],
            'kategori_iuran_id' => $kategori,
        ]);
    }
}
