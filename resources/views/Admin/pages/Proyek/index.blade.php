@extends('layout.adminPage') {{-- Pastikan nama layout Anda benar --}}

@section('content')
<div class="container-fluid">
    <h3>Manajemen Gambar Proyek</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form Upload -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Tambah Gambar Proyek Baru</h5>
            <form action="{{ route('admin.proyek.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">File Gambar</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Upload Gambar</button>
            </form>
        </div>
    </div>

    <!-- Galeri Gambar -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Galeri Proyek Saat Ini</h5>
            <div class="row">
                @forelse($proyeks as $proyek)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ Storage::url($proyek->image_path) }}" class="card-img-top" alt="Gambar Proyek" style="height: 150px; object-fit: cover;">
                            <div class="card-footer text-center">
                                <form action="{{ route('admin.proyek.destroy', $proyek->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gambar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <p class="text-center">Belum ada gambar proyek yang di-upload.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection