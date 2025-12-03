@extends('layout.LandingPage')

@section('content')
    <style>
        .page-title-section {
            background-color: #f8f9fa;
            padding: 50px 0;
            text-align: center;
        }

        .page-title-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .page-title-section p {
            font-size: 1.1rem;
            color: #666;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .panduan-section {
            padding: 60px 0;
        }

        .panduan-container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            padding-bottom: 30px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
        }

        .pemilahan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }

        .pemilahan-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 30px;
            background-color: #ffffff;
        }

        .pemilahan-card h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .pemilahan-card h4 i {
            margin-right: 10px;
            font-size: 1.8rem;
            vertical-align: middle;
        }

        .icon-organik { color: #28a745; }
        .icon-anorganik { color: #007bff; }
        .icon-residu { color: #dc3545; }

        .pemilahan-card p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }

        .pemilahan-card ul {
            padding-left: 20px;
            margin: 0;
            color: #666;
        }

        .pemilahan-card li {
            margin-bottom: 8px;
        }

        .jadwal-table-container {
            overflow-x: auto;
            margin-top: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .jadwal-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 1rem;
        }

        .jadwal-table th,
        .jadwal-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
        }

        .jadwal-table th {
            background-color: #f9f9f9;
            font-weight: 700;
            color: #333;
        }

        .jadwal-table tr:last-child td {
            border-bottom: none;
        }

        .jadwal-table td strong {
            color: #333;
        }
    </style>

    <main id="main">

        {{-- BAGIAN 1: ATURAN PEMILAHAN (FIXED CATEGORY) --}}
        <section id="aturan-pemilahan" class="page-title light-background">
            <div class="panduan-container">

                <div class="page-title-section">
                    <h2>Aturan Pemilahan Sampah</h2>
                    <p>Pemilahan sampah dari rumah adalah langkah awal terpenting untuk membantu proses daur
                        ulang dan pengomposan. Pastikan Anda memisahkan sampah ke dalam kategori berikut:</p>
                </div>

                {{-- NOTIFIKASI SUKSES --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- TOMBOL TAMBAH DIHAPUS (Agar kategori tetap 3 dan tidak berubah) --}}

                <div class="pemilahan-grid">

                    @forelse($aturan as $item)
                        <div class="pemilahan-card position-relative h-100">

                            {{-- TOMBOL EDIT (Hanya Admin - Ikon Pensil Saja) --}}
                            @auth
                                <div class="position-absolute top-0 end-0 p-3">
                                    <button class="btn btn-sm btn-warning text-white shadow-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalEditAturan{{ $item->id }}"
                                        title="Ubah Isi">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    {{-- Tombol Hapus DIHAPUS agar kategori aman --}}
                                </div>
                            @endauth

                            <h4>
                                <i class="bi {{ $item->icon }} {{ $item->warna_class }}"></i>
                                {{ $item->judul }}
                            </h4>

                            <p>{{ $item->deskripsi }}</p>

                            <strong>Contoh:</strong>
                            <ul>
                                {{-- Memecah teks berdasarkan Enter menjadi list --}}
                                @foreach (explode("\n", $item->contoh) as $contoh)
                                    @if (trim($contoh) != '')
                                        <li>{{ $contoh }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        {{-- MODAL EDIT KHUSUS ISI (Hanya Deskripsi & Contoh) --}}
                        @auth
                            <div class="modal fade" id="modalEditAturan{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title fw-bold">
                                                Ubah Isi: {{ $item->judul }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        {{-- Form mengarah ke aturan.update --}}
                                        <form action="{{ route('aturan.update', $item->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-body text-start">
                                                
                                                <div class="alert alert-info small mb-3">
                                                    <i class="bi bi-info-circle me-1"></i> Anda hanya dapat mengubah deskripsi dan daftar contoh barang.
                                                </div>

                                                <div class="mb-3">
                                                    <label class="fw-bold form-label">Deskripsi Singkat</label>
                                                    <textarea name="deskripsi" class="form-control" rows="3" required>{{ $item->deskripsi }}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="fw-bold form-label">Daftar Contoh Barang</label>
                                                    <div class="form-text mb-1 text-muted small">
                                                        Gunakan tombol <b>Enter</b> untuk memisahkan setiap poin contoh.
                                                    </div>
                                                    <textarea name="contoh" class="form-control" rows="6" required>{{ $item->contoh }}</textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth

                    @empty
                        <div class="text-center col-12 py-5">
                            <p class="text-muted">Belum ada data aturan pemilahan.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </section>

        {{-- BAGIAN 2: JADWAL LAYANAN (TETAP BISA TAMBAH/EDIT/HAPUS) --}}
        <section id="jadwal-layanan" class="panduan-section" style="background-color: #f9f9f9;">
            <div class="panduan-container">

                <div class="section-title">
                    <h2>Jadwal Layanan Kami</h2>
                    <p>Kami melayani pengambilan sampah terpilah sesuai jadwal berikut. Pastikan sampah sudah
                        diletakkan di depan rumah Anda sebelum jam penjemputan.</p>
                </div>

                {{-- TOMBOL TAMBAH (Hanya Admin) --}}
                @auth
                    <div class="mb-3 text-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Jadwal
                        </button>
                    </div>
                @endauth

                <div class="jadwal-table-container">
                    <table class="jadwal-table">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Wilayah Penjemputan</th>
                                <th>Jam Operasional</th>
                                @auth
                                    <th style="width: 15%; text-align: center;">Aksi</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwal as $item)
                                <tr>
                                    <td class="fw-bold">{{ $item->hari }}</td>
                                    <td>{{ $item->wilayah }}</td>
                                    <td>{{ $item->jam_operasional }}</td>

                                    {{-- KOLOM AKSI (Hanya Admin) --}}
                                    @auth
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                {{-- Tombol Edit --}}
                                                <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditJadwal{{ $item->id }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('jadwal.destroy', $item->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endauth
                                </tr>

                                {{-- MODAL EDIT JADWAL --}}
                                @auth
                                    <div class="modal fade" id="modalEditJadwal{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold">Edit Jadwal Layanan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('jadwal.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Hari</label>
                                                            <input type="text" name="hari" class="form-control"
                                                                value="{{ $item->hari }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Wilayah Penjemputan</label>
                                                            <input type="text" name="wilayah" class="form-control"
                                                                value="{{ $item->wilayah }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Jam Operasional</label>
                                                            <input type="text" name="jam_operasional" class="form-control"
                                                                value="{{ $item->jam_operasional }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endauth

                            @empty
                                <tr>
                                    <td colspan="@auth 4 @else 3 @endauth" class="text-center py-4 text-muted">
                                        Belum ada jadwal layanan yang diatur.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- MODAL TAMBAH JADWAL (Hanya Admin) --}}
        @auth
            <div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Tambah Jadwal Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('jadwal.store') }}" method="POST">
                            @csrf
                            <div class="modal-body text-start">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Hari</label>
                                    <input type="text" name="hari" class="form-control"
                                        placeholder="Contoh: Senin & Kamis" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Wilayah Penjemputan</label>
                                    <input type="text" name="wilayah" class="form-control"
                                        placeholder="Contoh: RW 01, RW 02" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Jam Operasional</label>
                                    <input type="text" name="jam_operasional" class="form-control"
                                        placeholder="Contoh: 08.00 - 12.00 WIB" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
    </main>
@endsection