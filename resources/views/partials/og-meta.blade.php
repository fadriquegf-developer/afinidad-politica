{{-- 
    INSTRUCCIONES: Añade esta línea en el <head> de tu layout principal
    (resources/views/layouts/app.blade.php), justo después del <title>:
--}}

{{-- Open Graph Meta Tags - Añadir en layouts/app.blade.php dentro de <head> --}}
@hasSection('og_meta')
    @yield('og_meta')
@else
    {{-- Meta tags por defecto --}}
    <meta property="og:title" content="{{ config('app.name') }} - Test de Afinidad Política">
    <meta property="og:description" content="Descubre qué partido político se alinea más con tus ideas. Test gratuito y anónimo.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-test-politico.png') }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta name="twitter:card" content="summary_large_image">
@endif
