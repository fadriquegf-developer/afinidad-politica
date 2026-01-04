<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', __('test.site_title')) - {{ config('app.name') }}</title>
    
    {{-- Manifest --}}
    <link rel="manifest" href="/manifest.json">

    {{-- SEO básico --}}
    <meta name="description" content="@yield('meta_description', __('test.og_description'))">
    <meta name="keywords"
        content="test político, afinidad política, elecciones España, partidos políticos, brújula política, PSOE, PP, VOX, Sumar, ERC, Junts, PNV, Bildu">
    <meta name="author" content="Afinidad Política">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Idiomas alternativos para SEO --}}
    <link rel="alternate" hreflang="es" href="{{ url(request()->path()) }}?lang=es">
    <link rel="alternate" hreflang="ca" href="{{ url(request()->path()) }}?lang=ca">
    <link rel="alternate" hreflang="eu" href="{{ url(request()->path()) }}?lang=eu">
    <link rel="alternate" hreflang="gl" href="{{ url(request()->path()) }}?lang=gl">
    <link rel="alternate" hreflang="x-default" href="{{ url(request()->path()) }}">

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

    {{-- Microsoft Tiles --}}
    <meta name="msapplication-TileColor" content="#667eea">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/mstile-144x144.png') }}">
    <meta name="msapplication-square70x70logo" content="{{ asset('favicon/mstile-70x70.png') }}">
    <meta name="msapplication-square150x150logo" content="{{ asset('favicon/mstile-150x150.png') }}">
    <meta name="msapplication-square310x310logo" content="{{ asset('favicon/mstile-310x310.png') }}">
    <meta name="msapplication-wide310x150logo" content="{{ asset('favicon/mstile-310x150.png') }}">

    {{-- Theme color --}}
    <meta name="theme-color" content="#667eea">
    <meta name="apple-mobile-web-app-status-bar-style" content="#667eea">

    {{-- Open Graph / Facebook --}}
    @hasSection('og')
        @yield('og')
    @else
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ config('app.name') }} - {{ __('test.site_title') }}">
        <meta property="og:description" content="{{ __('test.og_description') }}">
        <meta property="og:image" content="{{ asset('images/og_imagen.png') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:locale" content="{{ app()->getLocale() }}_ES">
        <meta property="og:site_name" content="{{ config('app.name') }}">
    @endif

    {{-- Twitter Card --}}
    @hasSection('twitter')
        @yield('twitter')
    @else
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@afinidadpol">
        <meta name="twitter:title" content="{{ config('app.name') }} - {{ __('test.site_title') }}">
        <meta name="twitter:description" content="{{ __('test.og_description') }}">
        <meta name="twitter:image" content="{{ asset('images/og_imagen.png') }}">
    @endif

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3WJBCGP683"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-3WJBCGP683');
    </script>

    {{-- Preconnect para rendimiento --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Fuente personalizada (opcional) --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary-color: #667eea;
            --secondary-color: #764ba2;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--primary-gradient);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            transition: transform 0.2s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        .card {
            border-radius: 12px;
        }

        .btn {
            border-radius: 8px;
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd6 0%, #6a4190 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        /* Skip to content para accesibilidad */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 0;
            background: #000;
            color: #fff;
            padding: 8px;
            z-index: 10000;
        }

        .skip-link:focus {
            top: 0;
        }

        /* Scrollbar personalizada */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }
    </style>

    @stack('styles')

    @include('partials.schema')
</head>

<body>
    {{-- Skip link para accesibilidad --}}
    <a href="#main-content" class="skip-link">Saltar al contenido</a>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('test.index') }}">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" height="40"
                    class="me-2" loading="eager">
                <span class="fw-bold d-none d-sm-inline">{{ config('app.name') }}</span>
            </a>

            <div class="d-flex align-items-center gap-2">
                {{-- Selector de idioma --}}
                <div class="btn-group" role="group" aria-label="{{ __('test.language') }}">
                    @foreach (['es', 'ca', 'eu', 'gl'] as $locale)
                        <a href="{{ route('lang.switch', $locale) }}"
                            class="btn btn-sm {{ app()->getLocale() == $locale ? 'btn-primary' : 'btn-outline-secondary' }}"
                            title="{{ ['es' => 'Español', 'ca' => 'Català', 'eu' => 'Euskara', 'gl' => 'Galego'][$locale] }}">
                            {{ strtoupper($locale) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </nav>

    {{-- Contenido principal --}}
    <main id="main-content" class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Cookie Banner --}}
    @include('partials.cookie-banner')

    {{-- JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
