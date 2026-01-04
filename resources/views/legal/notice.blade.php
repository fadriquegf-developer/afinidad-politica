@extends('layouts.static')

@section('title', __('legal.legal_notice_title'))

@section('static-content')
    <h1 class="mb-4"><i class="bi bi-file-text me-2"></i>{{ __('legal.legal_notice_title') }}</h1>
    
    <p class="text-muted mb-4">{{ __('legal.last_updated') }}: {{ date('d/m/Y') }}</p>

    <div class="legal-content">
        <h2>1. Datos identificativos</h2>
        <p>En cumplimiento del artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y Comercio Electrónico (LSSI-CE), se informa:</p>
        
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Titular</th>
                    <td>Fadrique Garcia Font</td>
                </tr>
                <tr>
                    <th>NIF/CIF</th>
                    <td>41572677Q</td>
                </tr>
                <tr>
                    <th>Domicilio</th>
                    <td>Carrer Alfabeguera 12</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a></td>
                </tr>
                <tr>
                    <th>Sitio web</th>
                    <td><a href="https://afinidadpolitica.es">https://afinidadpolitica.es</a></td>
                </tr>
            </tbody>
        </table>

        <h2>2. Objeto del sitio web</h2>
        <p><strong>Afinidad Política</strong> es una plataforma web de carácter informativo y educativo que permite a los usuarios conocer su afinidad ideológica con los principales partidos políticos españoles mediante un cuestionario anónimo.</p>
        
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Importante:</strong> Este sitio web NO tiene afiliación con ningún partido político, organización gubernamental ni grupo de interés. Su único objetivo es proporcionar información objetiva basada en los programas electorales públicos de los partidos.
        </div>

        <h2>3. Propiedad intelectual</h2>
        <p>Todos los contenidos del sitio web, incluyendo textos, imágenes, diseño gráfico, código fuente, logotipos y demás elementos, son propiedad del titular o se utilizan con la debida autorización.</p>
        <p>Queda prohibida la reproducción, distribución o transformación de estos contenidos sin autorización expresa, salvo para uso personal y privado.</p>
        <p>Las marcas y logotipos de los partidos políticos mostrados pertenecen a sus respectivos titulares y se utilizan únicamente con fines informativos.</p>

        <h2>4. Responsabilidad</h2>
        <h3>4.1. Sobre los resultados del test</h3>
        <p>Los resultados del test son meramente orientativos y se basan en el análisis de los programas electorales públicos. El titular:</p>
        <ul>
            <li>No garantiza la exactitud absoluta de los resultados</li>
            <li>No se hace responsable de las decisiones que los usuarios tomen basándose en dichos resultados</li>
            <li>Recomienda contrastar la información con fuentes oficiales de los partidos</li>
        </ul>

        <h3>4.2. Sobre el funcionamiento</h3>
        <p>El titular no garantiza la disponibilidad permanente del servicio y no será responsable de:</p>
        <ul>
            <li>Interrupciones del servicio por mantenimiento o causas técnicas</li>
            <li>Daños derivados de virus o elementos lesivos</li>
            <li>Uso indebido de la plataforma por parte de los usuarios</li>
        </ul>

        <h2>5. Enlaces externos</h2>
        <p>Este sitio puede contener enlaces a páginas web de terceros (partidos políticos, medios de comunicación, etc.). El titular no se hace responsable del contenido de dichas páginas externas.</p>

        <h2>6. Neutralidad política</h2>
        <p>Este sitio web mantiene una estricta neutralidad política:</p>
        <ul>
            <li>No promociona ni favorece a ningún partido político</li>
            <li>Las preguntas del test están diseñadas de forma neutral</li>
            <li>Los algoritmos de cálculo tratan a todos los partidos por igual</li>
            <li>No se acepta financiación de partidos políticos ni organizaciones afines</li>
        </ul>

        <h2>7. Condiciones de uso</h2>
        <p>Al utilizar este sitio web, el usuario se compromete a:</p>
        <ul>
            <li>Hacer un uso lícito y de buena fe de la plataforma</li>
            <li>No realizar acciones que puedan dañar, inutilizar o sobrecargar el sitio</li>
            <li>No intentar acceder a áreas restringidas o manipular los sistemas</li>
            <li>No utilizar los resultados con fines difamatorios o de manipulación</li>
        </ul>

        <h2>8. Legislación aplicable</h2>
        <p>Este aviso legal se rige por la legislación española. Para cualquier controversia, las partes se someten a los Juzgados y Tribunales de [TU CIUDAD], con renuncia expresa a cualquier otro fuero.</p>

        <h2>9. Modificaciones</h2>
        <p>El titular se reserva el derecho de modificar el presente aviso legal para adaptarlo a novedades legislativas o cambios en la actividad del sitio.</p>
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
    .legal-content ul {
        margin-bottom: 1rem;
    }
    .legal-content li {
        margin-bottom: 0.5rem;
    }
    .legal-content .table th {
        width: 150px;
        background: #f8f9fa;
    }
</style>
@endpush
