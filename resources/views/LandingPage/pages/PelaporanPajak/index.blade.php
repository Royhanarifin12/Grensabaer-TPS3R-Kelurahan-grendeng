@extends('layout.landingPage')

@section('content')
    <div class="page-title light-background">
        <div class="container">
            <h1>Pelaporan Pajak</h1>
        </div>
    </div>

    <section id="starter-section" class="starter-section section">
        <div class="tab-pane fade active show" id="features-tab-1">
                    <div class="row">
                        <div
                            class="col-lg-12 text-center mt-3 mt-lg-0 d-flex flex-column justify-content-center align-items-center">
                            
                            <img src="{{ asset('landing/img/pajak.jpg') }}" alt="Akta Notaris" class="img-fluid"
                                style="max-width: 600px; height: auto;"> 
                        </div>
                    </div>
                </div>
    </section>
@endsection
