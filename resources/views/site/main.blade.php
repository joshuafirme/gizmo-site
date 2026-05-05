@extends('site.layouts.app')

@section('panel')
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
            <button class="carousel-control-prev" type="button" data-bs-target="#techCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#techCarousel" data-bs-slide="next">
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
                                <button type="button" data-bs-target="#reviewCarousel" data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#reviewCarousel" data-bs-slide-to="2"></button>
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
@endsection
