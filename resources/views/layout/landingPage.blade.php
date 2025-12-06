<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Grensaber TPS3R Kelurahan Grendeng</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="{{ asset('landing/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/css/main.css') }}" rel="stylesheet">

    <style>
        .testimonial-item h3 {
            font-weight: 600;
        }

        .testimonial-item h4 {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .testimonial-item p {
            font-style: italic;
            font-size: 1.1rem;
            color: #333;
        }

        .testimonial-item .bi-quote {
            color: #74B435;
            font-size: 1.3rem;
        }
    </style>

</head>

<body class="index-page">

    <x-navbar />

    <main class="main">

        @yield('content')


    </main>

    <x-footer />

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('landing/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('landing/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('landing/vendor/purecounter/purecounter_vanilla.js') }}"></script>

    <script src="{{ asset('landing/js/main.js') }}"></script>

    <!-- PENTING: Penambahan @stack('scripts') -->
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new Swiper('.testimonials-slider', {
                speed: 10000,
                loop: true,
                autoplay: {
                    delay: 0,
                    disableOnInteraction: false,
                },
                allowTouchMove: false,
                pagination: false,
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    }
                }
            });
        });
    </script>
</body>

</html>
