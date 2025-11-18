<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            
            // Kolom dari Form Data Pribadi
            $table->string('nik')->unique();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('agama')->nullable();
            $table->string('status_pernikahan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email')->nullable()->unique();

            // Kolom Utama (yang sudah ada)
            $table->string('nama'); // Mapping dari nama_lengkap
            $table->string('no_telp'); // Mapping dari nomor_hp
            $table->string('posisi');
            $table->integer('status');
            $table->integer('hadir'); // Kolom yang menyebabkan error sebelumnya
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
