  <!-- Call to Action (Contact) -->
    <section id="contact" class="py-5 position-relative">
        <div class="container py-5">
            <div class="contact-box row align-items-center p-4 p-md-5 rounded-4 shadow-sm" data-aos="zoom-in">

                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="fw-bold mb-3 text-theme">Ready to upgrade your infrastructure?</h2>
                    <p class="text-muted mb-4">Request a custom quote or consultation. Our system architects will respond
                        within 24 hours.</p>

                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-bg p-3 rounded text-tech me-3"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <h6 class="mb-0 text-theme">Direct Sales Line</h6>
                            <span class="text-muted small">{{ $settings->contact_phone ?? '+1 (800) 555-0199' }}</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="icon-bg p-3 rounded text-tech me-3"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <h6 class="mb-0 text-theme">Email Inquiries</h6>
                            <span
                                class="text-muted small">{{ $settings->contact_email ?? 'b2bsales@gizmosystems.com' }}</span>
                        </div>
                    </div>

                    <!-- Optional Dynamic Socials -->
                    <div class="d-flex mt-4 gap-3">
                        @if ($settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" target="_blank" class="text-muted"><i
                                    class="fa-brands fa-facebook fa-lg"></i></a>
                        @endif
                        @if ($settings->twitter_url)
                            <a href="{{ $settings->twitter_url }}" target="_blank" class="text-muted"><i
                                    class="fa-brands fa-twitter fa-lg"></i></a>
                        @endif
                        @if ($settings->linkedin_url)
                            <a href="{{ $settings->linkedin_url }}" target="_blank" class="text-muted"><i
                                    class="fa-brands fa-linkedin fa-lg"></i></a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-7">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4 bg-success text-white border-0"
                            role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                     @elseif (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4 bg-danger text-white border-0"
                            role="alert">
                            <i class=" me-2"></i> {{ session('danger') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @error('captcha')
                        <div class="alert alert-danger mb-4 border-0" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ $message }}
                        </div>
                    @enderror

                    <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Full Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required placeholder="John Doe">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small">Company Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    required placeholder="john@company.com">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-muted small">Company Name</label>
                                <input type="text" name="subject"
                                    class="form-control @error('subject') is-invalid @enderror"
                                    value="{{ old('subject') }}" placeholder="Organization Ltd.">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-muted small">Hardware Requirements</label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="4" required
                                    placeholder="Tell us what you need...">{{ old('message') }}</textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-tech w-100 py-3">
                                    Submit Inquiry <i class="fa-solid fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    @push('script')
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site') }}"></script>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Stop normal submission

            // Execute reCAPTCHA
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('services.recaptcha.site') }}', {
                    action: 'submit_contact_form'
                }).then(function(token) {
                    // Add token to hidden field
                    document.getElementById('g-recaptcha-response').value = token;

                    // Submit the form programmatically
                    document.getElementById('contactForm').submit();
                });
            });
        });

        const hashLinks = document.querySelectorAll('a[href*="#"]');
        
        hashLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Parse the URL of the clicked link
                const url = new URL(this.href);
                
                // If the link points to the exact same page we are currently on
                if (url.pathname === window.location.pathname && url.hash) {
                    const targetElement = document.querySelector(url.hash);
                    
                    if (targetElement) {
                        e.preventDefault(); // Prevent default instant jump
                        
                        // Smoothly scroll to the element
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        
                        // Optional: Update the URL in the browser without jumping
                        history.pushState(null, null, url.hash);
                    }
                }
            });
        });
    </script>
@endpush