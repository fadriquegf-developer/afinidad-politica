@extends('layouts.static')

@section('title', __('legal.methodology_title'))

@section('static-content')
    <h1 class="mb-4"><i class="bi bi-graph-up me-2"></i>{{ __('legal.methodology_title') }}</h1>

    <p class="lead mb-4">Transparencia total: así calculamos tu afinidad política.</p>

    <div class="methodology-content">
        
        {{-- Resumen visual --}}
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="text-center p-3 rounded-3 bg-light h-100">
                    <div class="display-4 mb-2">📝</div>
                    <h5>56 Preguntas</h5>
                    <small class="text-muted">En 14 categorías temáticas</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 rounded-3 bg-light h-100">
                    <div class="display-4 mb-2">🏛️</div>
                    <h5>9 Partidos</h5>
                    <small class="text-muted">Nacionales y autonómicos</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 rounded-3 bg-light h-100">
                    <div class="display-4 mb-2">📊</div>
                    <h5>504 Posiciones</h5>
                    <small class="text-muted">Analizadas de programas electorales</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 rounded-3 bg-light h-100">
                    <div class="display-4 mb-2">🎯</div>
                    <h5>100% Neutral</h5>
                    <small class="text-muted">Sin sesgos partidistas</small>
                </div>
            </div>
        </div>

        <h2>1. Fuentes de información</h2>
        <p>Las posiciones de los partidos se han extraído exclusivamente de <strong>fuentes oficiales y públicas</strong>:</p>
        <ul>
            <li>Programas electorales de las elecciones generales de 2023</li>
            <li>Documentos programáticos publicados en las webs oficiales de los partidos</li>
            <li>Votaciones parlamentarias públicas</li>
            <li>Declaraciones oficiales en ruedas de prensa</li>
        </ul>
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Importante:</strong> Los partidos pueden modificar sus posiciones con el tiempo. Actualizamos periódicamente la base de datos, pero recomendamos consultar siempre las fuentes oficiales.
        </div>

        <h2>2. Diseño de preguntas</h2>
        <p>Cada pregunta del test cumple estos criterios:</p>
        <ul>
            <li><strong>Neutralidad:</strong> No menciona partidos ni figuras políticas</li>
            <li><strong>Claridad:</strong> Lenguaje accesible, sin tecnicismos</li>
            <li><strong>Relevancia:</strong> Temas de debate político actual en España</li>
            <li><strong>Diferenciación:</strong> Permite distinguir posiciones entre partidos</li>
        </ul>

        <h3>Escala de respuesta</h3>
        <p>Utilizamos una escala Likert de 5 puntos:</p>
        <div class="row g-2 mb-4">
            <div class="col text-center">
                <div class="p-2 rounded bg-danger text-white">1</div>
                <small>Muy en desacuerdo</small>
            </div>
            <div class="col text-center">
                <div class="p-2 rounded bg-warning">2</div>
                <small>En desacuerdo</small>
            </div>
            <div class="col text-center">
                <div class="p-2 rounded bg-secondary text-white">3</div>
                <small>Neutral</small>
            </div>
            <div class="col text-center">
                <div class="p-2 rounded bg-info text-white">4</div>
                <small>De acuerdo</small>
            </div>
            <div class="col text-center">
                <div class="p-2 rounded bg-success text-white">5</div>
                <small>Muy de acuerdo</small>
            </div>
        </div>

        <h2>3. Posiciones de los partidos</h2>
        <p>Para cada pregunta, se asigna una posición (1-5) a cada partido basándose en su programa electoral. Además, cada posición tiene un <strong>peso de confianza</strong>:</p>
        <ul>
            <li><strong>Peso 3 (Alto):</strong> Posición explícita en el programa electoral</li>
            <li><strong>Peso 2 (Medio):</strong> Posición inferida de votaciones o declaraciones</li>
            <li><strong>Peso 1 (Bajo):</strong> Posición estimada por contexto ideológico</li>
        </ul>

        <h2>4. Algoritmo de cálculo</h2>
        <p>La afinidad con cada partido se calcula mediante la siguiente fórmula:</p>
        
        <div class="bg-light p-4 rounded-3 mb-4">
            <p class="mb-2"><strong>Para cada pregunta respondida:</strong></p>
            <code>diferencia = |tu_respuesta - posición_partido|</code><br>
            <code>puntuación = (4 - diferencia) × peso_confianza</code>
            
            <p class="mt-3 mb-2"><strong>Afinidad total:</strong></p>
            <code>afinidad = (suma_puntuaciones / puntuación_máxima_posible) × 100</code>
        </div>

        <p><strong>Ejemplo:</strong></p>
        <ul>
            <li>Tu respuesta: 4 (De acuerdo)</li>
            <li>Posición del partido X: 5 (Muy de acuerdo)</li>
            <li>Peso de confianza: 3</li>
            <li>Diferencia: |4 - 5| = 1</li>
            <li>Puntuación: (4 - 1) × 3 = 9 puntos</li>
            <li>Máximo posible: 4 × 3 = 12 puntos</li>
        </ul>

        <h2>5. Brújula política</h2>
        <p>La brújula política ubica tu posición en dos ejes:</p>
        
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="p-3 rounded-3 border h-100">
                    <h5>↔️ Eje Económico</h5>
                    <p class="mb-0">
                        <strong>Izquierda:</strong> Mayor intervención estatal, redistribución, servicios públicos<br>
                        <strong>Derecha:</strong> Libre mercado, menor fiscalidad, iniciativa privada
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 rounded-3 border h-100">
                    <h5>↕️ Eje Social</h5>
                    <p class="mb-0">
                        <strong>Progresista:</strong> Derechos individuales, diversidad, cambio social<br>
                        <strong>Conservador:</strong> Tradición, valores clásicos, orden social
                    </p>
                </div>
            </div>
        </div>

        <p>Las categorías del test se agrupan así para calcular tu posición:</p>
        <ul>
            <li><strong>Eje económico:</strong> Economía, Fiscalidad, Empleo, Vivienda, Pensiones</li>
            <li><strong>Eje social:</strong> Inmigración, Seguridad, Educación, Sanidad, Medio ambiente, Igualdad</li>
        </ul>

        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Nota:</strong> La brújula no captura todas las dimensiones políticas, como el eje territorial (centralismo vs. autonomismo), muy relevante en España.
        </div>

        <h2>6. Limitaciones</h2>
        <p>Queremos ser transparentes sobre las limitaciones de este test:</p>
        <ul>
            <li>No puede capturar todos los matices de la política</li>
            <li>Las posiciones de los partidos pueden simplificarse</li>
            <li>Los programas electorales no siempre reflejan la acción de gobierno</li>
            <li>Algunas preguntas pueden ser más discriminantes que otras</li>
            <li>El test no considera el historial de cumplimiento de promesas</li>
        </ul>

        <h2>7. Código abierto</h2>
        <p>En aras de la transparencia, estamos trabajando para publicar:</p>
        <ul>
            <li>La lista completa de preguntas y sus categorías</li>
            <li>Las posiciones asignadas a cada partido con sus fuentes</li>
            <li>El algoritmo de cálculo detallado</li>
        </ul>

        <h2>8. Contacto y correcciones</h2>
        <p>Si detectas algún error en las posiciones de los partidos o tienes sugerencias para mejorar la metodología, contacta con nosotros en <a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a>.</p>
        <p>Valoramos especialmente los comentarios que incluyan fuentes verificables.</p>
    </div>
@endsection

@push('styles')
<style>
    .methodology-content h2 {
        font-size: 1.3rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #333;
        border-bottom: 2px solid #667eea;
        padding-bottom: 0.5rem;
    }
    .methodology-content h3 {
        font-size: 1.1rem;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        color: #555;
    }
    .methodology-content code {
        background: #fff;
        padding: 4px 8px;
        border-radius: 4px;
        color: #e83e8c;
        display: inline-block;
        margin: 2px 0;
    }
</style>
@endpush
