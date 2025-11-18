<header id="header" class="header d-flex align-items-center fixed-top">
    <div
        class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{ route('root') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <img src="{{ asset('landing/img/Greensaber-logo.jpg') }}" alt="">
            <div class="sitename">
                <h5 class="m-0 fw-bold text-tps">Grensaber TPS3R</h5>
                <p class="m-0 text-black">Kelurahan Grendeng</p>
            </div>
        </a>

        <x-nav-item />

    </div>
</header>
