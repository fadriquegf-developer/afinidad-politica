<?php

return [
    // Títol i subtítol
    'title' => 'Metodologia',
    'subtitle' => 'Transparència total: així calculem la teva afinitat política.',

    // Resum visual
    'summary_questions' => '56 Preguntes',
    'summary_questions_desc' => 'En 14 categories temàtiques',
    'summary_parties' => '9 Partits',
    'summary_parties_desc' => 'Nacionals i autonòmics',
    'summary_positions' => '504 Posicions',
    'summary_positions_desc' => 'Analitzades de programes electorals',
    'summary_neutral' => '100% Neutral',
    'summary_neutral_desc' => 'Sense biaixos partidistes',

    // Secció 1: Fonts
    'sources_title' => 'Fonts d\'informació',
    'sources_intro' => 'Les posicions dels partits s\'han extret exclusivament de <strong>fonts oficials i públiques</strong>:',
    'sources_programs' => 'Programes electorals de les eleccions generals de 2023',
    'sources_documents' => 'Documents programàtics publicats a les webs oficials dels partits',
    'sources_votes' => 'Votacions parlamentàries públiques',
    'sources_declarations' => 'Declaracions oficials en rodes de premsa',
    'important' => 'Important',
    'sources_warning' => 'Els partits poden modificar les seves posicions amb el temps. Actualitzem periòdicament la base de dades, però recomanem consultar sempre les fonts oficials.',

    // Secció 2: Disseny de preguntes
    'questions_title' => 'Disseny de preguntes',
    'questions_intro' => 'Cada pregunta del test compleix aquests criteris:',
    'questions_neutrality' => 'Neutralitat',
    'questions_neutrality_desc' => 'No menciona partits ni figures polítiques',
    'questions_clarity' => 'Claredat',
    'questions_clarity_desc' => 'Llenguatge accessible, sense tecnicismes',
    'questions_relevance' => 'Rellevància',
    'questions_relevance_desc' => 'Temes de debat polític actual a Espanya',
    'questions_differentiation' => 'Diferenciació',
    'questions_differentiation_desc' => 'Permet distingir posicions entre partits',

    // Escala
    'scale_title' => 'Escala de resposta',
    'scale_intro' => 'Utilitzem una escala Likert de 5 punts:',
    'scale_1' => 'Molt en desacord',
    'scale_2' => 'En desacord',
    'scale_3' => 'Neutral',
    'scale_4' => 'D\'acord',
    'scale_5' => 'Molt d\'acord',

    // Secció 3: Posicions
    'positions_title' => 'Posicions dels partits',
    'positions_intro' => 'Per a cada pregunta, s\'assigna una posició (1-5) a cada partit basant-se en el seu programa electoral. A més, cada posició té un <strong>pes de confiança</strong>:',
    'weight_high' => 'Pes 3 (Alt)',
    'weight_high_desc' => 'Posició explícita al programa electoral',
    'weight_medium' => 'Pes 2 (Mitjà)',
    'weight_medium_desc' => 'Posició inferida de votacions o declaracions',
    'weight_low' => 'Pes 1 (Baix)',
    'weight_low_desc' => 'Posició estimada per context ideològic',

    // Secció 4: Algoritme
    'algorithm_title' => 'Algoritme de càlcul',
    'algorithm_intro' => 'L\'afinitat amb cada partit es calcula mitjançant la següent fórmula:',
    'algorithm_per_question' => 'Per a cada pregunta resposta:',
    'algorithm_difference' => 'diferència = |la_teva_resposta - posició_partit|',
    'algorithm_score' => 'puntuació = (4 - diferència) × pes_confiança',
    'algorithm_total' => 'Afinitat total:',
    'algorithm_affinity' => 'afinitat = (suma_puntuacions / puntuació_màxima_possible) × 100',
    'example' => 'Exemple',
    'example_your_answer' => 'La teva resposta: 4 (D\'acord)',
    'example_party_position' => 'Posició del partit X: 5 (Molt d\'acord)',
    'example_weight' => 'Pes de confiança: 3',
    'example_difference' => 'Diferència: |4 - 5| = 1',
    'example_score' => 'Puntuació: (4 - 1) × 3 = 9 punts',
    'example_max' => 'Màxim possible: 4 × 3 = 12 punts',

    // Secció 5: Brúixola
    'compass_title' => 'Brúixola política',
    'compass_intro' => 'La brúixola política ubica la teva posició en dos eixos:',
    'compass_economic_axis' => 'Eix Econòmic',
    'compass_social_axis' => 'Eix Social',
    'compass_left' => 'Esquerra',
    'compass_left_desc' => 'Major intervenció estatal, redistribució, serveis públics',
    'compass_right' => 'Dreta',
    'compass_right_desc' => 'Lliure mercat, menor fiscalitat, iniciativa privada',
    'compass_progressive' => 'Progressista',
    'compass_progressive_desc' => 'Drets individuals, diversitat, canvi social',
    'compass_conservative' => 'Conservador',
    'compass_conservative_desc' => 'Tradició, valors clàssics, ordre social',
    'compass_categories_intro' => 'Les categories del test s\'agrupen així per calcular la teva posició:',
    'compass_economic_categories' => 'Economia, Fiscalitat, Ocupació, Habitatge, Pensions',
    'compass_social_categories' => 'Immigració, Seguretat, Educació, Sanitat, Medi ambient, Igualtat',
    'note' => 'Nota',
    'compass_note' => 'La brúixola no captura totes les dimensions polítiques, com l\'eix territorial (centralisme vs. autonomisme), molt rellevant a Espanya.',

    // Secció 6: Limitacions
    'limitations_title' => 'Limitacions',
    'limitations_intro' => 'Volem ser transparents sobre les limitacions d\'aquest test:',
    'limitations_nuances' => 'No pot capturar tots els matisos de la política',
    'limitations_simplification' => 'Les posicions dels partits poden simplificar-se',
    'limitations_programs' => 'Els programes electorals no sempre reflecteixen l\'acció de govern',
    'limitations_discriminating' => 'Algunes preguntes poden ser més discriminants que altres',
    'limitations_promises' => 'El test no considera l\'historial de compliment de promeses',

    // Secció 7: Codi obert
    'opensource_title' => 'Codi obert',
    'opensource_intro' => 'En nom de la transparència, estem treballant per publicar:',
    'opensource_questions' => 'La llista completa de preguntes i les seves categories',
    'opensource_positions' => 'Les posicions assignades a cada partit amb les seves fonts',
    'opensource_algorithm' => 'L\'algoritme de càlcul detallat',

    // Secció 8: Contacte
    'contact_title' => 'Contacte i correccions',
    'contact_desc' => 'Si detectes algun error en les posicions dels partits o tens suggeriments per millorar la metodologia, contacta amb nosaltres a :email.',
    'contact_sources' => 'Valorem especialment els comentaris que incloguin fonts verificables.',
];
