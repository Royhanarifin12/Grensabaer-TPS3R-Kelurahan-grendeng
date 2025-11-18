<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan nama tabel cocok dengan protected $table di Model
        Schema::create('volume_sampah_data', function (Blueprint $table) { 
            $table->id();
            $table->date('tanggal')->unique(); // Nama kolom yang disederhanakan
            $table->unsignedInteger('organik');
            $table->unsignedInteger('anorganik');
            $table->unsignedInteger('residu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volume_sampah_data');
    }
};