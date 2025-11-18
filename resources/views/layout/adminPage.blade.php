<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grensaber TPS3R Kelurahan Grendeng</title>
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link rel="stylesheet" crossorigin href="{{ asset('admin/compiled/css/app.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('admin/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('admin/compiled/css/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/extensions/toastify-js/src/toastify.css') }}">
</head>

<body>
    <script src="{{ asset('admin/static/js/initTheme.js') }}"></script>
    <div id="app">
        <x-admin-sidebar />
        <div id="main" class="layout-navbar navbar-fixed">
            <x-admin-header />
            <div id="main-content">
                <div class="page-heading">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3>@yield('pageTitle')</h3>
                            <p class="text-subtitle text-muted">@yield('pageSubtitle')</p>
                        </div>
                        @yield('pageHeadingBtn')
                    </div>
                </div>
                @yield('content')
                <x-admin-footer />
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('admin/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('admin/compiled/js/app.js') }}" defer></script>
    @stack('scripts')

</body>

</html>