  <!-- Navigation -->
  <nav id="main-nav" class="navbar navbar-expand-lg fixed-top py-3">
      <div class="container">
          <a class="navbar-brand text-theme" href="#">
              <img src="{{ asset('storage/' . $settings->logo_path) }}" width="70px;" alt="">
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
                  <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>

                  <!-- Hover Multi-level Dropdown for Products -->
                  <li class="nav-item dropdown dropdown-hover">
                      <a class="nav-link dropdown-toggle" href="{{ route('products') }}"
                          id="navbarDropdownProducts" data-bs-toggle="dropdown" aria-expanded="false"
                          onclick="window.location.href='{{ route('products') }}'">
                          Products
                      </a>

                      <!-- Light Theme Dropdown -->
                      <ul class="dropdown-menu shadow-lg custom-light-dropdown"
                          aria-labelledby="navbarDropdownProducts">
                          <li>
                              <a class="dropdown-item fw-bold text-tech active-item"
                                  href="{{ route('products') }}">All Products</a>
                          </li>
                          <li>
                              <hr class="dropdown-divider">
                          </li>

                          @foreach ($navCategories as $cat)
                              <li class="dropdown-submenu">
                                  <!-- Removed 'dropdown-toggle' class here to prevent the double-caret issue -->
                                  <a class="dropdown-item d-flex justify-content-between align-items-center"
                                      href="{{ route('products', ['category' => $cat->slug]) }}">
                                      {{ $cat->name }} <i class="fa-solid fa-chevron-right ms-3 chevron-icon"></i>
                                  </a>

                                  <!-- Submenu -->
                                  <ul class="dropdown-menu shadow-lg custom-light-dropdown">
                                      @foreach ($cat->subcategories as $sub)
                                          <li><a class="dropdown-item"
                                                  href="{{ route('products', ['subcategory' => $sub->slug]) }}">{{ $sub->name }}</a>
                                          </li>
                                      @endforeach
                                  </ul>
                              </li>
                          @endforeach
                      </ul>
                  </li>

                  <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#reviews">Reviews</a></li>
              </ul>

             <div class="d-flex align-items-center mt-3 mt-lg-0 ms-lg-3">
                  <a href="{{ route('home') }}#contact" class="btn btn-tech btn-sm px-4 py-2 me-3 me-lg-0">Get
                      Quote</a>
                  <button id="themeToggleDesktop"
                      class="d-none d-lg-flex ms-3 btn btn-outline-secondary btn-sm border-0">
                      <i class="fa-solid fa-moon"></i>
                  </button>
              </div>
          </div>

      </div>
  </nav>
