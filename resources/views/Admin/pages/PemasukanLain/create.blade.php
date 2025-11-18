@extends('layout.adminPage')

@section('title', 'Data Pemasukan Lain')
@section('pageSubtitle', 'Tambah Data Pemasukan Baru')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Pemasukan Lain</h4>
        </div>
        <div class="card-body">

            {{-- Menampilkan Error Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pemasukan-lain.store') }}" method="POST">
                @csrf
                <div class="row">
                    {{-- Kolom Kiri --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Pemasukan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" 
                                   value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                   placeholder="Cth: Dana Bantuan Pusat" value="{{ old('keterangan') }}" required>
                        </div>
                    </div>
                    
                    {{-- Kolom Kanan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" 
                                   placeholder="Cth: 5000000" value="{{ old('jumlah') }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori (Opsional)</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" 
                                   placeholder="Cth: Bantuan Pusat atau Donasi" value="{{ old('kategori') }}">
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pemasukan-lain.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection