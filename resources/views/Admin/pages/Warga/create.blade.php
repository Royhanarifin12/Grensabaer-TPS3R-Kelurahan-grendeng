@extends('layout.adminPage')

@section('pageTitle', 'Tambah Data Warga')
@section('pageSubtitle', 'Input data warga baru penerima layanan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Data Warga Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.warga.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
                        value="{{ old('nama_lengkap') }}" required autofocus>
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label">Nomor KTP/NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror"
                        value="{{ old('nik') }}" required maxlength="16" placeholder="16 digit NIK">
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="rw" class="form-label">RW</label>
                        <input type="text" name="rw" id="rw" class="form-control @error('rw') is-invalid @enderror" 
                                 value="{{ old('rw') }}" required placeholder="Contoh: 001 (3 digit)">
                        @error('rw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="rt" class="form-label">RT</label>
                        <input type="text" name="rt" id="rt" class="form-control @error('rt') is-invalid @enderror" 
                                 value="{{ old('rt') }}" required placeholder="Contoh: 005 (3 digit)">
                        @error('rt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="kategori_iuran_id" class="form-label">Kategori Iuran <span class="text-danger">*</span></label>
                    <select class="form-control @error('kategori_iuran_id') is-invalid @enderror" id="kategori_iuran_id" name="kategori_iuran_id" required>
                        <option value="">-- Pilih Kategori Iuran --</option>
                        @if(isset($kategoriIurans))
                            @foreach ($kategoriIurans as $kategori)
                                <option 
                                    value="{{ $kategori->id }}" 
                                    {{ old('kategori_iuran_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }} (Rp {{ number_format($kategori->tarif, 0, ',', '.') }})
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('kategori_iuran_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(!isset($kategoriIurans) || $kategoriIurans->isEmpty())
                        <div class="form-text text-danger">
                            * Harap buat minimal satu Kategori Iuran di menu Master Kategori Iuran sebelum menambah warga.
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="no_telp" class="form-label">Nomor Telepon/HP</label>
                        <input type="tel" name="no_telp" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror"
                            value="{{ old('no_telp') }}" required placeholder="Contoh: 081234567890">
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status_warga" class="form-label">Status Warga</label>
                        <select name="status_warga" id="status_warga" class="form-select @error('status_warga') is-invalid @enderror" required>
                            <option value="Aktif" {{ old('status_warga') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ old('status_warga') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            <option value="Pindah" {{ old('status_warga') == 'Pindah' ? 'selected' : '' }}>Pindah</option>
                        </select>
                        @error('status_warga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.warga.index') }}" class="btn btn-light me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Data Warga</button>
                </div>
            </form>
        </div>
    </div>
@endsection