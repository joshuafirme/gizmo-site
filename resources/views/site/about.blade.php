@extends('site.layouts.app')

@section('panel')
    <!-- Page Hero Header -->
    <section class="page-header py-5 bg-dark position-relative"
        style="background: radial-gradient(circle at center, #2b3035 0%, #121416 100%); border-bottom: 1px solid rgba(255,255,255,0.05);">
        <div class="container py-5 text-center position-relative z-1" data-aos="fade-up">
            <h6 class="text-tech text-uppercase fw-bold mb-3 tracking-widest">Our Story</h6>
            <h1 class="display-4 fw-bold text-white mb-3">About {{ $settings->app_name ?? 'Gizmo Systems' }}</h1>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                {{ $settings->description ?? 'Discover our journey, our mission, and the core values that drive us to build the future of enterprise IT infrastructure.' }}
            </p>
        </div>
    </section>

    <!-- Who We Are Section -->
    @if ($whoWeAre)
        <section class="py-5">
            <div class="container py-5">
                <div class="row align-items-center g-5">
                    <!-- Left: Decorative Image or Abstract Graphic -->
                    <div class="col-lg-5" data-aos="fade-right">
                        <div class="position-relative rounded-4 overflow-hidden shadow-lg"
                            style="height: 500px; background: #1a1d21;">
                            <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&q=80&w=800"
                                alt="Technology Background" class="w-100 h-100" style="object-fit: cover; opacity: 0.7;">
                            <div class="position-absolute bottom-0 start-0 w-100 p-4"
                                style="background: linear-gradient(transparent, #121416);">
                                <h3 class="text-white fw-bold mb-0">{{ $whoWeAre->heading }}</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Content from Database -->
                    <div class="col-lg-7" data-aos="fade-left">
                        <h6 class="text-tech text-uppercase fw-bold mb-3">{{ $whoWeAre->badge_text }}</h6>
                        <h2 class="display-6 fw-bold mb-4 text-theme">Pioneering Enterprise Solutions</h2>

                        <!-- CKEditor Content -->
                        <div class="text-muted fs-5 mb-5 content-wrapper">
                            {!! $whoWeAre->main_content !!}
                        </div>

                        <!-- Bullet Points -->
                        @if (!empty($whoWeAre->bullet_points))
                            <div class="row g-3">
                                @foreach ($whoWeAre->bullet_points as $point)
                                    <div class="col-md-6">
                                        <div
                                            class="d-flex align-items-start bg-card p-3 rounded border border-secondary h-100">
                                            <i class="fa-solid fa-check-circle text-tech mt-1 me-3 fs-5"></i>
                                            <span class="text-muted fw-medium">{{ $point }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Core Identity (Mission, Vision, Values) -->
    @if ($aboutUs)
        @php
            $content = is_array($aboutUs->json_content)
                ? $aboutUs->json_content
                : json_decode($aboutUs->json_content, true);
        @endphp
        <section class="py-5 bg-tech-dark position-relative">
            <div class="container py-5">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h6 class="text-tech text-uppercase fw-bold">{{ $aboutUs->section_title }}</h6>
                    <h2 class="display-5 fw-bold text-theme">Our Core Identity</h2>
                    <div class="mx-auto mt-3" style="width: 50px; height: 3px; background-color: var(--primary-tech);">
                    </div>
                </div>

                <!-- Mission & Vision row -->
                <div class="row g-4 mb-5">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="p-5 h-100 rounded-4 border border-secondary position-relative overflow-hidden"
                            style="background-color: var(--bg-card);">
                            <i
                                class="fa-solid fa-bullseye fa-5x text-tech opacity-25 position-absolute top-0 end-0 mt-4 me-4"></i>
                            <h3 class="text-theme fw-bold mb-4 position-relative z-1">Our Mission</h3>
                            <p class="lead text-muted position-relative z-1 mb-0">
                                {{ $content['mission'] ?? 'To bridge the gap between technology and business growth.' }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="p-5 h-100 rounded-4 border border-secondary position-relative overflow-hidden"
                            style="background-color: var(--bg-card);">
                            <i
                                class="fa-solid fa-eye fa-5x text-tech opacity-25 position-absolute top-0 end-0 mt-4 me-4"></i>
                            <h3 class="text-theme fw-bold mb-4 position-relative z-1">Our Vision</h3>
                            <p class="lead text-muted position-relative z-1 mb-0">
                                {{ $content['vision'] ?? 'To be the global standard for IT infrastructure supply.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Values Grid -->
                @if (!empty($content['values']))
                    <h4 class="text-center text-white fw-bold mb-4" data-aos="fade-up">Our Guiding Values</h4>
                    <div class="row g-4 justify-content-center" data-aos="fade-up" data-aos-delay="300">
                        @foreach ($content['values'] as $value)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div
                                    class="text-center p-4 rounded bg-dark border border-secondary h-100 hover-lift transition-all">
                                    <i class="fa-solid fa-star text-tech mb-3 fs-3"></i>
                                    <h6 class="text-white fw-bold mb-0">{{ $value }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    <!-- Call to Action Banner -->
    <section class="py-5 text-center">
        <div class="container py-5" data-aos="zoom-in">
            <h2 class="display-6 fw-bold text-white mb-4">Want to be part of our story?</h2>
            <p class="text-muted lead mb-4 mx-auto" style="max-width: 600px;">
                Whether you're looking for top-tier infrastructure or expert consultation, we are ready to help your
                business scale.
            </p>
            <a href="{{ route('home') }}#contact" class="btn btn-tech px-5 py-3 rounded-pill fs-5">
                Contact Our Team <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Styling for CKEditor Content generated on the backend */
        .content-wrapper p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .content-wrapper strong {
            color: #fff;
        }

        .bg-card {
            background-color: var(--bg-card);
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            border-color: var(--primary-tech) !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
@endpush
