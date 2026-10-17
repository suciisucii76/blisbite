@extends('layouts.auth')

@section('main-content')
@php($brandName = config('app.name', 'Warung Ibu Engkar'))
@php($brandLogo = file_exists(public_path('img/logo.png')) ? asset('img/logo.png') : asset('img/favicon.png'))

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-10">
            <div class="auth-card">
                <div class="row no-gutters">
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="auth-hero h-100 d-flex flex-column justify-content-between">
                            <div>
                                <span class="auth-hero-logo mb-4">
                                    <img src="{{ $brandLogo }}" alt="{{ $brandName }}">
                                </span>
                                <div class="text-uppercase font-weight-bold mb-2" style="opacity:.85; letter-spacing:.18em; font-size:.72rem;">Hampir Selesai</div>
                                <h2 style="font-size: 1.85rem;">Verifikasi email Anda</h2>
                                <p class="mt-2 mb-0" style="opacity:.92;">Satu langkah lagi untuk mengaktifkan akun di {{ $brandName }}.</p>
                            </div>
                            <div class="d-flex align-items-center" style="opacity:.9;">
                                <i class="fas fa-envelope-open-text mr-2"></i>
                                <small>Cek kotak masuk dan folder Spam.</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="auth-form-wrap text-center">
                            <div class="brand-mini d-lg-none justify-content-center">
                                <span class="logo-mini"><img src="{{ $brandLogo }}" alt="{{ $brandName }}"></span>
                                <span class="name">{{ $brandName }}</span>
                            </div>

                            <div class="d-inline-flex align-items-center justify-content-center mb-3"
                                 style="width: 78px; height: 78px; border-radius: 50%; background: var(--warung-cream); color: var(--warung-saffron-dark); font-size: 2rem;">
                                <i class="fas fa-envelope"></i>
                            </div>

                            <h1 class="auth-title mb-2" style="font-size: 1.7rem;">Cek email Anda</h1>
                            <p class="auth-subtitle mb-4">Kami sudah mengirim tautan verifikasi. Klik tautan tersebut untuk mengaktifkan akun.</p>

                            @if (session('resent'))
                                <div class="alert alert-success-warung p-3 text-left" role="alert">
                                    <i class="fas fa-check-circle mr-1"></i> Tautan verifikasi baru telah dikirim ke email Anda.
                                </div>
                            @endif

                            <p class="small mb-4" style="color:#92400e;">
                                Belum menerima email?
                            </p>

                            <form method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-warung btn-block">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Ulang Tautan
                                </button>
                            </form>

                            <div class="auth-divider">atau</div>
                            <div class="small">
                                <a class="auth-link" href="{{ route('login') }}"><i class="fas fa-arrow-left mr-1"></i> Kembali ke login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
