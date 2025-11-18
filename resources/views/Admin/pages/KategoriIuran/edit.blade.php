@extends('layout.adminPage')

@section('pageTitle', 'Master Kategori Iuran')
{{-- Asumsi Controller mengirim variabel $kategori (satu data) --}}
@section('pageSubtitle', 'Edit Kategori Iuran: ' . $kategori->nama_kategori) 

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit Kategori</h4>
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

            {{-- Form ini mengarah ke route 'update' --}}
            <form action="{{ route('admin.kategori-iuran.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT') 
                
                <div class="row">
                    {{-- Input 1: Nama Kategori (Bukan dropdown) --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                   placeholder="Cth: Rumah Tangga" 
                                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                        </div>
                    </div>
                    
                    {{-- Input 2: Tarif Iuran (Bukan dropdown) --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tarif" class="form-label">Tarif Iuran (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="tarif" name="tarif" 
                                   placeholder="Cth: 20000" 
                                   value="{{ old('tarif', (int)$kategori->tarif) }}" required>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.kategori-iuran.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-warning">Update Kategori</button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection