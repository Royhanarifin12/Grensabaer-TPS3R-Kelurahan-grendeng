{{-- Pastikan ini @extends ke layout Anda yang benar --}}
@extends('layout.adminPage') 

@section('content')
<div class="container-fluid">
    <h3>Tambah Informasi Baru</h3>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Informasi</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Header</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Konten</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                    @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Kirim</button>
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection