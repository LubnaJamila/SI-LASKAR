<nav class="navbar">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <!-- HAMBURGER SIDEBAR -->
        <button class="hamburger-btn" id="menu-toggle">
            <i class="bi bi-list-nested"></i>
        </button>

        <!-- TITLE -->
        <span class="title">@yield('title')</span>

        <!-- USER DROPDOWN (TIDAK AKAN HILANG DI HP) -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-dropdown">
                <a class="nav-link dropdown-toggle fw-semibold"
                   style="color: var(--heading-color)"
                   href="#"
                   role="button"
                   data-bs-toggle="dropdown">
                    Selamat Datang Admin
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person me-2"></i>Profil
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
