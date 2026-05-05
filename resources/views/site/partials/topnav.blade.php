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
