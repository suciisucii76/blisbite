<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php($brandName = config('app.name', 'Warung Bu Engkar'))
    @php($brandLogo = file_exists(public_path('img/logo.png')) ? asset('img/logo.png') : asset('img/favicon.png'))

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $brandName }}">
    <meta name="author" content="{{ $brandName }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $brandName }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ $brandLogo }}" rel="icon" type="image/png">

    <style>
        :root {
            --warung-saffron: #d97706;
            --warung-saffron-dark: #b45309;
            --warung-terracotta: #c2410c;
            --warung-cream: #fef3c7;
            --warung-cream-soft: #fffbeb;
            --warung-brown: #78350f;
            --warung-brown-dark: #422006;
            --warung-leaf: #65a30d;
        }

        body { font-family: 'Nunito', sans-serif; background: #fdf8ee; color: #422006; }
        .headline-serif { font-family: 'Playfair Display', Georgia, serif; letter-spacing: -.5px; }

        /* Sidebar warung theme */
        .sidebar.bg-gradient-primary {
            background: linear-gradient(180deg, #78350f 0%, #92400e 50%, #b45309 100%) !important;
            box-shadow: .15rem 0 1.5rem rgba(120, 53, 15, .15);
        }
        .sidebar .sidebar-brand {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 251, 235, .12);
        }
        .sidebar .sidebar-brand-icon {
            background: #fff;
            width: 46px; height: 46px;
            border-radius: 14px;
            padding: 6px;
            display: inline-flex; align-items: center; justify-content: center;
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
        }
        .sidebar .sidebar-brand-icon img { width: 100%; height: 100%; object-fit: contain; }
        .sidebar .sidebar-brand-text {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            text-transform: none;
            font-size: 1.05rem;
            letter-spacing: 0;
            color: #fff7ed;
        }
        .sidebar-dark .nav-item .nav-link {
            color: rgba(255, 247, 237, .82);
            font-weight: 600;
            padding: .85rem 1rem;
            margin: .15rem .65rem;
            border-radius: 12px;
            transition: background .15s ease, color .15s ease;
        }
        .sidebar-dark .nav-item .nav-link i {
            color: rgba(255, 247, 237, .65);
        }
        .sidebar-dark .nav-item .nav-link:hover,
        .sidebar-dark .nav-item .nav-link:focus {
            background: rgba(255, 247, 237, .12);
            color: #fff;
        }
        .sidebar-dark .nav-item .nav-link:hover i { color: #fef3c7; }
        .sidebar-dark .nav-item.active .nav-link,
        .sidebar-dark .nav-item .nav-link.active {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #fff;
            box-shadow: 0 .4rem 1rem rgba(0,0,0,.18);
        }
        .sidebar-dark .nav-item.active .nav-link i,
        .sidebar-dark .nav-item .nav-link.active i { color: #fff; }
        .sidebar-dark .sidebar-divider { border-top: 1px solid rgba(255, 247, 237, .14); }
        .sidebar-dark .sidebar-heading {
            color: rgba(255, 247, 237, .55);
            font-weight: 700;
            letter-spacing: .12em;
        }
        .sidebar-dark #sidebarToggle {
            background: rgba(255, 247, 237, .15);
        }
        .sidebar-dark #sidebarToggle:hover { background: rgba(255, 247, 237, .28); }

        /* Topbar */
        .topbar {
            background: #fff !important;
            border-bottom: 1px solid rgba(120, 53, 15, .08);
            box-shadow: 0 .25rem 1rem rgba(120, 53, 15, .06) !important;
            border-radius: 0 0 18px 18px;
        }
        .topbar .navbar-search .form-control {
            border-radius: 999px !important;
            background: var(--warung-cream-soft) !important;
            border: 1px solid #f3d4a4 !important;
            padding-left: 1rem;
        }
        .topbar .navbar-search .btn-primary {
            background: var(--warung-saffron);
            border-color: var(--warung-saffron);
            border-radius: 999px !important;
            margin-left: .5rem;
        }
        .topbar .navbar-search .btn-primary:hover {
            background: var(--warung-saffron-dark);
            border-color: var(--warung-saffron-dark);
        }
        .topbar .nav-link { color: var(--warung-brown) !important; }
        .topbar .nav-link i { color: var(--warung-saffron-dark); }
        .topbar .badge-counter {
            background: var(--warung-terracotta) !important;
            border: 2px solid #fff;
        }
        .topbar .img-profile.avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--warung-saffron), var(--warung-terracotta));
            color: #fff;
            display: inline-flex; align-items: center; justify-content: center;
            text-transform: uppercase;
            border: 2px solid #fff;
            box-shadow: 0 .25rem .65rem rgba(120, 53, 15, .25);
        }
        .topbar .img-profile.avatar::before { content: attr(data-initial); }

        /* Buttons & utility overrides */
        .btn-primary {
            background: var(--warung-saffron);
            border-color: var(--warung-saffron);
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background: var(--warung-saffron-dark) !important;
            border-color: var(--warung-saffron-dark) !important;
        }
        .btn-outline-primary {
            color: var(--warung-saffron-dark);
            border-color: var(--warung-saffron);
        }
        .btn-outline-primary:hover {
            background: var(--warung-saffron);
            border-color: var(--warung-saffron);
            color: #fff;
        }
        .btn-link, a.text-primary { color: var(--warung-saffron-dark) !important; }
        .text-primary { color: var(--warung-saffron-dark) !important; }
        .bg-primary, .bg-gradient-primary:not(.sidebar) {
            background: linear-gradient(135deg, var(--warung-saffron), var(--warung-terracotta)) !important;
        }

        .border-left-primary { border-left-color: var(--warung-saffron) !important; }
        .border-left-success { border-left-color: var(--warung-leaf) !important; }
        .border-left-info    { border-left-color: #0891b2 !important; }
        .border-left-warning { border-left-color: #f59e0b !important; }
        .border-left-danger  { border-left-color: #dc2626 !important; }

        .card {
            border: 1px solid rgba(120, 53, 15, .08);
            border-radius: 16px;
        }
        .card .card-header {
            background: #fff;
            border-bottom: 1px solid rgba(120, 53, 15, .08);
            border-radius: 16px 16px 0 0 !important;
        }
        .card .card-header h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--warung-brown);
        }

        .h1, .h2, .h3, h1, h2, h3 { color: var(--warung-brown); }
        .text-gray-800 { color: var(--warung-brown-dark) !important; }

        .sticky-footer {
            background: #fff !important;
            border-top: 1px solid rgba(120, 53, 15, .08);
            color: #92400e;
        }
        .sticky-footer .copyright { color: #92400e; font-weight: 600; }

        .scroll-to-top {
            background: var(--warung-saffron) !important;
        }
        .scroll-to-top:hover { background: var(--warung-saffron-dark) !important; }

        /* Dropdown menus */
        .dropdown-menu { border: 1px solid rgba(120, 53, 15, .1); border-radius: 14px; box-shadow: 0 1rem 2rem rgba(120, 53, 15, .12); }
        .dropdown-item:hover, .dropdown-item:focus { background: var(--warung-cream-soft); color: var(--warung-brown); }
        .dropdown-header {
            background: var(--warung-cream-soft) !important;
            color: var(--warung-brown) !important;
            font-weight: 700 !important;
            border-radius: 14px 14px 0 0;
        }
        .icon-circle.bg-warning { background: linear-gradient(135deg, #f59e0b, #d97706) !important; }
        .icon-circle.bg-success { background: linear-gradient(135deg, #84cc16, #65a30d) !important; }
        .icon-circle.bg-primary { background: linear-gradient(135deg, var(--warung-saffron), var(--warung-terracotta)) !important; }

        /* Tables */
        .table thead th {
            border-top: 0;
            border-bottom: 2px solid #f3d4a4;
            color: var(--warung-brown);
            font-weight: 800;
            text-transform: uppercase;
            font-size: .76rem;
            letter-spacing: .06em;
        }
        .table tbody tr { transition: background .12s ease; }
        .table-borderless tbody tr:hover { background: var(--warung-cream-soft); }

        /* Badges */
        .badge { font-weight: 700; padding: .4em .65em; border-radius: 8px; }
        .badge-success { background: #65a30d; }
        .badge-warning { background: #f59e0b; color: #fff; }
        .badge-danger  { background: #dc2626; }

        /* Alerts */
        .alert { border-radius: 14px; border: 1px solid transparent; }
        .alert-warning { background: var(--warung-cream); border-color: #fcd34d; color: var(--warung-brown); }
        .alert-success { background: #ecfdf5; border-color: #a7f3d0; color: #065f46; }
        .alert-danger  { background: #fef2f2; border-color: #fecaca; color: #991b1b; }
        .alert-info    { background: #ecfeff; border-color: #a5f3fc; color: #155e75; }

        /* Feature search dropdown */
        .feature-search-dropdown { border: 1px solid rgba(120, 53, 15, .1); border-radius: 14px; }

        /* Modals */
        .modal-content { border-radius: 18px; border: 1px solid rgba(120, 53, 15, .1); }
        .modal-header { border-bottom: 1px solid rgba(120, 53, 15, .08); }
        .modal-footer { border-top: 1px solid rgba(120, 53, 15, .08); }
        .modal-title { font-family: 'Playfair Display', serif; color: var(--warung-brown); font-weight: 700; }
    </style>

    @stack('css')
</head>
<body id="page-top" data-role="{{ auth()->user()->role ?? '' }}">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
            <div class="sidebar-brand-icon">
                <img src="{{ $brandLogo }}" alt="{{ $brandName }}" style="width: 34px; height: 34px; object-fit: contain;">
            </div>
            <div class="sidebar-brand-text mx-3">{{ $brandName }}</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('Dashboard') }}</span></a>
        </li>

        @if (auth()->user() && auth()->user()->role === 'admin')
            <li class="nav-item {{ Nav::isRoute('produk.index') }}">
                <a class="nav-link" href="{{ route('produk.index') }}">
                    <i class="fas fa-fw fa-box"></i>
                    <span>{{ __('Produk') }}</span>
                </a>
            </li>
        @endif

        <li class="nav-item {{ Nav::isRoute('transaksi.index') }}">
            <a class="nav-link" href="{{ route('transaksi.index') }}">
                <i class="fas fa-fw fa-receipt"></i>
                <span>{{ __('Transaksi') }}</span>
            </a>
        </li>

        <li class="nav-item {{ Nav::isRoute('stok.index') }}">
            <a class="nav-link" href="{{ route('stok.index') }}">
                <i class="fas fa-fw fa-warehouse"></i>
                <span>{{ __('Stok Bahan') }}</span>
            </a>
        </li>

        <li class="nav-item {{ Nav::isRoute('laporan.index') }}">
            <a class="nav-link" href="{{ route('laporan.index') }}">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>{{ __('Laporan') }}</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Settings') }}
        </div>

        <!-- Nav Item -->
        <li class="nav-item {{ Nav::isRoute('basic.index') }}">
            <a class="nav-link" href="{{ route('basic.index') }}">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>{{ __('User Management') }}</span>
            </a>
        </li>

        <!-- Nav Item - Profile -->
        <li class="nav-item {{ Nav::isRoute('profile') }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Profile') }}</span>
            </a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search js-feature-search">
                    <div class="input-group position-relative">
                        <input type="text" class="form-control bg-light border-0 small js-feature-search-input" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                        <div class="feature-search-dropdown d-none"></div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search js-feature-search">
                                <div class="input-group position-relative">
                                    <input type="text" class="form-control bg-light border-0 small js-feature-search-input" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                    <div class="feature-search-dropdown d-none"></div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            @if (!empty($alertCount) && $alertCount > 0)
                                <span class="badge badge-danger badge-counter">{{ $alertCount }}</span>
                            @endif
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            @forelse ($alerts ?? [] as $alert)
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('stok.index') }}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{ $alert->tgl_kirim ? $alert->tgl_kirim->format('d M Y') : '-' }}</div>
                                        <span class="font-weight-bold">{{ $alert->pesan }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="dropdown-item text-center small text-gray-500">Tidak ada notifikasi</div>
                            @endforelse
                            <a class="dropdown-item text-center small text-gray-500" href="{{ route('stok.index') }}">Lihat Stok</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Settings') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Activity Log') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @stack('notif')
                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>&copy; {{ now()->year }} {{ $brandName }} — Masakan rumahan, rasa keluarga.</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-door-open mr-2" style="color: var(--warung-saffron-dark);"></i> Keluar dari Warung?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Yakin ingin keluar dari sesi saat ini? Pilih "Logout" untuk mengakhiri sesi.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt mr-1"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<div id="search-routes"
    data-dashboard="{{ route('dashboard') }}"
    data-produk="{{ route('produk.index') }}"
    data-transaksi="{{ route('transaksi.index') }}"
    data-transaksi-create="{{ route('transaksi.create') }}"
    data-stok="{{ route('stok.index') }}"
    data-stok-create="{{ route('stok.create') }}"
    data-laporan="{{ route('laporan.index') }}"
    data-profile="{{ route('profile') }}"
    data-basic="{{ route('basic.index') }}"
    data-about="{{ route('about') }}"
    data-blank="{{ route('blank') }}">
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script>
    (function () {
        const routesEl = document.getElementById('search-routes');
        if (!routesEl) return;

        const routes = routesEl.dataset;
        const role = document.body.dataset.role || '';

        const features = [
            { label: 'Dashboard', keywords: ['dashboard', 'home', 'beranda'], route: routes.dashboard },
            { label: 'Produk', keywords: ['produk', 'barang', 'menu'], route: routes.produk, adminOnly: true },
            { label: 'Transaksi', keywords: ['transaksi', 'riwayat transaksi'], route: routes.transaksi },
            { label: 'Tambah Transaksi', keywords: ['tambah transaksi', 'buat transaksi', 'input transaksi'], route: routes.transaksiCreate, adminOnly: true },
            { label: 'Stok Bahan', keywords: ['stok', 'stok bahan', 'bahan'], route: routes.stok },
            { label: 'Tambah Stok', keywords: ['tambah stok', 'restock', 'isi ulang stok'], route: routes.stokCreate, adminOnly: true },
            { label: 'Laporan', keywords: ['laporan', 'keuangan', 'report'], route: routes.laporan },
            { label: 'Profil', keywords: ['profile', 'profil'], route: routes.profile },
            { label: 'User Management', keywords: ['user management', 'user', 'users', 'pengguna', 'basic'], route: routes.basic, adminOnly: true }
        ];

        function findRoute(query) {
            const lowered = query.toLowerCase();
            return features.find(item => item.keywords.some(keyword => lowered.includes(keyword)) && item.route);
        }

        function getMatches(query) {
            const lowered = query.toLowerCase();
            return features.filter(item => item.keywords.some(keyword => keyword.includes(lowered)) || item.label.toLowerCase().includes(lowered));
        }

        function renderDropdown(container, items) {
            if (!container) return;
            if (items.length === 0) {
                container.classList.add('d-none');
                container.innerHTML = '';
                return;
            }

            container.innerHTML = items.map(item => {
                const disabled = item.adminOnly && role !== 'admin';
                const badge = item.adminOnly ? '<span class="badge badge-light ml-2">Admin</span>' : '';
                return `
                    <button type="button" class="dropdown-item d-flex justify-content-between align-items-center" ${disabled ? 'disabled' : ''} data-route="${item.route}">
                        <span>${item.label}</span>
                        ${badge}
                    </button>
                `;
            }).join('');

            container.classList.remove('d-none');
        }

        document.querySelectorAll('.js-feature-search').forEach(form => {
            const input = form.querySelector('.js-feature-search-input');
            const dropdown = form.querySelector('.feature-search-dropdown');

            if (input && dropdown) {
                input.addEventListener('input', function () {
                    const query = this.value.trim();
                    if (query.length < 1) {
                        dropdown.classList.add('d-none');
                        dropdown.innerHTML = '';
                        return;
                    }
                    renderDropdown(dropdown, getMatches(query));
                });

                input.addEventListener('blur', function () {
                    setTimeout(() => {
                        dropdown.classList.add('d-none');
                    }, 150);
                });

                dropdown.addEventListener('click', function (event) {
                    const target = event.target.closest('[data-route]');
                    if (!target || target.hasAttribute('disabled')) return;
                    window.location.href = target.dataset.route;
                });
            }

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const query = (input && input.value ? input.value.trim() : '');
                if (!query) return;

                const match = findRoute(query);
                if (!match) {
                    alert('Fitur tidak ditemukan. Coba kata kunci seperti: dashboard, transaksi, stok, laporan.');
                    return;
                }

                if (match.adminOnly && role !== 'admin') {
                    alert('Fitur ini hanya tersedia untuk admin.');
                    return;
                }

                window.location.href = match.route;
            });
        });
    })();
</script>
<style>
    .feature-search-dropdown {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: .35rem;
        box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15);
        max-height: 220px;
        overflow-y: auto;
        z-index: 1050;
        padding: .25rem 0;
    }

    .feature-search-dropdown .dropdown-item {
        font-size: .85rem;
    }
</style>
@stack('js')
</body>
</html>
