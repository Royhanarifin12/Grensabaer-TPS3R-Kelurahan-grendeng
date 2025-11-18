@extends('layout.adminPage')

@section('pageTitle', 'Master Kategori Iuran')
@section('pageSubtitle', 'Pengaturan tarif iuran bulanan per kategori (Rumah Tangga / Usaha)')

@section('pageHeadingBtn')
    {{-- Tombol Tambah Data --}}
    <a href="{{ route('admin.kategori-iuran.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Kategori
    </a>
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            {{ session('error') }}
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
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th class="text-end">Tarif Iuran (Rp)</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategoriIuran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_kategori }}</td>
                                    <td class="text-end">Rp {{ number_format($item->tarif, 0, ',', '.') }}</td>
                                    
                                    <td class="text-center">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('admin.kategori-iuran.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.kategori-iuran.destroy', $item->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Menghapus kategori ini akan merusak data warga yang terikat. Yakin?');">
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
                                    <td colspan="4" class="text-center">
                                        Belum ada kategori yang dibuat. Harap buat kategori dasar (Rumah Tangga, Usaha).
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection