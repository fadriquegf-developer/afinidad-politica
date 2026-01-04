{{-- Cookie Banner con gestión de consentimiento para Analytics --}}

<div id="cookie-banner" class="cookie-banner" style="display: none;">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center">
                <span class="me-3 fs-4">🍪</span>
                <div>
                    <p class="mb-1 small fw-medium">{{ __('cookie.title') }}</p>
                    <p class="mb-0 small text-white-50">
                        {{ __('cookie.message') }}
                        <a href="{{ route('legal.cookies') }}" class="text-white text-decoration-underline">
                            {{ __('cookie.more_info') }}
                        </a>
                    </p>
                </div>
            </div>
            <div class="d-flex gap-2 flex-shrink-0">
                <button type="button" class="btn btn-outline-light btn-sm" onclick="acceptCookies('essential')">
                    {{ __('cookie.reject_optional') }}
                </button>
                <button type="button" class="btn btn-light btn-sm px-4" onclick="acceptCookies('all')">
                    <i class="bi bi-check-lg me-1"></i>{{ __('cookie.accept_all') }}
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .cookie-banner {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1rem 0;
        z-index: 9999;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.2);
        animation: slideUp 0.3s ease-out;
    }

    @keyframes slideUp {
        from { transform: translateY(100%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @keyframes slideDown {
        from { transform: translateY(0); opacity: 1; }
        to { transform: translateY(100%); opacity: 0; }
    }

    .cookie-banner a {
        color: white;
    }
</style>

<script>
    // Configuración de Analytics
    const GA_ID = '{{ config('services.google.analytics_id') }}';
    
    // Verificar consentimiento al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const consent = localStorage.getItem('cookie_consent');
        
        if (!consent) {
            // No ha decidido aún, mostrar banner
            document.getElementById('cookie-banner').style.display = 'block';
        } else if (consent === 'all') {
            // Aceptó todas, cargar Analytics
            loadGoogleAnalytics();
        }
        // Si consent === 'essential', no cargamos Analytics
    });

    // Aceptar cookies
    function acceptCookies(level) {
        localStorage.setItem('cookie_consent', level);
        localStorage.setItem('cookie_consent_date', new Date().toISOString());
        
        // Ocultar banner
        const banner = document.getElementById('cookie-banner');
        banner.style.animation = 'slideDown 0.3s ease-out forwards';
        setTimeout(() => banner.style.display = 'none', 300);
        
        // Si aceptó todas, cargar Analytics
        if (level === 'all') {
            loadGoogleAnalytics();
        }
    }

    // Cargar Google Analytics
    function loadGoogleAnalytics() {
        if (!GA_ID || GA_ID === '') return;
        
        // Evitar cargar dos veces
        if (window.gaLoaded) return;
        window.gaLoaded = true;

        // Cargar script de gtag.js
        const script = document.createElement('script');
        script.async = true;
        script.src = 'https://www.googletagmanager.com/gtag/js?id=' + GA_ID;
        document.head.appendChild(script);

        // Inicializar gtag
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', GA_ID, {
            'anonymize_ip': true,  // RGPD: anonimizar IP
            'cookie_flags': 'SameSite=None;Secure'
        });

        // Hacer gtag disponible globalmente
        window.gtag = gtag;

        console.log('Google Analytics cargado');
    }

    // Función para revocar consentimiento (por si quieres añadir un botón en la página de cookies)
    function revokeCookieConsent() {
        localStorage.removeItem('cookie_consent');
        localStorage.removeItem('cookie_consent_date');
        
        // Eliminar cookies de Google Analytics
        document.cookie.split(';').forEach(function(c) {
            if (c.trim().startsWith('_ga') || c.trim().startsWith('_gid')) {
                document.cookie = c.trim().split('=')[0] + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;domain=.' + window.location.hostname;
            }
        });
        
        // Recargar para mostrar banner de nuevo
        window.location.reload();
    }
</script>