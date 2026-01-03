<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('test.title'))</title>
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
