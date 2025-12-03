@extends('layout.landingPage')
@section('content')
    <div class="page-title light-background">
        <div class="container">
            <h1>Form Pengaduan</h1>
        </div>
    </div>

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
                                        required="" oninvalid="this.setCustomValidity('Wajib diisi!')"
                                        oninput="this.setCustomValidity('')">
                                    @error('nama')
                                        <small class="text-danger{{ $message }}"></small>
                                    @enderror
                                </div>

                                <div class="col-md-6 ">
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                                        name="no_telp" placeholder="No. Telepon" required=""
                                        oninvalid="this.setCustomValidity('Wajib diisi!')"
                                        oninput="this.setCustomValidity('')">
                                    @error('no_telp')
                                        <small class="text-danger{{ $message }}"></small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" placeholder="Alamat" required=""
                                        oninvalid="this.setCustomValidity('Wajib diisi!')"
                                        oninput="this.setCustomValidity('')">
                                    @error('alamat')
                                        <small class="text-danger{{ $message }}"></small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <textarea class="form-control @error('pengaduan') is-invalid @enderror" name="pengaduan" rows="6"
                                        placeholder="Pengaduan" required="" oninvalid="this.setCustomValidity('Wajib diisi!')"
                                        oninput="this.setCustomValidity('')"></textarea>
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
        </div>
        <div class="container mt-5 mb-5">
            <div class="row">

                {{-- KOLOM KIRI: CEK STATUS PENGADUAN --}}
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white border-0 pt-4 pb-0">
                            <h4 class="fw-bold text-secondary"><i class="bi bi-search me-2"></i>Cek Status Pengaduan</h4>
                            <p class="text-muted small">Masukkan nomor HP yang Anda gunakan saat melapor.</p>
                        </div>
                        <div class="card-body">
                            {{-- Form Pencarian (Ganti Method jadi POST agar tidak muncul di URL) --}}
                            <form action="{{ route('form-pengaduan.cari') }}" method="POST" class="mb-4">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="no_telp" class="form-control form-control-lg"
                                        placeholder="Contoh: 08123456789" value="{{ session('keyword') }}" required>
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </form>

                            {{-- Hasil Pencarian --}}
                            @if ($hasilPencarian)
                                @if ($hasilPencarian->count() > 0)
                                    <div class="alert alert-success border-0 bg-success-subtle text-success-emphasis small mb-3">
                                        <i class="bi bi-check-circle-fill me-1"></i> Ditemukan
                                        {{ $hasilPencarian->count() }} riwayat pengaduan.
                                    </div>

                                    <div class="vstack gap-3" style="max-height: 500px; overflow-y: auto;">
                                        @foreach ($hasilPencarian as $item)
                                            <div class="card border-0 bg-light shadow-sm">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <small class="text-muted">{{ $item->created_at->format('d M Y, H:i') }}</small>
                                                        
                                                        {{-- Badge Status --}}
                                                        @php
                                                            $status = strtolower($item->status);
                                                            $color = match ($status) {
                                                                'menunggu' => 'bg-secondary',
                                                                'proses'   => 'bg-info text-dark',
                                                                'selesai'  => 'bg-success',
                                                                'ditolak'  => 'bg-danger',
                                                                default    => 'bg-secondary',
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $color }} rounded-pill">{{ ucfirst($item->status) }}</span>
                                                    </div>

                                                    <p class="mb-2 fw-bold text-dark">"{{ $item->pengaduan }}"</p>

                                                    {{-- TANGGAPAN ADMIN (HANYA MUNCUL DI SINI) --}}
                                                    @if ($item->tanggapan)
                                                        <div class="mt-2 p-2 rounded bg-white border border-success">
                                                            <small class="fw-bold text-success d-block mb-1">
                                                                <i class="bi bi-arrow-return-right"></i> Balasan Pengelola:
                                                            </small>
                                                            <p class="mb-0 small text-dark">{{ $item->tanggapan }}</p>
                                                        </div>
                                                    @else
                                                        <small class="text-muted fst-italic">Belum ada tanggapan.</small>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="bi bi-emoji-frown text-muted fs-1"></i>
                                        <p class="text-muted mt-2">Tidak ditemukan pengaduan dengan nomor tersebut.</p>
                                    </div>
                                @endif
                            @else
                                {{-- Tampilan Awal (Kosong) --}}
                                <div class="text-center py-5 text-muted opacity-50">
                                    <i class="bi bi-search fs-1"></i>
                                    <p class="mt-2">Silakan cari riwayat pengaduan Anda.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: DAFTAR PENGADUAN PUBLIK --}}
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 h-100 bg-transparent">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0">
                            <h4 class="fw-bold text-secondary">Daftar Pengaduan Terkini</h4>
                            <p class="text-muted small">Aspirasi warga yang telah masuk.</p>
                        </div>
                        <div class="card-body px-0">
                            <div class="vstack gap-3 pe-2" style="max-height: 500px; overflow-y:auto;">
                                @forelse($pengaduan as $publik)
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="bi bi-person-fill text-secondary"></i>
                                                </div>
                                                <div class="lh-1">
                                                    <h6 class="mb-0 fw-bold text-dark">{{ $publik->nama }}</h6>
                                                    <small class="text-muted" style="font-size: 0.75rem;">
                                                        {{ Str::mask($publik->no_telp, '*', 4, 4) }}
                                                    </small>
                                                </div>
                                                <div class="ms-auto text-end">
                                                    <small class="text-muted d-block"
                                                        style="font-size: 0.7rem;">{{ $publik->created_at->diffForHumans() }}</small>
                                                    
                                                    {{-- Badge Status Publik --}}
                                                    @php
                                                        $statusPublik = strtolower($publik->status);
                                                        $colorPublik = match ($statusPublik) {
                                                            'menunggu' => 'bg-secondary',
                                                            'proses'   => 'bg-info text-white',
                                                            'selesai'  => 'bg-success',
                                                            'ditolak'  => 'bg-danger',
                                                            default    => 'bg-secondary',
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $colorPublik }} rounded-pill" style="font-size: 0.6rem;">
                                                        {{ ucfirst($publik->status) }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="bg-light p-2 rounded mb-0">
                                                <p class="mb-0 text-dark fst-italic small">
                                                    "{{ Str::limit($publik->pengaduan, 100) }}"</p>
                                            </div>
                                            
                                            {{-- TIDAK ADA TANGGAPAN DI SINI (PRIVASI) --}}
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-muted py-4">
                                        <small>Belum ada pengaduan publik.</small>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection