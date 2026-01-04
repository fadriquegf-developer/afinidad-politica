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
                    {{ __('footer.independent') }}
                </p>
                <p class="text-white-50 small mb-0">
                    © {{ date('Y') }} {{ config('app.name') }}. {{ __('footer.rights') }}
                </p>
            </div>

            {{-- Enlaces legales --}}
            <div class="col-6 col-lg-2">
                <h6 class="text-white mb-3">{{ __('footer.legal') }}</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <a href="{{ route('legal.privacy') }}"
                            class="text-white-50 text-decoration-none small footer-link">
                            {{ __('footer.privacy') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('legal.notice') }}"
                            class="text-white-50 text-decoration-none small footer-link">
                            {{ __('footer.legal_notice') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('legal.cookies') }}"
                            class="text-white-50 text-decoration-none small footer-link">
                            {{ __('footer.cookies') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Enlaces informativos --}}
            <div class="col-6 col-lg-2">
                <h6 class="text-white mb-3">{{ __('footer.info') }}</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <a href="{{ route('legal.methodology') }}"
                            class="text-white-50 text-decoration-none small footer-link">
                            {{ __('footer.methodology') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('legal.about') }}"
                            class="text-white-50 text-decoration-none small footer-link">
                            {{ __('footer.about') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('legal.faq') }}"
                            class="text-white-50 text-decoration-none small footer-link">
                            {{ __('footer.faq') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('test.index') }}"
                            class="text-white-50 text-decoration-none small footer-link">
                            {{ __('footer.start_test') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Idiomas --}}
            <div class="col-6 col-lg-2">
                <h6 class="text-white mb-3">{{ __('footer.language') }}</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <a href="{{ route('lang.switch', 'es') }}"
                            class="text-white-50 text-decoration-none small footer-link {{ app()->getLocale() == 'es' ? 'text-white fw-bold' : '' }}">
                            {{ __('footer.lang_es') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('lang.switch', 'ca') }}"
                            class="text-white-50 text-decoration-none small footer-link {{ app()->getLocale() == 'ca' ? 'text-white fw-bold' : '' }}">
                            {{ __('footer.lang_ca') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('lang.switch', 'eu') }}"
                            class="text-white-50 text-decoration-none small footer-link {{ app()->getLocale() == 'eu' ? 'text-white fw-bold' : '' }}">
                            {{ __('footer.lang_eu') }}
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('lang.switch', 'gl') }}"
                            class="text-white-50 text-decoration-none small footer-link {{ app()->getLocale() == 'gl' ? 'text-white fw-bold' : '' }}">
                            {{ __('footer.lang_gl') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Redes sociales --}}
            {{-- <div class="col-6 col-lg-2">
                <h6 class="text-white mb-3">{{ __('footer.follow') }}</h6>
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
                    {{ __('footer.disclaimer') }}
                </p>
            </div>
        </div>
    </div>
</footer>

{{-- Estilos del footer --}}
<style>
    .footer {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    }

    .footer-link:hover {
        color: #fff !important;
        text-decoration: underline !important;
    }
</style>
