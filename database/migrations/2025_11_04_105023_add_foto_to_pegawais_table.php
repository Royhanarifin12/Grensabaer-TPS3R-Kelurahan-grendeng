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
        // Pastikan tabel 'pegawais' sudah ada sebelum mencoba memodifikasinya
        Schema::table('pegawais', function (Blueprint $table) {
            // Menambahkan kolom 'foto' setelah kolom 'email' (opsional, bisa di mana saja)
            // 'nullable' karena tidak semua pegawai mungkin memiliki foto saat ini.
            $table->string('foto', 255)->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus kolom 'foto' jika migrasi di-rollback
        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};
