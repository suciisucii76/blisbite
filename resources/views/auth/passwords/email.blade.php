@extends('layouts.auth')

@section('main-content')
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
                                <div class="text-uppercase font-weight-bold mb-2" style="opacity:.85; letter-spacing:.18em; font-size:.72rem;">Bantuan Akses</div>
                                <h2 style="font-size: 1.85rem;">Lupa kata sandi?</h2>
                                <p class="mt-2 mb-0" style="opacity:.92;">Tenang, kami kirim tautan reset ke email Anda. Cuma butuh beberapa detik.</p>
                            </div>
                            <div class="d-flex align-items-center" style="opacity:.9;">
                                <i class="fas fa-envelope-open-text mr-2"></i>
                                <small>Cek folder Spam jika tak kunjung sampai.</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="auth-form-wrap">
                            <div class="brand-mini d-lg-none">
                                <span class="logo-mini"><img src="{{ $brandLogo }}" alt="{{ $brandName }}"></span>
                                <span class="name">{{ $brandName }}</span>
                            </div>

                            <h1 class="auth-title mb-1" style="font-size: 1.7rem;">Reset Kata Sandi</h1>
                            <p class="auth-subtitle mb-4">Masukkan email akun Anda. Kami kirimkan tautan untuk membuat sandi baru.</p>

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

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="input-warung">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <input type="email" class="form-control" name="email" placeholder="Alamat email" value="{{ old('email') }}" required autofocus>
                                </div>

                                <button type="submit" class="btn btn-warung btn-block mt-2">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Tautan Reset
                                </button>
                            </form>

                            <div class="auth-divider">atau</div>
                            <div class="text-center small">
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
