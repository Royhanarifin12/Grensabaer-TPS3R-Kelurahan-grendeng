@extends('layout.adminPage')

@section('pageTitle', 'Master Kategori Iuran')
@section('pageSubtitle', 'Tambah Kategori Iuran Baru')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Kategori</h4>
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

            <form action="{{ route('admin.kategori-iuran.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                   placeholder="Cth: Rumah Tangga atau Usaha Kecil" value="{{ old('nama_kategori') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tarif" class="form-label">Tarif Iuran (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="tarif" name="tarif" 
                                   placeholder="Cth: 20000" value="{{ old('tarif', 0) }}" required>
                            <div class="form-text">
                                Masukkan nominal tarif iuran bulanan.
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.kategori-iuran.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection