{{-- Schema.org JSON-LD --}}

{{-- WebApplication --}}
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "WebApplication",
    "name": "Test de Afinidad Política España",
    "alternateName": "Test Político España",
    "url": "{{ url('/') }}",
    "applicationCategory": "UtilitiesApplication",
    "operatingSystem": "Web",
    "description": "{{ __('test.og_description') }}",
    "inLanguage": ["es-ES", "ca-ES", "eu-ES", "gl-ES"],
    "offers": {
        "@@type": "Offer",
        "price": "0",
        "priceCurrency": "EUR"
    },
    "author": {
        "@@type": "Organization",
        "name": "Afinidad Política",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.webp') }}"
    },
    "datePublished": "2024-01-01",
    "dateModified": "{{ now()->format('Y-m-d') }}",
    "screenshot": "{{ asset('images/og_imagen.webp') }}",
    "featureList": [
        "Test de 10, 20 o 30 preguntas",
        "9 partidos políticos españoles",
        "Brújula política visual",
        "Disponible en 4 idiomas",
        "Resultados compartibles",
        "Comparador con amigos",
        "100% anónimo y gratuito"
    ]
}
</script>

{{-- Organization --}}
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Organization",
    "name": "Afinidad Política",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('images/logo.webp') }}",
    "contactPoint": {
        "@@type": "ContactPoint",
        "email": "contacto@afinidadpolitica.es",
        "contactType": "customer support"
    }
}
</script>

@stack('schema')
