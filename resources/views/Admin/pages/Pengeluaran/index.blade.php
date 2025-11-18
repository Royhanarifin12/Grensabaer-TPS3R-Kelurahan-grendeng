@extends('layout.adminPage')

@section('pageTitle', 'Data Pengeluaran')
@section('pageSubtitle', 'Pencatatan alokasi dana operasional')

@section('pageHeadingBtn')
    <a href="{{ route('admin.pengeluaran.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Data
    </a>
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Filter Laporan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pengeluaran.index') }}" method="GET" id="filterPengeluaran">

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Tipe Filter:</strong>
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="radio" name="filter_type" id="radioPerTanggal"
                                    value="tanggal" {{ request('filter_type', 'tanggal') == 'tanggal' ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioPerTanggal">Per Tanggal</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="filter_type" id="radioPerBulan"
                                    value="bulan" {{ request('filter_type') == 'bulan' ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioPerBulan">Per Bulan & Tahun</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" id="filter-tanggal-wrapper" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                        value="{{ request('tanggal_mulai') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                                        value="{{ request('tanggal_selesai') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id="filter-bulan-wrapper" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="bulan" class="form-label">Pilih Bulan</label>
                                    <select class="form-select" id="bulan" name="bulan">
                                        <option value="">-- Semua Bulan --</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}"
                                                {{ request('bulan') == $i ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create(null, $i, 1)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tahun" class="form-label">Pilih Tahun</label>
                                    <input type="number" class="form-control" id="tahun" name="tahun"
                                        placeholder="Cth: 2025" value="{{ request('tahun', date('Y')) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="kategori_id" class="form-label">Filter Kategori</label>
                            <select class="form-select" id="kategori_id" name="kategori_id">
                                <option value="">-- Semua Kategori --</option>

                                @foreach ($kategoriOptions as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Cari
                            </button>
                            <a href="{{ route('admin.pengeluaran.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-repeat"></i> Reset
                            </a>

                            <a href="{{ route('admin.pengeluaran.cetak', request()->all()) }}" target="_blank"
                                class="btn btn-success">
                                <i class="bi bi-printer"></i> Cetak Laporan
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Kategori</th>
                                <th class="text-end">Jumlah (Rp)</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataPengeluaran as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $item->keterangan }}</td>

                                    <td>{{ $item->kategoriPengeluaran->nama ?? '-' }}</td>

                                    <td class="text-end">{{ number_format($item->jumlah, 0, ',', '.') }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.pengeluaran.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <form action="{{ route('admin.pengeluaran.destroy', $item->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Belum ada data pengeluaran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total Pengeluaran:</th>
                                <th class="text-end">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
<script>
    // Pastikan DOM sudah siap
    document.addEventListener('DOMContentLoaded', function() {
        
        // Ambil elemen-elemen yang diperlukan
        const radioPerTanggal = document.getElementById('radioPerTanggal');
        const radioPerBulan = document.getElementById('radioPerBulan');
        const filterTanggalWrapper = document.getElementById('filter-tanggal-wrapper');
        const filterBulanWrapper = document.getElementById('filter-bulan-wrapper');

        // Fungsi untuk menampilkan/menyembunyikan filter
        function toggleFilterVisibility() {
            if (radioPerTanggal.checked) {
                filterTanggalWrapper.style.display = 'block'; // Tampilkan filter tanggal
                filterBulanWrapper.style.display = 'none';   // Sembunyikan filter bulan
            } else if (radioPerBulan.checked) {
                filterTanggalWrapper.style.display = 'none';    // Sembunyikan filter tanggal
                filterBulanWrapper.style.display = 'block';  // Tampilkan filter bulan
            }
        }

        // Tambahkan listener ke kedua radio button
        radioPerTanggal.addEventListener('change', toggleFilterVisibility);
        radioPerBulan.addEventListener('change', toggleFilterVisibility);

        // Panggil fungsi saat halaman pertama kali dimuat
        // Ini untuk menangani filter yang sudah aktif (setelah submit)
        toggleFilterVisibility();

    });
</script>
@endpush

@endsection
