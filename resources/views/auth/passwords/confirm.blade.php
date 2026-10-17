@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 col-md-10">
            <div class="auth-card">
                <div class="row no-gutters">
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="auth-hero h-100 d-flex flex-column justify-content-between">
                            <div>
                                <span class="auth-hero-logo mb-4">
                                    <img src="{{ $brandLogo }}" alt="{{ $brandName }}">
                                </span>
                                <div class="text-uppercase font-weight-bold mb-2" style="opacity:.85; letter-spacing:.18em; font-size:.72rem;">Verifikasi Akses</div>
                                <h2 style="font-size: 1.85rem;">Konfirmasi sandi dulu, ya</h2>
                                <p class="mt-2 mb-0" style="opacity:.92;">Untuk keamanan, kami minta sandi Anda sebelum melanjutkan ke area sensitif.</p>
                            </div>
                            <div class="d-flex align-items-center" style="opacity:.9;">
                                <i class="fas fa-lock mr-2"></i>
                                <small>Hanya Anda yang tahu sandi ini.</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="auth-form-wrap">
                            <div class="brand-mini d-lg-none">
                                <span class="logo-mini"><img src="{{ $brandLogo }}" alt="{{ $brandName }}"></span>
                                <span class="name">{{ $brandName }}</span>
                            </div>

                            <h1 class="auth-title mb-1" style="font-size: 1.7rem;">Konfirmasi Sandi</h1>
                            <p class="auth-subtitle mb-4">Masukkan kembali sandi Anda untuk melanjutkan.</p>

                            @if ($errors->any())
                                <div class="alert alert-danger-warung p-3" role="alert">
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

                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <div class="input-warung">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" class="form-control" name="password" placeholder="Kata sandi" required autocomplete="current-password" autofocus>
                                </div>

                                <button type="submit" class="btn btn-warung btn-block mt-2">
                                    <i class="fas fa-check mr-2"></i> Konfirmasi
                                </button>
                            </form>

                            @if (Route::has('password.request'))
                                <div class="auth-divider">atau</div>
                                <div class="text-center small">
                                    <a class="auth-link" href="{{ route('password.request') }}">Lupa sandi?</a>
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
