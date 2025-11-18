<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel wargas
            $table->foreignId('warga_id')->constrained('wargas')->onDelete('cascade'); 
            
            // Periode Iuran (misal: '2025-11')
            $table->string('periode_bulan_tahun', 7); 
            
            $table->date('tanggal_bayar');
            $table->decimal('jumlah_bayar', 10, 2)->default(0);
            
            // Unique constraint agar 1 warga tidak bisa bayar 2x di periode yg sama
            $table->unique(['warga_id', 'periode_bulan_tahun']);
            
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};