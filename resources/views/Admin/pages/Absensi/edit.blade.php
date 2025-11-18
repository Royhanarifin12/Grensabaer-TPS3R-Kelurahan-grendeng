@extends('layout.adminPage')

@section('pageTitle', 'Ubah Absensi')
@section('pageSubtitle', 'Mengubah data absensi pegawai pada tanggal ' .
    \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y'))

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ubah Absensi Tanggal:
                        {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</h3>
                </div>

                <form action="{{ route('admin.absensi.update', $tanggal) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle-fill"></i> <strong>Catatan:</strong> Hanya pegawai aktif yang
                            ditampilkan. Isi status kehadiran untuk semua pegawai.
                        </div>

                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <table class="table" style="vertical-align: middle;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Nama Pegawai</th>
                                    <th style="width: 40%;">Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawais as $pegawai)
                                    @php
                                        $statusTersimpan = $absensiSudahAda[$pegawai->id] ?? 'hadir';
                                    @endphp 
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pegawai->nama }}</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="status[{{ $pegawai->id }}]" id="hadir_{{ $pegawai->id }}"
                                                    value="hadir" {{ $statusTersimpan == 'hadir' ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="hadir_{{ $pegawai->id }}">Hadir</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="status[{{ $pegawai->id }}]" id="sakit_{{ $pegawai->id }}"
                                                    value="sakit" {{ $statusTersimpan == 'sakit' ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="sakit_{{ $pegawai->id }}">Sakit</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="status[{{ $pegawai->id }}]" id="izin_{{ $pegawai->id }}"
                                                    value="izin" {{ $statusTersimpan == 'izin' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="izin_{{ $pegawai->id }}">Izin</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="status[{{ $pegawai->id }}]" id="alpa_{{ $pegawai->id }}"
                                                    value="alpa" {{ $statusTersimpan == 'alpa' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="alpa_{{ $pegawai->id }}">Alpa</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
