@extends('layout.adminPage')

@section('pageTitle', 'Manajemen Iuran Warga')
@section('pageSubtitle', 'Pencatatan iuran operasional warga')

@section('content')

<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">
                Daftar Iuran Warga (Periode: {{ \Carbon\Carbon::parse($periode_aktif)->translatedFormat('F Y') }})
            </h4>
            
            <a href="{{ route('admin.iuran.cetak', [
                    'filter_bulan' => $filter_bulan_aktif,
                    'filter_tahun' => $filter_tahun_aktif,
                    'filter_rw' => $filter_rw_aktif,
                    'filter_rt' => $filter_rt_aktif,
                    'filter_status' => $filter_status_aktif
                ]) }}" target="_blank" class="btn btn-success">
                <i class="bi bi-printer"></i> Cetak Laporan
            </a>
        </div>
        
        <div class="card-body">
        
            <h5 class="card-title mb-3">Filter Data Iuran</h5>
            <form action="{{ route('admin.iuran.index') }}" method="GET" id="iuran">
                <div class="row g-3">
                    
                    <div class="col-md-3">
                        <label for="filter_nama">Cari Nama Warga</label>
                        <input type="text" class="form-control" name="filter_nama" id="filter_nama" 
                               value="{{ $filter_nama_aktif ?? '' }}" placeholder="Ketik nama...">
                    </div>

                    <div class="col-md-2">
                        <label for="filter_bulan">Pilih Bulan</label>
                        <select name="filter_bulan" id="filter_bulan" class="form-select">
                            @for ($b = 1; $b <= 12; $b++)
                                <option value="{{ $b }}" {{ $filter_bulan_aktif == $b ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-1">
                        <label for="filter_tahun">Tahun</label>
                        <select name="filter_tahun" id="filter_tahun" class="form-select">
                            @for ($t = date('Y') + 1; $t >= date('Y') - 5; $t--)
                                <option value="{{ $t }}" {{ $filter_tahun_aktif == $t ? 'selected' : '' }}>
                                    {{ $t }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-1">
                        <label for="filter_rw">RW</label>
                        <select name="filter_rw" id="filter_rw" class="form-select">
                            <option value="">Semua</option>
                            @foreach ($daftar_rw as $rw)
                                <option value="{{ $rw->rw }}" {{ $filter_rw_aktif == $rw->rw ? 'selected' : '' }}>
                                    {{ $rw->rw }}
                                </option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="col-md-1">
                        <label for="filter_rt">RT</label>
                        <select name="filter_rt" id="filter_rt" class="form-select">
                            <option value="">Semua</option>
                            @foreach ($daftar_rt as $rt)
                                <option value="{{ $rt->rt }}" {{ $filter_rt_aktif == $rt->rt ? 'selected' : '' }}>
                                    {{ $rt->rt }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label for="filter_status">Status Bayar</label>
                        <select name="filter_status" id="filter_status" class="form-select">
                            <option value="" {{ $filter_status_aktif == '' ? 'selected' : '' }}>Semua</option>
                            <option value="Lunas" {{ $filter_status_aktif == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="Menunggak" {{ $filter_status_aktif == 'Menunggak' ? 'selected' : '' }}>Menunggak</option>
                        </select>
                    </div>

                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Cari</button>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <a href="{{ route('admin.iuran.index') }}" class="btn btn-light w-100">Reset</a>
                    </div>
                </div>
            </form>

            <hr class="my-4">

            <div class="table-responsive">
                <table class="table table-striped table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>Nama Warga</th>
                            <th>Alamat</th>
                            <th>RT/RW</th>
                            <th>Kategori & Tarif</th>
                            <th class="text-center">Status Pembayaran</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataIuran as $warga)
                            <tr>
                                <td>{{ $warga->nama_lengkap }}</td>
                                <td>{{ $warga->alamat_lengkap ?? $warga->alamat }}</td>
                                <td>{{ $warga->rt }}/{{ $warga->rw }}</td>
                                <td>
                                    @if ($warga->kategori)
                                        <span class="fw-bold">{{ $warga->kategori->nama_kategori }}</span><br>
                                        <small>Rp {{ number_format($warga->tarif_iuran, 0, ',', '.') }}</small>
                                    @else
                                        <span class="text-danger">Kategori Belum Ditentukan</span>
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    @if ($warga->status_bayar == 'Lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-danger">Menunggak</span>
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    @if ($warga->status_bayar == 'Lunas')
                                        <form action="{{ route('admin.iuran.batal') }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="pembayaran_id" value="{{ $warga->pembayaran_id }}">
                                            <button type="submit" class="btn btn-warning btn-sm" title="Batalkan Lunas">
                                                <i class="bi bi-x-circle"></i> Batalkan
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.iuran.bayar') }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="warga_id" value="{{ $warga->id }}">
                                            <input type="hidden" name="periode" value="{{ $periode_aktif }}">
                                            <button type="submit" class="btn btn-success btn-sm" title="Tandai Lunas">
                                                <i class="bi bi-check-circle"></i> Tandai Lunas
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    Tidak ada data warga untuk filter yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection