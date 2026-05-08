@extends('site.layouts.app')

@section('panel')
    <h1 class="visually-hidden">
        Enterprise Hardware, Servers, and IT Infrastructure Solutions
    </h1>

    <!-- Hero Carousel Section -->
    @if ($sliders->isNotEmpty())
        <section id="home" class="hero-carousel" aria-label="Hero Carousel">
            <div id="techCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <!-- Dynamic Indicators -->
                <div class="carousel-indicators">
                    @foreach ($sliders as $key => $slider)
                        <button type="button" data-bs-target="#techCarousel" data-bs-slide-to="{{ $key }}"
                            class="{{ $loop->first ? 'active' : '' }}" aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @foreach ($sliders as $slider)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}"
                            style="background-image: url('{{ asset('storage/' . $slider->image_path) }}');">
                            <div class="hero-overlay"></div>
                            <div class="container h-100 position-relative">
                                <div class="carousel-caption w-md-50" data-aos="fade-right" data-aos-duration="1000">
                                    <p class="text-tech text-uppercase fw-bold mb-3 tracking-widest h6">
                                        {{ $slider->title_badge }}
                                    </p>
                                    <h2 class="display-3 fw-bold mb-4 text-white">{!! nl2br(e($slider->heading)) !!}</h2>
                                    @if ($slider->description)
                                        <p class="lead mb-4 text-light">{{ $slider->description }}</p>
                                    @endif
                                    @if ($slider->button_text && $slider->button_link)
                                        <a href="{{ $slider->button_link }}" class="btn btn-tech px-5 py-3"
                                            aria-label="{{ $slider->button_text }} about {{ strip_tags($slider->heading) }}"
                                            @if (Str::startsWith($slider->button_link, ['http://', 'https://']) &&
                                                    !Str::contains($slider->button_link, request()->getHost())) target="_blank" rel="noopener noreferrer" @endif>
                                            {{ $slider->button_text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($sliders->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#techCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#techCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        </section>
    @endif

    <!-- Company Introduction -->
    <section id="about" class="py-5 bg-tech-dark" aria-label="About Us">
        <div class="container py-5">
            <div class="row align-items-center mb-5">
                <!-- Who We Are (Left Side) -->
                <div class="col-lg-6" data-aos="fade-right">
                    @if ($whoWeAre)
                        <p class="text-tech text-uppercase fw-bold h6">{{ $whoWeAre->badge_text }}</p>
                        <h2 class="display-5 fw-bold mb-4 text-theme">{{ $whoWeAre->heading }}</h2>
                        <div class="text-muted fs-5 mb-4">
                            {!! $whoWeAre->main_content !!}
                        </div>

                        @if (!empty($whoWeAre->bullet_points))
                            <ul class="list-unstyled text-muted mb-4">
                                @foreach ($whoWeAre->bullet_points as $point)
                                    <li class="mb-2"><i class="fa-solid fa-check text-tech-alt me-2"></i>
                                        {{ $point }}</li>
                                @endforeach
                            </ul>
                        @endif
                    @endif
                </div>

                <!-- About Us / Core Identity (Right Side Grid) -->
                <div class="col-lg-6" data-aos="fade-left">
                    @if ($aboutUs)
                        @php
                            $content = is_array($aboutUs->json_content)
                                ? $aboutUs->json_content
                                : json_decode($aboutUs->json_content, true);
                        @endphp
                        <div class="row g-4">
                            <!-- Mission Box -->
                            <div class="col-md-6">
                                <div class="feature-icon-box text-center h-100 p-4 border border-secondary rounded">
                                    <i class="fa-solid fa-bullseye fa-3x text-tech mb-3"></i>
                                    <h3 class="h5 text-theme">Our Mission</h3>
                                    <p class="text-muted small mb-0">
                                        {{ $content['mission'] ?? 'To bridge the gap between technology and growth.' }}</p>
                                </div>
                            </div>
                            <!-- Vision Box -->
                            <div class="col-md-6">
                                <div class="feature-icon-box text-center h-100 p-4 border border-secondary rounded">
                                    <i class="fa-solid fa-eye fa-3x text-tech mb-3"></i>
                                    <h3 class="h5 text-theme">Our Vision</h3>
                                    <p class="text-muted small mb-0">
                                        {{ $content['vision'] ?? 'To be the global standard for IT supply.' }}</p>
                                </div>
                            </div>

                            <!-- Dynamic Values Loop -->
                            @foreach (array_slice($content['values'] ?? [], 0, 2) as $index => $value)
                                <div class="col-md-6">
                                    <div class="feature-icon-box text-center h-100 p-4 border border-secondary rounded">
                                        <i
                                            class="fa-solid {{ $index == 0 ? 'fa-handshake' : 'fa-lightbulb' }} fa-3x text-tech mb-3"></i>
                                        <p class="h5 text-theme fw-bold mb-2">Core Value</p>
                                        <p class="text-muted small mb-0">{{ $value }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="products" class="py-5" aria-label="Featured Products">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <p class="text-tech text-uppercase fw-bold h6">Hardware Catalog</p>
                <h2 class="display-5 fw-bold text-theme">Featured Equipment</h2>
                <p class="text-muted mx-auto mt-3" style="max-width: 800px;">
                    Explore our selection of enterprise servers, networking hardware,
                    storage systems, cybersecurity appliances, and IT infrastructure
                    equipment sourced from trusted global technology manufacturers.
                    Our solutions are designed to support scalability, reliability,
                    and high-performance enterprise operations.
                </p>
                <div class="mx-auto mt-3" style="width: 50px; height: 3px; background-color: var(--primary-tech);"></div>
            </div>

            <div class="row g-4">
                @forelse($featuredProducts as $product)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <article class="product-card h-100">
                            <div class="product-img-wrapper" style="height: 250px; overflow: hidden; background: #1a1d21;">
                                @if ($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}"
                                        alt="Front view of {{ $product->name }} server" loading="lazy" width="600"
                                        height="400" class="w-100 h-100" style="object-fit: cover;">
                                @else
                                    <div class="d-flex h-100 align-items-center justify-content-center">
                                        <i class="fa-solid fa-image fa-4x text-muted opacity-25"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span
                                        class="badge badge-alt rounded-pill">{{ $product->subcategory->name ?? 'Uncategorized' }}</span>
                                    <i class="fa-solid {{ $product->icon_class ?? 'fa-box' }} fs-5 text-tech"></i>
                                </div>
                                <h3 class="h5 text-theme mb-3">{{ $product->name }}</h3>
                                <p class="text-muted small mb-4">{{ Str::limit($product->description, 100) }}</p>
                                <a href="#contact" class="btn btn-outline-secondary btn-sm w-100 text-theme"
                                    style="border-color: var(--border-color);"
                                    aria-label="Inquire about {{ $product->name }}">
                                    Inquire Now <i class="fa-solid fa-arrow-right ms-2 text-tech"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>No featured products available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('site.sections.client-reviews')

    @include('site.sections.contact')

@endsection
