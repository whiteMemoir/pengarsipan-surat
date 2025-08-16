<!--**********************************
            Sidebar start
        ***********************************-->
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">MENU UTAMA</li>
            <li>
                <a href="{{ url('/') }}" aria-expanded="false">
                    <i class="fa fa-dashboard menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->level_user == 'super_admin')
                <li>
                    <a href="{{ url('users') }}" aria-expanded="false">
                        <i class="fa fa-user menu-icon"></i><span class="nav-text">Users</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ url('/surat-masuk') }}" aria-expanded="false">
                    <i class="fa fa-envelope-open menu-icon"></i><span class="nav-text">Surat Masuk</span>
                </a>
            </li>
            <li>
                <a href="{{ url('surat-keluar') }}" aria-expanded="false">
                    <i class="fa fa-envelope menu-icon"></i><span class="nav-text">Surat Keluar</span>
                </a>
            </li>

            <li>
                <a href="{{ url('laporan') }}" aria-expanded="false">
                    <i class="fa fa-file menu-icon"></i><span class="nav-text">Laporan</span>
                </a>
            </li>

            {{-- divider --}}
            <div class="divider border mt-2"></div>

            {{-- logout --}}
            <li>
                <a href="javascript:void()" onclick="logout()" aria-expanded="false">
                    <i class="fa fa-sign-out menu-icon text-danger"></i><span class="nav-text text-danger">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>


<form action="{{ url('/logout') }}" method="POST" id="logout-form">
    @csrf
</form>

<!--**********************************
    Sidebar end
***********************************-->
