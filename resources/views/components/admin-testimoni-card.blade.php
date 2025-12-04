@props(['id', 'nama', 'no_telp', 'alamat', 'created_at', 'tampilkanDiBeranda'])

@php
    $initial = strtoupper(substr($nama, 0, 1));
    
    $badgeClass = $tampilkanDiBeranda ? 'bg-success' : 'bg-secondary';
    $badgeText  = $tampilkanDiBeranda ? 'Aktif' : 'Non-Aktif';

    $colors = ['primary', 'success', 'danger', 'warning', 'info', 'dark'];
    $colorIndex = intval($id) % count($colors);
    $avatarColor = $colors[$colorIndex];
@endphp

<div class="col-md-6 col-xl-4 mb-4">
    <div class="card h-100 border-0 shadow-sm rounded-4 p-3 bg-white">
        
        <div class="d-flex gap-2">
            
            <div class="mt-2">
                <input class="form-check-input testimoni-checkbox border-2" type="checkbox" value="{{ $id }}" style="cursor: pointer;">
            </div>

            <div class="flex-grow-1 overflow-hidden">
                
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="d-flex gap-3 align-items-center">
                        
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm bg-{{ $avatarColor }} bg-gradient" 
                             style="width: 42px; height: 42px; font-size: 1rem; flex-shrink: 0;">
                            {{ $initial }}
                        </div>
                        
                        <div style="line-height: 1.2;">
                            <h6 class="fw-bold text-dark mb-0">{{ $nama }}</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">
                                <i class="bi bi-telephone me-1"></i> {{ $no_telp }}
                            </small>
                        </div>
                    </div>

                    <span class="badge {{ $badgeClass }} rounded-pill shadow-sm" style="font-size: 0.7rem; padding: 6px 12px;">
                        {{ $badgeText }}
                    </span>
                </div>

                <div class="mt-2">
                    
                    <div class="d-flex gap-3 text-muted mb-2 small align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar3 me-2 text-primary"></i> {{ $created_at }}
                        </div>
                        <div class="text-truncate border-start ps-3 d-flex align-items-center">
                            <i class="bi bi-geo-alt me-2 text-danger"></i> {{ $alamat }}
                        </div>
                    </div>

                    <div class="bg-light rounded-3 p-3 border border-light-subtle position-relative mb-1">
                        <i class="bi bi-quote position-absolute text-secondary opacity-25" style="top: 2px; left: 5px; font-size: 1.2rem;"></i>
                        <p class="fst-italic text-dark mb-0 position-relative z-1 lh-base" style="font-size: 0.95rem; padding-left: 10px;">
                            "{{ $slot }}"
                        </p>
                    </div>

                    <hr class="text-muted opacity-25 my-3">

                    <div class="d-flex justify-content-between align-items-center">
                        
                        @if (!$tampilkanDiBeranda)
                            <form action="{{ route('admin.testimoni.approve', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm rounded-pill px-4 fw-bold shadow-sm" style="font-size: 0.8rem;">
                                    <i class="bi bi-check-lg me-1"></i> Tampilkan
                                </button>
                            </form>
                        @else
                            <div class="text-success fw-bold d-flex align-items-center bg-success-subtle px-3 py-1 rounded-pill" style="font-size: 0.8rem;">
                                <i class="bi bi-check-circle-fill me-2"></i> Sudah Tampil
                            </div>
                        @endif

                        @if($tampilkanDiBeranda)
                             <form action="{{ route('admin.testimoni.unapprove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" style="font-size: 0.8rem;">
                                    <i class="bi bi-eye-slash me-1"></i> Sembunyikan
                                </button>
                            </form>
                        @else
                            <button class="btn btn-light text-muted btn-sm rounded-pill px-3 border" disabled style="font-size: 0.8rem;">
                                <i class="bi bi-three-dots"></i>
                            </button>
                        @endif
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>