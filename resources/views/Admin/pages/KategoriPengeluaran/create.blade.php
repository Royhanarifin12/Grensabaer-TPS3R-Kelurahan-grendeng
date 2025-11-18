@extends('layout.adminPage')

@section('pageTitle', 'Master Kategori Pengeluaran')  
@section('pageSubtitle', 'Tambah Kategori Pengeluaran Baru')  

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

            <form action="{{ route('admin.kategori-pengeluaran.store') }}" method="POST">  
                @csrf
                
                <div class="row">
                     <div class="col-md-12">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                   placeholder="Cth: Biaya ATK" 
                                   value="{{ old('nama') }}" required>
                        </div>
                    </div>
                 </div>
                
                <hr>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.kategori-pengeluaran.index') }}" class="btn btn-light">Batal</a>  
                    <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection