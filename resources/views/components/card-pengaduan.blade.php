@props([
    'nama' => 'John Doe',
    'no_telp' => '1234',
    'status' => 'Menunggu',
    'created_at' => '',
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

<div class="col-md-4 mb-4">
    <div class="card card-body shadow border-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex flex-column">
                <h5 class="m-0 text-tps fw-bold">{{ $nama }}</h5>
                <small>{{ $no_telp }}</small>
            </div>
            <span class="badge text-capitalize {{ $badgeClass }}">{{ $status }}</span>
        </div>
        <p class="m-0 text-black">{{ $slot }}</p>
        <small class="mt-2 text-secondary text-right fw-light">{{ $created_at }}</small>
    </div>
</div>
