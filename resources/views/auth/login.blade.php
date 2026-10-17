@extends('layouts.auth')

@section('main-content')
@php($brandName = config('app.name', 'Warung Ibu Engkar'))
@php($brandLogo = file_exists(public_path('img/logo.png')) ? asset('img/logo.png') : asset('img/favicon.png'))

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-11 col-md-10">
            <div class="auth-card">
                <div class="row no-gutters">
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="auth-hero h-100 d-flex flex-column justify-content-between">
                            <div>
                                <span class="auth-hero-logo mb-4">
                                    <img src="{{ $brandLogo }}" alt="{{ $brandName }}">
                                </span>
                                <div class="text-uppercase font-weight-bold mb-2" style="opacity:.85; letter-spacing:.18em; font-size:.72rem;">Selamat Datang Kembali</div>
                                <h2 style="font-size: 2rem;">{{ $brandName }}</h2>
                                <p class="mt-2 mb-0" style="opacity:.92;">Masuk untuk meracik laporan, mencatat pesanan, dan menjaga stok dapur tetap rapi.</p>
                            </div>

                            <ul class="feat-list">
                                <li><i class="fas fa-receipt"></i> <span><strong>Catat transaksi</strong> tanpa repot, secepat melayani pelanggan.</span></li>
                                <li><i class="fas fa-warehouse"></i> <span><strong>Pantau stok bahan</strong> dapur sebelum kehabisan.</span></li>
                                <li><i class="fas fa-chart-line"></i> <span><strong>Laporan otomatis</strong>—tahu untung tiap hari.</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="auth-form-wrap">
                            <div class="brand-mini d-lg-none">
                                <span class="logo-mini"><img src="{{ $brandLogo }}" alt="{{ $brandName }}"></span>
                                <span class="name">{{ $brandName }}</span>
                            </div>

                            <h1 class="auth-title mb-1" style="font-size: 1.85rem;">Masuk ke Dapur</h1>
                            <p class="auth-subtitle mb-4">Silakan login untuk mulai mengelola warung.</p>

                            @if ($errors->any())
                                <div class="alert alert-danger-warung p-3" role="alert">
                                    <div class="font-weight-bold mb-1"><i class="fas fa-exclamation-circle mr-1"></i> Login gagal</div>
                                    <ul class="pl-3 mb-0 small">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('status'))
                                <div class="alert alert-success-warung p-3" role="alert">
                                    <i class="fas fa-check-circle mr-1"></i> {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="input-warung">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <input type="email" class="form-control" name="email" placeholder="Alamat email" value="{{ old('email') }}" required autofocus autocomplete="email">
                                </div>

                                <div class="input-warung">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" class="form-control" name="password" placeholder="Kata sandi" required autocomplete="current-password">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="custom-control custom-checkbox small check-warung">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">Ingat saya</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="small auth-link" href="{{ route('password.request') }}">Lupa sandi?</a>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-warung btn-block">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk Sekarang
                                </button>
                            </form>

                            @if (Route::has('register'))
                                <div class="auth-divider">atau</div>
                                <div class="text-center small">
                                    Belum punya akun?
                                    <a class="auth-link ml-1" href="{{ route('register') }}">Daftar di sini</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
