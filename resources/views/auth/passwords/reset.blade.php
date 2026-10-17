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
                                <div class="text-uppercase font-weight-bold mb-2" style="opacity:.85; letter-spacing:.18em; font-size:.72rem;">Atur Sandi Baru</div>
                                <h2 style="font-size: 1.85rem;">Pilih sandi yang kuat &amp; mudah diingat</h2>
                                <p class="mt-2 mb-0" style="opacity:.92;">Gunakan kombinasi huruf, angka, dan simbol agar akun {{ $brandName }} Anda tetap aman.</p>
                            </div>
                            <div class="d-flex align-items-center" style="opacity:.9;">
                                <i class="fas fa-shield-alt mr-2"></i>
                                <small>Sandi tersimpan terenkripsi.</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="auth-form-wrap">
                            <div class="brand-mini d-lg-none">
                                <span class="logo-mini"><img src="{{ $brandLogo }}" alt="{{ $brandName }}"></span>
                                <span class="name">{{ $brandName }}</span>
                            </div>

                            <h1 class="auth-title mb-1" style="font-size: 1.7rem;">Buat Kata Sandi Baru</h1>
                            <p class="auth-subtitle mb-4">Isi form di bawah untuk menyelesaikan reset sandi.</p>

                            @if ($errors->any())
                                <div class="alert alert-danger-warung p-3" role="alert">
                                    <ul class="pl-3 mb-0 small">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="input-warung">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <input type="email" class="form-control" name="email" placeholder="Alamat email" value="{{ $email ?? old('email') }}" required autofocus>
                                </div>

                                <div class="input-warung">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" class="form-control" name="password" placeholder="Kata sandi baru" required autocomplete="new-password">
                                </div>

                                <div class="input-warung">
                                    <i class="fas fa-shield-alt input-icon"></i>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi sandi" required autocomplete="new-password">
                                </div>

                                <button type="submit" class="btn btn-warung btn-block mt-2">
                                    <i class="fas fa-key mr-2"></i> Simpan Sandi Baru
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
