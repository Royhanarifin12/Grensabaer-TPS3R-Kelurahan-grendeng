@extends('layout.adminPage')

@section('pageTitle', 'Tambah Data Absensi')
@section('pageSubtitle', 'Tambah Data Absensi')

@section('content')
    @php
        $tanggalDipilih = request('tanggal', today()->format('Y-m-d'));
    @endphp

    <div class="card">

        <div class="card-header">
            <form action="{{ route('admin.absensi.create') }}" method="GET" id="filterTanggal">
                <div class="form-label">
                    Tanggal
                </div>
                <input type="date" name="tanggal" id="" class="form-control" max="{{ today()->format('Y-m-d') }}"
                    value="{{ $tanggalDipilih }}" onchange="document.getElementById('filterTanggal').submit();">
            </form>
        </div>
        <div class="card-body">
            <div class="card-content">
                <form action="{{ route('admin.absensi.store') }}" method="POST" id="absensiForm">
                    @csrf
                    <input type="hidden" name="tanggal" value="{{ $tanggalDipilih }}">
                    <table class="table table-striped table-lg">
                        <thead>
                            <th>Nama</th>
                            <th class="text-center">Hadir</th>
                            <th class="text-center">Sakit</th>
                            <th class="text-center">Izin</th>
                            <th class="text-center">Alpa</th>
                        </thead>
                        <tbody>
                            @forelse ($pegawai as $data)
                                <tr>
                                    <td>{{ $data->nama }}</td>
                                    <td class="text-center"><input type="radio" name="status[{{ $data->id }}]"
                                            value="hadir" required></td>
                                    <td class="text-center"><input type="radio" name="status[{{ $data->id }}]"
                                            value="sakit"></td>
                                    <td class="text-center"><input type="radio" name="status[{{ $data->id }}]"
                                            value="izin"></td>
                                    <td class="text-center"><input type="radio" name="status[{{ $data->id }}]"
                                            value="alpa"></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-success fw-bold">
                                        Semua pegawai sudah diabsen untuk tanggal ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <button type="submit" form="absensiForm" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
@endsection
