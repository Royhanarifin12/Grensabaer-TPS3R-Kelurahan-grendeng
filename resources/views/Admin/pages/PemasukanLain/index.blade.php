@extends('layout.adminPage')

@section('title', 'Data Pemasukan Lain')
@section('pageSubtitle', 'Pencatatan pemasukan di luar iuran warga (Donasi, Bantuan Pusat, dll)')

@section('pageHeadingBtn')
     <a href="{{ route('admin.pemasukan-lain.create') }}" class="btn btn-primary">
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
                            @forelse ($dataPemasukan as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->kategori ?? '-' }}</td>
                                    <td class="text-end">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    
                                     <td class="text-center">
                                         <a href="{{ route('admin.pemasukan-lain.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                         <form action="{{ route('admin.pemasukan-lain.destroy', $item->id) }}" method="POST" class="d-inline"
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
                                        Belum ada data pemasukan lain.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        {{-- Tampilkan Total di Footer Tabel --}}
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total Pemasukan Lain:</th>
                                <th class="text-end">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection