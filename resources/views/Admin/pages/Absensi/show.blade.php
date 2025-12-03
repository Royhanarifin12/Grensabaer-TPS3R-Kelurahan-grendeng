@extends('layout.adminPage') 

@section('pageTitle', 'Detail Absensi')
@section('pageSubtitle', 'Detail kehadiran pegawai pada tanggal ' . \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Absensi Tanggal: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.absensi.edit', $tanggal) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> Ubah Absensi
                    </a>
                    <a href="{{ route('admin.absensi') }}" class="btn btn-secondary btn-sm ml-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama Pegawai</th>
                            <th class="text-center">Status Kehadiran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($detailAbsensi as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->pegawai->nama }}</td>
                            <td class="text-center">
                                @php
                                    $badgeClass = '';
                                    if ($data->status == 'hadir') {
                                        $badgeClass = 'badge bg-success';
                                    } elseif ($data->status == 'sakit') {
                                        $badgeClass = 'badge bg-warning';
                                    } elseif ($data->status == 'izin') {
                                        $badgeClass = 'badge bg-info';
                                    } else {
                                        $badgeClass = 'badge bg-danger';
                                    }
                                @endphp
                                <span class="{{ $badgeClass }} text-capitalize">{{ $data->status }}</span>
                            </td>
                            <td>
                                {{-- Jika ada kolom keterangan, tampilkan di sini --}}
                                @if($data->keterangan ?? false)
                                    {{ $data->keterangan }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data absensi untuk tanggal ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>
        </div>
</div>
@endsection