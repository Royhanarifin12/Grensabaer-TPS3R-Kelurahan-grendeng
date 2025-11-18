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
        Schema::table('wargas', function (Blueprint $table) {
            // PERBAIKAN 1: Kita hapus dulu kolom 'tarif_iuran' jika masih ada
            // Menggunakan ifExists untuk menghindari error Can't DROP
            if (Schema::hasColumn('wargas', 'tarif_iuran')) {
                $table->dropColumn('tarif_iuran');
            }

            // PERBAIKAN 2: Hanya tambahkan kolom baru jika belum ada
            if (!Schema::hasColumn('wargas', 'kategori_iuran_id')) {
                $table->foreignId('kategori_iuran_id')->default(1)->after('status_warga')->constrained();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wargas', function (Blueprint $table) {
            if (Schema::hasColumn('wargas', 'kategori_iuran_id')) {
                $table->dropConstrainedForeignId('kategori_iuran_id');
            }
            // Kita kembalikan kolom lama (meski tidak ideal)
            if (!Schema::hasColumn('wargas', 'tarif_iuran')) {
                $table->decimal('tarif_iuran', 15, 2)->default(0)->after('status_warga');
            }
        });
    }
};