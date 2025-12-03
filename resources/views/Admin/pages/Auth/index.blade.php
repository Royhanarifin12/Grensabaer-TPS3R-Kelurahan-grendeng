<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link rel="stylesheet" crossorigin href="{{ asset('admin/compiled/css/app.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('admin/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('admin/compiled/css/auth.css') }}">
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-8 col-12">
                <div id="auth-left">
                    <div class="auth-logo d-flex justify-content-center mb-2">
                        <a href="{{ route('root') }}">
                            <div class="d-flex justify-content-center flex-column align-items-center gap-2">
                                <img src="{{ asset('landing/img/download.png') }}" alt="">
                                <div class=" text-center">
                                    <h1 class="m-0 fw-bold">Grensaber TPS3R</h1>
                                    <h5 class="m-0">Kelurahan Grendeng</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <p class="auth-subtitle mb-3">
                        Masuk dengan akun yang sudah didaftarkan.
                    </p>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <div class="form-group position-relative has-icon-left mb-0">
                                <input type="text"
                                    class="form-control @error('username')
                                    is-invalid
                                @enderror"
                                    placeholder="Username" name="username" value="">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-group position-relative has-icon-left mb-0">
                                <input type="password"
                                    class="form-control @error('password')
                                    is-invalid
                                @enderror"
                                    placeholder="Password" name="password">
                                <div class="form-control-icon">
                                    <i class="bi bi-lock"></i>
                                </div>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="flexCheckDefault" name="remember">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Tetap masuk
                            </label>
                        </div>

                        <button type="submit" class="btn btn-block btn-primary mt-5 fw-bold">Masuk</button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="text-gray-600">
                            2025 &copy; Grensaber TPS3R Kelurahan Grendeng
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
