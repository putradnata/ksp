<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('images/Logo-Koperasi-1.png') }}" alt="logo ksp"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">KSP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('template/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            @if(Auth::user()->jabatan == 'K')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                </ul>
            @elseif(Auth::user()->jabatan == 'A')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('staff.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>Admin</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('anggota.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Anggota</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('akun.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Akun</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('simpanan.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Simpanan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('simpananPokok.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Simpanan Pokok</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('simpananWajib.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Simpanan Wajib</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pinjaman.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Pinjaman</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('angsuran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Angsuran</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('penarikan.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Penarikan</p>
                        </a>
                    </li>
                </ul>
            @endif
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
