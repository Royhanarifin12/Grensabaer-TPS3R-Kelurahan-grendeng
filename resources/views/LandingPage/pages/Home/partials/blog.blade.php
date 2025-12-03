<section id="blog" class="blog section light-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>Informasi</h2>
        <p>Dapatkan informasi tentang layanan Grensaber TPS3R Kelurahan Grendeng.</p>
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
                  "spaceBetween": 40
                }
              }
            }
            </script>

            <div class="swiper-wrapper align-items-center">
                @forelse($artikels as $artikel)
                    <div class="swiper-slide">
                        <div class="card p-3 border-0 shadow-sm rounded-4">
                            <div class="card-body">
                                <div class="rounded overflow-hidden mb-3"
                                    style="width: 100%; height:200px; object-fit: cover; object-position: center;">
                                    <img src="{{ Storage::url($artikel->image) }}" alt="{{ $artikel->title }}"
                                        class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <h5 class="text-tps fw-bold">{{ $artikel->title }}</h5>
                                <p>{{ Str::limit(strip_tags($artikel->content), 150, '...') }}</p>
                                <button class="btn btn-secondary mt-2 rounded-5"
                                    data-bs-target="#modalBlog-{{ $artikel->id }}" data-bs-toggle="modal">Baca
                                    selengkapnya</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="card p-3 border-0 shadow-sm rounded-4">
                            <div class="card-body text-center">
                                <h5 class="text-tps fw-bold">Belum Ada Artikel</h5>
                                <p>Saat ini belum ada artikel baru untuk ditampilkan. Silakan cek kembali nanti.</p>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>
            <div class="swiper-pagination"></div>
        </div>

        @foreach ($artikels as $artikel)
            <div class="modal fade" tabindex="-1" id="modalBlog-{{ $artikel->id }}">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $artikel->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-5">
                            <div class="rounded overflow-hidden mb-3 mx-auto"
                                style="width: 70%; height:300px; object-fit: cover; object-position: center;">
                                <img src="{{ Storage::url($artikel->image) }}" alt="{{ $artikel->title }}"
                                    class="img-fluid" style="">
                            </div>
                            <p>
                                {!! nl2br(e($artikel->content)) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- <div class="swiper testimonials-slider">
            <div class="swiper-wrapper">
                @forelse ($testimonis as $testimoni)
                    <div class="swiper-slide">
                        <div class="testimonial-item">                            
                            <h3>{{ $testimoni->nama }}</h3>
                            <h4>{{ $testimoni->alamat }}</h4> 
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>{{ $testimoni->pengaduan }}</span> 
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide mx-auto">
                        <div class="testimonial-item">
                            <h3>Belum Ada Testimoni</h3>
                            <h4></h4>
                            <div class="stars"></div>
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
        </div> --}}
    </div>
</section>
