<section id="testimonials" class="testimonials section light-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>Testimoni Warga</h2>
        <p>Apa kata warga tentang layanan Grensaber TPS3R Kelurahan Grendeng.</p>
    </div><div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper init-swiper testimonials-slider">
            <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 800,
              "autoplay": {
                "delay": 6000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 2,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 3,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 4,
                  "spaceBetween": 10
                }
              }
            }
          </script>
            <div class="swiper-wrapper align-items-center">
                @forelse ($testimonis as $testimoni)
                    <div class="swiper-slide">
                        <div class="testimonial-item">                            
                            <h3>{{ $testimoni->nama }}</h3>
                            <h4>{{ $testimoni->alamat }}</h4> 
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>{{ $testimoni->testimoni }}</span> 
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide mx-auto">
                        <div class="testimonial-item">
                            <h3>Belum Ada Testimoni</h3>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Saat ini belum ada testimoni untuk ditampilkan.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>