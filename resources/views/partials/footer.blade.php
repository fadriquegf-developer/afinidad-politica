<footer class="footer mt-auto py-4">
    <div class="container">
        <div class="row g-4">
            {{-- Logo y descripción --}}
            <div class="col-lg-4 mb-3 mb-lg-0">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" height="40" class="me-2">
                    <span class="fw-bold text-white">{{ config('app.name') }}</span>
                </div>
                <p class="text-white-50 small mb-2">
                    {{ __('legal.footer_independent') }}
                </p>
                <p class="text-white-50 small mb-0">
                    © {{ date('Y') }} {{ config('app.name') }}. {{ __('legal.footer_rights') }}.
                </p>
            </div>

            {{-- Enlaces legales --}}
            <div class="col-6 col-lg-2">
                <h6 class="text-white mb-3">{{ __('legal.footer_legal') }}</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <a href="{{ route('legal.privacy') }}" class="text-white-50 text-decoration-none small footer-link">
                            {{ __('legal.privacy_title') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('legal.notice') }}" class="text-white-50 text-decoration-none small footer-link">
                            {{ __('legal.legal_notice_title') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('legal.cookies') }}" class="text-white-50 text-decoration-none small footer-link">
                            {{ __('legal.cookies_title') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Enlaces informativos --}}
            <div class="col-6 col-lg-2">
                <h6 class="text-white mb-3">{{ __('legal.footer_info') }}</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <a href="{{ route('legal.methodology') }}" class="text-white-50 text-decoration-none small footer-link">
                            {{ __('legal.methodology_title') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('legal.about') }}" class="text-white-50 text-decoration-none small footer-link">
                            {{ __('legal.about_title') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('test.index') }}" class="text-white-50 text-decoration-none small footer-link">
                            {{ __('test.start_test') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Idiomas --}}
            <div class="col-6 col-lg-2">
                <h6 class="text-white mb-3">{{ __('test.language') }}</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <a href="{{ route('lang.switch', 'es') }}" class="text-white-50 text-decoration-none small footer-link {{ app()->getLocale() == 'es' ? 'text-white fw-bold' : '' }}">
                            Español
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('lang.switch', 'ca') }}" class="text-white-50 text-decoration-none small footer-link {{ app()->getLocale() == 'ca' ? 'text-white fw-bold' : '' }}">
                            Català
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('lang.switch', 'eu') }}" class="text-white-50 text-decoration-none small footer-link {{ app()->getLocale() == 'eu' ? 'text-white fw-bold' : '' }}">
                            Euskara
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('lang.switch', 'gl') }}" class="text-white-50 text-decoration-none small footer-link {{ app()->getLocale() == 'gl' ? 'text-white fw-bold' : '' }}">
                            Galego
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Redes sociales --}}
            {{-- <div class="col-6 col-lg-2">
                <h6 class="text-white mb-3">{{ __('legal.footer_follow') }}</h6>
                <div class="d-flex gap-2">
                    <a href="https://twitter.com/afinidadpol" target="_blank" rel="noopener" 
                       class="btn btn-outline-light btn-sm" title="Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="mailto:contacto@afinidadpolitica.es" 
                       class="btn btn-outline-light btn-sm" title="Email">
                        <i class="bi bi-envelope"></i>
                    </a>
                </div>
            </div> --}}
        </div>

        {{-- Línea divisoria y disclaimer --}}
        <hr class="my-4 border-secondary">
        <div class="row">
            <div class="col-12">
                <p class="text-white-50 small text-center mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    Los resultados son orientativos y se basan en programas electorales públicos. 
                    Recomendamos consultar las fuentes oficiales de cada partido.
                </p>
            </div>
        </div>
    </div>
</footer>

{{-- Estilos del footer (añadir al CSS o en @push('styles')) --}}
<style>
    .footer {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    }
    .footer-link:hover {
        color: #fff !important;
        text-decoration: underline !important;
    }
</style>
