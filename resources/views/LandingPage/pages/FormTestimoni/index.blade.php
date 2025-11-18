@extends('layout.landingPage')
@section('content')
    <div class="page-title light-background">
        <div class="container">
            <h1>Form Testimoni</h1>
            <p>Berikan ulasan, kritik, atau saran Anda untuk layanan kami.</p>
        </div>
    </div>

    <!-- Starter Section Section -->
    <section class="contact section">
        <div class="container" data-aos="fade-up">
            <div class="row g-4 g-lg-5 justify-content-center">
                <div class="col-xl-7">
                    <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                        
                        {{-- UBAH NAMA SESSION SUCCESS --}}
                        @if (session('testimoniSuccess'))
                            <div class="alert alert-success alert-dismissible fade show">
                                Testimoni berhasil terkirim! Terima kasih atas ulasan Anda.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- UBAH ACTION ROUTE --}}
                        <form action="{{ route('form-testimoni.store') }}" method="post" data-aos="fade-up"
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
                                    {{-- UBAH TEXTAREA --}}
                                    <textarea class="form-control @error('testimoni') is-invalid @enderror" name="testimoni" rows="6"
                                        placeholder="Testimoni / Ulasan Anda" required=""></textarea>
                                    @error('testimoni')
                                        <small class="text-danger{{ $message }}"></small>
                                    @enderror
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn">Kirim Ulasan</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection