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
        Schema::create('aturan_pemilahans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');        
            $table->text('deskripsi');      
            $table->text('contoh');         
            $table->string('icon');         
            $table->string('warna_class');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aturan_pemilahans');
    }
};
