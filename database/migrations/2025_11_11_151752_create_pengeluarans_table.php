<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');  
            $table->string('keterangan');  
            $table->decimal('jumlah', 15, 2);  
            
            $table->unsignedBigInteger('kategori_pengeluaran_id')->nullable();

            $table->foreign('kategori_pengeluaran_id')
                  ->references('id')
                  ->on('kategori_pengeluarans')
                  ->nullOnDelete();
             

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
        Schema::dropIfExists('pengeluarans');
    }
};