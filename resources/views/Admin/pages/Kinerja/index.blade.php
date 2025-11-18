@extends('layout.adminPage')

@section('pageTitle', 'Kinerja Operasional')
@section('pageSubtitle', 'Input volume sampah harian (Organik, Anorganik, Residu)')

@section('content')
    <div class="row">
          <div class="col-lg-5 col-md-12 print-hide"> 
            <div class="card">
                <div class="card-header">
                    <h4>Catat Volume Sampah Harian</h4>
                </div>
                 <form action="{{ route('admin.kinerja.store') }}" method="POST" class="card-body">
                    @csrf
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Input Data</label>
                        <input type="date" name="tanggal" id="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal', now()->toDateString()) }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <h6 class="mt-4 text-muted">Volume Sampah (dalam Kilogram / m<sup>3</sup>)</h6>
                    <div class="mb-3">
                        <label for="organik" class="form-label">Volume Organik (m<sup>3</sup>)</label>
                        <input type="number" name="organik" id="organik"
                            class="form-control @error('organik') is-invalid @enderror"
                            value="{{ old('organik') }}" min="0" required>
                        @error('organik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="anorganik" class="form-label">Volume Anorganik (m<sup>3</sup>)</label>
                        <input type="number" name="anorganik" id="anorganik"
                            class="form-control @error('anorganik') is-invalid @enderror"
                            value="{{ old('anorganik') }}" min="0" required>
                        @error('anorganik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="residu" class="form-label">Residu (m<sup>3</sup>)</label>
                        <input type="number" name="residu" id="residu"
                            class="form-control @error('residu') is-invalid @enderror"
                            value="{{ old('residu') }}" min="0" required>
                        @error('residu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <h6 class="mt-4 text-muted">Nilai Ekonomi (dalam Rupiah)</h6>
                    <div class="mb-3">
                        <label for="nilai_ekonomi" class="form-label">Nilai Ekonomi Harian (Rp)</label>
                        <input type="number" name="nilai_ekonomi" id="nilai_ekonomi"
                            class="form-control @error('nilai_ekonomi') is-invalid @enderror"
                            value="{{ old('nilai_ekonomi', 0) }}" min="0" required>
                        @error('nilai_ekonomi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary d-flex ">
                            <i class="bi bi-save-fill me-2"></i> Simpan Kinerja
                        </button>
                    </div>
                </form>
            </div>
        </div>

         <div class="col-lg-7 col-md-12" id="print-area">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Riwayat Pencatatan Kinerja</h4>
                    
                    <button onclick="window.print()" class="btn btn-success btn-sm print-hide">
                        <i class="bi bi-printer-fill me-2"></i> Cetak Laporan
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-lg">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Organik (m<sup>3</sup>)</th>
                                <th>Anorganik (m<sup>3</sup>)</th>
                                <th>Residu (m<sup>3</sup>)</th>
                                <th>Nilai Ekonomi (Rp)</th>
                                <th>Total (m<sup>3</sup>)</th>
                                <th class="text-center print-hide">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kinerja as $data)
                                <tr>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ number_format($data->organik, 0, ',', '.') }}</td>
                                    <td>{{ number_format($data->anorganik, 0, ',', '.') }}</td>
                                    <td>{{ number_format($data->residu, 0, ',', '.') }}</td>
                                    <td>{{ number_format($data->nilai_ekonomi, 0, ',', '.') }}</td>
                                    <td>{{ number_format($data->organik + $data->anorganik + $data->residu, 0, ',', '.') }}</td>
                                    <td class="text-center print-hide">
                                        <form action="{{ route('admin.kinerja.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data kinerja tanggal {{ $data->tanggal }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-sm btn-outline-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada data kinerja yang tercatat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #print-area, #print-area * {
                visibility: visible;
            }

            #print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            #sidebar, #main header, .page-heading, .print-hide, .col-lg-5 {
                display: none !important;
            }

            .table {
                width: 100%;
            }

            .card {
                page-break-inside: avoid;
            }
        }
    </style>
@endsection