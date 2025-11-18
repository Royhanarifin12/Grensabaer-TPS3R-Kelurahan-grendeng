<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nik', 16)->unique();
            $table->string('no_telp', 15);
            $table->text('alamat');
            $table->string('rt', 3); // Kolom RT
            $table->string('rw', 3); // Kolom RW
            $table->enum('status_warga', ['Aktif', 'Nonaktif', 'Pindah'])->default('Aktif');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};