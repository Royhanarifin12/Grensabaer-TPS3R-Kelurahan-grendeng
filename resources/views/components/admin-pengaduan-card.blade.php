@props([
    'id' => '',
    'nama' => 'User',
    'no_telp' => '-',
    'status' => 'Menunggu',
    'alamat' => '',
    'created_at' => '',
    'tanggapan' => null, 
])

@php
    $initial = strtoupper(substr($nama, 0, 1));
    $statusText = strtolower($status);
    
    // 1. Logika Warna Status Badge
    if ($statusText == 'menunggu') {
        $badgeClass = 'bg-secondary';
    } elseif ($statusText == 'proses') {
        $badgeClass = 'bg-info text-white';
    } elseif ($statusText == 'selesai') {
        $badgeClass = 'bg-success';
    } elseif ($statusText == 'ditolak') {
        $badgeClass = 'bg-danger';
    } else {
        $badgeClass = 'bg-secondary';
    }

    // 2. Logika Warna Avatar (Random Konsisten berdasarkan ID)
    $colors = ['primary', 'success', 'danger', 'warning', 'info', 'dark'];
    $colorIndex = intval($id) % count($colors);
    $avatarColor = $colors[$colorIndex];
@endphp

<style>
    .card-hover {
        transition: all 0.3s ease;
        border: 1px solid #eef2f7;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        border-color: #bce4fa;
    }
    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
        /* Background akan dihandle oleh class Bootstrap */
    }
</style>

