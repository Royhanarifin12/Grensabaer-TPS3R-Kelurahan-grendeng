<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DaftarPengaduan;
use App\Http\Controllers\Admin\DaftarTestimoniController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KinerjaController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\Admin\IuranController;
use App\Http\Controllers\Admin\PemasukanLainController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\KategoriPengeluaranController;
use App\Http\Controllers\Admin\KategoriIuranController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\ProyekController;
use App\Http\Controllers\LandingPage\LegalitasController;
use App\Http\Controllers\LandingPage\TransparansiController;
use App\Http\Controllers\LandingPage\AktaNotarisController;
use App\Http\Controllers\LandingPage\FormPengaduanController;
use App\Http\Controllers\LandingPage\FormTestimonialController;
use App\Http\Controllers\LandingPage\HomeController;
use App\Http\Controllers\LandingPage\KewajibanRetribusiController;
use App\Http\Controllers\LandingPage\KinerjaLingkunganController;
use App\Http\Controllers\LandingPage\PanduanWargaController;
use App\Http\Controllers\LandingPage\PelaporanPajakController;
use App\Http\Controllers\LandingPage\ProfilController;
use App\Http\Controllers\LandingPage\SejarahController;
use App\Http\Controllers\LandingPage\SkPembentukanController;
use App\Http\Controllers\LandingPage\SkPengesahanController;
use App\Http\Controllers\LandingPage\StrukturOrganisasiController;
use Illuminate\Support\Facades\Route;

// --- ROUTE PUBLIK (BISA DIAKSES SIAPA SAJA) ---

Route::get('/', [HomeController::class, 'index'])->name('root');

Route::prefix('tentang-kami')->name('tentang-kami.')->group(function () {
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/sejarah', [SejarahController::class, 'index'])->name('sejarah');
    Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur-organisasi');
    Route::get('/legalitas', [LegalitasController::class, 'index'])->name('legalitas');
});

Route::get('/kinerja-lingkungan', [KinerjaLingkunganController::class, 'index'])->name('kinerja-lingkungan');

Route::prefix('tata-kelola')->name('tata-kelola.')->group(function () {
    Route::get('/pelaporan-pajak', [PelaporanPajakController::class, 'index'])->name('pelaporan-pajak');
    Route::get('/kewajiban-retribusi', [KewajibanRetribusiController::class, 'index'])->name('kewajiban-retribusi');
});

Route::get('/transparansi-anggaran', [TransparansiController::class, 'index'])->name('transparansi');

// PANDUAN WARGA (HALAMAN DEPAN)
Route::get('/panduan-warga', [PanduanWargaController::class, 'index'])->name('panduan-warga');

// PENGADUAN & TESTIMONI
Route::get('/form-pengaduan', [FormPengaduanController::class, 'index'])->name('form-pengaduan');
Route::post('/form-pengaduan', [FormPengaduanController::class, 'store'])->name('form-pengaduan.store');
Route::post('/form-pengaduan/cari', [FormPengaduanController::class, 'cari'])->name('form-pengaduan.cari'); // Ubah ke POST sesuai diskusi sebelumnya

Route::get('/form-testimoni', [FormTestimonialController::class, 'index'])->name('form-testimoni');
Route::post('/form-testimoni', [FormTestimonialController::class, 'store'])->name('form-testimoni.store');

