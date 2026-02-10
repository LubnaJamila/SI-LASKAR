<div id="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('assets/img/logo-si_laskar.png') }}" alt="Logo">
        <h5>SI-LASKAR</h5>
    </div>
    <ul class="nav flex-column">

        {{-- MENU ADMIN --}}
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> <span>Dashboard</span>
            </a>
        </li>
        @php
            $isDataMasterActive = Request::is('hotspot*') || Request::is('petugas*') || Request::is('team*');
        @endphp

        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ $isDataMasterActive ? 'active' : '' }}"
                data-bs-toggle="collapse" href="#menuMaster" role="button"
                aria-expanded="{{ $isDataMasterActive ? 'true' : 'false' }}" aria-controls="menuMaster">
                <i class="bi bi-folder"></i><span>Data Master</span>
                <i class="bi bi-chevron-down chevron"></i>
            </a>

            <div class="collapse {{ $isDataMasterActive ? 'show' : '' }}" id="menuMaster">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('hotspot') }}" class="nav-link {{ Request::is('hotspot*') ? 'active' : '' }}">
                            <i class="bi bi-wifi menu-icon"></i><span class="menu-text">Hotspot</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('petugas') }}" class="nav-link {{ Request::is('petugas*') ? 'active' : '' }}">
                            <i class="bi bi-person"></i><span class="menu-text">Petugas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('team') }}" class="nav-link {{ Request::is('team*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i><span class="menu-text">Team</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('periode_kunjungan') }}"
                class="nav-link {{ Request::is('periode_kunjungan*') ? 'active' : '' }}">
                <i class="bi bi-calendar2-week"></i> <span>Periode Kunjungan</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('rencana_tim') }}" class="nav-link {{ Request::is('rencana_tim*') ? 'active' : '' }}">
                <i class="bi bi-kanban"></i> <span>Rencana Tim</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('hasil_kunjungan') }}"
                class="nav-link {{ Request::is('hasil_kunjungan*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-check"></i> <span>Hasil Kunjungan </span>
            </a>
        </li>

        @php
            $isClusteringActive = Request::is('wps*') || Request::is('lsl*');
        @endphp

        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ $isClusteringActive ? 'active' : '' }}"
                data-bs-toggle="collapse" href="#Clustering" role="button"
                aria-expanded="{{ $isClusteringActive ? 'true' : 'false' }}" aria-controls="Clustering">
                <i class="bi bi-globe-americas"></i><span>Clustering</span>
                <i class="bi bi-chevron-down chevron"></i>
            </a>

            <div class="collapse {{ $isClusteringActive ? 'show' : '' }}" id="Clustering">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('wps') }}" class="nav-link {{ Request::is('wps*') ? 'active' : '' }}">
                            <i class="bi bi-gender-female"></i><span class="menu-text">WPS</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('lsl') }}" class="nav-link {{ Request::is('lsl*') ? 'active' : '' }}">
                            <i class="bi bi-gender-male"></i><span class="menu-text">LSL</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>


        {{-- MENU PETUGAS --}}
        <li class="nav-item">
            <a href="{{ route('dashboard_petugas') }}"
                class="nav-link {{ Request::is('dashboard_petugas') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> <span>Dashboard</span>
            </a>
        </li>
    </ul>

</div>
<div class="mobile-overlay"></div>
