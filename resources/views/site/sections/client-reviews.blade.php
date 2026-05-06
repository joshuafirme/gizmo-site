<!-- Client Reviews Section -->
@if ($reviews->isNotEmpty())
    <section id="reviews" class="py-5 bg-tech-dark">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-tech-alt text-uppercase fw-bold">Testimonials</h6>
                <h2 class="display-5 fw-bold text-theme">Client Success Stories</h2>
                <div class="mx-auto mt-3" style="width: 50px; height: 3px; background-color: var(--secondary-tech);">
                </div>
            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-8">
                    <div class="review-box text-center shadow-lg position-relative">
                        <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach ($reviews as $key => $review)
                                    <button type="button" data-bs-target="#reviewCarousel" data-bs-slide-to="{{ $key }}"
                                        class="{{ $loop->first ? 'active' : '' }}"></button>
                                @endforeach
                            </div>

                            <div class="carousel-inner pb-5">
                                @foreach ($reviews as $review)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <!-- Dynamic Profile Image -->
                                        <img src="{{ $review->image_path ? asset('storage/' . $review->image_path) : 'https://ui-avatars.com/api/?name=' . urlencode($review->client_name) . '&background=random' }}"
                                            class="rounded-circle mb-3 border border-secondary shadow-sm" width="80" height="80"
                                            style="object-fit: cover;" alt="Client">
                                        <br>
                                        <i class="fa-solid fa-quote-left fa-2x text-tech mb-3 opacity-50"></i>
                                        <p class="lead text-theme mb-4 fst-italic">"{{ $review->review_text }}"</p>

                                        <!-- Dynamic Rating Stars -->
                                        <div class="text-warning mb-3">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($review->rating))
                                                    <i class="fa-solid fa-star"></i>
                                                @elseif($i == ceil($review->rating) && fmod($review->rating, 1) !== 0.0)
                                                    <i class="fa-solid fa-star-half-stroke"></i>
                                                @else
                                                    <i class="fa-regular fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <h5 class="text-theme mb-0">{{ $review->client_name }}</h5>
                                        <p class="text-tech-alt small fw-bold mt-1">{{ $review->position_company }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev d-none d-md-flex" type="button"
                                data-bs-target="#reviewCarousel" data-bs-slide="prev" style="left: -60px; width: auto;">
                                <i class="fa-solid fa-chevron-left fs-3 text-tech hover-tech"></i>
                            </button>
                            <button class="carousel-control-next d-none d-md-flex" type="button"
                                data-bs-target="#reviewCarousel" data-bs-slide="next" style="right: -60px; width: auto;">
                                <i class="fa-solid fa-chevron-right fs-3 text-tech hover-tech"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif