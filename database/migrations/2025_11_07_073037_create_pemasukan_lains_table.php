<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Ini akan membuat tabel baru untuk Pemasukan Lain
        Schema::create('pemasukan_lains', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Tanggal terima dana
            $table->string('keterangan'); // Keterangan (cth: Dana Pusat, Donasi)
            $table->decimal('jumlah', 15, 2); // Jumlah uangnya
            $table->string('kategori')->nullable(); // Opsional (cth: Donasi, Bantuan)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemasukan_lains');
    }
};