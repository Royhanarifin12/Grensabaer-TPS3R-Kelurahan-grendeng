@extends('layout.adminPage')

@section('pageTitle', 'Tambah Data Pegawai')
@section('pageSubtitle', 'Input Data Pribadi Pegawai Baru')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Data Pribadi Pegawai</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pegawai.store') }}" method="POST" enctype="multipart/form-data">
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

                 <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
                            value="{{ old('tempat_lahir') }}" required>
                        @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            value="{{ old('tanggal_lahir') }}" required>
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                 <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <select name="agama" id="agama" class="form-select @error('agama') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Agama</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                        <select name="status_pernikahan" id="status_pernikahan" class="form-select @error('status_pernikahan') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="Belum Menikah" {{ old('status_pernikahan') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="Menikah" {{ old('status_pernikahan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                            <option value="Cerai Hidup" {{ old('status_pernikahan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                            <option value="Cerai Mati" {{ old('status_pernikahan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                        </select>
                        @error('status_pernikahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
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
                        <label for="nomor_hp" class="form-label">Nomor Telepon/HP</label>
                        <input type="tel" name="nomor_hp" id="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror"
                            value="{{ old('nomor_hp') }}" required placeholder="Contoh: 081234567890">
                        @error('nomor_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="contoh@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                 <div class="mb-3">
                    <label for="posisi" class="form-label">Posisi</label>
                    <select name="posisi" id="posisi" class="form-select @error('posisi') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Posisi Pegawai</option>
                        <option value="Staff Umum" {{ old('posisi') == 'Staff Umum' ? 'selected' : '' }}>Staff Umum</option>
                        <option value="Operator" {{ old('posisi') == 'Operator' ? 'selected' : '' }}>Operator</option>
                        <option value="Koordinator" {{ old('posisi') == 'Koordinator' ? 'selected' : '' }}>Koordinator</section>
                        <option value="Admin" {{ old('posisi') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('posisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                 
                <div class="mb-4">
                    <label for="foto" class="form-label">Foto Pegawai (Opsional)</label>
                     <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept=".jpg,.jpeg,.png">
                    <div class="form-text">Maksimal 2MB. Format: JPG, JPEG, PNG.</div>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
 
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection
