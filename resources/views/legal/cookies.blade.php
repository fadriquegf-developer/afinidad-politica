@extends('layouts.static')

@section('title', __('cookies.title'))

@section('static-content')
    <h1 class="mb-4"><i class="bi bi-cookie me-2"></i>{{ __('cookies.title') }}</h1>

    <p class="text-muted mb-4">{{ __('cookies.last_updated') }}: {{ date('d/m/Y') }}</p>

    <div class="legal-content">
        <h2>1. {{ __('cookies.what_are') }}</h2>
        <p>{{ __('cookies.what_are_desc') }}</p>

        <h2>2. {{ __('cookies.what_we_use') }}</h2>
        <p>{!! __('cookies.what_we_use_desc', ['site' => '<strong>Afinidad Política</strong>']) !!}</p>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('cookies.table_name') }}</th>
                        <th>{{ __('cookies.table_type') }}</th>
                        <th>{{ __('cookies.table_purpose') }}</th>
                        <th>{{ __('cookies.table_duration') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>XSRF-TOKEN</code></td>
                        <td>{{ __('cookies.type_technical') }}</td>
                        <td>{{ __('cookies.purpose_csrf') }}</td>
                        <td>{{ __('cookies.duration_session') }}</td>
                    </tr>
                    <tr>
                        <td><code>afinidadpolitica_session</code></td>
                        <td>{{ __('cookies.type_technical') }}</td>
                        <td>{{ __('cookies.purpose_session') }}</td>
                        <td>{{ __('cookies.duration_2hours') }}</td>
                    </tr>
                    <tr>
                        <td><code>locale</code></td>
                        <td>{{ __('cookies.type_technical') }}</td>
                        <td>{{ __('cookies.purpose_locale') }}</td>
                        <td>{{ __('cookies.duration_1year') }}</td>
                    </tr>
                    <tr>
                        <td><code>cookies_accepted</code></td>
                        <td>{{ __('cookies.type_technical') }}</td>
                        <td>{{ __('cookies.purpose_consent') }}</td>
                        <td>{{ __('cookies.duration_1year') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>3. {{ __('cookies.analytics_title') }}</h2>
        <p>{{ __('cookies.analytics_desc') }}</p>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('cookies.table_name') }}</th>
                        <th>{{ __('cookies.table_provider') }}</th>
                        <th>{{ __('cookies.table_purpose') }}</th>
                        <th>{{ __('cookies.table_duration') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>_ga</code></td>
                        <td>Google Analytics</td>
                        <td>{{ __('cookies.purpose_ga') }}</td>
                        <td>{{ __('cookies.duration_2years') }}</td>
                    </tr>
                    <tr>
                        <td><code>_ga_*</code></td>
                        <td>Google Analytics</td>
                        <td>{{ __('cookies.purpose_ga_session') }}</td>
                        <td>{{ __('cookies.duration_2years') }}</td>
                    </tr>
                    <tr>
                        <td><code>_gid</code></td>
                        <td>Google Analytics</td>
                        <td>{{ __('cookies.purpose_gid') }}</td>
                        <td>{{ __('cookies.duration_24hours') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="alert alert-info">
            <i class="bi bi-shield-check me-2"></i>
            <strong>{{ __('cookies.privacy_matters') }}:</strong> {{ __('cookies.privacy_note') }}
        </div>

        <h3>{{ __('cookies.change_preferences') }}</h3>
        <p>{{ __('cookies.change_preferences_desc') }}</p>
        <button type="button" class="btn btn-outline-primary" onclick="revokeCookieConsent()">
            <i class="bi bi-arrow-counterclockwise me-1"></i> {{ __('cookies.reset_button') }}
        </button>

        <h2>4. {{ __('cookies.legal_basis_title') }}</h2>
        <p>{{ __('cookies.legal_basis_desc') }}</p>
        <p>{{ __('cookies.legal_basis_transparency') }}</p>

        <h2>5. {{ __('cookies.how_to_manage') }}</h2>
        <p>{{ __('cookies.how_to_manage_desc') }}</p>

        <h3>{{ __('cookies.browser_instructions') }}</h3>
        <ul>
            <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener">Google Chrome</a></li>
            <li><a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias" target="_blank" rel="noopener">Mozilla Firefox</a></li>
            <li><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" rel="noopener">Safari</a></li>
            <li><a href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener">Microsoft Edge</a></li>
        </ul>

        <h2>6. {{ __('cookies.updates_title') }}</h2>
        <p>{{ __('cookies.updates_desc') }}</p>

        <h2>7. {{ __('cookies.contact_title') }}</h2>
        <p>{!! __('cookies.contact_desc', ['email' => '<a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a>']) !!}</p>
    </div>
@endsection

@push('styles')
    <style>
        .legal-content h2 {
            font-size: 1.3rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #333;
            border-bottom: 2px solid #667eea;
            padding-bottom: 0.5rem;
        }

        .legal-content h3 {
            font-size: 1.1rem;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            color: #555;
        }

        .legal-content code {
            background: #f8f9fa;
            padding: 2px 6px;
            border-radius: 4px;
            color: #e83e8c;
            font-size: 0.9em;
        }
    </style>
@endpush