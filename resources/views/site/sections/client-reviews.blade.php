<!-- Client Reviews Section -->
@if ($reviews->isNotEmpty())
    <section id="reviews" class="py-5 bg-tech-dark" aria-label="Client Testimonials">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <p class="text-tech text-uppercase fw-bold h6">Client Testimonials</p>
                <h2 class="display-5 fw-bold text-theme">What Our Clients Say</h2>

                <p class="text-muted mx-auto mt-3" style="max-width: 850px;">
                    Businesses and organizations trust Gizmo System Solutions Inc.
                    for reliable enterprise hardware, IT infrastructure solutions,
                    networking equipment, and professional technology support.
                    Our commitment to quality products, responsive service, and
                    long-term client partnerships continues to help companies
                    strengthen their operational efficiency and digital infrastructure.
                </p>
                <div class="mx-auto mt-3" style="width: 50px; height: 3px; background-color: var(--secondary-tech);">
                </div>
            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-8">
                    <div class="review-box text-center shadow-lg position-relative">
                        <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel"
                            aria-label="Client Reviews Carousel">

                            <!-- Carousel Indicators -->
                            <div class="carousel-indicators">
                                @foreach ($reviews as $key => $review)
                                    <button type="button" data-bs-target="#reviewCarousel"
                                        data-bs-slide-to="{{ $key }}"
                                        class="{{ $loop->first ? 'active' : '' }}"
                                        aria-label="Read review {{ $key + 1 }}"></button>
                                @endforeach
                            </div>

                            <div class="carousel-inner pb-5">
                                @foreach ($reviews as $review)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}" itemscope
                                        itemtype="https://schema.org/Review">

                                        <!-- Hidden Microdata for Google Rich Snippets -->
                                        <meta itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating"
                                            content="{{ $review->rating }}" />

                                        <!-- Dynamic Profile Image -->
                                        <img src="{{ $review->image_path ? asset('storage/' . $review->image_path) : 'https://ui-avatars.com/api/?name=' . urlencode($review->client_name) . '&background=random' }}"
                                            class="rounded-circle mb-3 border border-secondary shadow-sm" width="80"
                                            height="80" style="object-fit: cover;"
                                            alt="Profile photo of {{ $review->client_name }}" loading="lazy"
                                            itemprop="image">
                                        <br>
                                        <i class="fa-solid fa-quote-left fa-2x text-tech mb-3 opacity-50"
                                            aria-hidden="true"></i>

                                        <!-- Semantic Blockquote -->
                                        <blockquote class="blockquote mb-4">
                                            <p class="lead text-theme fst-italic" itemprop="reviewBody">
                                                "{{ $review->review_text }}"</p>
                                        </blockquote>

                                        <!-- Dynamic Rating Stars (Accessible) -->
                                        <div class="text-warning mb-3"
                                            aria-label="Rating: {{ $review->rating }} out of 5 stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($review->rating))
                                                    <i class="fa-solid fa-star" aria-hidden="true"></i>
                                                @elseif($i == ceil($review->rating) && fmod($review->rating, 1) !== 0.0)
                                                    <i class="fa-solid fa-star-half-stroke" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa-regular fa-star" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </div>

                                        <!-- Author Info -->
                                        <div itemprop="author" itemscope itemtype="https://schema.org/Person">
                                            <h3 class="h5 text-theme mb-0" itemprop="name">{{ $review->client_name }}
                                            </h3>
                                            <p class="text-tech-alt small fw-bold mt-1">{{ $review->position_company }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Carousel Controls -->
                            <button class="carousel-control-prev d-none d-md-flex" type="button"
                                data-bs-target="#reviewCarousel" data-bs-slide="prev" style="left: -60px; width: auto;">
                                <i class="fa-solid fa-chevron-left fs-3 text-tech hover-tech" aria-hidden="true"></i>
                                <span class="visually-hidden">Previous Review</span>
                            </button>
                            <button class="carousel-control-next d-none d-md-flex" type="button"
                                data-bs-target="#reviewCarousel" data-bs-slide="next"
                                style="right: -60px; width: auto;">
                                <i class="fa-solid fa-chevron-right fs-3 text-tech hover-tech" aria-hidden="true"></i>
                                <span class="visually-hidden">Next Review</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
