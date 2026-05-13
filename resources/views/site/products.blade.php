@extends('site.layouts.app')

@section('seo_title', (request('subcategory') ? ucwords(str_replace('-', ' ', request('subcategory'))) . ' | ' : '') .
    'Hardware Catalog | ' . $settings->app_name)
@section('seo_description', 'Browse our extensive catalog of ' . (request('subcategory') ? ucwords(str_replace('-', ' ',
    request('subcategory'))) : 'enterprise IT infrastructure') . ' solutions.')
@section('canonical_url', request()->url()) <!-- Strips query parameters to avoid duplicate content -->

@section('panel')
    <!-- Page Header -->
    <section class="page-header py-5 bg-dark position-relative"
        style="background: radial-gradient(circle at top right, #2b3035 0%, #121416 100%); border-bottom: 1px solid rgba(255,255,255,0.05);">
        <div class="container py-4 position-relative z-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active text-tech" aria-current="page">Hardware Catalog</li>
                </ol>
            </nav>
            <h1 class="display-5 fw-bold text-white mb-2">
                @if (request('subcategory'))
                    {{ ucwords(str_replace('-', ' ', request('subcategory'))) }}
                @elseif(request('category'))
                    {{ ucwords(str_replace('-', ' ', request('category'))) }}
                @else
                    All Products
                @endif
            </h1>
            <p class="text-muted lead mb-0">Browse our enterprise-grade IT infrastructure solutions.</p>
        </div>
    </section>

    <!-- Catalog Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">

                <!-- Sidebar Filters -->
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm sticky-top"
                        style="top: 100px; background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                        <div
                            class="card-header border-bottom py-3 bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-dark fw-bold"><i class="fa-solid fa-filter text-tech me-2"></i> Filters
                            </h5>
                            @if (request()->hasAny(['category', 'subcategory']))
                                <a href="{{ route('products') }}"
                                    class="small text-danger text-decoration-none fw-semibold">Clear</a>
                            @endif
                        </div>
                        <div class="card-body p-0">
                            <div class="accordion accordion-flush" id="filterAccordion">
                                @foreach ($categories as $cat)
                                    <div class="accordion-item border-bottom">
                                        <h2 class="accordion-header">
                                            <button
                                                class="accordion-button {{ request('category') == $cat->slug || $cat->subcategories->contains('slug', request('subcategory')) ? '' : 'collapsed' }} text-dark fw-semibold shadow-none bg-white"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#cat-{{ $cat->id }}">
                                                {{ $cat->name }}
                                            </button>
                                        </h2>
                                        <div id="cat-{{ $cat->id }}"
                                            class="accordion-collapse collapse {{ request('category') == $cat->slug || $cat->subcategories->contains('slug', request('subcategory')) ? 'show' : '' }}"
                                            data-bs-parent="#filterAccordion">
                                            <div class="accordion-body pt-0 pb-3 bg-white">
                                                <div class="list-group list-group-flush">
                                                    <!-- "All" link for parent category -->
                                                    <a href="{{ route('products', ['category' => $cat->slug]) }}"
                                                        class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center px-0 py-2 {{ request('category') == $cat->slug ? 'text-tech fw-bold' : '' }}">
                                                        <span><i class="fa-solid fa-angle-right me-2"
                                                                style="font-size:0.6rem;"></i> View All
                                                            {{ $cat->name }}</span>
                                                    </a>

                                                    <!-- Subcategories -->
                                                    @foreach ($cat->subcategories as $sub)
                                                        <a href="{{ route('products', ['subcategory' => $sub->slug]) }}"
                                                            class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center px-0 py-2 {{ request('subcategory') == $sub->slug ? 'text-tech fw-bold' : 'hover-dark-text' }}">
                                                            <span class="ms-3">{{ $sub->name }}</span>
                                                            <span
                                                                class="badge rounded-pill {{ request('subcategory') == $sub->slug ? 'bg-tech text-white' : 'bg-light text-secondary border' }}">{{ $sub->products_count }}</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9">
                    <!-- Active Filter Pill & Results Count -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="text-muted mb-0">Showing <span
                                class="text-white fw-bold">{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</span>
                            of <span class="text-white fw-bold">{{ $products->total() }}</span> results</p>
                    </div>

                    <div class="row g-4">
                        @forelse($products as $product)
                            <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                                <div
                                    class="product-card h-100 bg-card border border-secondary rounded-3 overflow-hidden d-flex flex-column transition-all hover-lift">
                                    <div class="product-img-wrapper position-relative"
                                        style="height: 200px; background: #121416;">
                                        @if ($product->is_featured)
                                            <span
                                                class="badge bg-warning text-dark position-absolute top-0 start-0 m-3 z-2"><i
                                                    class="fa-solid fa-star me-1"></i> Featured</span>
                                        @endif

                                        @if ($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}"
                                                alt="Front view of {{ $product->name }} server" loading="lazy"
                                                width="600" height="400" class="w-100 h-100"
                                                style="object-fit: cover;">
                                        @else
                                            <div class="d-flex h-100 align-items-center justify-content-center">
                                                <i class="fa-solid fa-image fa-3x text-muted opacity-25"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge bg-dark border border-secondary text-muted rounded-pill"
                                                style="font-size: 0.7rem;">{{ $product->subcategory->name }}</span>
                                            <i class="fa-solid {{ $product->icon_class ?? 'fa-box' }} text-tech"></i>
                                        </div>
                                        <h5 class="text-white fw-bold mb-3">{{ $product->name }}</h5>
                                        <p class="text-muted small mb-4 flex-grow-1">
                                            {{ Str::limit($product->description, 90) }}</p>
                                        <a href="{{ route('home') }}#contact"
                                            class="btn btn-outline-secondary w-100 text-white"
                                            style="border-color: rgba(255,255,255,0.1);">
                                            Request Quote <i class="fa-solid fa-arrow-right ms-2 text-tech"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <div class="bg-card border border-secondary rounded-4 p-5">
                                    <i class="fa-solid fa-magnifying-glass fa-3x text-muted mb-3 opacity-50"></i>
                                    <h4 class="text-white">No Products Found</h4>
                                    <p class="text-muted">There are no hardware solutions matching your current filter.</p>
                                    <a href="{{ route('products') }}" class="btn btn-tech mt-2">View All Products</a>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            border-color: var(--primary-tech) !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .hover-text-white:hover {
            color: #fff !important;
        }

        .accordion-button::after {
            filter: invert(1);
            opacity: 0.5;
        }

        .accordion-button:not(.collapsed) {
            color: var(--primary-tech);
            background-color: transparent;
            box-shadow: none;
        }

        .accordion-button:not(.collapsed)::after {
            filter: invert(40%) sepia(80%) saturate(3000%) hue-rotate(200deg) brightness(90%) contrast(90%);
            opacity: 1;
        }
    </style>
@endpush


@push('script')
    @if ($product)
        <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "Product",
            "name": "{{ $product->name }}",
            "image": "{{ asset('storage/' . $product->image_path) }}",
            "description": "{{ $product->description }}",
            "brand": {
                "@type": "Brand",
                "name": "Gizmo Systems"
            }
        }
        </script>
    @endif
@endpush
