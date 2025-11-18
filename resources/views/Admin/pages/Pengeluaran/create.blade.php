@extends('layout.adminPage')

@section('pageTitle', 'Data Pengeluaran')
@section('pageSubtitle', 'Tambah Data Pengeluaran Baru')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Pengeluaran</h4>
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

            <form action="{{ route('admin.pengeluaran.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Pengeluaran <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" 
                                   value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                   placeholder="Cth: Gaji petugas penyapu" value="{{ old('keterangan') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" 
                                   placeholder="Cth: 1500000" value="{{ old('jumlah') }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kategori_pengeluaran_id" class="form-label">Kategori (Opsional)</label>
                            <select class="form-select" id="kategori_pengeluaran_id" name="kategori_pengeluaran_id">
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}" {{ old('kategori_pengeluaran_id') == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pengeluaran.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection