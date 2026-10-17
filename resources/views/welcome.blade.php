<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php($brandName = 'Warung Bu Engkar')
    @php($brandLogo = file_exists(public_path('img/logo.png')) ? asset('img/logo.png') : asset('img/favicon.png'))

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Landing page - {{ $brandName }}">

    <title>{{ $brandName }} — Masakan Rumahan, Rasa Keluarga</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ $brandLogo }}" rel="icon" type="image/png">

    <style>
        :root {
            --warung-saffron: #d97706;
            --warung-saffron-dark: #b45309;
            --warung-terracotta: #c2410c;
            --warung-cream: #fef3c7;
            --warung-cream-soft: #fffbeb;
            --warung-brown: #78350f;
            --warung-leaf: #65a30d;
        }

        body {
            padding-top: 78px;
            font-family: 'Nunito', sans-serif;
            background: var(--warung-cream-soft);
            color: #422006;
        }

        .display-serif, .headline-serif {
            font-family: 'Playfair Display', Georgia, serif;
            letter-spacing: -0.5px;
        }

        /* Navbar */
        #mainNav {
            background: rgba(255, 251, 235, 0.92) !important;
            backdrop-filter: saturate(180%) blur(12px);
            transition: box-shadow .2s ease, background .2s ease;
            border-bottom: 1px solid rgba(217, 119, 6, 0.08);
        }
        #mainNav .navbar-brand { color: var(--warung-brown) !important; }
        #mainNav .nav-link { color: var(--warung-brown) !important; font-weight: 600; }
        #mainNav .nav-link:hover { color: var(--warung-saffron) !important; }
        #mainNav.navbar-scrolled { box-shadow: 0 .35rem 1.5rem rgba(120, 53, 15, .12) !important; }

        .btn-warung {
            background: var(--warung-saffron);
            border-color: var(--warung-saffron);
            color: #fff;
            font-weight: 700;
        }
        .btn-warung:hover { background: var(--warung-saffron-dark); border-color: var(--warung-saffron-dark); color: #fff; }
        .btn-outline-warung {
            color: var(--warung-saffron);
            border-color: var(--warung-saffron);
            background: transparent;
            font-weight: 700;
        }
        .btn-outline-warung:hover { background: var(--warung-saffron); color: #fff; }

        /* Hero */
        .hero {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 12% 18%, rgba(254, 215, 170, .55) 0, transparent 38%),
                radial-gradient(circle at 88% 86%, rgba(254, 240, 138, .45) 0, transparent 42%),
                linear-gradient(135deg, #fff7ed 0%, #fed7aa 50%, #fdba74 100%);
            border-bottom: 4px solid var(--warung-saffron);
        }

        /* Subtle batik-inspired dot pattern */
        .hero::before {
            content: "";
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(120, 53, 15, .08) 1.2px, transparent 1.2px);
            background-size: 22px 22px;
            pointer-events: none;
            opacity: .55;
        }

        .hero-eyebrow {
            display: inline-flex; align-items: center;
            background: rgba(255,255,255,.7);
            color: var(--warung-brown);
            border: 1px solid rgba(120, 53, 15, .15);
            padding: .35rem .75rem;
            border-radius: 999px;
            font-size: .8rem; font-weight: 700;
            letter-spacing: .04em;
        }

        .hero-logo-wrap {
            width: 96px; height: 96px;
            border-radius: 28px;
            background: #fff;
            box-shadow: 0 1.2rem 2.5rem rgba(120, 53, 15, .18);
            display: inline-flex; align-items: center; justify-content: center;
            padding: 12px;
            border: 3px solid #fff;
        }
        .hero-logo-wrap img { width: 100%; height: 100%; object-fit: contain; }

        .h-brand {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 800;
            color: var(--warung-brown);
            line-height: 1.05;
        }
        .h-brand .accent { color: var(--warung-saffron-dark); }

        .pill-stat {
            display: inline-flex; align-items: center;
            background: #fff;
            padding: .55rem .9rem;
            border-radius: 999px;
            box-shadow: 0 .35rem .9rem rgba(120, 53, 15, .12);
            font-weight: 700;
            color: var(--warung-brown);
            font-size: .85rem;
        }
        .pill-stat .dot {
            width: 8px; height: 8px; border-radius: 50%; margin-right: .5rem; background: var(--warung-leaf);
            box-shadow: 0 0 0 4px rgba(101, 163, 13, .15);
        }

        .hero-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 2rem 4rem rgba(120, 53, 15, .18);
            border: 1px solid rgba(120, 53, 15, .08);
            overflow: hidden;
        }
        .hero-card-header {
            background: linear-gradient(135deg, var(--warung-saffron) 0%, var(--warung-terracotta) 100%);
            color: #fff;
            padding: 1rem 1.25rem;
        }

        .stat-tile {
            background: var(--warung-cream-soft);
            border: 1px solid rgba(120, 53, 15, .08);
            border-radius: 14px;
            padding: .85rem .9rem;
        }
        .stat-tile .label {
            font-size: .68rem; font-weight: 800;
            text-transform: uppercase; letter-spacing: .06em;
            color: #92400e;
        }
        .stat-tile .value {
            font-family: 'Playfair Display', serif;
            font-weight: 800; font-size: 1.45rem;
            color: var(--warung-brown);
            line-height: 1.1; margin-top: .2rem;
        }
        .stat-tile.danger .value { color: #b91c1c; }

        /* Sections */
        .section-pad { padding: 5rem 0; }
        .section-title-eyebrow {
            color: var(--warung-saffron-dark);
            font-weight: 800; letter-spacing: .12em;
            text-transform: uppercase; font-size: .78rem;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            color: var(--warung-brown);
            font-weight: 800;
        }

        .feature-card {
            background: #fff;
            border-radius: 18px;
            border: 1px solid rgba(120, 53, 15, .08);
            box-shadow: 0 .5rem 1.5rem rgba(120, 53, 15, .06);
            transition: transform .18s ease, box-shadow .18s ease;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 1.25rem 2.5rem rgba(120, 53, 15, .14);
        }
        .feature-icon {
            width: 54px; height: 54px;
            border-radius: 16px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 1.35rem; color: #fff;
            box-shadow: 0 .5rem 1rem rgba(120, 53, 15, .18);
        }
        .bg-saffron { background: linear-gradient(135deg, #f59e0b, #d97706) !important; }
        .bg-tomato  { background: linear-gradient(135deg, #ef4444, #c2410c) !important; }
        .bg-leaf    { background: linear-gradient(135deg, #84cc16, #4d7c0f) !important; }
        .bg-cocoa   { background: linear-gradient(135deg, #a16207, #78350f) !important; }

        .strip-cream { background: linear-gradient(180deg, var(--warung-cream-soft) 0%, #fff 100%); }

        .step-card {
            background: #fff;
            border-radius: 18px;
            padding: 1.5rem;
            border-left: 5px solid var(--warung-saffron);
            box-shadow: 0 .5rem 1.5rem rgba(120, 53, 15, .06);
        }
        .step-num {
            display: inline-flex; align-items: center; justify-content: center;
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--warung-saffron); color: #fff;
            font-family: 'Playfair Display', serif; font-weight: 800;
            margin-right: .75rem;
        }

        .stat-mini-card {
            background: #fff;
            border-radius: 14px;
            padding: 1rem 1.1rem;
            border-left: 4px solid var(--warung-saffron);
            box-shadow: 0 .35rem 1rem rgba(120, 53, 15, .06);
        }
        .stat-mini-card.info  { border-left-color: #0891b2; }
        .stat-mini-card.leaf  { border-left-color: var(--warung-leaf); }
        .stat-mini-card.danger{ border-left-color: #dc2626; }

        .quote-banner {
            background: linear-gradient(135deg, var(--warung-saffron) 0%, var(--warung-terracotta) 100%);
            color: #fff;
            border-radius: 24px;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
        }
        .quote-banner::after {
            content: "\f805"; /* fa-utensils */
            font-family: "Font Awesome 5 Free"; font-weight: 900;
            position: absolute; right: -10px; bottom: -30px;
            font-size: 14rem; opacity: .08;
        }

        footer.foot {
            background: var(--warung-brown);
            color: #fde68a;
        }
        footer.foot a { color: #fef3c7; }
        footer.foot a:hover { color: #fff; text-decoration: underline; }

        @media (max-width: 767px) {
            .h-brand { font-size: 2.25rem; }
            .quote-banner { padding: 2rem 1.25rem; }
        }
    </style>
</head>

<body id="page-top">

<nav class="navbar navbar-expand-lg fixed-top py-2" id="mainNav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#top">
            <span class="d-inline-flex align-items-center justify-content-center mr-2"
                  style="width:42px;height:42px;border-radius:12px;background:#fff;box-shadow:0 .25rem .75rem rgba(120,53,15,.12);padding:6px;">
                <img src="{{ $brandLogo }}" alt="{{ $brandName }}" style="width:100%;height:100%;object-fit:contain;">
            </span>
            <span class="font-weight-bold headline-serif" style="font-size:1.15rem;">{{ $brandName }}</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                <li class="nav-item"><a class="nav-link" href="#cara">Cara Kerja</a></li>
                <li class="nav-item"><a class="nav-link" href="#statistik">Statistik</a></li>
            </ul>

            <div class="d-flex align-items-center mt-3 mt-lg-0 ml-lg-3">
                @auth
                    <a class="btn btn-warung btn-sm" href="{{ route('home') }}">
                        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                    </a>
                @else
                    @if (Route::has('login'))
                        <a class="btn btn-outline-warung btn-sm mr-2" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt mr-1"></i> Login
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a class="btn btn-warung btn-sm" href="{{ route('register') }}">
                            <i class="fas fa-user-plus mr-1"></i> Daftar
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>

<header class="hero" id="top">
    <div class="container py-5 position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <span class="hero-eyebrow mb-3">
                    <i class="fas fa-utensils mr-2" style="color: var(--warung-saffron-dark);"></i>
                    Masakan Rumahan • Sejak Dulu
                </span>

                <div class="d-flex align-items-center mb-3 mt-2">
                    <span class="hero-logo-wrap mr-3">
                        <img src="{{ $brandLogo }}" alt="{{ $brandName }}">
                    </span>
                    <div>
                        <div class="text-uppercase font-weight-bold" style="color: var(--warung-saffron-dark); letter-spacing: .15em; font-size:.75rem;">Selamat Datang di</div>
                        <h1 class="h-brand mb-0" style="font-size: clamp(2.2rem, 5vw, 3.4rem);">{{ $brandName }}</h1>
                    </div>
                </div>

                <p class="lead mb-4" style="color:#5b2c0a; max-width: 38rem;">
                    Sistem pengelolaan warung yang sederhana namun lengkap. Catat transaksi, jaga stok bahan, kelola produk, dan susun laporan—semua dalam satu tempat, secepat menyiapkan hidangan favorit pelanggan.
                </p>

                <div class="d-flex flex-wrap align-items-center" id="mulai">
                    @auth
                        <a href="{{ route('home') }}" class="btn btn-warung btn-lg mr-2 mb-2 px-4">
                            <i class="fas fa-arrow-right mr-2"></i> Masuk Dashboard
                        </a>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-warung btn-lg mr-2 mb-2 px-4">
                                <i class="fas fa-sign-in-alt mr-2"></i> Login
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-warung btn-lg mb-2 px-4">
                                <i class="fas fa-user-plus mr-2"></i> Buat Akun
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="d-flex flex-wrap mt-4" style="gap:.6rem;">
                    <span class="pill-stat"><span class="dot"></span> Online &amp; siap pakai</span>
                    <span class="pill-stat"><i class="fas fa-shield-alt mr-2" style="color: var(--warung-saffron-dark);"></i> Login aman</span>
                    <span class="pill-stat"><i class="fas fa-mobile-alt mr-2" style="color: var(--warung-saffron-dark);"></i> Responsif</span>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="hero-card">
                    <div class="hero-card-header d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-white-50 text-uppercase font-weight-bold" style="font-size:.7rem; letter-spacing:.1em;">Ringkasan Warung</div>
                            <div class="font-weight-bold headline-serif" style="font-size:1.25rem;">Bulan Ini</div>
                        </div>
                        <span style="font-size: 1.6rem;"><i class="fas fa-mug-hot"></i></span>
                    </div>
                    <div class="p-3">
                        <div class="row no-gutters" style="row-gap: .6rem;">
                            <div class="col-6 pr-2">
                                <div class="stat-tile">
                                    <div class="label"><i class="fas fa-receipt mr-1"></i> Transaksi</div>
                                    <div class="value" data-counter data-count="{{ (int)($stats['transaksi_bulan'] ?? 0) }}">0</div>
                                </div>
                            </div>
                            <div class="col-6 pl-2">
                                <div class="stat-tile">
                                    <div class="label"><i class="fas fa-coins mr-1"></i> Pendapatan</div>
                                    <div class="value">Rp <span data-counter data-count="{{ (int)($stats['pendapatan_bulan'] ?? 0) }}">0</span></div>
                                </div>
                            </div>
                            <div class="col-6 pr-2">
                                <div class="stat-tile">
                                    <div class="label"><i class="fas fa-bowl-rice mr-1"></i> Produk Aktif</div>
                                    <div class="value" data-counter data-count="{{ (int)($stats['produk_active'] ?? 0) }}">0</div>
                                </div>
                            </div>
                            <div class="col-6 pl-2">
                                <div class="stat-tile danger">
                                    <div class="label"><i class="fas fa-exclamation-triangle mr-1"></i> Stok Kritis</div>
                                    <div class="value" data-counter data-count="{{ (int)($stats['stok_kritis'] ?? 0) }}">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 text-center small" style="color:#92400e;">
                            <i class="fas fa-clock mr-1"></i> Diperbarui: {{ now()->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="section-pad" id="fitur">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <div class="section-title-eyebrow mb-2">Apa yang bisa dikelola?</div>
                <h2 class="section-title mb-3" style="font-size: clamp(1.8rem, 3.5vw, 2.4rem);">Semua kebutuhan warung, di ujung jari</h2>
                <p class="mb-0" style="color:#7c2d12;">Dari mencatat resep ibu hingga melihat untung tiap bulan—semua dirancang sederhana, supaya yang punya warung bisa lebih fokus ke pelanggan.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="feature-card p-4">
                    <span class="feature-icon bg-saffron mb-3"><i class="fas fa-bowl-rice"></i></span>
                    <h6 class="font-weight-bold headline-serif" style="color: var(--warung-brown);">Menu &amp; Produk</h6>
                    <p class="mb-0 small" style="color:#7c2d12;">Atur menu andalan, kategori, harga jual, dan status ketersediaan dengan mudah.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="feature-card p-4">
                    <span class="feature-icon bg-leaf mb-3"><i class="fas fa-warehouse"></i></span>
                    <h6 class="font-weight-bold headline-serif" style="color: var(--warung-brown);">Stok Bahan</h6>
                    <p class="mb-0 small" style="color:#7c2d12;">Pantau stok bumbu &amp; bahan baku, dapat peringatan saat stok menipis.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="feature-card p-4">
                    <span class="feature-icon bg-tomato mb-3"><i class="fas fa-receipt"></i></span>
                    <h6 class="font-weight-bold headline-serif" style="color: var(--warung-brown);">Transaksi Harian</h6>
                    <p class="mb-0 small" style="color:#7c2d12;">Catat pemasukan tiap pesanan dan pengeluaran belanja dengan rapi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="feature-card p-4">
                    <span class="feature-icon bg-cocoa mb-3"><i class="fas fa-chart-line"></i></span>
                    <h6 class="font-weight-bold headline-serif" style="color: var(--warung-brown);">Laporan</h6>
                    <p class="mb-0 small" style="color:#7c2d12;">Lihat ringkasan bulanan dan ekspor Excel/PDF untuk evaluasi cepat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-pad strip-cream" id="cara">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <div class="section-title-eyebrow mb-2">Cara Memulai</div>
                <h2 class="section-title mb-3" style="font-size: clamp(1.8rem, 3.5vw, 2.4rem);">Tiga langkah, langsung jalan</h2>
                <p class="mb-0" style="color:#7c2d12;">Tidak perlu pelatihan panjang. Ikuti tiga langkah sederhana, warung sudah bisa dikelola digital.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="step-card h-100">
                    <div class="d-flex align-items-center mb-2">
                        <span class="step-num">1</span>
                        <div class="headline-serif font-weight-bold" style="color: var(--warung-brown); font-size:1.15rem;">Buat Akun</div>
                    </div>
                    <p class="mb-0 small" style="color:#7c2d12;">Daftarkan diri sebagai admin atau pemilik. Login aman menggunakan Fortify.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="step-card h-100">
                    <div class="d-flex align-items-center mb-2">
                        <span class="step-num">2</span>
                        <div class="headline-serif font-weight-bold" style="color: var(--warung-brown); font-size:1.15rem;">Isi Menu &amp; Bahan</div>
                    </div>
                    <p class="mb-0 small" style="color:#7c2d12;">Masukkan daftar menu warung dan bahan-bahan dapur sebagai data dasar.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="step-card h-100">
                    <div class="d-flex align-items-center mb-2">
                        <span class="step-num">3</span>
                        <div class="headline-serif font-weight-bold" style="color: var(--warung-brown); font-size:1.15rem;">Catat &amp; Pantau</div>
                    </div>
                    <p class="mb-0 small" style="color:#7c2d12;">Catat tiap transaksi dan lihat performa warung lewat laporan harian/bulanan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-pad" id="statistik">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="section-title-eyebrow mb-2">Sekilas Warung</div>
                <h2 class="section-title mb-3" style="font-size: clamp(1.8rem, 3.5vw, 2.4rem);">Angka jujur, langsung dari data</h2>
                <p class="mb-4" style="color:#7c2d12;">Tidak ada angka karangan. Semua statistik di bawah ini diambil langsung dari isi aplikasi—biar yang punya warung selalu tahu kondisi sebenarnya.</p>

                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <div class="stat-mini-card">
                            <div class="text-xs font-weight-bold text-uppercase" style="color: var(--warung-saffron-dark);"><i class="fas fa-bowl-rice mr-1"></i> Produk Aktif</div>
                            <div class="h4 mb-0 headline-serif font-weight-bold" style="color: var(--warung-brown);" data-counter data-count="{{ (int)($stats['produk_active'] ?? 0) }}">0</div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="stat-mini-card info">
                            <div class="text-xs font-weight-bold text-uppercase" style="color:#0e7490;"><i class="fas fa-boxes mr-1"></i> Item Stok</div>
                            <div class="h4 mb-0 headline-serif font-weight-bold" style="color: var(--warung-brown);" data-counter data-count="{{ (int)($stats['stok_items'] ?? 0) }}">0</div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="stat-mini-card leaf">
                            <div class="text-xs font-weight-bold text-uppercase" style="color:#4d7c0f;"><i class="fas fa-receipt mr-1"></i> Transaksi Bulan Ini</div>
                            <div class="h4 mb-0 headline-serif font-weight-bold" style="color: var(--warung-brown);" data-counter data-count="{{ (int)($stats['transaksi_bulan'] ?? 0) }}">0</div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="stat-mini-card danger">
                            <div class="text-xs font-weight-bold text-uppercase" style="color:#b91c1c;"><i class="fas fa-exclamation-triangle mr-1"></i> Stok Kritis</div>
                            <div class="h4 mb-0 headline-serif font-weight-bold" style="color: var(--warung-brown);" data-counter data-count="{{ (int)($stats['stok_kritis'] ?? 0) }}">0</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="quote-banner">
                    <i class="fas fa-quote-left mb-3" style="font-size:1.6rem; opacity:.7;"></i>
                    <p class="headline-serif mb-3" style="font-size: clamp(1.3rem, 2.5vw, 1.7rem); line-height:1.35;">
                        "Warung yang baik bukan cuma soal masakan enak, tapi juga tahu pesanan, stok, dan untungnya tiap hari."
                    </p>
                    <div class="d-flex align-items-center">
                        <span class="d-inline-flex align-items-center justify-content-center mr-2" style="width:38px;height:38px;border-radius:50%;background:rgba(255,255,255,.2);">
                            <i class="fas fa-user"></i>
                        </span>
                        <div>
                            <div class="font-weight-bold">Bu Engkar</div>
                            <div class="small" style="opacity:.85;">Pemilik Warung</div>
                        </div>
                    </div>

                    <hr style="border-color: rgba(255,255,255,.25);">

                    @auth
                        <a href="{{ route('home') }}" class="btn btn-light btn-block font-weight-bold" style="color: var(--warung-saffron-dark);">
                            <i class="fas fa-tachometer-alt mr-2"></i> Buka Dashboard
                        </a>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-light btn-block font-weight-bold" style="color: var(--warung-saffron-dark);">
                                <i class="fas fa-sign-in-alt mr-2"></i> Login Sekarang
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="foot py-4">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="d-flex align-items-center mb-2 mb-md-0">
                <span class="d-inline-flex align-items-center justify-content-center mr-2"
                      style="width:34px;height:34px;border-radius:10px;background:#fff;padding:5px;">
                    <img src="{{ $brandLogo }}" alt="{{ $brandName }}" style="width:100%;height:100%;object-fit:contain;">
                </span>
                <div>
                    <div class="font-weight-bold headline-serif" style="color:#fff;">{{ $brandName }}</div>
                    <div class="small" style="opacity:.85;">&copy; {{ now()->year }} — Masakan rumahan, rasa keluarga.</div>
                </div>
            </div>
            <div class="small">
                @auth
                    <a href="{{ route('home') }}">Dashboard</a>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}">Login</a>
                    @endif
                    @if (Route::has('register'))
                        <span class="mx-2">•</span>
                        <a href="{{ route('register') }}">Daftar</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    (function () {
        function formatNumber(n) {
            try { return new Intl.NumberFormat('id-ID').format(n); }
            catch (e) { return String(n); }
        }

        function animateCounter(el, endValue, durationMs) {
            var start = 0;
            var startTime = null;
            var end = Math.max(0, Number(endValue) || 0);

            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                var progress = Math.min((timestamp - startTime) / durationMs, 1);
                var value = Math.floor(start + (end - start) * progress);
                el.textContent = formatNumber(value);
                if (progress < 1) window.requestAnimationFrame(step);
            }
            window.requestAnimationFrame(step);
        }

        function startCountersOnce() {
            document.querySelectorAll('[data-counter]').forEach(function (el) {
                if (el.getAttribute('data-started') === '1') return;
                el.setAttribute('data-started', '1');
                animateCounter(el, el.getAttribute('data-count'), 1000);
            });
        }

        function setupCounterObserver() {
            var section = document.getElementById('statistik');
            if (!section) return;
            if ('IntersectionObserver' in window) {
                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            startCountersOnce();
                            observer.disconnect();
                        }
                    });
                }, { threshold: 0.2 });
                observer.observe(section);
            } else {
                startCountersOnce();
            }
        }

        function setupSmoothScroll() {
            document.querySelectorAll('a[href^="#"]').forEach(function (a) {
                a.addEventListener('click', function (e) {
                    var href = a.getAttribute('href');
                    if (!href || href === '#') return;
                    var target = document.querySelector(href);
                    if (!target) return;
                    e.preventDefault();
                    var y = target.getBoundingClientRect().top + window.pageYOffset - 80;
                    window.scrollTo({ top: y, behavior: 'smooth' });
                });
            });
        }

        function setupNavbarShadow() {
            var nav = document.getElementById('mainNav');
            if (!nav) return;
            function onScroll() {
                if (window.scrollY > 8) nav.classList.add('navbar-scrolled');
                else nav.classList.remove('navbar-scrolled');
            }
            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll();
        }

        document.addEventListener('DOMContentLoaded', function () {
            setupSmoothScroll();
            setupNavbarShadow();
            setupCounterObserver();
            startCountersOnce();
        });
    })();
</script>

</body>
</html>
