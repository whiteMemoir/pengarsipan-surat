<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <img src="{{ asset('logo-black.png') }}" alt="{{ config('app.name') }}" width="35">
            <span class="app-brand-text demo text-black fw-bolder ms-2">{{ config('app.name') }}</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        {{-- Dashboard --}}
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu Utama</span>
        </li>
        {{-- Surat Masuk --}}
        <li class="menu-item {{ request()->routeIs('surat-masuk.*') ? 'active open' : '' }}">
            <a href="{{ route('surat-masuk.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope-in"></i>
                <div>Surat Masuk</div>
            </a>
        </li>
        {{-- Surat Keluar --}}
        <li class="menu-item {{ request()->routeIs('surat-keluar.*') ? 'active open' : '' }}">
            <a href="{{ route('surat-keluar.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div>Surat Keluar</div>
            </a>
        </li>
        {{-- Disposisi --}}
        <li class="menu-item {{ request()->routeIs('disposisi.*') ? 'active open' : '' }}">
            <a href="{{ route('disposisi.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-transfer"></i>
                <div>Disposisi</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu Lain</span>
        </li>
        {{-- Gallery --}}
        {{-- <li class="menu-item {{ request()->routeIs('gallery.*') ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-images"></i>
                <div>Gallery</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('gallery.incoming') ? 'active' : '' }}">
                    <a href="{{ route('gallery.incoming') }}" class="menu-link">
                        <div>Gallery Surat Masuk</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('gallery.outgoing') ? 'active' : '' }}">
                    <a href="{{ route('gallery.outgoing') }}" class="menu-link">
                        <div>Gallery Surat Keluar</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        {{-- Role-based (admin/super_admin only) --}}
        @if(Auth::user() && (Auth::user()->level_user == 'admin' || Auth::user()->level_user == 'super_admin'))
            {{-- Pengguna --}}
            <li class="menu-item {{ request()->routeIs('users.*') ? 'active open' : '' }}">
                <a href="{{ route('users.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-pin"></i>
                    <div>Pengguna</div>
                </a>
            </li>
            {{-- Referensi --}}
            {{-- <li class="menu-item {{ request()->routeIs('reference.*') ? 'active open' : '' }}">
                <a href="#" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-analyse"></i>
                    <div>Referensi</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('reference.classification') ? 'active' : '' }}">
                        <a href="{{ route('reference.classification') }}" class="menu-link">
                            <div>Klasifikasi</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('reference.status') ? 'active' : '' }}">
                        <a href="{{ route('reference.status') }}" class="menu-link">
                            <div>Status Surat</div>
                        </a>
                    </li>
                </ul>
            </li> --}}
        @endif
    </ul>
</aside>
