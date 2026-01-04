<?php

return [
    // Izenburua eta azpititulua
    'title' => 'Metodologia',
    'subtitle' => 'Gardentasun osoa: horrela kalkulatzen dugu zure afinitate politikoa.',

    // Laburpen bisuala
    'summary_questions' => '56 Galdera',
    'summary_questions_desc' => '14 gai-kategoriatan',
    'summary_parties' => '9 Alderdi',
    'summary_parties_desc' => 'Nazionalak eta autonomikoak',
    'summary_positions' => '504 Posizio',
    'summary_positions_desc' => 'Hauteskunde programetatik aztertuak',
    'summary_neutral' => '%100 Neutrala',
    'summary_neutral_desc' => 'Alderdikeria-joerarik gabe',

    // 1. atala: Iturriak
    'sources_title' => 'Informazio iturriak',
    'sources_intro' => 'Alderdien posizioak <strong>iturri ofizial eta publikoetatik</strong> bakarrik atera dira:',
    'sources_programs' => '2023ko hauteskunde orokorretako hauteskunde programak',
    'sources_documents' => 'Alderdien webgune ofizialetan argitaratutako dokumentu programatikoak',
    'sources_votes' => 'Parlamentu-bozketa publikoak',
    'sources_declarations' => 'Prentsa-aurreko adierazpen ofizialak',
    'important' => 'Garrantzitsua',
    'sources_warning' => 'Alderdiek haien posizioak aldatu ditzakete denborarekin. Aldian-aldian datu-basea eguneratzen dugu, baina iturri ofizialak kontsultatzea gomendatzen dugu beti.',

    // 2. atala: Galderen diseinua
    'questions_title' => 'Galderen diseinua',
    'questions_intro' => 'Testeko galdera bakoitzak irizpide hauek betetzen ditu:',
    'questions_neutrality' => 'Neutraltasuna',
    'questions_neutrality_desc' => 'Ez du alderdiak edo pertsona politikoak aipatzen',
    'questions_clarity' => 'Argitasuna',
    'questions_clarity_desc' => 'Hizkuntza irisgarria, teknizismorik gabe',
    'questions_relevance' => 'Garrantzia',
    'questions_relevance_desc' => 'Espainiako eztabaida politiko aktualeko gaiak',
    'questions_differentiation' => 'Diferentziatzea',
    'questions_differentiation_desc' => 'Alderdien arteko posizioak bereiztea ahalbidetzen du',

    // Eskala
    'scale_title' => 'Erantzun eskala',
    'scale_intro' => '5 puntuko Likert eskala erabiltzen dugu:',
    'scale_1' => 'Erabat desados',
    'scale_2' => 'Desados',
    'scale_3' => 'Neutrala',
    'scale_4' => 'Ados',
    'scale_5' => 'Erabat ados',

    // 3. atala: Posizioak
    'positions_title' => 'Alderdien posizioak',
    'positions_intro' => 'Galdera bakoitzeko, posizio bat (1-5) esleitzen zaio alderdi bakoitzari bere hauteskunde programan oinarrituta. Gainera, posizio bakoitzak <strong>konfiantza pisu</strong> bat du:',
    'weight_high' => '3 Pisua (Altua)',
    'weight_high_desc' => 'Posizio esplizitua hauteskunde programan',
    'weight_medium' => '2 Pisua (Ertaina)',
    'weight_medium_desc' => 'Bozketatik edo adierazpenetatik ondorioztatutako posizioa',
    'weight_low' => '1 Pisua (Baxua)',
    'weight_low_desc' => 'Testuinguru ideologikotik estimatutako posizioa',

    // 4. atala: Algoritmoa
    'algorithm_title' => 'Kalkulu algoritmoa',
    'algorithm_intro' => 'Alderdi bakoitzarekiko afinitatea formula honen bidez kalkulatzen da:',
    'algorithm_per_question' => 'Erantzundako galdera bakoitzeko:',
    'algorithm_difference' => 'diferentzia = |zure_erantzuna - alderdi_posizioa|',
    'algorithm_score' => 'puntuazioa = (4 - diferentzia) × konfiantza_pisua',
    'algorithm_total' => 'Afinitate osoa:',
    'algorithm_affinity' => 'afinitatea = (puntuazio_batura / gehienezko_puntuazio_posiblea) × 100',
    'example' => 'Adibidea',
    'example_your_answer' => 'Zure erantzuna: 4 (Ados)',
    'example_party_position' => 'X alderdiaren posizioa: 5 (Erabat ados)',
    'example_weight' => 'Konfiantza pisua: 3',
    'example_difference' => 'Diferentzia: |4 - 5| = 1',
    'example_score' => 'Puntuazioa: (4 - 1) × 3 = 9 puntu',
    'example_max' => 'Gehienezko posiblea: 4 × 3 = 12 puntu',

    // 5. atala: Ipar-orratza
    'compass_title' => 'Ipar-orratz politikoa',
    'compass_intro' => 'Ipar-orratz politikoak zure posizioa bi ardatzetan kokatzen du:',
    'compass_economic_axis' => 'Ardatz Ekonomikoa',
    'compass_social_axis' => 'Ardatz Soziala',
    'compass_left' => 'Ezkerra',
    'compass_left_desc' => 'Estatuaren esku-hartze handiagoa, birbanaketa, zerbitzu publikoak',
    'compass_right' => 'Eskuina',
    'compass_right_desc' => 'Merkatu askea, fiskalitate txikiagoa, ekimen pribatua',
    'compass_progressive' => 'Aurrerakoia',
    'compass_progressive_desc' => 'Eskubide indibidualak, aniztasuna, gizarte aldaketa',
    'compass_conservative' => 'Kontserbadorea',
    'compass_conservative_desc' => 'Tradizioa, balio klasikoak, gizarte ordena',
    'compass_categories_intro' => 'Testeko kategoriak honela taldekatzen dira zure posizioa kalkulatzeko:',
    'compass_economic_categories' => 'Ekonomia, Fiskalitatea, Enplegua, Etxebizitza, Pentsioak',
    'compass_social_categories' => 'Immigrazioa, Segurtasuna, Hezkuntza, Osasuna, Ingurumena, Berdintasuna',
    'note' => 'Oharra',
    'compass_note' => 'Ipar-orratzak ez ditu dimentsio politiko guztiak jasotzen, hala nola lurralde ardatza (zentralismoa vs. autonomismoa), Espainian oso garrantzitsua dena.',

    // 6. atala: Mugak
    'limitations_title' => 'Mugak',
    'limitations_intro' => 'Gardenak izan nahi dugu test honen mugekin:',
    'limitations_nuances' => 'Ezin ditu politikaren ñabardura guztiak jaso',
    'limitations_simplification' => 'Alderdien posizioak sinplifikatu daitezke',
    'limitations_programs' => 'Hauteskunde programek ez dute beti gobernu-ekintza islatzen',
    'limitations_discriminating' => 'Galdera batzuk beste batzuk baino diskriminatzaileagoak izan daitezke',
    'limitations_promises' => 'Testak ez du promesen betetze-historia kontuan hartzen',

    // 7. atala: Kode irekia
    'opensource_title' => 'Kode irekia',
    'opensource_intro' => 'Gardentasunaren izenean, hau argitaratzeko lanean ari gara:',
    'opensource_questions' => 'Galdera zerrenda osoa eta haien kategoriak',
    'opensource_positions' => 'Alderdi bakoitzari esleitutako posizioak haien iturriarekin',
    'opensource_algorithm' => 'Kalkulu algoritmo zehatza',

    // 8. atala: Kontaktua
    'contact_title' => 'Kontaktua eta zuzenketak',
    'contact_desc' => 'Alderdien posizioetan akatsik antzematen baduzu edo metodologia hobetzeko iradokizunak badituzu, jarri gurekin harremanetan :email helbidean.',
    'contact_sources' => 'Bereziki baloratzen ditugu iturri egiaztatzaileak barne hartzen dituzten iruzkinak.',
];
