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
        // Perintah untuk MENAMBAH kolom baru
        Schema::table('wargas', function (Blueprint $table) {
            // Kita tambahkan kolom 'tarif_iuran'
            // Kita set default 0 agar data warga yang sudah ada tidak error
            // Kita letakkan setelah kolom 'status_warga'
            $table->decimal('tarif_iuran', 15, 2)->default(0)->after('status_warga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Perintah untuk MENGHAPUS kolom jika kita rollback
        Schema::table('wargas', function (Blueprint $table) {
            $table->dropColumn('tarif_iuran');
        });
    }
};