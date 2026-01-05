<?php

return [
    // Título y subtítulo
    'title' => 'Metodología',
    'subtitle' => 'Transparencia total: así calculamos tu afinidad política.',

    // Resumen visual
    'summary_questions' => '56 Preguntas',
    'summary_questions_desc' => 'En 14 categorías temáticas',
    'summary_parties' => '9 Partidos',
    'summary_parties_desc' => 'Nacionales y autonómicos',
    'summary_positions' => '504 Posiciones',
    'summary_positions_desc' => 'Analizadas de programas electorales',
    'summary_neutral' => '100% Neutral',
    'summary_neutral_desc' => 'Sin sesgos partidistas',

    // Sección 1: Fuentes
    'sources_title' => 'Fuentes de información',
    'sources_intro' => 'Las posiciones de los partidos se han extraído exclusivamente de <strong>fuentes oficiales y públicas</strong>:',
    'sources_programs' => 'Programas electorales de las elecciones generales de 2023',
    'sources_documents' => 'Documentos programáticos publicados en las webs oficiales de los partidos',
    'sources_votes' => 'Votaciones parlamentarias públicas',
    'sources_declarations' => 'Declaraciones oficiales en ruedas de prensa',
    'important' => 'Importante',
    'sources_warning' => 'Los partidos pueden modificar sus posiciones con el tiempo. Actualizamos periódicamente la base de datos, pero recomendamos consultar siempre las fuentes oficiales.',

    // Sección 2: Diseño de preguntas
    'questions_title' => 'Diseño de preguntas',
    'questions_intro' => 'Cada pregunta del test cumple estos criterios:',
    'questions_neutrality' => 'Neutralidad',
    'questions_neutrality_desc' => 'No menciona partidos ni figuras políticas',
    'questions_clarity' => 'Claridad',
    'questions_clarity_desc' => 'Lenguaje accesible, sin tecnicismos',
    'questions_relevance' => 'Relevancia',
    'questions_relevance_desc' => 'Temas de debate político actual en España',
    'questions_differentiation' => 'Diferenciación',
    'questions_differentiation_desc' => 'Permite distinguir posiciones entre partidos',

    // Escala
    'scale_title' => 'Escala de respuesta',
    'scale_intro' => 'Utilizamos una escala Likert de 5 puntos:',
    'scale_1' => 'Muy en desacuerdo',
    'scale_2' => 'En desacuerdo',
    'scale_3' => 'Neutral',
    'scale_4' => 'De acuerdo',
    'scale_5' => 'Muy de acuerdo',

    // Sección 3: Posiciones
    'positions_title' => 'Posiciones de los partidos',
    'positions_intro' => 'Para cada pregunta, se asigna una posición (1-5) a cada partido basándose en su programa electoral. Además, cada posición tiene un <strong>peso de confianza</strong>:',
    'weight_high' => 'Peso 3 (Alto)',
    'weight_high_desc' => 'Posición explícita en el programa electoral',
    'weight_medium' => 'Peso 2 (Medio)',
    'weight_medium_desc' => 'Posición inferida de votaciones o declaraciones',
    'weight_low' => 'Peso 1 (Bajo)',
    'weight_low_desc' => 'Posición estimada por contexto ideológico',

    // Sección 4: Algoritmo
    'algorithm_title' => 'Algoritmo de cálculo',
    'algorithm_intro' => 'La afinidad con cada partido se calcula mediante un algoritmo avanzado que tiene en cuenta tres factores:',
    'algorithm_factors' => '<ul>
        <li><strong>Escala cuadrática:</strong> Las grandes diferencias de opinión se penalizan más que las pequeñas</li>
        <li><strong>Factor de convicción:</strong> Las opiniones fuertes (muy de acuerdo/muy en desacuerdo) tienen más peso que las moderadas</li>
        <li><strong>Reducción de neutrales:</strong> Las respuestas "neutral" tienen menos impacto en el resultado final</li>
    </ul>',
    'algorithm_per_question' => 'Para cada pregunta respondida:',
    'algorithm_difference' => 'diferencia = |tu_respuesta - posición_partido|',
    'algorithm_score' => 'puntuación_base = (4 - diferencia)²',
    'algorithm_conviction' => 'factor_convicción = 0.5 + (distancia_del_centro × 0.25)',
    'algorithm_weight' => 'peso_total = peso_confianza × importancia × factor_convicción',
    'algorithm_total' => 'Afinidad total:',
    'algorithm_affinity' => 'afinidad = (suma_puntuaciones / puntuación_máxima_posible) × 100',

    'conviction_title' => 'Factor de convicción',
    'conviction_intro' => 'Tus opiniones más firmes tienen más peso en el resultado:',
    'conviction_extreme' => 'Muy de acuerdo / Muy en desacuerdo → Factor 1.0 (máximo peso)',
    'conviction_moderate' => 'De acuerdo / En desacuerdo → Factor 0.75',
    'conviction_neutral' => 'Neutral → Factor 0.5 (menor peso)',

    'example' => 'Ejemplo',
    'example_your_answer' => 'Tu respuesta: 5 (Muy de acuerdo)',
    'example_party_position' => 'Posición del partido X: 4 (De acuerdo)',
    'example_weight' => 'Peso de confianza: 3, Importancia: 4',
    'example_difference' => 'Diferencia: |5 - 4| = 1',
    'example_base_score' => 'Puntuación base: (4 - 1)² = 9',
    'example_conviction' => 'Factor convicción: 0.5 + (2 × 0.25) = 1.0',
    'example_total_weight' => 'Peso total: 3 × 4 × 1.0 = 12',
    'example_score' => 'Puntuación: 9 × 12 = 108 puntos',
    'example_max' => 'Máximo posible: 16 × 12 = 192 puntos',
    'example_percent' => 'Afinidad en esta pregunta: 108/192 = 56%',

    // Sección 5: Brújula
    'compass_title' => 'Brújula política',
    'compass_intro' => 'La brújula política ubica tu posición en dos ejes:',
    'compass_economic_axis' => 'Eje Económico',
    'compass_social_axis' => 'Eje Social',
    'compass_left' => 'Izquierda',
    'compass_left_desc' => 'Mayor intervención estatal, redistribución, servicios públicos',
    'compass_right' => 'Derecha',
    'compass_right_desc' => 'Libre mercado, menor fiscalidad, iniciativa privada',
    'compass_progressive' => 'Progresista',
    'compass_progressive_desc' => 'Derechos individuales, diversidad, cambio social',
    'compass_conservative' => 'Conservador',
    'compass_conservative_desc' => 'Tradición, valores clásicos, orden social',
    'compass_categories_intro' => 'Las categorías del test se agrupan así para calcular tu posición:',
    'compass_economic_categories' => 'Economía, Fiscalidad, Empleo, Vivienda, Pensiones',
    'compass_social_categories' => 'Inmigración, Seguridad, Educación, Sanidad, Medio ambiente, Igualdad',
    'compass_algorithm_title' => 'Cómo calculamos tu posición',
    'compass_algorithm_intro' => 'Para garantizar coherencia entre tu afinidad con los partidos y tu posición en la brújula, utilizamos un sistema de <strong>polaridad automática</strong>:',
    'compass_algorithm_steps' => '<ol>
    <li><strong>Análisis de cada pregunta:</strong> Para cada pregunta, analizamos las posiciones de partidos de referencia (izquierda: PSOE, Sumar, Bildu, ERC; derecha: PP, VOX, Aliança Catalana).</li>
    <li><strong>Determinación de polaridad:</strong> Si los partidos de izquierda tienen posiciones más altas en una pregunta, responder "muy de acuerdo" te posiciona hacia la izquierda. Si son los de derecha, te posiciona hacia la derecha.</li>
    <li><strong>Cálculo del score:</strong> Tu respuesta se convierte a una escala de -100 (izquierda/progresista) a +100 (derecha/conservador), ajustada por la polaridad de cada pregunta.</li>
    <li><strong>Promedio por eje:</strong> La posición final en cada eje es el promedio de todas las preguntas de las categorías correspondientes.</li>
</ol>',
    'compass_algorithm_example' => 'Por ejemplo, en la pregunta "Los ricos deberían pagar más impuestos", los partidos de izquierda tienen posiciones altas (4-5) y los de derecha bajas (1-2). Por tanto, si respondes "muy de acuerdo" (5), tu score se ajusta hacia la izquierda, no hacia la derecha.',
    'compass_algorithm_benefit' => 'Este sistema garantiza que si tienes alta afinidad con un partido de izquierdas, tu brújula te situará coherentemente en la izquierda, y viceversa.',
    'note' => 'Nota',
    'compass_note' => 'La brújula no captura todas las dimensiones políticas, como el eje territorial (centralismo vs. autonomismo), muy relevante en España.',

    // Sección 6: Limitaciones
    'limitations_title' => 'Limitaciones',
    'limitations_intro' => 'Queremos ser transparentes sobre las limitaciones de este test:',
    'limitations_nuances' => 'No puede capturar todos los matices de la política',
    'limitations_simplification' => 'Las posiciones de los partidos pueden simplificarse',
    'limitations_programs' => 'Los programas electorales no siempre reflejan la acción de gobierno',
    'limitations_discriminating' => 'Algunas preguntas pueden ser más discriminantes que otras',
    'limitations_promises' => 'El test no considera el historial de cumplimiento de promesas',

    // Sección 7: Código abierto
    'opensource_title' => 'Código abierto',
    'opensource_intro' => 'En aras de la transparencia, estamos trabajando para publicar:',
    'opensource_questions' => 'La lista completa de preguntas y sus categorías',
    'opensource_positions' => 'Las posiciones asignadas a cada partido con sus fuentes',
    'opensource_algorithm' => 'El algoritmo de cálculo detallado',

    // Sección 8: Contacto
    'contact_title' => 'Contacto y correcciones',
    'contact_desc' => 'Si detectas algún error en las posiciones de los partidos o tienes sugerencias para mejorar la metodología, contacta con nosotros en :email.',
    'contact_sources' => 'Valoramos especialmente los comentarios que incluyan fuentes verificables.',
];
