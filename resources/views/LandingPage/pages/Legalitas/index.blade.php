@extends('layout.landingPage')
@section('content')
    <div class="page-title light-background">
        <div class="container">
            <h1>Legalitas</h1>
        </div>
    </div>

    <section class="features section">
        <div class="container" data-aos="fade-up">
            <div class="d-flex justify-content-center">
                <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">

                    <li class="nav-item">
                        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                            <h4>KPP Grensaber</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                            <h4>KTP Grensaber</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                            <h4>Akta Notaris</h4>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                <div class="tab-pane fade active show" id="features-tab-1">
                    <div class="row">
                        <div
                            class="col-lg-12 text-center mt-3 mt-lg-0 d-flex flex-column justify-content-center align-items-center">
                            <h3>KPP Grensaber</h3>
                            <p class="mb-4">
                                konten KPP Grensaber
                            </p>
                            <img src="{{ asset('landing/img/akta-notaris.jpg') }}" alt="Akta Notaris" class="img-fluid"
                                style="max-width: 600px; height: auto;"> 
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="features-tab-2">
                    <div class="row">
                        <div
                            class="col-lg-12 text-center mt-3 mt-lg-0 d-flex flex-column justify-content-center align-items-center">
                            <h3>KTP Grensaber</h3>
                            <p class="mb-4">
                                Konten KTP Grensaber
                            </p>
                            <img src="{{ asset('landing/img/features-illustration-1.webp') }}" alt="Akta Notaris"
                                class="img-fluid" style="max-width: 600px; height: auto;">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="features-tab-3">
                    <div class="row">
                        <div
                            class="col-lg-12 text-center mt-3 mt-lg-0 d-flex flex-column justify-content-center align-items-center">
                            <h3>Akta Notaris</h3>
                            <p class="mb-4">
                                Konten Akta Notaris
                            </p>
                            <img src="{{ asset('landing/img/sk-pengesahan.jpg') }}" alt="SK Pengesahan"
                                class="img-fluid" style="max-width: 600px; height: auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
