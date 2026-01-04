<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('test.title'))</title>

    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-touch-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-touch-icon-152x152.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('favicon/favicon-128.png') }}">
    <link rel="icon" type="image/png" sizes="196x196" href="{{ asset('favicon/favicon-196x196.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#667eea">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/mstile-144x144.png') }}">
    <meta name="msapplication-square70x70logo" content="{{ asset('favicon/mstile-70x70.png') }}">
    <meta name="msapplication-square150x150logo" content="{{ asset('favicon/mstile-150x150.png') }}">
    <meta name="msapplication-square310x310logo" content="{{ asset('favicon/mstile-310x310.png') }}">
    <meta name="msapplication-wide310x150logo" content="{{ asset('favicon/mstile-310x150.png') }}">
    <meta name="theme-color" content="#667eea">

    {{-- AÑADIR ESTO: Open Graph Meta Tags --}}
    @hasSection('og')
        @yield('og')
    @else
        <meta property="og:title" content="{{ config('app.name') }} - {{ __('test.site_title') }}">
        <meta property="og:description" content="{{ __('test.og_description') }}">
        <meta property="og:image" content="{{ asset('images/og_imagen.png') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="{{ app()->getLocale() }}_ES">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ config('app.name') }}">
        <meta name="twitter:description" content="{{ __('test.og_description') }}">
        <meta name="twitter:image" content="{{ asset('images/og_imagen.png') }}">
    @endif
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366f1;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .btn-answer {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 1.5rem;
            transition: all 0.2s;
        }

        .btn-answer:hover,
        .btn-answer.active {
            transform: scale(1.15);
        }

        .progress {
            height: 8px;
            border-radius: 4px;
        }

        .party-bar {
            height: 30px;
            border-radius: 6px;
            transition: width 1s ease;
        }

        .category-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
        }

        .lang-switcher a {
            opacity: 0.6;
            text-decoration: none;
        }

        .lang-switcher a:hover,
        .lang-switcher a.active {
            opacity: 1;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="container py-4">
        <div class="lang-switcher text-end mb-3">
            <a href="{{ route('lang.switch', 'es') }}"
                class="badge bg-light text-dark {{ app()->getLocale() == 'es' ? 'active' : '' }}">ES</a>
            <a href="{{ route('lang.switch', 'ca') }}"
                class="badge bg-light text-dark {{ app()->getLocale() == 'ca' ? 'active' : '' }}">CA</a>
            <a href="{{ route('lang.switch', 'eu') }}"
                class="badge bg-light text-dark {{ app()->getLocale() == 'eu' ? 'active' : '' }}">EU</a>
            <a href="{{ route('lang.switch', 'gl') }}"
                class="badge bg-light text-dark {{ app()->getLocale() == 'gl' ? 'active' : '' }}">GL</a>
        </div>
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>

</html>
