@extends('layout.adminPage')

@section('pageTitle', 'Ubah Data Pegawai')
@section('pageSubtitle', 'Perbarui Data Pribadi Pegawai')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Data Pribadi Pegawai</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 

                {{-- 1. Nama Lengkap --}}
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    {{-- value diisi dengan data lama ($pegawai->nama) atau old() jika validasi gagal --}}
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
                        value="{{ old('nama_lengkap', $pegawai->nama) }}" required autofocus>
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 2. Nomor KTP/NIK --}}
                <div class="mb-3">
                    <label for="nik" class="form-label">Nomor KTP/NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror"
                        value="{{ old('nik', $pegawai->nik) }}" required maxlength="16" placeholder="16 digit NIK">
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 3. Tempat, Tanggal Lahir & Jenis Kelamin --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
                            value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}" required>
                        @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}" required>
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- 4. Agama & Status Pernikahan --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <select name="agama" id="agama" class="form-select @error('agama') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Agama</option>
                            <option value="Islam" {{ old('agama', $pegawai->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama', $pegawai->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama', $pegawai->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama', $pegawai->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama', $pegawai->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama', $pegawai->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                        <select name="status_pernikahan" id="status_pernikahan" class="form-select @error('status_pernikahan') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="Belum Menikah" {{ old('status_pernikahan', $pegawai->status_pernikahan) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="Menikah" {{ old('status_pernikahan', $pegawai->status_pernikahan) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                            <option value="Cerai Hidup" {{ old('status_pernikahan', $pegawai->status_pernikahan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                            <option value="Cerai Mati" {{ old('status_pernikahan', $pegawai->status_pernikahan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                        </select>
                        @error('status_pernikahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- 5. Alamat Lengkap --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $pegawai->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 6. Nomor Telepon & Email --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nomor_hp" class="form-label">Nomor Telepon/HP</label>
                        <input type="tel" name="nomor_hp" id="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror"
                            value="{{ old('nomor_hp', $pegawai->no_telp) }}" required placeholder="Contoh: 081234567890">
                        @error('nomor_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $pegawai->email) }}" placeholder="contoh@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- --- PERBAIKAN WAJIB DI SINI --- --}}
                <div class="row">
                    {{-- 7. Posisi --}}
                    <div class="col-md-6 mb-3">
                        <label for="posisi" class="form-label">Posisi</label>
                        <select name="posisi" id="posisi" class="form-select @error('posisi') is-invalid @enderror" required>
                            <option value="" disabled>Pilih Posisi Pegawai</option>
                            <option value="Staff Umum" {{ old('posisi', $pegawai->posisi) == 'Staff Umum' ? 'selected' : '' }}>Staff Umum</option>
                            <option value="Operator" {{ old('posisi', $pegawai->posisi) == 'Operator' ? 'selected' : '' }}>Operator</option>
                            <option value="Koordinator" {{ old('posisi', $pegawai->posisi) == 'Koordinator' ? 'selected' : '' }}>Koordinator</option>
                            <option value="Admin" {{ old('posisi', $pegawai->posisi) == 'Admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('posisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                {{-- 7. Status Pegawai (Tambahan untuk Edit) --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status Pegawai</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="1" {{ old('status', $pegawai->status) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status', $pegawai->status) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 8. Input FOTO --}}
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Pegawai (Maks 2MB, JPG/PNG)</label>
                    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($pegawai->foto)
                        <div class="mt-3">
                            <label>Foto Saat Ini:</label><br>
                            {{-- Menggunakan asset('storage/...') karena foto disimpan di public disk --}}
                            <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto Pegawai Saat Ini" style="width: 150px; height: auto; border-radius: 8px; border: 1px solid #ccc;">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.pegawai') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection
