<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

class PegawaiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pegawai::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // WAJIB: Menambahkan kolom 'nik' yang unik untuk menghindari error SQL
            'nik' => $this->faker->unique()->numerify('################'), // Menghasilkan 16 digit angka unik
            
            'nama' => $this->faker->name,
            'no_telp' => $this->faker->phoneNumber,
            'posisi' => $this->faker->randomElement(['Karyawan', 'Manajer', 'Staff']),
            'status' => $this->faker->boolean(80), // 80% kemungkinan aktif (1)
        ];
    }
}
