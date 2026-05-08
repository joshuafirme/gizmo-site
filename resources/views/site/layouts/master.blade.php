<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('seo_title', ($settings->app_name ?? 'Gizmo System Solutions Inc.') . ' | Enterprise Hardware & Servers')</title>
    <meta name="description" content="@yield('seo_description', $settings->description ?? 'Global supplier of enterprise-grade hardware, servers, and networking equipment.')">
    <meta name="author" content="{{ $settings->app_name ?? 'Gizmo Systems' }}">

    @if (!empty($settings->favicon_path))
        <!-- Standard Favicon -->
        <link rel="icon" href="{{ asset('storage/' . $settings->favicon_path) }}" type="image/png">
        <!-- Apple Touch Icon (For iOS Home Screens) -->
        <link rel="apple-touch-icon" href="{{ asset('storage/' . $settings->favicon_path) }}">
    @else
        <!-- Fallback if no favicon is uploaded (place a default favicon.ico in your public folder) -->
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif

    <!-- Canonical URL (Crucial for SEO) -->
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <!-- Control Search Engine Crawling -->
    <meta name="robots" content="@yield('seo_robots', 'index, follow')">

    <!-- Open Graph (Facebook/LinkedIn) -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    <meta property="og:title" content="@yield('seo_title', $settings->app_name)">
    <meta property="og:description" content="@yield('seo_description', $settings->description)">
    <meta property="og:image" content="@yield('seo_image', asset('storage/' . $settings->logo_path))">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('seo_title', $settings->app_name)">
    <meta name="twitter:description" content="@yield('seo_description', $settings->description)">
    <meta name="twitter:image" content="@yield('seo_image', asset('storage/' . $settings->logo_path))">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- AOS Animation Library CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="{{ asset('assets/css/main.css?v=' . $settings->version) }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


</head>

<body data-bs-spy="scroll" data-bs-target="#main-nav" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true">
    @yield('content')
    @stack('script')

    <!-- Organization Schema -->
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ $settings->app_name ?? 'Gizmo Systems' }}",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('storage/' . $settings->logo_path) }}",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{ $settings->contact_phone }}",
            "contactType": "customer service",
            "email": "{{ $settings->contact_email }}"
        },
        "sameAs": [
            "{{ $settings->facebook_url }}",
            "{{ $settings->twitter_url }}",
            "{{ $settings->linkedin_url }}"
        ]
        }
        </script>
</body>

</html>
