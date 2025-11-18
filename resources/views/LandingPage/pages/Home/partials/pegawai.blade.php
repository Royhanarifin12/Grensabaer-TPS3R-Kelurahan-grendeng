<section id="testimonials" class="testimonials section light-background">

    <div class="container section-title" data-aos="fade-up">
        
        <h2>Pegawai</h2>
        <p>Para pegawai Grensaber TPS3R Kelurahan Grendeng.</p>

    </div><div class="container">

        <div class="row g-5">
            @foreach ($pegawai as $data)  
            <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-item d-flex justify-content-center align-items-center flex-column">
                    @if ($data->foto)
                        <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto {{ $data->nama }}"  style="width: 100px; height: 100px; object-fit: cover;" class="rounded-circle">
                    @else
                        <i class="bi bi-person-circle text-secondary" style="font-size: 4rem;"></i>
                    @endif
                    
                    <h3>{{ $data->nama }}</h3>
                    <h4>{{ $data->posisi }}</h4>
                </div>
            </div>
            @endforeach
            
        </div>

    </div>

</section>