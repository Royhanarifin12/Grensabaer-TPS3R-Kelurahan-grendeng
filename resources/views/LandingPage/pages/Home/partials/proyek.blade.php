<section id="testimonials" class="testimonials section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Proyek</h2>
        <p>Proyek layanan Grensaber TPS3R Kelurahan Grendeng.</p>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
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
                  "slidesPerView": 1,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 2,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 3,
                  "spaceBetween": 10
                }
              }
            }
          </script>
            <div class="swiper-wrapper align-items-center">
                @forelse($proyeks as $proyek)
                    <div class="swiper-slide p-3">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body">
                                <div class="rounded overflow-hidden"
                                    style="width: 100%; height:200px; object-fit: cover; object-position: center;">
                                    <img src="{{ Storage::url($proyek->image_path) }}" alt="Gambar Proyek"
                                        class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide p-3">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body">
                                <div class="text-center d-flex align-items-center justify-content-center"
                                    style="width: 100%; height:200px;">
                                    <p>Belum ada foto proyek.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
