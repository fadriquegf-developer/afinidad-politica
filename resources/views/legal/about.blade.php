@extends('layouts.static')

@section('title', __('legal.about_title'))

@section('static-content')
    <h1 class="mb-4"><i class="bi bi-people me-2"></i>{{ __('legal.about_title') }}</h1>

    <div class="about-content">
        
        {{-- Misión --}}
        <div class="text-center mb-5">
            <div class="display-1 mb-3">🗳️</div>
            <h2 class="h3">Nuestra misión</h2>
            <p class="lead">Ayudar a los ciudadanos españoles a tomar decisiones informadas sobre su voto, proporcionando una herramienta neutral y accesible para conocer su afinidad política.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 bg-light h-100">
                    <div class="display-4 mb-3">🎯</div>
                    <h3 class="h5">Neutralidad</h3>
                    <p class="mb-0 text-muted">No favorecemos a ningún partido. Nuestro único interés es proporcionar información objetiva.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 bg-light h-100">
                    <div class="display-4 mb-3">🔒</div>
                    <h3 class="h5">Privacidad</h3>
                    <p class="mb-0 text-muted">Tus respuestas son anónimas. No recopilamos datos personales ni vendemos información.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 bg-light h-100">
                    <div class="display-4 mb-3">📖</div>
                    <h3 class="h5">Transparencia</h3>
                    <p class="mb-0 text-muted">Explicamos nuestra metodología y fuentes. Queremos que entiendas cómo funciona.</p>
                </div>
            </div>
        </div>

        <h2>¿Por qué creamos este test?</h2>
        <p>En un panorama político cada vez más complejo, con múltiples partidos y posiciones que a veces se solapan, creemos que los ciudadanos merecen herramientas que les ayuden a entender mejor dónde se sitúan ideológicamente.</p>
        <p>Este proyecto nació de la frustración con tests políticos existentes que:</p>
        <ul>
            <li>Estaban sesgados hacia determinadas ideologías</li>
            <li>No incluían partidos autonómicos relevantes</li>
            <li>No estaban adaptados a la realidad política española</li>
            <li>Recopilaban datos personales innecesarios</li>
        </ul>

        <h2>¿Quiénes somos?</h2>
        <p>Somos un equipo independiente de desarrolladores y analistas políticos interesados en fomentar la participación ciudadana y el voto informado.</p>
        
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Independencia:</strong> No tenemos afiliación con ningún partido político, medio de comunicación, think tank ni organización gubernamental. Este proyecto se autofinancia sin aceptar donaciones de entidades políticas.
        </div>

        <h2>Nuestros principios</h2>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="me-3 text-success fs-4">✓</span>
                    <div>
                        <strong>Basado en datos</strong>
                        <p class="mb-0 text-muted small">Todas las posiciones se extraen de programas electorales públicos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="me-3 text-success fs-4">✓</span>
                    <div>
                        <strong>Gratuito para siempre</strong>
                        <p class="mb-0 text-muted small">Sin suscripciones, sin pagos, sin publicidad</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="me-3 text-success fs-4">✓</span>
                    <div>
                        <strong>Multilingüe</strong>
                        <p class="mb-0 text-muted small">Disponible en castellano, catalán, euskera y gallego</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="me-3 text-success fs-4">✓</span>
                    <div>
                        <strong>En constante mejora</strong>
                        <p class="mb-0 text-muted small">Actualizamos preguntas y posiciones regularmente</p>
                    </div>
                </div>
            </div>
        </div>

        <h2>Contacto</h2>
        <p>¿Tienes preguntas, sugerencias o has detectado algún error? Nos encantaría escucharte:</p>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 rounded-3 border h-100">
                    <h5><i class="bi bi-envelope me-2"></i>Email</h5>
                    <p class="mb-0">
                        <a href="mailto:contacto@afinidadpolitica.es" class="text-decoration-none">
                            contacto@afinidadpolitica.es
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <h2 class="mt-5">Agradecimientos</h2>
        <p>Este proyecto no sería posible sin:</p>
        <ul>
            <li>Los usuarios que nos envían correcciones y sugerencias</li>
            <li>La comunidad de código abierto</li>
            <li>Los partidos políticos que publican sus programas de forma accesible</li>
        </ul>
    </div>
@endsection

@push('styles')
<style>
    .about-content h2 {
        font-size: 1.3rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #333;
        border-bottom: 2px solid #667eea;
        padding-bottom: 0.5rem;
    }
</style>
@endpush
