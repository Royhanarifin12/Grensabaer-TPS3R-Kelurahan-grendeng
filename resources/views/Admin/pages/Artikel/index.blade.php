@extends('layout.adminPage') 

@section('content')
<div class="container-fluid">
    <h3>Manajemen Informasi</h3>
    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary mb-3">Tambah Infromasi Baru</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artikels as $artikel)
                    <tr>
                        <td>
                            <img src="{{ Storage::disk('local')->url($artikel->image) }}" alt="{{ $artikel->title }}" width="100">
                        </td>
                        <td>{{ $artikel->title }}</td>
                        <td>
                            <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada artikel.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $artikels->links() }}
        </div>
    </div>
</div>
@endsection