@extends('layout.adminPage') {{-- Sesuaikan nama layout Anda jika berbeda --}}

@section('pageTitle', 'Data Warga')
@section('pageSubtitle', 'Edit Data Warga: ' . $warga->nama_lengkap)

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit Data Warga</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Menggunakan route update resource dan method PUT --}}
            <form action="{{ route('admin.warga.update', $warga->id) }}" method="POST">
                @csrf
                @method('PUT') 

                <div class="row">
                    {{-- ----------------------------------------------------- --}}
                    {{-- FIELD NAMA LENGKAP --}}
                    <div class="col-md-6 mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                               value="{{ old('nama_lengkap', $warga->nama_lengkap) }}" required>
                    </div>

                    {{-- FIELD NIK --}}
                    <div class="col-md-6 mb-3">
                        <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nik" name="nik"
                               value="{{ old('nik', $warga->nik) }}" required maxlength="16">
                    </div>

                    {{-- ----------------------------------------------------- --}}
                    {{-- FIELD KATEGORI IURAN (PENTING: Pengganti input Tarif) --}}
                    <div class="col-md-6 mb-3">
                        <label for="kategori_iuran_id" class="form-label">Kategori Iuran <span class="text-danger">*</span></label>
                        <select class="form-control @error('kategori_iuran_id') is-invalid @enderror" id="kategori_iuran_id" name="kategori_iuran_id" required>
                            <option value="">-- Pilih Kategori Iuran --</option>
                            
                            @foreach ($kategoriIurans as $kategori)
                                @php
                                    // Logic untuk memilih opsi yang sesuai: ambil dari old() atau data warga saat ini
                                    $isSelected = old('kategori_iuran_id', $warga->kategori_iuran_id) == $kategori->id;
                                @endphp
                                <option 
                                    value="{{ $kategori->id }}" 
                                    {{ $isSelected ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }} (Rp {{ number_format($kategori->tarif, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_iuran_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- ----------------------------------------------------- --}}

                    {{-- FIELD NO TELP --}}
                    <div class="col-md-6 mb-3">
                        <label for="no_telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp"
                               value="{{ old('no_telp', $warga->no_telp) }}">
                    </div>

                    {{-- FIELD ALAMAT --}}
                    <div class="col-md-12 mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $warga->alamat) }}</textarea>
                    </div>

                    {{-- FIELD RT --}}
                    <div class="col-md-4 mb-3">
                        <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="rt" name="rt"
                               value="{{ old('rt', $warga->rt) }}" required>
                    </div>

                    {{-- FIELD RW --}}
                    <div class="col-md-4 mb-3">
                        <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="rw" name="rw"
                               value="{{ old('rw', $warga->rw) }}" required>
                    </div>

                    {{-- FIELD STATUS WARGA --}}
                    <div class="col-md-4 mb-3">
                        <label for="status_warga" class="form-label">Status Warga <span class="text-danger">*</span></label>
                        <select class="form-control" id="status_warga" name="status_warga" required>
                            <option value="Aktif" {{ old('status_warga', $warga->status_warga) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ old('status_warga', $warga->status_warga) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            <option value="Pindah" {{ old('status_warga', $warga->status_warga) == 'Pindah' ? 'selected' : '' }}>Pindah</option>
                        </select>
                    </div>

                </div>
                
                <hr>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.warga.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-warning">Perbarui Data Warga</button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection