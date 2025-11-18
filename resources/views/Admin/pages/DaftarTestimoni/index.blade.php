@extends('layout.adminPage')

@section('pageTitle', 'Daftar Testimoni')
@section('pageSubtitle', 'Ulasan yang disampaikan oleh masyarakat melalui form testimoni')

@section('content')

    {{-- FORM HAPUS (Sudah dipisah agar tidak nested) --}}
    <form id="bulkDeleteForm" action="{{ route('admin.daftar-testimoni.bulkDestroy') }}" method="POST">
        @csrf
        @method('DELETE')

        <input type="hidden" name="selected_ids" id="selectedIdsInput" value="">
        
        <div class="d-flex justify-content-end mb-3">
            <button type="submit" id="bulkDeleteButton" class="btn btn-danger icon-left" disabled 
                onclick="return confirm('APAKAH ANDA YAKIN INGIN MENGHAPUS SEMUA TESTIMONI YANG TERPILIH PERMANEN?');">
                <i class="bi bi-trash"></i> <span id="buttonText">Hapus Data Terpilih</span>
            </button>
        </div>
    </form>
    {{-- AKHIR FORM HAPUS --}}


    {{-- DAFTAR CARD (Di luar form) --}}
    <div class="row">
        @foreach ($testimoni as $data)
            {{-- PERHATIKAN PERBAIKAN DI BAWAH INI --}}
            <x-admin-testimoni-card id="{{ $data->id }}" nama="{{ $data->nama }}" no_telp="{{ $data->no_telp }}"
                alamat="{{ $data->alamat }}"
                tampilkan_di_beranda="{{ $data->tampilkan_di_beranda }}"
                created_at="{{ $data->created_at->translatedFormat('d M Y, H:i') }}">
                
                {{-- INI ADALAH TEKS YANG HILANG. SEKARANG SUDAH DITAMBAHKAN. --}}
                {{ $data->testimoni }} 

            </x-admin-testimoni-card>
        @endforeach
    </div>

@endsection


@push('scripts')
    {{-- Kode JavaScript Anda (tidak diubah) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.testimoni-checkbox');
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