@extends('layout.adminPage')

@section('pageTitle', 'Master Kategori Pengeluaran') 
@section('pageSubtitle', 'Pengaturan data master untuk kategori pengeluaran operasional')  
@section('pageHeadingBtn')
     <a href="{{ route('admin.kategori-pengeluaran.create') }}" class="btn btn-primary"> 
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
                                 <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                             @forelse ($KategoriPengeluaran as $item) 
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>  
                                     
                                    <td class="text-center">
                                         <a href="{{ route('admin.kategori-pengeluaran.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                         <form action="{{ route('admin.kategori-pengeluaran.destroy', $item->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
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
                                     <td colspan="3" class="text-center">
                                        Belum ada kategori pengeluaran yang dibuat.
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