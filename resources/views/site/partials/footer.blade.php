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
                    <button class="btn btn-tech px-3" type="button"><i class="fa-solid fa-arrow-right"></i></button>
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
