@extends('layouts.admin')

@section('main-content')
    @php($brandName = config('app.name', 'Warung Bu Engkar'))
    @php($brandLogo = file_exists(public_path('img/logo.png')) ? asset('img/logo.png') : asset('img/favicon.png'))

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Profile hero -->
            <div class="card shadow-sm mb-4 border-0" style="overflow: hidden;">
                <div class="about-cover">
                    <div class="about-cover-inner d-flex flex-column flex-md-row align-items-center align-items-md-end">
                        <div class="about-logo mr-md-4 mb-3 mb-md-0">
                            <img src="{{ $brandLogo }}" alt="{{ $brandName }}">
                        </div>
                        <div class="text-center text-md-left text-white">
                            <div class="text-uppercase font-weight-bold" style="opacity:.85; letter-spacing:.18em; font-size:.72rem;">Tentang Kami</div>
                            <h2 class="headline-serif mb-1" style="color:#fff7ed; font-weight:800;">{{ $brandName }}</h2>
                            <p class="mb-0" style="opacity:.95;">Sistem pengelolaan UMKM kuliner — rapi, ringan, dan dibuat dengan cinta.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="row">
                        <div class="col-md-7">
                            <h5 class="headline-serif font-weight-bold mb-2" style="color: var(--warung-brown);">
                                <i class="fas fa-utensils mr-2" style="color: var(--warung-saffron-dark);"></i> Cerita Singkat
                            </h5>
                            <p style="color:#7c2d12;">
                                {{ $brandName }} hadir untuk membantu pemilik warung dan UMKM kuliner mencatat operasional harian
                                tanpa repot. Mulai dari menu, stok bahan, transaksi, sampai laporan—semuanya tersusun rapi dalam
                                satu dashboard.
                            </p>
                            <p class="mb-0" style="color:#7c2d12;">
                                Dibangun di atas Laravel &amp; Fortify, dipadukan dengan pengalaman pemakaian yang sederhana
                                bagi siapa saja—termasuk yang baru pertama kali memakai aplikasi.
                            </p>
                        </div>
                        <div class="col-md-5 mt-4 mt-md-0">
                            <div class="info-tile mb-2">
                                <i class="fas fa-bowl-rice"></i>
                                <div>
                                    <div class="label">Fokus</div>
                                    <div class="value">UMKM Kuliner Indonesia</div>
                                </div>
                            </div>
                            <div class="info-tile mb-2">
                                <i class="fas fa-shield-alt"></i>
                                <div>
                                    <div class="label">Keamanan</div>
                                    <div class="value">Login &amp; Sesi via Fortify</div>
                                </div>
                            </div>
                            <div class="info-tile">
                                <i class="fas fa-mobile-alt"></i>
                                <div>
                                    <div class="label">Tampilan</div>
                                    <div class="value">Responsif &amp; Modern</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Credits -->
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-heart mr-2" style="color: var(--warung-saffron-dark);"></i> Terima Kasih</h6>
                </div>
                <div class="card-body">
                    <p class="mb-3" style="color:#7c2d12;">Aplikasi ini berdiri di atas pundak komunitas open-source. Salam hangat untuk:</p>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="https://laravel.com" target="_blank" class="credit-card">
                                <i class="fab fa-laravel"></i>
                                <div>
                                    <div class="font-weight-bold">Laravel</div>
                                    <div class="small">Framework PHP modern</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="https://github.com/DevMarketer/LaravelEasyNav" target="_blank" class="credit-card">
                                <i class="fas fa-compass"></i>
                                <div>
                                    <div class="font-weight-bold">LaravelEasyNav</div>
                                    <div class="small">Navigasi Laravel yang mudah</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="https://startbootstrap.com/themes/sb-admin-2" target="_blank" class="credit-card">
                                <i class="fas fa-paint-brush"></i>
                                <div>
                                    <div class="font-weight-bold">SB Admin 2</div>
                                    <div class="small">Tema dashboard Bootstrap</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('css')
<style>
    .about-cover {
        background: linear-gradient(135deg, var(--warung-saffron) 0%, var(--warung-terracotta) 100%);
        position: relative;
        overflow: hidden;
        padding: 3.5rem 2rem 2rem;
    }
    .about-cover::before {
        content: ""; position: absolute; inset: 0;
        background-image: radial-gradient(rgba(255,255,255,.12) 1.5px, transparent 1.5px);
        background-size: 22px 22px;
        opacity: .5;
    }
    .about-cover::after {
        content: "\f805";
        font-family: "Font Awesome 5 Free"; font-weight: 900;
        position: absolute; right: -30px; bottom: -60px;
        font-size: 14rem; opacity: .08; color: #fff;
    }
    .about-cover-inner { position: relative; z-index: 2; }

    .about-logo {
        width: 110px; height: 110px;
        border-radius: 24px;
        background: #fff;
        padding: 14px;
        display: inline-flex; align-items: center; justify-content: center;
        box-shadow: 0 1.25rem 2rem rgba(0,0,0,.18);
    }
    .about-logo img { width: 100%; height: 100%; object-fit: contain; }

    .info-tile {
        display: flex; align-items: center;
        background: var(--warung-cream-soft);
        border: 1px solid #f3d4a4;
        border-radius: 14px;
        padding: .9rem 1rem;
    }
    .info-tile > i {
        width: 42px; height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--warung-saffron), var(--warung-terracotta));
        color: #fff;
        display: inline-flex; align-items: center; justify-content: center;
        margin-right: .85rem;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .info-tile .label {
        font-size: .68rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: .08em;
        color: #92400e;
    }
    .info-tile .value {
        font-weight: 700; color: var(--warung-brown);
    }

    .credit-card {
        display: flex; align-items: center;
        background: #fff;
        border: 1px solid rgba(120, 53, 15, .1);
        border-radius: 14px;
        padding: 1rem;
        color: var(--warung-brown);
        text-decoration: none;
        transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
        height: 100%;
    }
    .credit-card:hover {
        transform: translateY(-2px);
        border-color: var(--warung-saffron);
        box-shadow: 0 .75rem 1.5rem rgba(120, 53, 15, .1);
        text-decoration: none;
        color: var(--warung-brown);
    }
    .credit-card > i {
        width: 44px; height: 44px;
        border-radius: 12px;
        background: var(--warung-cream);
        color: var(--warung-saffron-dark);
        display: inline-flex; align-items: center; justify-content: center;
        margin-right: .85rem;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
</style>
@endpush