// LOGIN
Route::middleware(['guest'])->group(function () {
    Route::get('/admin/masuk', [AuthController::class, 'index'])->name('login.form');
    Route::post('/admin/masuk', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    
    // 1. ROUTE UTAMA ADMIN PANEL
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Pengaduan
        Route::match(['get', 'post'], '/daftar-pengaduan', [DaftarPengaduan::class, 'index'])->name('daftar-pengaduan');
        Route::get('/daftar-pengaduan/proses/{id}', [DaftarPengaduan::class, 'proses'])->name('daftar-pengaduan.proses');
        Route::get('/daftar-pengaduan/tolak/{id}', [DaftarPengaduan::class, 'tolak'])->name('daftar-pengaduan.tolak');
        Route::get('/daftar-pengaduan/selesai/{id}', [DaftarPengaduan::class, 'selesai'])->name('daftar-pengaduan.selesai');
        Route::delete('/daftar-pengaduan/bulk-destroy', [DaftarPengaduan::class, 'bulkDestroy'])->name('daftar-pengaduan.bulkDestroy');
        Route::post('/daftar-pengaduan/tanggapi/{id}', [DaftarPengaduan::class, 'tanggapi'])->name('daftar-pengaduan.tanggapi');

        // Testimoni
        Route::get('/daftar-testimoni', [DaftarTestimoniController::class, 'index'])->name('daftar-testimoni.index');
        Route::get('/daftar-testimoni/reject/{id}', [DaftarTestimoniController::class, 'reject'])->name('daftar-testimoni.reject');
        Route::delete('/daftar-testimoni/bulk-destroy', [DaftarTestimoniController::class, 'bulkDestroy'])->name('daftar-testimoni.bulkDestroy');
        Route::post('/testimoni/{id}/approve', [DaftarTestimoniController::class, 'approve'])->name('testimoni.approve');
        Route::post('/testimoni/{id}/unapprove', [DaftarTestimoniController::class, 'unapprove'])->name('testimoni.unapprove');

        // Pegawai & Kinerja
        Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai'); 
        Route::get('/pegawai/tambah', [PegawaiController::class, 'create'])->name('pegawai.create');
        Route::post('/pegawai/tambah', [PegawaiController::class, 'store'])->name('pegawai.store');
        Route::get('/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit'); 
        Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update'); 
        Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy'); 

        Route::get('/kinerja', [KinerjaController::class, 'index'])->name('kinerja');
        Route::post('/kinerja', [KinerjaController::class, 'store'])->name('kinerja.store');
        Route::delete('/kinerja/{kinerja}', [KinerjaController::class, 'destroy'])->name('kinerja.destroy');

        // Absensi
        Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
        Route::get('/absensi/tambah', [AbsensiController::class, 'create'])->name('absensi.create');
        Route::post('/absensi/tambah', [AbsensiController::class, 'store'])->name('absensi.store');
        Route::get('/absensi/cetak', [AbsensiController::class, 'cetak'])->name('absensi.cetak');
        Route::get('/absensi/lihat/{tanggal}', [AbsensiController::class, 'show'])->name('absensi.show');
        Route::get('/absensi/ubah/{tanggal}', [AbsensiController::class, 'edit'])->name('absensi.edit');
        Route::put('/absensi/ubah/{tanggal}', [AbsensiController::class, 'update'])->name('absensi.update');

        // Warga & Kategori
        Route::resource('warga', WargaController::class)->except(['show']);
        Route::post('/warga/import', [WargaController::class, 'import'])->name('warga.import');
        Route::resource('kategori-pengeluaran', KategoriPengeluaranController::class)->except(['show']);
        Route::resource('kategori-iuran', KategoriIuranController::class)->except(['show']);
        
        // Keuangan
        Route::get('iuran', [IuranController::class, 'index'])->name('iuran.index');
        Route::post('iuran/bayar', [IuranController::class, 'tandaiLunas'])->name('iuran.bayar');
        Route::delete('iuran/batal', [IuranController::class, 'batalkanLunas'])->name('iuran.batal');
        Route::get('iuran/cetak', [IuranController::class, 'cetak'])->name('iuran.cetak');
        Route::get('/pengeluaran/cetak', [PengeluaranController::class, 'cetak'])->name('pengeluaran.cetak');
        Route::resource('pengeluaran', PengeluaranController::class)->except(['show']);
        Route::resource('pemasukan-lain', PemasukanLainController::class)->except(['show']);

        // Artikel & Proyek
        Route::resource('artikel', ArtikelController::class);
        Route::get('proyek', [ProyekController::class,'index'])->name('proyek.index');
        Route::post('proyek', [ProyekController::class,'store'])->name('proyek.store');
        Route::delete('proyek/{proyek}', [ProyekController::class,'destroy'])->name('proyek.destroy');
    });

    // 2. ROUTE EDIT PANDUAN WARGA 
    Route::post('/panduan-warga/jadwal', [PanduanWargaController::class, 'storeJadwal'])->name('jadwal.store');
    Route::put('/panduan-warga/jadwal/{id}', [PanduanWargaController::class, 'updateJadwal'])->name('jadwal.update');
    Route::delete('/panduan-warga/jadwal/{id}', [PanduanWargaController::class, 'destroyJadwal'])->name('jadwal.destroy');

    Route::put('/panduan-warga/aturan/{id}', [PanduanWargaController::class, 'updateAturan'])->name('aturan.update');

    // KELUAR
    Route::get('/keluar', [AuthController::class, 'logout'])->name('logout');
});