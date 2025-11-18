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
        Schema::table('volume_sampah_data', function (Blueprint $table) {
            $table->integer('nilai_ekonomi')->default(0)->after('residu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('volume_sampah_data', function (Blueprint $table) {
            //
        });
    }
};
