@extends('layouts.static')

@section('title', __('legal.privacy_title'))

@section('static-content')
    <h1 class="mb-4"><i class="bi bi-shield-check me-2"></i>{{ __('legal.privacy_title') }}</h1>
    
    <p class="text-muted mb-4">{{ __('legal.last_updated') }}: {{ date('d/m/Y') }}</p>

    <div class="legal-content">
        <h2>1. Responsable del tratamiento</h2>
        <p>
            <strong>Titular:</strong> Fadrique Garcia Font<br>
            <strong>NIF/CIF:</strong> 41572677Q<br>
            <strong>Dirección:</strong> Carrer Alfabeguera 12<br>
            <strong>Email:</strong> <a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a>
        </p>

        <h2>2. Datos que recopilamos</h2>
        <p>En <strong>Afinidad Política</strong> nos tomamos muy en serio tu privacidad. Por eso, hemos diseñado nuestro test para recopilar la mínima cantidad de datos posible:</p>
        
        <h3>2.1. Datos que NO recopilamos</h3>
        <ul>
            <li>Nombre, apellidos o cualquier dato identificativo personal</li>
            <li>Dirección de correo electrónico (salvo que nos contactes voluntariamente)</li>
            <li>Número de teléfono</li>
            <li>Dirección postal</li>
            <li>Datos de pago o financieros</li>
        </ul>

        <h3>2.2. Datos que SÍ recopilamos</h3>
        <ul>
            <li><strong>Respuestas al test:</strong> Tus respuestas se almacenan de forma anónima para calcular tus resultados.</li>
            <li><strong>Hash de IP:</strong> Almacenamos un hash (versión encriptada e irreversible) de tu dirección IP únicamente para prevenir abusos y generar estadísticas agregadas por región.</li>
            <li><strong>Datos de sesión:</strong> Utilizamos cookies técnicas para mantener tu progreso en el test.</li>
            <li><strong>Región aproximada:</strong> Derivada del hash de IP para mostrar estadísticas por comunidad autónoma.</li>
        </ul>

        <h2>3. Finalidad del tratamiento</h2>
        <p>Los datos recopilados se utilizan exclusivamente para:</p>
        <ul>
            <li>Proporcionar los resultados del test de afinidad política</li>
            <li>Permitir la comparación de resultados entre usuarios (mediante código anónimo)</li>
            <li>Generar estadísticas agregadas y anónimas sobre tendencias políticas</li>
            <li>Mejorar el funcionamiento de la plataforma</li>
        </ul>

        <h2>4. Base legal del tratamiento</h2>
        <p>El tratamiento de datos se realiza en base a:</p>
        <ul>
            <li><strong>Consentimiento:</strong> Al iniciar el test, aceptas expresamente esta política de privacidad.</li>
            <li><strong>Interés legítimo:</strong> Para la prevención de fraude y abusos en la plataforma.</li>
        </ul>

        <h2>5. Tiempo de conservación</h2>
        <p>Los datos del test se conservan durante <strong>12 meses</strong> desde su realización, tras lo cual se eliminan automáticamente. Las estadísticas agregadas (que no permiten identificar a ningún usuario) pueden conservarse indefinidamente.</p>

        <h2>6. Destinatarios de los datos</h2>
        <p>Tus datos NO se ceden a terceros, salvo obligación legal. Utilizamos los siguientes servicios técnicos:</p>
        <ul>
            <li><strong>Servidor de hosting:</strong> [NOMBRE DEL PROVEEDOR] ubicado en la Unión Europea.</li>
        </ul>

        <h2>7. Tus derechos</h2>
        <p>Conforme al RGPD, tienes derecho a:</p>
        <ul>
            <li><strong>Acceso:</strong> Conocer qué datos tenemos sobre ti.</li>
            <li><strong>Rectificación:</strong> Corregir datos inexactos.</li>
            <li><strong>Supresión:</strong> Solicitar la eliminación de tus datos.</li>
            <li><strong>Limitación:</strong> Solicitar que limitemos el tratamiento.</li>
            <li><strong>Portabilidad:</strong> Recibir tus datos en formato estructurado.</li>
            <li><strong>Oposición:</strong> Oponerte al tratamiento de tus datos.</li>
        </ul>
        <p>Dado el carácter anónimo de los datos, puede que no sea posible identificar tus respuestas específicas. Si deseas ejercer tus derechos, contacta con nosotros en <a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a>.</p>

        <h2>8. Seguridad</h2>
        <p>Implementamos medidas técnicas y organizativas para proteger tus datos:</p>
        <ul>
            <li>Conexión cifrada mediante HTTPS/SSL</li>
            <li>Hash irreversible de direcciones IP</li>
            <li>Acceso restringido a la base de datos</li>
            <li>Copias de seguridad periódicas</li>
        </ul>

        <h2>9. Menores de edad</h2>
        <p>Este test está dirigido a mayores de 16 años. No recopilamos conscientemente datos de menores de esta edad.</p>

        <h2>10. Cambios en esta política</h2>
        <p>Nos reservamos el derecho de modificar esta política. Cualquier cambio será publicado en esta página con la fecha de actualización.</p>

        <h2>11. Contacto y reclamaciones</h2>
        <p>Para cualquier consulta sobre privacidad, contacta con nosotros en <a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a>.</p>
        <p>También puedes presentar una reclamación ante la <a href="https://www.aepd.es" target="_blank" rel="noopener">Agencia Española de Protección de Datos (AEPD)</a>.</p>
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
</style>
@endpush
