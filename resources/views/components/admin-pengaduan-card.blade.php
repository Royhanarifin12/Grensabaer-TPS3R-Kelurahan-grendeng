@props([
    'id' => '',
    'nama' => 'John Doe',
    'no_telp' => '1234',
    'status' => 'Menunggu',
    'alamat' => '',
    'created_at' => '',
    'tampilkan_di_beranda' => 'false',
])

@php
    $badgeClass = 'text-bg-secondary';

    if ($status == 'menunggu') {
        $badgeClass = 'text-bg-secondary';
    } elseif ($status == 'proses') {
        $badgeClass = 'text-bg-primary';
    } elseif ($status == 'selesai') {
        $badgeClass = 'text-bg-success';
    } elseif ($status == 'ditolak') {
        $badgeClass = 'text-bg-danger';
    }
@endphp

<div class="col-md-4 mb-2">
    <div class="card">
        <div class="card-header p-2"> {{-- Penyesuaian layout dari history --}}
            <div class="d-flex align-items-center">
                
                {{-- Checkbox untuk seleksi massal --}}
                <div class="form-check me-2">
                    <input class="form-check-input pengaduan-checkbox" type="checkbox" value="{{ $id }}" id="pengaduan-{{ $id }}">
                </div>

                <div class="flex-grow-1">
                    <h5 class="m-0 text-primary">{{ $nama }}</h5>
                    <p class="m-0 text-muted">{{ $no_telp }}</p>
                </div>

                <div class="d-flex flex-column align-items-end">
                    <span class="badge text-capitalize {{ $badgeClass }} mb-1">
                        {{ $status }}
                    </span>
                    <small class="text-secondary">{{ $created_at }}</small>
                </div>
            </div>
        </div>
        <div class="card-body py-2"> {{-- Penyesuaian layout dari history --}}
            <p class="m-0">Alamat: {{ $alamat }}</p>
            <p class="m-0">{{ $slot }}</p>
        </div>
        <div class="card-footer p-2"> {{-- Penyesuaian layout dari history --}}
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('admin.daftar-pengaduan.proses', ['id' => $id]) }}"
                        class="btn btn-sm btn-primary icon me-2 {{ $status == 'proses' ? 'd-none' : '' }}">
                        <i class="bi bi-gear"></i> Proses
                    </a>
                    <a href="{{ route('admin.daftar-pengaduan.tolak', ['id' => $id]) }}"
                        class="btn btn-sm btn-danger icon {{ $status == 'ditolak' ? 'd-none' : '' }}">
                        <i class="bi bi-x"></i> Tolak
                    </a>

                    {{-- START: HAPUS FORM TESTIMONI YANG LAMA --}}
                    {{-- <form action="{{ route('admin.pengaduan.toggleTestimoni', $id) }}" method="POST" class="d-inline ms-2">
                        @csrf
                        @if ($tampilkan_di_beranda)
                            <button type="submit" class="btn btn-sm btn-danger icon">
                                <i class="bi bi-x-circle"></i> Batalkan Testimoni
                            </button>
                        @else
                            <button type="submit" class="btn btn-sm btn-success icon">
                                <i class="bi bi-star-fill"></i> Jadikan Testimoni
                            </button>
                        @endif
                    </form> --}}
                    {{-- END: HAPUS FORM TESTIMONI YANG LAMA --}}

                </div>
                <div>
                    <a href="{{ route('admin.daftar-pengaduan.selesai', ['id' => $id]) }}"
                        class="btn btn-sm btn-success icon {{ $status == 'selesai' ? 'd-none' : '' }}">
                        <i class="bi bi-check-lg"></i> Selesai
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>