@extends('layout.adminPage')

@section('pageTitle', 'Daftar Pengaduan')
@section('pageSubtitle', 'Pengaduan yang disampaikan oleh masyarakat melalui form pengaduan')

@section('content')

    <form id="bulkDeleteForm" action="{{ route('admin.daftar-pengaduan.bulkDestroy') }}" method="POST">
        @csrf
        @method('DELETE')

        <input type="hidden" name="selected_ids" id="selectedIdsInput" value="">
        
        <div class="d-flex justify-content-end mb-3">
            <button type="submit" id="bulkDeleteButton" class="btn btn-danger icon-left" disabled 
                onclick="return confirm('APAKAH ANDA YAKIN INGIN MENGHAPUS SEMUA PENGADUAN YANG TERPILIH PERMANEN?');">
                <i class="bi bi-trash"></i> <span id="buttonText">Hapus Data Terpilih</span>
            </button>
        </div>

        <div class="row">
            @foreach ($pengaduan as $data)
                <x-admin-pengaduan-card id="{{ $data->id }}" nama="{{ $data->nama }}" no_telp="{{ $data->no_telp }}"
                    status="{{ $data->status }}" alamat="{{ $data->alamat }}"
                    created_at="{{ $data->created_at->translatedFormat('d M Y, H:i') }}" :tampilkan_di_beranda="$data->tampilkan_di_beranda">
                    {{ $data->pengaduan }}
                </x-admin-pengaduan-card>
            @endforeach
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.pengaduan-checkbox');
        const bulkDeleteButton = document.getElementById('bulkDeleteButton');
        const selectedIdsInput = document.getElementById('selectedIdsInput');
        const buttonText = document.getElementById('buttonText');

        if (!bulkDeleteButton) {
            console.error('Elemen tombol Hapus Massal (bulkDeleteButton) tidak ditemukan.');
            return;
        }

        function updateBulkDeleteButton() {
            const selectedIds = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            console.log('Pengaduan terpilih:', selectedIds.length);

            selectedIdsInput.value = selectedIds.join(',');

            if (selectedIds.length > 0) {
                bulkDeleteButton.removeAttribute('disabled');
                buttonText.textContent = `Hapus Data Terpilih (${selectedIds.length})`;
            } else {
                bulkDeleteButton.setAttribute('disabled', 'disabled');
                buttonText.textContent = 'Hapus Data Terpilih';
            }
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkDeleteButton);
        });

        updateBulkDeleteButton();
    });
</script>
@endpush
