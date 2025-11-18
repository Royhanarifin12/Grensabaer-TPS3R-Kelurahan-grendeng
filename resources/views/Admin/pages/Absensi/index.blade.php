@extends('layout.adminPage') {{-- Sesuaikan dengan layout Anda --}}

@section('pageTitle', 'Data Absensi')
@section('pageSubtitle', 'Ringkasan absensi pegawai harian')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="card-title">Data Absensi</h3>
                <div class="card-tools my-3">
                    
                    {{-- 1. TOMBOL CETAK BARU --}}
                    <a href="{{ route('admin.absensi.cetak') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-printer"></i> Cetak Laporan
                    </a>
                    
                    {{-- Tombol Tambah Anda yang sudah ada --}}
                    <a href="{{ route('admin.absensi.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> Tambah
                    </a>

                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jumlah Hadir</th>
                            <th>Jumlah Sakit</th>
                            <th>Jumlah Izin</th>
                            <th>Jumlah Alpa</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataAbsensi as $absensi)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('d F Y') }}</td>
                            <td>{{ $absensi->jumlah_hadir ?? 0 }} orang</td>
                            <td>{{ $absensi->jumlah_sakit ?? 0 }} orang</td>
                            <td>{{ $absensi->jumlah_izin ?? 0 }} orang</td>
                            <td>{{ $absensi->jumlah_alpa ?? 0 }} orang</td>
                            <td class="text-center">
                                
                                <a href="{{ route('admin.absensi.show', $absensi->tanggal) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                
                                <a href="{{ route('admin.absensi.edit', $absensi->tanggal) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Ubah
                                </a>
                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data absensi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>
        </div>
</div>
@endsection