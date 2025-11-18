@props(['id', 'nama', 'no_telp', 'alamat', 'created_at', 'tampilkanDiBeranda'])

<div class="col-md-4 mb-2">
    <div class="card">
        <div class="card-header p-2">
            <div class="d-flex align-items-center">
                <div class="form-check me-2">
                    <input class="form-check-input testimoni-checkbox" type="checkbox" value="{{ $id }}"
                        id="testimoni-{{ $id }}">
                </div>

                <div class="flex-grow-1">
                    <h5 class="m-0 text-primary">{{ $nama }}</h5>
                    <p class="m-0 text-muted">{{ $no_telp }}</p>
                </div>

                <div class="d-flex flex-column align-items-end">
                    <small class="text-secondary">{{ $created_at }}</small>
                </div>
            </div>
        </div>
        <div class="card-body py-2">
            <p class="m-0">Alamat: {{ $alamat }}</p>
            <p class="m-0">{{ $slot }}</p>
        </div>
        <div class="card-footer p-2">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    @if ($tampilkanDiBeranda)
                        <span class="badge text-bg-success">Sudah Tampil</span>
                    @endif
                </div>

                <div>
                    @if (!$tampilkanDiBeranda)
                        <form action="{{ route('admin.testimoni.approve', $id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Setujui</button>
                        </form>
                    @else
                        <form action="{{ route('admin.testimoni.unapprove', $id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Sembunyikan</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
