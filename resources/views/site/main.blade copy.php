<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gizmo System Solutions Inc. | Enterprise Hardware & Servers</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- AOS Animation Library CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body data-bs-spy="scroll" data-bs-target="#main-nav" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true">

    <!-- Navigation -->
    <nav id="main-nav" class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand text-theme" href="#">
                <img src="{{ asset('assets/images/logo.png') }}" width="70px;" alt="">
                <i class="fa-solid fa-microchip text-tech me-2"></i>GIZMO<span class="text-tech">SYSTEMS</span>
            </a>

            <div class="d-flex align-items-center">
                <!-- Theme Toggle Button for Mobile view -->
                <button id="themeToggleMobile" class="btn d-lg-none me-2"
                    style="border: 1px solid var(--border-color); color: var(--text-main);">
                    <i class="fa-solid fa-moon"></i>
                </button>
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon" style="filter: invert(var(--theme-invert, 0));"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-semibold">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#products">Hardware</a></li>
                    <li class="nav-item"><a class="nav-link" href="#reviews">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Inquiry</a></li>
                </ul>
                <div class="d-flex align-items-center mt-3 mt-lg-0 ms-lg-3">
                    <a href="#contact" class="btn btn-tech btn-sm px-4 py-2 me-3 me-lg-0">Get Quote</a>
                    <!-- Theme Toggle Button for Desktop view -->
                    <button id="themeToggleDesktop" class="d-none d-lg-flex ms-3">
                        <i class="fa-solid fa-moon"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Slider Section -->
    <section id="home" class="hero-carousel">
        <div id="techCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#techCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#techCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#techCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active"
                    style="background-image: url('https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&q=80&w=1920');">
                    <div class="hero-overlay"></div>
                    <div class="container h-100 position-relative">
                        <div class="carousel-caption w-md-50" data-aos="fade-right" data-aos-duration="1000">
                            <h6 class="text-tech text-uppercase fw-bold mb-3 tracking-widest">Enterprise Architecture
                            </h6>
                            <h1 class="display-3 fw-bold mb-4 text-white">High-Performance<br>Data Centers</h1>
                            <p class="lead mb-4 text-light">Equipping your business with scalable, state-of-the-art
                                server solutions and reliable rack infrastructure.</p>
                            <a href="#products" class="btn btn-tech px-5 py-3">Explore Servers</a>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item"
                    style="background-image: url('https://images.unsplash.com/photo-1593640408182-31c70c8268f5?auto=format&fit=crop&q=80&w=1920');">
                    <div class="hero-overlay"></div>
                    <div class="container h-100 position-relative">
                        <div class="carousel-caption w-md-50">
                            <h6 class="text-tech text-uppercase fw-bold mb-3 tracking-widest">Corporate Workstations
                            </h6>
                            <h1 class="display-3 fw-bold mb-4 text-white">Next-Gen<br>Computing Power</h1>
                            <p class="lead mb-4 text-light">Deploy advanced corporate laptops, desktops, and thin
                                clients built for modern, demanding workloads.</p>
                            <a href="#contact" class="btn btn-tech px-5 py-3">Request Catalog</a>
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item"
                    style="background-image: url('https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&q=80&w=1920');">
                    <div class="hero-overlay"></div>
                    <div class="container h-100 position-relative">
                        <div class="carousel-caption w-md-50">
                            <h6 class="text-tech text-uppercase fw-bold mb-3 tracking-widest">Network Infrastructure
                            </h6>
                            <h1 class="display-3 fw-bold mb-4 text-white">Secure & Seamless<br>Connectivity</h1>
                            <p class="lead mb-4 text-light">Enterprise-grade routers, switches, and firewalls ensuring
                                zero downtime for your critical operations.</p>
                            <a href="#about" class="btn btn-tech px-5 py-3">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#techCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#techCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- Company Introduction -->
    <section id="about" class="py-5 bg-tech-dark">
        <div class="container py-5">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h6 class="text-tech text-uppercase fw-bold">Who We Are</h6>
                    <h2 class="display-5 fw-bold mb-4 text-theme">Powering the Future of Enterprise IT</h2>
                    <p class="text-muted fs-5 mb-4">Gizmo System Solutions Inc. is the premier global supplier of
                        enterprise-grade hardware. We partner with industry leaders to provide robust servers, advanced
                        networking equipment, and high-performance workstations tailored to your organizational needs.
                    </p>
                    <ul class="list-unstyled text-muted mb-4">
                        <li class="mb-2"><i class="fa-solid fa-check text-tech-alt me-2"></i> Global supply chain
                            logistics</li>
                        <li class="mb-2"><i class="fa-solid fa-check text-tech-alt me-2"></i> 24/7 Enterprise
                            Hardware Support</li>
                        <li class="mb-2"><i class="fa-solid fa-check text-tech-alt me-2"></i> Custom-built data
                            center solutions</li>
                    </ul>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="feature-icon-box text-center">
                                <i class="fa-solid fa-server fa-3x text-tech mb-3"></i>
                                <h4 class="h5 text-theme">Server Infrastructure</h4>
                                <p class="text-muted small mb-0">Scalable rack and blade servers for high-availability
                                    environments.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-icon-box text-center">
                                <i class="fa-solid fa-shield-halved fa-3x text-tech mb-3"></i>
                                <h4 class="h5 text-theme">Network Security</h4>
                                <p class="text-muted small mb-0">Hardware firewalls and VPN appliances to secure your
                                    data.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-icon-box text-center">
                                <i class="fa-solid fa-laptop-code fa-3x text-tech mb-3"></i>
                                <h4 class="h5 text-theme">Corporate Devices</h4>
                                <p class="text-muted small mb-0">Laptops, desktops, and peripherals bulk supply for
                                    remote and office teams.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-icon-box text-center">
                                <i class="fa-solid fa-microchip fa-3x text-tech mb-3"></i>
                                <h4 class="h5 text-theme">OEM Components</h4>
                                <p class="text-muted small mb-0">Processors, enterprise SSDs, and ECC memory for
                                    internal upgrades.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="products" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-tech text-uppercase fw-bold">Hardware Catalog</h6>
                <h2 class="display-5 fw-bold text-theme">Featured Equipment</h2>
                <div class="mx-auto mt-3" style="width: 50px; height: 3px; background-color: var(--primary-tech);">
                </div>
            </div>

            <div class="row g-4">
                <!-- Product 1 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="product-card h-100">
                        <div class="product-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&q=80&w=600"
                                alt="Rack Server">
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-alt rounded-pill">Data Center</span>
                                <i class="fa-solid fa-server fs-5 text-tech"></i>
                            </div>
                            <h4 class="h5 text-theme mb-3">GizmoRack Pro V3 Servers</h4>
                            <p class="text-muted small mb-4">High-density 1U/2U rack servers equipped with dual
                                processors, ideal for virtualization and heavy database workloads.</p>
                            <a href="#contact" class="btn btn-outline-secondary btn-sm w-100 text-theme"
                                style="border-color: var(--border-color);">Inquire Now <i
                                    class="fa-solid fa-arrow-right ms-2 text-tech"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-card h-100">
                        <div class="product-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=600"
                                alt="Workstation">
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-alt rounded-pill">Workstations</span>
                                <i class="fa-solid fa-desktop fs-5 text-tech"></i>
                            </div>
                            <h4 class="h5 text-theme mb-3">EliteDesk Enterprise Fleet</h4>
                            <p class="text-muted small mb-4">Powerful business laptops and small form factor desktops
                                designed for productivity, security, and remote management.</p>
                            <a href="#contact" class="btn btn-outline-secondary btn-sm w-100 text-theme"
                                style="border-color: var(--border-color);">Inquire Now <i
                                    class="fa-solid fa-arrow-right ms-2 text-tech"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="product-card h-100">
                        <div class="product-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&q=80&w=600"
                                alt="Network Switch">
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-alt rounded-pill">Networking</span>
                                <i class="fa-solid fa-network-wired fs-5 text-tech"></i>
                            </div>
                            <h4 class="h5 text-theme mb-3">Core Routing & Switches</h4>
                            <p class="text-muted small mb-4">Managed L2/L3 Gigabit and 10G switches ensuring seamless
                                communication across your entire corporate network.</p>
                            <a href="#contact" class="btn btn-outline-secondary btn-sm w-100 text-theme"
                                style="border-color: var(--border-color);">Inquire Now <i
                                    class="fa-solid fa-arrow-right ms-2 text-tech"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
                <a href="#contact" class="btn btn-tech-alt px-4 py-2 rounded-pill">Download Full PDF Catalog <i
                        class="fa-solid fa-file-pdf ms-2"></i></a>
            </div>
        </div>
    </section>

    <!-- Client Reviews Section -->
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
                    <div class="review-box text-center shadow-lg">
                        <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#reviewCarousel" data-bs-slide-to="0"
                                    class="active"></button>
                                <button type="button" data-bs-target="#reviewCarousel"
                                    data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#reviewCarousel"
                                    data-bs-slide-to="2"></button>
                            </div>

                            <div class="carousel-inner pb-4">
                                <!-- Review 1 -->
                                <div class="carousel-item active">
                                    <i class="fa-solid fa-quote-left fa-3x text-tech mb-4 opacity-50"></i>
                                    <p class="lead text-theme mb-4 fst-italic">"Gizmo System Solutions completely
                                        overhauled our data center infrastructure. Their servers are top-notch, and the
                                        deployment was seamless. We haven't experienced a single minute of downtime
                                        since."</p>
                                    <div class="text-warning mb-3">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i>
                                    </div>
                                    <h5 class="text-theme mb-0">Sarah Jenkins</h5>
                                    <p class="text-tech-alt small fw-bold mt-1">CTO, FinTech Global</p>
                                </div>

                                <!-- Review 2 -->
                                <div class="carousel-item">
                                    <i class="fa-solid fa-quote-left fa-3x text-tech mb-4 opacity-50"></i>
                                    <p class="lead text-theme mb-4 fst-italic">"Procuring workstations for a 500-person
                                        remote team seemed daunting until we partnered with Gizmo. The EliteDesk fleet
                                        arrived pre-configured, secure, and ready to go. Incredible service."</p>
                                    <div class="text-warning mb-3">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                    <h5 class="text-theme mb-0">David Chen</h5>
                                    <p class="text-tech-alt small fw-bold mt-1">IT Director, NexusCorp</p>
                                </div>

                                <!-- Review 3 -->
                                <div class="carousel-item">
                                    <i class="fa-solid fa-quote-left fa-3x text-tech mb-4 opacity-50"></i>
                                    <p class="lead text-theme mb-4 fst-italic">"Their core routing and switching
                                        hardware stabilized our entire factory floor network. The 24/7 enterprise
                                        support team is highly knowledgeable and always responsive. Highly recommended."
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i>
                                    </div>
                                    <h5 class="text-theme mb-0">Marcus Thorne</h5>
                                    <p class="text-tech-alt small fw-bold mt-1">VP of Operations, BuildTech Industries
                                    </p>
                                </div>
                            </div>

                            <button class="carousel-control-prev d-none d-md-flex" type="button"
                                data-bs-target="#reviewCarousel" data-bs-slide="prev"
                                style="left: -60px; width: auto;">
                                <i class="fa-solid fa-chevron-left fs-3 text-tech hover-tech"></i>
                            </button>
                            <button class="carousel-control-next d-none d-md-flex" type="button"
                                data-bs-target="#reviewCarousel" data-bs-slide="next"
                                style="right: -60px; width: auto;">
                                <i class="fa-solid fa-chevron-right fs-3 text-tech hover-tech"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action (Contact) -->
    <section id="contact" class="py-5 position-relative">
        <div class="container py-5">
            <div class="contact-box row align-items-center p-4 p-md-5 rounded-4 shadow-sm" data-aos="zoom-in">

                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="fw-bold mb-3 text-theme">Ready to upgrade your infrastructure?</h2>
                    <p class="text-muted mb-4">Request a custom quote or consultation. Our system architects will
                        respond within 24 hours.</p>

                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-bg p-3 rounded text-tech me-3"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <h6 class="mb-0 text-theme">Direct Sales Line</h6>
                            <span class="text-muted small">+1 (800) 555-0199</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="icon-bg p-3 rounded text-tech me-3"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <h6 class="mb-0 text-theme">Email Inquiries</h6>
                            <span class="text-muted small">b2bsales@gizmosystems.com</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <form
                        onsubmit="event.preventDefault(); alert('Inquiry Sent! A representative will contact you shortly.');">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Full Name</label>
                                <input type="text" class="form-control" required placeholder="John Doe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Company Email</label>
                                <input type="email" class="form-control" required placeholder="john@company.com">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small">Company Name</label>
                                <input type="text" class="form-control" required placeholder="Organization Ltd.">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small">Hardware Requirements</label>
                                <textarea class="form-control" rows="4" required
                                    placeholder="Tell us about the servers, computers, or network gear you need..."></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-tech w-100 py-3">Submit Inquiry <i
                                        class="fa-solid fa-paper-plane ms-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-theme mb-3"><i class="fa-solid fa-microchip text-tech me-2"></i>GIZMO<span
                            class="text-tech">SYSTEMS</span></h5>
                    <p class="text-muted small pe-lg-4">Your trusted partner in scaling digital environments. Providing
                        Tier-1 hardware and architecture solutions globally.</p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="text-theme mb-3">Solutions</h6>
                    <ul class="list-unstyled text-muted small">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Servers &
                                Storage</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Networking</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Client
                                Computing</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Data Center</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="text-theme mb-3">Company</h6>
                    <ul class="list-unstyled text-muted small">
                        <li class="mb-2"><a href="#about" class="text-decoration-none text-muted">About Us</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Partner
                                Program</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Careers</a></li>
                        <li class="mb-2"><a href="#contact" class="text-decoration-none text-muted">Contact
                                Support</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 class="text-theme mb-3">Stay Connected</h6>
                    <p class="text-muted small">Subscribe to our newsletter for hardware updates and tech news.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email Address">
                        <button class="btn btn-tech px-3" type="button"><i
                                class="fa-solid fa-arrow-right"></i></button>
                    </div>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-muted fs-5"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="#" class="text-muted fs-5"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="text-muted fs-5"><i class="fa-brands fa-github"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center text-muted small mt-5 pt-4 border-top"
                style="border-color: var(--nav-border) !important;">
                &copy; 2026 Gizmo System Solutions Inc. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize Animate On Scroll
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Theme Toggling Logic
        const toggleBtns = document.querySelectorAll('#themeToggleDesktop, #themeToggleMobile');
        const currentTheme = localStorage.getItem('theme') || 'dark';

        function updateIcons(isLight) {
            toggleBtns.forEach(btn => {
                const icon = btn.querySelector('i');
                if (isLight) {
                    icon.classList.replace('fa-moon', 'fa-sun');
                    document.documentElement.style.setProperty('--theme-invert', '1');
                } else {
                    icon.classList.replace('fa-sun', 'fa-moon');
                    document.documentElement.style.setProperty('--theme-invert', '0');
                }
            });
        }

        // Apply saved theme
        if (currentTheme === 'light') {
            document.documentElement.setAttribute('data-theme', 'light');
            updateIcons(true);
        }

        toggleBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                let theme = document.documentElement.getAttribute('data-theme');
                if (theme === 'light') {
                    document.documentElement.removeAttribute('data-theme');
                    localStorage.setItem('theme', 'dark');
                    updateIcons(false);
                } else {
                    document.documentElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('theme', 'light');
                    updateIcons(true);
                }
            });
        });

        // jQuery addition for Navbar scroll effect
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.navbar').css('background-color', 'var(--nav-scrolled)');
                $('.navbar').css('box-shadow', '0 4px 10px rgba(0,0,0,0.1)');
            } else {
                $('.navbar').css('background-color', 'var(--nav-bg)');
                $('.navbar').css('box-shadow', 'none');
            }
        });
    </script>
</body>

</html>
