<?php

return [
    // Título e subtítulo
    'title' => 'Metodoloxía',
    'subtitle' => 'Transparencia total: así calculamos a túa afinidade política.',

    // Resumo visual
    'summary_questions' => '56 Preguntas',
    'summary_questions_desc' => 'En 14 categorías temáticas',
    'summary_parties' => '9 Partidos',
    'summary_parties_desc' => 'Nacionais e autonómicos',
    'summary_positions' => '504 Posicións',
    'summary_positions_desc' => 'Analizadas de programas electorais',
    'summary_neutral' => '100% Neutral',
    'summary_neutral_desc' => 'Sen nesgos partidistas',

    // Sección 1: Fontes
    'sources_title' => 'Fontes de información',
    'sources_intro' => 'As posicións dos partidos extráronse exclusivamente de <strong>fontes oficiais e públicas</strong>:',
    'sources_programs' => 'Programas electorais das eleccións xerais de 2023',
    'sources_documents' => 'Documentos programáticos publicados nas webs oficiais dos partidos',
    'sources_votes' => 'Votacións parlamentarias públicas',
    'sources_declarations' => 'Declaracións oficiais en roldas de prensa',
    'important' => 'Importante',
    'sources_warning' => 'Os partidos poden modificar as súas posicións co tempo. Actualizamos periodicamente a base de datos, pero recomendamos consultar sempre as fontes oficiais.',

    // Sección 2: Deseño de preguntas
    'questions_title' => 'Deseño de preguntas',
    'questions_intro' => 'Cada pregunta do test cumpre estes criterios:',
    'questions_neutrality' => 'Neutralidade',
    'questions_neutrality_desc' => 'Non menciona partidos nin figuras políticas',
    'questions_clarity' => 'Claridade',
    'questions_clarity_desc' => 'Linguaxe accesible, sen tecnicismos',
    'questions_relevance' => 'Relevancia',
    'questions_relevance_desc' => 'Temas de debate político actual en España',
    'questions_differentiation' => 'Diferenciación',
    'questions_differentiation_desc' => 'Permite distinguir posicións entre partidos',

    // Escala
    'scale_title' => 'Escala de resposta',
    'scale_intro' => 'Utilizamos unha escala Likert de 5 puntos:',
    'scale_1' => 'Moi en desacordo',
    'scale_2' => 'En desacordo',
    'scale_3' => 'Neutral',
    'scale_4' => 'De acordo',
    'scale_5' => 'Moi de acordo',

    // Sección 3: Posicións
    'positions_title' => 'Posicións dos partidos',
    'positions_intro' => 'Para cada pregunta, asígnase unha posición (1-5) a cada partido baseándose no seu programa electoral. Ademais, cada posición ten un <strong>peso de confianza</strong>:',
    'weight_high' => 'Peso 3 (Alto)',
    'weight_high_desc' => 'Posición explícita no programa electoral',
    'weight_medium' => 'Peso 2 (Medio)',
    'weight_medium_desc' => 'Posición inferida de votacións ou declaracións',
    'weight_low' => 'Peso 1 (Baixo)',
    'weight_low_desc' => 'Posición estimada por contexto ideolóxico',

    // Sección 4: Algoritmo
    'algorithm_title' => 'Algoritmo de cálculo',
    'algorithm_intro' => 'A afinidade con cada partido calcúlase mediante un algoritmo avanzado que ten en conta tres factores:',
    'algorithm_factors' => '<ul>
        <li><strong>Escala cuadrática:</strong> As grandes diferenzas de opinión penalízanse máis que as pequenas</li>
        <li><strong>Factor de convicción:</strong> As opinións fortes (moi de acordo/moi en desacordo) teñen máis peso que as moderadas</li>
        <li><strong>Redución de neutrales:</strong> As respostas "neutral" teñen menos impacto no resultado final</li>
    </ul>',
    'algorithm_per_question' => 'Para cada pregunta respondida:',
    'algorithm_difference' => 'diferenza = |a_túa_resposta - posición_partido|',
    'algorithm_score' => 'puntuación_base = (4 - diferenza)²',
    'algorithm_conviction' => 'factor_convicción = 0.5 + (distancia_do_centro × 0.25)',
    'algorithm_weight' => 'peso_total = peso_confianza × importancia × factor_convicción',
    'algorithm_total' => 'Afinidade total:',
    'algorithm_affinity' => 'afinidade = (suma_puntuacións / puntuación_máxima_posible) × 100',

    'conviction_title' => 'Factor de convicción',
    'conviction_intro' => 'As túas opinións máis firmes teñen máis peso no resultado:',
    'conviction_extreme' => 'Moi de acordo / Moi en desacordo → Factor 1.0 (máximo peso)',
    'conviction_moderate' => 'De acordo / En desacordo → Factor 0.75',
    'conviction_neutral' => 'Neutral → Factor 0.5 (menor peso)',

    'example' => 'Exemplo',
    'example_your_answer' => 'A túa resposta: 5 (Moi de acordo)',
    'example_party_position' => 'Posición do partido X: 4 (De acordo)',
    'example_weight' => 'Peso de confianza: 3, Importancia: 4',
    'example_difference' => 'Diferenza: |5 - 4| = 1',
    'example_base_score' => 'Puntuación base: (4 - 1)² = 9',
    'example_conviction' => 'Factor convicción: 0.5 + (2 × 0.25) = 1.0',
    'example_total_weight' => 'Peso total: 3 × 4 × 1.0 = 12',
    'example_score' => 'Puntuación: 9 × 12 = 108 puntos',
    'example_max' => 'Máximo posible: 16 × 12 = 192 puntos',
    'example_percent' => 'Afinidade nesta pregunta: 108/192 = 56%',

    // Sección 5: Compás
    'compass_title' => 'Compás político',
    'compass_intro' => 'O compás político sitúa a túa posición en dous eixes:',
    'compass_economic_axis' => 'Eixe Económico',
    'compass_social_axis' => 'Eixe Social',
    'compass_left' => 'Esquerda',
    'compass_left_desc' => 'Maior intervención estatal, redistribución, servizos públicos',
    'compass_right' => 'Dereita',
    'compass_right_desc' => 'Libre mercado, menor fiscalidade, iniciativa privada',
    'compass_progressive' => 'Progresista',
    'compass_progressive_desc' => 'Dereitos individuais, diversidade, cambio social',
    'compass_conservative' => 'Conservador',
    'compass_conservative_desc' => 'Tradición, valores clásicos, orde social',
    'compass_categories_intro' => 'As categorías do test agrúpanse así para calcular a túa posición:',
    'compass_economic_categories' => 'Economía, Fiscalidade, Emprego, Vivenda, Pensións',
    'compass_social_categories' => 'Inmigración, Seguridade, Educación, Sanidade, Medio ambiente, Igualdade',
    'compass_algorithm_title' => 'Como calculamos a túa posición',
    'compass_algorithm_intro' => 'Para garantir coherencia entre a túa afinidade cos partidos e a túa posición no compás, utilizamos un sistema de <strong>polaridade automática</strong>:',
    'compass_algorithm_steps' => '<ol>
    <li><strong>Análise de cada pregunta:</strong> Para cada pregunta, analizamos as posicións de partidos de referencia (esquerda: PSOE, Sumar, Bildu, ERC; dereita: PP, VOX, Aliança Catalana).</li>
    <li><strong>Determinación de polaridade:</strong> Se os partidos de esquerda teñen posicións máis altas nunha pregunta, responder "moi de acordo" posiciónate cara á esquerda. Se son os de dereita, posiciónate cara á dereita.</li>
    <li><strong>Cálculo do score:</strong> A túa resposta convértese a unha escala de -100 (esquerda/progresista) a +100 (dereita/conservador), axustada pola polaridade de cada pregunta.</li>
    <li><strong>Media por eixe:</strong> A posición final en cada eixe é a media de todas as preguntas das categorías correspondentes.</li>
</ol>',
    'compass_algorithm_example' => 'Por exemplo, na pregunta "Os ricos deberían pagar máis impostos", os partidos de esquerda teñen posicións altas (4-5) e os de dereita baixas (1-2). Polo tanto, se respondes "moi de acordo" (5), o teu score axústase cara á esquerda, non cara á dereita.',
    'compass_algorithm_benefit' => 'Este sistema garante que se tes alta afinidade cun partido de esquerdas, o teu compás situarate coherentemente na esquerda, e viceversa.',
    'note' => 'Nota',
    'compass_note' => 'O compás non captura todas as dimensións políticas, como o eixe territorial (centralismo vs. autonomismo), moi relevante en España.',

    // Sección 6: Limitacións
    'limitations_title' => 'Limitacións',
    'limitations_intro' => 'Queremos ser transparentes sobre as limitacións deste test:',
    'limitations_nuances' => 'Non pode capturar todos os matices da política',
    'limitations_simplification' => 'As posicións dos partidos poden simplificarse',
    'limitations_programs' => 'Os programas electorais non sempre reflicten a acción de goberno',
    'limitations_discriminating' => 'Algunhas preguntas poden ser máis discriminantes ca outras',
    'limitations_promises' => 'O test non considera o historial de cumprimento de promesas',

    // Sección 7: Código aberto
    'opensource_title' => 'Código aberto',
    'opensource_intro' => 'En aras da transparencia, estamos traballando para publicar:',
    'opensource_questions' => 'A lista completa de preguntas e as súas categorías',
    'opensource_positions' => 'As posicións asignadas a cada partido coas súas fontes',
    'opensource_algorithm' => 'O algoritmo de cálculo detallado',

    // Sección 8: Contacto
    'contact_title' => 'Contacto e correccións',
    'contact_desc' => 'Se detectas algún erro nas posicións dos partidos ou tes suxestións para mellorar a metodoloxía, contacta connosco en :email.',
    'contact_sources' => 'Valoramos especialmente os comentarios que inclúan fontes verificables.',
];
