@extends('layout.adminPage')

@section('pageTitle', 'Data Warga')
@section('pageSubtitle', 'Pengelolaan data warga penerima layanan')

@section('pageHeadingBtn')
    <div class="d-flex gap-2 align-items-center">
        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#importExcelModal">
            <i class="bi bi-file-excel"></i> Import Excel (Test)
        </button>
        <a href="{{ route('admin.warga.create') }}" class="btn btn-primary">
            <i class="bi bi-plus"></i> Tambah Warga
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Filter Data Warga</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.warga.index') }}" method="GET" id="wargaFilter">
                        <div class="row g-3">

                            <div class="col-md-2">
                                <label for="filter_nama" class="form-label">Cari Nama Warga</label>
                                <input type="text" name="filter_nama" id="filter_nama" class="form-control"
                                    placeholder="Masukkan nama..." value="{{ $filter_nama_aktif ?? '' }}">
                            </div>

                            <div class="col-md-2">
                                <label for="filter_rw" class="form-label">Filter RW</label>
                                <select name="filter_rw" id="filter_rw" class="form-control">
                                    <option value="">Semua RW</option>
                                    @foreach ($daftar_rw as $rw)
                                        <option value="{{ $rw->rw }}"
                                            {{ ($filter_rw_aktif ?? '') == $rw->rw ? 'selected' : '' }}>
                                            RW {{ $rw->rw }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="filter_rt" class="form-label">Filter RT</label>
                                <select name="filter_rt" id="filter_rt" class="form-control">
                                    <option value="">Semua RT</option>
                                    @foreach ($daftar_rt as $rt)
                                        <option value="{{ $rt->rt }}"
                                            {{ ($filter_rt_aktif ?? '') == $rt->rt ? 'selected' : '' }}>
                                            RT {{ $rt->rt }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="filter_status_warga" class="form-label">Filter Status</label>
                                <select name="filter_status_warga" id="filter_status_warga" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="Aktif"
                                        {{ ($filter_status_warga_aktif ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Nonaktif"
                                        {{ ($filter_status_warga_aktif ?? '') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    <option value="Pindah"
                                        {{ ($filter_status_warga_aktif ?? '') == 'Pindah' ? 'selected' : '' }}>Pindah</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="filter_kategori_id" class="form-label">Filter Kategori</label>
                                <select name="filter_kategori_id" id="filter_kategori_id" class="form-control">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($daftar_kategori as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ ($filter_kategori_id_aktif ?? '') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2 w-100">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                                <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary w-100">
                                    <i class="bi bi-arrow-repeat te me-1"></i>Reset
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Warga Terdaftar</h4>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-lg">
                            <thead>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat</th>
                                    <th>RT/RW</th>
                                    <th>Kategori & Tarif</th>
                                    <th>No. Telepon</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($wargas as $data)
                                    <tr>
                                        <td class="align-middle">{{ $data->nama_lengkap }}</td>
                                        <td class="align-middle">{{ $data->alamat }}</td>
                                        <td class="align-middle">{{ $data->rt }}/{{ $data->rw }}</td>

                                        <td class="align-middle">
                                            @if ($data->kategori)
                                                <span class="fw-bold">{{ $data->kategori->nama_kategori }}</span><br>
                                                <small>Rp {{ number_format($data->kategori->tarif, 0, ',', '.') }}</small>
                                            @else
                                                <span class="badge bg-danger">Belum Ditetapkan</span>
                                            @endif
                                        </td>

                                        <td class="align-middle">{{ $data->no_telp }}</td>
                                        <td class="align-middle">
                                            @if ($data->status_warga == 'Aktif')
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $data->status_warga }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <a href="{{ route('admin.warga.edit', $data->id) }}"
                                                    class="btn btn-icon btn-sm btn-outline-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('admin.warga.destroy', $data->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data warga {{ $data->nama_lengkap }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada data warga yang
                                            tercatat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="importExcelModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.warga.import') }}" method="POST" enctype="multipart/form-data"
                        id="importForm">
                        @csrf
                        <input type="file" name="file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="importForm" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
