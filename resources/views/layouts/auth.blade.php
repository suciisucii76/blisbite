<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php($brandName = config('app.name', 'Warung Bu Engkar'))
    @php($brandLogo = file_exists(public_path('img/logo.png')) ? asset('img/logo.png') : asset('img/favicon.png'))

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $brandName }}</title>

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
            font-family: 'Nunito', sans-serif;
            background:
                radial-gradient(circle at 15% 20%, rgba(254, 215, 170, .65) 0, transparent 40%),
                radial-gradient(circle at 85% 80%, rgba(254, 240, 138, .55) 0, transparent 45%),
                linear-gradient(135deg, #fef3c7 0%, #fdba74 60%, #fb923c 100%);
            min-height: 100vh;
            display: flex; justify-content: center; align-items: center;
            padding: 1.5rem 0;
            position: relative;
        }
        body::before {
            content: ""; position: fixed; inset: 0;
            background-image: radial-gradient(rgba(120, 53, 15, .07) 1.2px, transparent 1.2px);
            background-size: 24px 24px;
            pointer-events: none;
        }

        .headline-serif {
            font-family: 'Playfair Display', Georgia, serif;
            letter-spacing: -0.5px;
        }

        .auth-card {
            background: #fff;
            border-radius: 28px;
            box-shadow: 0 2.5rem 5rem rgba(120, 53, 15, .25);
            overflow: hidden;
            border: 1px solid rgba(120, 53, 15, .08);
            position: relative;
            z-index: 1;
        }

        .auth-hero {
            background: linear-gradient(160deg, var(--warung-saffron) 0%, var(--warung-terracotta) 100%);
            color: #fff;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
            min-height: 100%;
        }
        .auth-hero::before {
            content: "";
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(255,255,255,.12) 1.5px, transparent 1.5px);
            background-size: 22px 22px;
            opacity: .55;
        }
        .auth-hero::after {
            content: "\f805"; /* fa-utensils */
            font-family: "Font Awesome 5 Free"; font-weight: 900;
            position: absolute; right: -30px; bottom: -50px;
            font-size: 18rem; opacity: .08;
        }
        .auth-hero > * { position: relative; z-index: 2; }

        .auth-hero-logo {
            width: 84px; height: 84px;
            border-radius: 22px;
            background: #fff;
            padding: 12px;
            display: inline-flex; align-items: center; justify-content: center;
            box-shadow: 0 1.25rem 2rem rgba(0,0,0,.18);
        }
        .auth-hero-logo img { width: 100%; height: 100%; object-fit: contain; }

        .auth-hero h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            line-height: 1.1;
        }

        .auth-hero .feat-list { list-style: none; padding: 0; margin: 1.5rem 0 0 0; }
        .auth-hero .feat-list li {
            display: flex; align-items: flex-start;
            margin-bottom: .8rem;
        }
        .auth-hero .feat-list li i {
            width: 30px; height: 30px;
            border-radius: 9px;
            background: rgba(255,255,255,.18);
            display: inline-flex; align-items: center; justify-content: center;
            margin-right: .75rem; flex-shrink: 0;
            font-size: .85rem;
        }

        .auth-form-wrap {
            padding: 3rem 2.5rem;
        }
        .auth-form-wrap .brand-mini {
            display: inline-flex; align-items: center;
            margin-bottom: 1.5rem;
        }
        .auth-form-wrap .brand-mini .logo-mini {
            width: 38px; height: 38px;
            border-radius: 11px;
            background: var(--warung-cream-soft);
            padding: 6px;
            display: inline-flex; align-items: center; justify-content: center;
            margin-right: .6rem;
            border: 1px solid rgba(120, 53, 15, .12);
        }
        .auth-form-wrap .brand-mini .logo-mini img { width: 100%; height: 100%; object-fit: contain; }
        .auth-form-wrap .brand-mini .name {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--warung-brown);
        }

        .auth-title {
            font-family: 'Playfair Display', serif;
            color: var(--warung-brown);
            font-weight: 800;
        }
        .auth-subtitle { color: #92400e; font-size: .92rem; }

        /* Inputs */
        .input-warung {
            position: relative;
            margin-bottom: 1rem;
        }
        .input-warung .form-control {
            height: 52px;
            border-radius: 14px;
            border: 1.5px solid #f3d4a4;
            background: var(--warung-cream-soft);
            padding-left: 46px;
            font-size: .95rem;
            color: #422006;
            transition: border-color .15s ease, box-shadow .15s ease, background .15s ease;
        }
        .input-warung .form-control:focus {
            border-color: var(--warung-saffron);
            background: #fff;
            box-shadow: 0 0 0 .2rem rgba(217, 119, 6, .15);
        }
        .input-warung .form-control::placeholder { color: #b08968; }
        .input-warung .input-icon {
            position: absolute;
            left: 16px; top: 50%;
            transform: translateY(-50%);
            color: var(--warung-saffron);
            pointer-events: none;
            font-size: 1rem;
        }
        .input-warung select.form-control { padding-left: 46px; appearance: none; -webkit-appearance: none; background-image: linear-gradient(45deg, transparent 50%, var(--warung-saffron) 50%), linear-gradient(135deg, var(--warung-saffron) 50%, transparent 50%); background-position: calc(100% - 18px) 22px, calc(100% - 13px) 22px; background-size: 5px 5px, 5px 5px; background-repeat: no-repeat; }

        .btn-warung {
            background: linear-gradient(135deg, var(--warung-saffron) 0%, var(--warung-terracotta) 100%);
            border: none;
            color: #fff;
            font-weight: 700;
            height: 52px;
            border-radius: 14px;
            font-size: 1rem;
            letter-spacing: .02em;
            box-shadow: 0 .75rem 1.5rem rgba(217, 119, 6, .35);
            transition: transform .12s ease, box-shadow .12s ease, filter .12s ease;
        }
        .btn-warung:hover, .btn-warung:focus {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 .9rem 1.8rem rgba(217, 119, 6, .45);
            filter: brightness(1.03);
        }
        .btn-warung:active { transform: translateY(0); }

        .auth-link {
            color: var(--warung-saffron-dark);
            font-weight: 700;
        }
        .auth-link:hover { color: var(--warung-terracotta); text-decoration: underline; }

        .auth-divider {
            display: flex; align-items: center;
            margin: 1.25rem 0;
            color: #a16207;
            font-size: .82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
        }
        .auth-divider::before, .auth-divider::after {
            content: ""; flex: 1;
            border-top: 1px dashed #f3d4a4;
        }
        .auth-divider::before { margin-right: .85rem; }
        .auth-divider::after { margin-left: .85rem; }

        .alert-warning-warung {
            background: var(--warung-cream);
            border: 1px solid #fcd34d;
            color: var(--warung-brown);
            border-radius: 14px;
        }
        .alert-danger-warung {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 14px;
        }
        .alert-success-warung {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            border-radius: 14px;
        }

        .check-warung label { color: #6b3410; font-weight: 600; }
        .check-warung .custom-control-input:checked ~ .custom-control-label::before {
            background: var(--warung-saffron);
            border-color: var(--warung-saffron);
        }

        .back-home {
            position: absolute;
            top: 1.2rem; left: 1.2rem;
            background: rgba(255,255,255,.85);
            border: 1px solid rgba(120, 53, 15, .15);
            color: var(--warung-brown);
            border-radius: 999px;
            padding: .35rem .85rem;
            font-size: .8rem; font-weight: 700;
            text-decoration: none;
            box-shadow: 0 .35rem .9rem rgba(120, 53, 15, .12);
            backdrop-filter: blur(8px);
            z-index: 3;
        }
        .back-home:hover { background: #fff; color: var(--warung-saffron-dark); text-decoration: none; }

        @media (max-width: 991px) {
            .auth-hero { padding: 2.5rem 2rem; text-align: center; }
            .auth-hero .feat-list { display: inline-block; text-align: left; }
            .auth-form-wrap { padding: 2.5rem 1.75rem; }
        }
        @media (max-width: 575px) {
            .auth-form-wrap { padding: 2rem 1.25rem; }
            .auth-hero { padding: 2rem 1.25rem; }
        }
    </style>

    @stack('css')
</head>
<body class="min-vh-100">

<a href="{{ url('/') }}" class="back-home">
    <i class="fas fa-arrow-left mr-1"></i> Beranda
</a>

@yield('main-content')

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
@stack('js')
</body>
</html>
