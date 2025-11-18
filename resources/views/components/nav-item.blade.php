<div class="navbar-nav mx-auto py-0">

</div>

<nav id="navmenu" class="navmenu">
    <ul>
        <x-nav-link route="root">Beranda</x-nav-link>

        <x-nav-item-dropdown title="Profil & Legalitas" :active="Route::is('tentang-kami.*')">
            <x-nav-dropdown-link route="tentang-kami.profil">Profil</x-nav-dropdown-link>
            <x-nav-dropdown-link route="tentang-kami.sejarah">Latar Belakang</x-nav-dropdown-link>
            <x-nav-dropdown-link route="tentang-kami.struktur-organisasi">Struktur Organisasi</x-nav-dropdown-link>
            <x-nav-dropdown-link route="tentang-kami.legalitas">Legalitas</x-nav-dropdown-link>
        </x-nav-item-dropdown>

        <x-nav-link route="panduan-warga" :active="Route::is('panduan-warga')">Panduan Warga</x-nav-link>

        <x-nav-item-dropdown title="Tata Kelola" :active="Route::is('tata-kelola.*') || Route::is('kinerja-lingkungan') || Route::is('transparansi')">
            <x-nav-dropdown-link route="tata-kelola.pelaporan-pajak">Pelaporan Pajak</x-nav-dropdown-link>
            <x-nav-dropdown-link route="tata-kelola.kewajiban-retribusi">Kewajiban Retribusi</x-nav-dropdown-link>
            <x-nav-dropdown-link route="kinerja-lingkungan" :active="Route::is('kinerja-lingkungan')">Kinerja Lingkungan</x-nav-dropdown-link>
            <x-nav-dropdown-link route="transparansi" :active="Route::is('transparansi')">Laporan Keuangan</x-nav-dropdown-link>
        </x-nav-item-dropdown>

        <x-nav-item-dropdown title="Suara Warga" :active="Route::is('form-pengaduan') || Route::is('form-testimoni')">
            <x-nav-dropdown-link route="form-pengaduan">Form Pengaduan</x-nav-dropdown-link>
            <x-nav-dropdown-link route="form-testimoni">Form Testimoni</x-nav-dropdown-link>
        </x-nav-item-dropdown>

    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

@if (Auth::user())
    <a class="btn-getstarted" href="{{ route('admin.dashboard') }}">Panel Admin <i class="bi bi-arrow-right"></i></a>
@endif
