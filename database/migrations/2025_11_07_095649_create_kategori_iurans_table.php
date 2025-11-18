<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kategori_iurans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 100)->unique(); 
            $table->unsignedBigInteger('tarif')->default(0); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_iurans');
    }
};
