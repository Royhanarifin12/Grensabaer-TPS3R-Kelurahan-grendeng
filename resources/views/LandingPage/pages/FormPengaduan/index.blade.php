@extends('layout.landingPage')
@section('content')
    <div class="page-title light-background">
        <div class="container">
            <h1>Form Pengaduan</h1>
        </div>
    </div>

    <!-- Starter Section Section -->
    <section class="contact section">
        <div class="container" data-aos="fade-up">
            <div class="row g-4 g-lg-5 justify-content-center">
                <div class="col-xl-7">
                    <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                        @if (session('pengaduanSuccess'))
                            <div class="alert alert-success alert-dismissible fade show">
                                Pengaduan berhasil terkirim!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('form-pengaduan.store') }}" method="post" data-aos="fade-up"
                            data-aos-delay="200">
                            @csrf
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror" placeholder="Nama"
                                        required="">
                                    @error('nama')
                                        <small class="text-danger{{ $message }}"></small>
                                    @enderror
                                </div>

                                <div class="col-md-6 ">
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                                        name="no_telp" placeholder="No. Telepon" required="">
                                    @error('no_telp')
                                        <small class="text-danger{{ $message }}"></small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" placeholder="Alamat" required="">
                                    @error('alamat')
                                        <small class="text-danger{{ $message }}"></small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <textarea class="form-control @error('pengaduan') is-invalid @enderror" name="pengaduan" rows="6"
                                        placeholder="Pengaduan" required=""></textarea>
                                    @error('pengaduan')
                                        <small class="text-danger{{ $message }}"></small>
                                    @enderror
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn">Kirim</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Daftar Pengaduan</h2>
            <p>
                Necessitatibus eius consequatur ex aliquid fuga eum quidem sint
                consectetur velit
            </p>
        </div>
        <div class="container" data-aos="fade-up">
            <div class="row g-4 g-lg-5 justify-content-center">
                <div class="col-12">
                    <div class="row overflow-y-auto" style="max-height: 500px;">
                        @foreach ($pengaduan as $data)
                            <x-card-pengaduan nama="{{ $data->nama }}" no_telp="{{ $data->no_telp }}"
                                status="{{ $data->status }}"
                                created_at="{{ $data->created_at->translatedFormat('d M Y, H:i') }}">
                                {{ $data->pengaduan }}
                            </x-card-pengaduan>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
