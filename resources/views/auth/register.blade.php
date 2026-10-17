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
                                <div class="text-uppercase font-weight-bold mb-2" style="opacity:.85; letter-spacing:.18em; font-size:.72rem;">Bergabung Bersama Kami</div>
                                <h2 style="font-size: 2rem;">Mulai kelola warung dengan rapi</h2>
                                <p class="mt-2 mb-0" style="opacity:.92;">Buat akun untuk {{ $brandName }} dan nikmati pengelolaan warung yang sederhana, cepat, dan terorganisir.</p>
                            </div>

                            <ul class="feat-list">
                                <li><i class="fas fa-bowl-rice"></i> <span><strong>Kelola menu</strong> dan harga jual dengan mudah.</span></li>
                                <li><i class="fas fa-boxes"></i> <span><strong>Notifikasi stok</strong> kritis langsung ke dashboard.</span></li>
                                <li><i class="fas fa-file-export"></i> <span><strong>Ekspor laporan</strong> Excel &amp; PDF kapan saja.</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="auth-form-wrap">
                            <div class="brand-mini d-lg-none">
                                <span class="logo-mini"><img src="{{ $brandLogo }}" alt="{{ $brandName }}"></span>
                                <span class="name">{{ $brandName }}</span>
                            </div>

                            <h1 class="auth-title mb-1" style="font-size: 1.85rem;">Buat Akun Baru</h1>
                            <p class="auth-subtitle mb-4">Daftar dulu, baru bisa masuk ke dapur digital warung.</p>

                            @if ($errors->any())
                                <div class="alert alert-danger-warung p-3" role="alert">
                                    <div class="font-weight-bold mb-1"><i class="fas fa-exclamation-circle mr-1"></i> Periksa kembali isian Anda</div>
                                    <ul class="pl-3 mb-0 small">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-warung">
                                            <i class="fas fa-user input-icon"></i>
                                            <input type="text" class="form-control" name="name" placeholder="Nama depan" value="{{ old('name') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-warung">
                                            <i class="fas fa-user input-icon"></i>
                                            <input type="text" class="form-control" name="last_name" placeholder="Nama belakang" value="{{ old('last_name') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-warung">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <input type="email" class="form-control" name="email" placeholder="Alamat email" value="{{ old('email') }}" required autocomplete="email">
                                </div>

                                <div class="input-warung">
                                    <i class="fas fa-user-tag input-icon"></i>
                                    <select class="form-control" name="role" required>
                                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih peran Anda…</option>
                                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin (Pengelola)</option>
                                        <option value="pemilik" {{ old('role') === 'pemilik' ? 'selected' : '' }}>Pemilik UMKM</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-warung">
                                            <i class="fas fa-lock input-icon"></i>
                                            <input type="password" class="form-control" name="password" placeholder="Kata sandi" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-warung">
                                            <i class="fas fa-shield-alt input-icon"></i>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi sandi" required autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-warung btn-block mt-2">
                                    <i class="fas fa-user-plus mr-2"></i> Buat Akun
                                </button>
                            </form>

                            <div class="auth-divider">atau</div>
                            <div class="text-center small">
                                Sudah punya akun?
                                <a class="auth-link ml-1" href="{{ route('login') }}">Masuk di sini</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