<div class="col-md-6 col-xl-4 mb-4">
    <div class="card h-100 border-0 shadow-sm card-hover rounded-4 overflow-hidden bg-white">
        
        {{-- HEADER CARD --}}
        <div class="card-body pb-0 pt-3">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="form-check mt-1">
                        <input class="form-check-input pengaduan-checkbox border-2" type="checkbox" value="{{ $id }}" id="pengaduan-{{ $id }}" style="cursor: pointer;">
                    </div>
                    
                    {{-- AVATAR BERWARNA (Perubahan di sini) --}}
                    <div class="user-avatar shadow-sm text-white bg-{{ $avatarColor }} bg-gradient">
                        {{ $initial }}
                    </div>
                    
                    <div class="lh-1 ms-1">
                        <h6 class="mb-1 fw-bold text-dark text-truncate" style="max-width: 150px;">{{ $nama }}</h6>
                        <small class="text-muted" style="font-size: 0.75rem;">
                            <i class="bi bi-telephone me-1"></i>{{ $no_telp }}
                        </small>
                    </div>
                </div>
                
                {{-- STATUS BADGE --}}
                <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2 shadow-sm text-capitalize" style="font-weight: 500; letter-spacing: 0.5px;">
                    {{ $statusText }}
                </span>
            </div>

            {{-- META INFO (Dengan Ikon Berwarna) --}}
            <div class="d-flex gap-3 border-bottom pb-3 mb-3">
                <small class="text-secondary d-flex align-items-center">
                    <i class="bi bi-calendar-event me-2 text-primary"></i> {{ $created_at }}
                </small>
                <small class="text-secondary text-truncate d-flex align-items-center" style="max-width: 120px;">
                    <i class="bi bi-geo-alt me-2 text-danger"></i> {{ $alamat }}
                </small>
            </div>

            {{-- ISI PENGADUAN --}}
            <div class="p-3 rounded-3 bg-light position-relative mb-3 border border-light-subtle">
                <i class="bi bi-quote position-absolute text-secondary opacity-25" style="top: 5px; left: 10px; font-size: 1.5rem;"></i>
                <p class="m-0 fst-italic text-dark position-relative z-1 ps-2" style="font-size: 0.95rem; line-height: 1.5;">"{{ $slot }}"</p>
            </div>

            {{-- BAGIAN TANGGAPAN (Warna Background lebih soft) --}}
            @if($tanggapan)
                <div class="d-flex align-items-start mt-3 p-3 rounded-3 bg-success-subtle position-relative overflow-hidden">
                    {{-- Garis hijau di kiri --}}
                    <div class="position-absolute start-0 top-0 bottom-0 bg-success" style="width: 4px;"></div>
                    
                    <div class="ps-2 w-100">
                        <small class="fw-bold text-success d-block mb-1">
                            <i class="bi bi-arrow-return-right me-1"></i> Balasan Admin:
                        </small>
                        <p class="m-0 text-dark lh-sm" style="font-size: 0.9rem;">{{ $tanggapan }}</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- FOOTER CARD --}}
        <div class="card-footer bg-white border-0 pt-0 pb-3 mt-auto">
            
            {{-- TAG HR YANG DIPERTAHANKAN --}}
            <hr class="mt-0 mb-3 text-muted opacity-25">

            <div class="d-flex justify-content-between align-items-center">
                
                {{-- TOMBOL KIRI --}}
                @if(!$tanggapan)
                    <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm fw-bold" 
                            data-bs-toggle="modal" data-bs-target="#modalTanggapi-{{ $id }}">
                        <i class="bi bi-chat-dots me-1"></i> Tanggapi
                    </button>
                @else
                    <span class="text-success fw-bold bg-success-subtle px-3 py-1 rounded-pill" style="font-size: 0.8rem;">
                        <i class="bi bi-check-circle-fill me-1"></i> Selesai Ditanggapi
                    </span>
                @endif

                {{-- Dropdown AKSI --}}
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-gear-wide-connected me-1"></i> Aksi
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                        <li><h6 class="dropdown-header text-uppercase small fw-bold">Ubah Status</h6></li>
                        <li>
                            <a class="dropdown-item py-2 {{ $statusText == 'proses' ? 'disabled' : '' }}" 
                               href="{{ route('admin.daftar-pengaduan.proses', ['id' => $id]) }}">
                                <i class="bi bi-arrow-clockwise text-primary me-2"></i>Proses
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2 {{ $statusText == 'selesai' ? 'disabled' : '' }}" 
                               href="{{ route('admin.daftar-pengaduan.selesai', ['id' => $id]) }}">
                                <i class="bi bi-check-circle text-success me-2"></i>Selesai
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2 {{ $statusText == 'ditolak' ? 'disabled' : '' }}" 
                               href="{{ route('admin.daftar-pengaduan.tolak', ['id' => $id]) }}">
                                <i class="bi bi-x-circle text-danger me-2"></i>Tolak
                            </a>
                        </li>

                        @if($tanggapan)
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header text-uppercase small fw-bold">Tanggapan</h6></li>
                            <li>
                                <button type="button" class="dropdown-item py-2 text-warning fw-bold" data-bs-toggle="modal" data-bs-target="#modalTanggapi-{{ $id }}">
                                    <i class="bi bi-pencil-square me-2"></i>Ubah Tanggapan
                                </button>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TANGGAPI (Sama seperti sebelumnya) --}}
<div class="modal fade" id="modalTanggapi-{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-light rounded-top-4">
                <h5 class="modal-title fw-bold text-primary">
                    <i class="bi bi-reply-fill me-2"></i>
                    {{ $tanggapan ? 'Ubah Tanggapan' : 'Tanggapi Pengaduan' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('admin.daftar-pengaduan.tanggapi', $id) }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="d-flex gap-3 mb-4">
                        <div class="flex-shrink-0">
                             <div class="bg-{{ $avatarColor }} bg-opacity-10 text-{{ $avatarColor }} rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-person-fill"></i>
                             </div>
                        </div>
                        <div>
                            <small class="text-muted fw-bold">{{ $nama }} berkata:</small>
                            <p class="mb-0 fst-italic text-dark bg-light p-2 rounded small">"{{ Str::limit($slot, 150) }}"</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Isi Balasan Anda</label>
                        <textarea class="form-control bg-light border-0 focus-ring" name="tanggapan" rows="5" placeholder="Ketikkan balasan..." required style="resize: none;">{{ $tanggapan }}</textarea>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="bi bi-send-fill me-2"></i>
                        {{ $tanggapan ? 'Simpan Perubahan' : 'Kirim' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>