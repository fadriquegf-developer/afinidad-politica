@extends('layouts.static')

@section('title', 'Preguntas Frecuentes - Test de Afinidad Política')

@push('schema')
    <script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "¿Es anónimo el test de afinidad política?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Sí, el test es completamente anónimo. No recopilamos ningún dato personal identificativo. Solo almacenamos las respuestas de forma agregada para generar estadísticas generales."
            }
        },
        {
            "@@type": "Question",
            "name": "¿Cómo se calculan los resultados del test?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Comparamos tus respuestas con las posiciones oficiales de cada partido político según sus programas electorales. Analizamos la coincidencia en 10 categorías temáticas y calculamos un porcentaje de afinidad con cada partido."
            }
        },
        {
            "@@type": "Question",
            "name": "¿Cuántas preguntas tiene el test político?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "El test completo tiene 56 preguntas que cubren todas las temáticas políticas relevantes. Tardarás aproximadamente 15-20 minutos en completarlo."
            }
        },
        {
            "@@type": "Question",
            "name": "¿Qué partidos políticos incluye el test?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "El test analiza los 9 principales partidos con representación parlamentaria en España: PSOE, PP, VOX, Sumar, Esquerra Republicana (ERC), Junts per Catalunya, PNV, EH Bildu y Aliança Catalana."
            }
        },
        {
            "@@type": "Question",
            "name": "¿Puedo hacer el test en catalán, euskera o gallego?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Sí, el test está disponible en los cuatro idiomas oficiales de España: castellano, catalán, euskera y gallego. Puedes cambiar el idioma en cualquier momento usando el selector de la página."
            }
        },
        {
            "@@type": "Question",
            "name": "¿Puedo compartir mis resultados?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Sí, al finalizar el test recibes un enlace único que puedes compartir en redes sociales o con amigos. También puedes usar el comparador para ver tu compatibilidad política con otras personas."
            }
        },
        {
            "@@type": "Question",
            "name": "¿Qué es la brújula política?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "La brújula política es una visualización que ubica tu posición ideológica en dos ejes: izquierda-derecha (económico) y progresista-conservador (social). Te permite ver gráficamente dónde te sitúas respecto a los partidos políticos."
            }
        },
        {
            "@@type": "Question",
            "name": "¿Este test está afiliado a algún partido político?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "No, este test es completamente independiente y neutral. No recibimos financiación de ningún partido político ni organización afín. Las preguntas están diseñadas de forma neutral sin mencionar partidos específicos."
            }
        }
    ]
}
</script>
@endpush

@section('static-content')
    <h1 class="mb-4">
        <i class="bi bi-question-circle me-2 text-primary"></i>
        Preguntas Frecuentes
    </h1>

    <p class="lead text-muted mb-5">
        Respuestas a las dudas más comunes sobre el Test de Afinidad Política.
    </p>

    <div class="accordion" id="faqAccordion">

        {{-- Pregunta 1 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    <i class="bi bi-shield-check me-2 text-success"></i>
                    ¿Es anónimo el test de afinidad política?
                </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <strong>Sí, el test es completamente anónimo.</strong> No recopilamos ningún dato personal
                    identificativo como nombre, email o dirección IP. Solo almacenamos las respuestas de forma agregada para
                    generar estadísticas generales. Puedes leer más en nuestra <a
                        href="{{ route('legal.privacy') }}">Política de Privacidad</a>.
                </div>
            </div>
        </div>

        {{-- Pregunta 2 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    <i class="bi bi-calculator me-2 text-info"></i>
                    ¿Cómo se calculan los resultados del test?
                </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Comparamos tus respuestas con las <strong>posiciones oficiales de cada partido político</strong> según
                    sus programas electorales. Analizamos la coincidencia en 10 categorías temáticas (economía, política
                    territorial, medio ambiente, inmigración, sanidad, etc.) y calculamos un porcentaje de afinidad con cada
                    partido.
                </div>
            </div>
        </div>

        {{-- Pregunta 3 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    <i class="bi bi-list-ol me-2 text-warning"></i>
                    ¿Cuántas preguntas tiene el test político?
                </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    El test tiene <strong>56 preguntas</strong> que cubren todas las temáticas políticas relevantes:
                    economía, sanidad, educación, medio ambiente, inmigración, política territorial, y más. Tardarás
                    aproximadamente <strong>15-20 minutos</strong> en completarlo.
                </div>
            </div>
        </div>

        {{-- Pregunta 4 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                    <i class="bi bi-flag me-2 text-danger"></i>
                    ¿Qué partidos políticos incluye el test?
                </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    El test analiza los <strong>9 principales partidos con representación parlamentaria</strong> en España:
                    PSOE, PP, VOX, Sumar, Esquerra Republicana (ERC), Junts per Catalunya, PNV, EH Bildu y Aliança Catalana.
                </div>
            </div>
        </div>

        {{-- Pregunta 5 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                    <i class="bi bi-translate me-2 text-primary"></i>
                    ¿Puedo hacer el test en catalán, euskera o gallego?
                </button>
            </h2>
            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <strong>Sí</strong>, el test está disponible en los cuatro idiomas oficiales de España:
                    🇪🇸 Castellano, 🏴 Català, 🏴 Euskara y 🏴 Galego.
                    Puedes cambiar el idioma en cualquier momento usando el selector de la parte superior.
                </div>
            </div>
        </div>

        {{-- Pregunta 6 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                    <i class="bi bi-share me-2 text-success"></i>
                    ¿Puedo compartir mis resultados?
                </button>
            </h2>
            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <strong>Sí</strong>, al finalizar recibes un enlace único que puedes compartir en redes sociales o
                    enviar a amigos. También puedes usar el <strong>comparador</strong> para ver tu compatibilidad política
                    con otras personas.
                </div>
            </div>
        </div>

        {{-- Pregunta 7 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                    <i class="bi bi-compass me-2 text-info"></i>
                    ¿Qué es la brújula política?
                </button>
            </h2>
            <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    La <strong>brújula política</strong> es una visualización que ubica tu posición ideológica en dos ejes:
                    <ul class="mt-2">
                        <li><strong>Eje horizontal:</strong> Izquierda - Derecha (aspectos económicos)</li>
                        <li><strong>Eje vertical:</strong> Progresista - Conservador (aspectos sociales)</li>
                    </ul>
                    Te permite ver gráficamente dónde te sitúas respecto a los partidos políticos españoles.
                </div>
            </div>
        </div>

        {{-- Pregunta 8 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8">
                    <i class="bi bi-bank me-2 text-secondary"></i>
                    ¿Este test está afiliado a algún partido político?
                </button>
            </h2>
            <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <strong>No</strong>, este test es completamente independiente y neutral. No recibimos financiación de
                    ningún partido político ni organización afín. Las preguntas están diseñadas de forma neutral sin
                    mencionar partidos específicos. Nuestro objetivo es proporcionar una herramienta educativa para los
                    ciudadanos.
                </div>
            </div>
        </div>

    </div>

    {{-- CTA --}}
    <div class="text-center mt-5 p-4 bg-light rounded">
        <h4>¿Listo para descubrir tu afinidad política?</h4>
        <p class="text-muted">56 preguntas · 15-20 minutos · 100% anónimo</p>
        <a href="{{ route('test.index') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-play-fill me-2"></i>Hacer el Test
        </a>
    </div>
@endsection
