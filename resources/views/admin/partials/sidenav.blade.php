<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-microchip me-2" style="color: var(--primary-tech);"></i>GIZMO<span
                style="color: var(--primary-tech);">CMS</span></h5>
    </div>
    <ul class="sidebar-nav">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-message"></i> Contact Messages</a></li>
        <li><a href="{{ route('admin.sliders.index') }}"><i class="fa-solid fa-images"></i> Hero Slider</a></li>

        <!-- Products Dropdown -->
        <li>
            <a href="#productsSubmenu" data-bs-toggle="collapse" aria-expanded="false"
                class="d-flex align-items-center justify-content-between dropdown-toggle-custom">
                <span><i class="fa-solid fa-boxes-stacked"></i> Products Catalog</span>
                <i class="fa-solid fa-chevron-down toggle-icon" style="width: auto; font-size: 0.8em;"></i>
            </a>
            <ul class="collapse list-unstyled submenu-list" id="productsSubmenu">
                <li><a href="{{ route('admin.products.index') }}"><i class="fa-solid fa-list-ul"></i> Product List</a>
                </li>
                <li><a href="{{ route('admin.categories.index') }}"><i class="fa-solid fa-tags"></i> Categories</a></li>
                <li><a href="{{ route('admin.subcategories.index') }}"><i class="fa-solid fa-tag"></i> Subcategories</a>
                </li>
            </ul>
        </li>

        <!-- Page Sections Dropdown -->
        <li>
            <a href="#sectionsSubmenu" data-bs-toggle="collapse" aria-expanded="false"
                class="d-flex align-items-center justify-content-between dropdown-toggle-custom">
                <span><i class="fa-solid fa-layer-group"></i> Page Sections</span>
                <i class="fa-solid fa-chevron-down toggle-icon" style="width: auto; font-size: 0.8em;"></i>
            </a>
            <ul class="collapse list-unstyled submenu-list" id="sectionsSubmenu">
                <li><a href="{{ route('admin.who-we-are.index') }}"><i class="fa-solid fa-users-gear"></i> Who We
                        Are</a></li>
                <li><a href="{{ route('admin.about-us.index') }}"><i class="fa-solid fa-circle-info"></i> About Us</a>
                </li>
                <li><a href="{{ route('admin.client-reviews.index') }}"><i class="fa-solid fa-star"></i> Client
                        Reviews</a></li>
            </ul>
        </li>

        <!-- Administration Dropdown -->
        <li>
            <a href="#adminSubmenu" data-bs-toggle="collapse" aria-expanded="false"
                class="d-flex align-items-center justify-content-between dropdown-toggle-custom">
                <span><i class="fa-solid fa-shield-halved"></i> Administration</span>
                <i class="fa-solid fa-chevron-down toggle-icon" style="width: auto; font-size: 0.8em;"></i>
            </a>
            <ul class="collapse list-unstyled submenu-list" id="adminSubmenu">
                <li><a href="{{ route('admin.users.index') }}"><i class="fa-solid fa-users"></i> Users</a></li>
                {{-- <li><a href="#"><i class="fa-solid fa-user-tag"></i> Roles</a></li> --}}
            </ul>
        </li>

        <li><a href="{{ route('admin.settings.index') }}"><i class="fa-solid fa-gears"></i> System Settings</a></li>

        <li class="mt-4">
            <a href="#" class="text-danger text-decoration-none"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-power-off text-danger me-2"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
