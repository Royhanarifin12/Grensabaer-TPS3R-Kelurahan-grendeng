@extends('layout.adminPage')

@section('pageTitle', 'Data Pegawai')
@section('pageSubtitle', 'Data pegawai')
@section('pageHeadingBtn')
    <a href="{{ route('admin.pegawai.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Tambah
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-content">
                <table class="table table-striped table-lg">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>No. Telepon</th>
                            <th>Posisi</th>
                            <th>Status</th>
                            <th class="text-center">Foto</th> {{-- Kolom Baru untuk Foto --}}
                            <th class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $data)
                            <tr>
                                <td class="align-middle">{{ $data->nama }}</td>
                                <td class="align-middle">{{ $data->no_telp }}</td>
                                <td class="align-middle">{{ $data->posisi }}</td>
                                <td class="align-middle">
                                    <span class="badge {{ $data->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $data->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                
                                {{-- KOLOM BARU: FOTO PEGAWAI --}}
                                <td class="text-center align-middle">
                                    @if ($data->foto)
                                        <img src="{{ asset('storage/' . $data->foto) }}" 
                                             alt="Foto {{ $data->nama }}" 
                                             class="img-fluid rounded-circle" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        {{-- Placeholder jika foto belum diunggah --}}
                                        <i class="bi bi-person-circle text-secondary" style="font-size: 2.5rem;"></i>
                                    @endif
                                </td>
                                {{-- AKHIR KOLOM FOTO --}}
                                
                                {{-- KOLOM AKSI (Perataan dan Desain Tombol) --}}
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center gap-2"> 
                                        
                                        <!-- Tombol Ubah (Edit) -->
                                        <a href="{{ route('admin.pegawai.edit', $data->id) }}" class="btn btn-icon btn-sm btn-outline-warning" title="Ubah Data">
                                            <i class="bi bi-pencil-square"></i> 
                                        </a>
                                        
                                        <!-- Tombol Hapus (Menggunakan form dengan metode DELETE) -->
                                        <form action="{{ route('admin.pegawai.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pegawai {{ $data->nama }}?')">
                                            @csrf
                                            @method('DELETE') 
                                            <button type="submit" class="btn btn-icon btn-sm btn-outline-danger" title="Hapus Data">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                {{-- AKHIR KOLOM AKSI --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
