@extends('layouts.static')

@section('title', __('legal.cookies_title'))

@section('static-content')
    <h1 class="mb-4"><i class="bi bi-cookie me-2"></i>{{ __('legal.cookies_title') }}</h1>

    <p class="text-muted mb-4">{{ __('legal.last_updated') }}: {{ date('d/m/Y') }}</p>

    <div class="legal-content">
        <h2>1. ¿Qué son las cookies?</h2>
        <p>Las cookies son pequeños archivos de texto que los sitios web almacenan en tu dispositivo (ordenador, tablet,
            móvil) cuando los visitas. Sirven para recordar tus preferencias, mantener tu sesión activa y mejorar tu
            experiencia de navegación.</p>

        <h2>2. ¿Qué cookies utilizamos?</h2>
        <p>En <strong>Afinidad Política</strong> utilizamos únicamente <strong>cookies técnicas esenciales</strong>, que son
            estrictamente necesarias para el funcionamiento del sitio:</p>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Finalidad</th>
                        <th>Duración</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>XSRF-TOKEN</code></td>
                        <td>Técnica</td>
                        <td>Seguridad - Prevención de ataques CSRF</td>
                        <td>Sesión</td>
                    </tr>
                    <tr>
                        <td><code>afinidadpolitica_session</code></td>
                        <td>Técnica</td>
                        <td>Mantener tu progreso en el test</td>
                        <td>2 horas</td>
                    </tr>
                    <tr>
                        <td><code>locale</code></td>
                        <td>Técnica</td>
                        <td>Recordar tu preferencia de idioma</td>
                        <td>1 año</td>
                    </tr>
                    <tr>
                        <td><code>cookies_accepted</code></td>
                        <td>Técnica</td>
                        <td>Recordar que aceptaste las cookies</td>
                        <td>1 año</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>3. Cookies de análisis (opcionales)</h2>
        <p>Si aceptas todas las cookies, utilizamos Google Analytics para entender cómo los usuarios interactúan con nuestro
            sitio:</p>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Proveedor</th>
                        <th>Finalidad</th>
                        <th>Duración</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>_ga</code></td>
                        <td>Google Analytics</td>
                        <td>Distinguir usuarios únicos</td>
                        <td>2 años</td>
                    </tr>
                    <tr>
                        <td><code>_ga_*</code></td>
                        <td>Google Analytics</td>
                        <td>Mantener el estado de la sesión</td>
                        <td>2 años</td>
                    </tr>
                    <tr>
                        <td><code>_gid</code></td>
                        <td>Google Analytics</td>
                        <td>Distinguir usuarios</td>
                        <td>24 horas</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="alert alert-info">
            <i class="bi bi-shield-check me-2"></i>
            <strong>Tu privacidad importa:</strong> Hemos configurado Google Analytics con anonimización de IP, por lo que
            no almacenamos tu dirección IP completa.
        </div>

        <h3>Cambiar tu preferencia</h3>
        <p>Puedes cambiar tu preferencia de cookies en cualquier momento:</p>
        <button type="button" class="btn btn-outline-primary" onclick="revokeCookieConsent()">
            <i class="bi bi-arrow-counterclockwise me-1"></i> Restablecer preferencias de cookies
        </button>

        <h2>4. Base legal</h2>
        <p>Las cookies técnicas esenciales están exentas del requisito de consentimiento según el artículo 22.2 de la LSSI y
            el considerando 32 del RGPD, ya que son estrictamente necesarias para proporcionar el servicio solicitado por el
            usuario.</p>
        <p>No obstante, te informamos de su uso para total transparencia.</p>

        <h2>5. ¿Cómo gestionar las cookies?</h2>
        <p>Puedes configurar tu navegador para rechazar cookies. Sin embargo, esto podría afectar al funcionamiento del test
            (por ejemplo, no se guardaría tu progreso).</p>

        <h3>Instrucciones por navegador:</h3>
        <ul>
            <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener">Google Chrome</a>
            </li>
            <li><a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias"
                    target="_blank" rel="noopener">Mozilla Firefox</a></li>
            <li><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank"
                    rel="noopener">Safari</a></li>
            <li><a href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09"
                    target="_blank" rel="noopener">Microsoft Edge</a></li>
        </ul>

        <h2>6. Actualizaciones</h2>
        <p>Esta política puede actualizarse si añadimos nuevas funcionalidades. Cualquier cambio será reflejado en esta
            página.</p>

        <h2>7. Contacto</h2>
        <p>Para cualquier duda sobre nuestra política de cookies, contacta con nosotros en <a
                href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a>.</p>
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
