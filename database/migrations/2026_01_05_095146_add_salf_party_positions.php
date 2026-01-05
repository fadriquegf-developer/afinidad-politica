<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Party;
use App\Models\Question;
use App\Models\PartyPosition;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Posiciones basadas en los estatutos de SALF (Art. 3):
     * - Defensa de la libertad en su más amplia expresión
     * - España es una nación de ciudadanos libres e iguales
     * - Dignidad del sistema democrático
     * - Estado de Derecho
     * - Transparencia de las administraciones públicas
     * 
     * Y posiciones públicas conocidas del partido y su fundador.
     */
    public function up(): void
    {
        $party = Party::where('slug', 'salf')->first();

        if (!$party) {
            return;
        }

        // Array de posiciones: 'texto_pregunta' => [posicion, justificacion_es, justificacion_ca, justificacion_eu, justificacion_gl]
        $positions = [
            // ===== MODELO TERRITORIAL =====
            'España debería ser un estado más centralizado, reduciendo el poder de las comunidades autónomas.' => [
                5,
                'Defiende la unidad de España y recentralización de competencias.',
                'Defensa la unitat d\'Espanya i recentralització de competències.',
                'Espainiaren batasuna eta eskumenen birzentralizazioa defendatzen du.',
                'Defende a unidade de España e recentralización de competencias.'
            ],
            'Las regiones con lengua y cultura propias deberían poder votar sobre su independencia.' => [
                1,
                'Rechaza el derecho a autodeterminación. Unidad de España innegociable.',
                'Rebutja el dret a l\'autodeterminació. Unitat d\'Espanya innegociable.',
                'Autodeterminazio eskubidea baztertzen du. Espainiaren batasuna negoziatu ezina.',
                'Rexeita o dereito á autodeterminación. Unidade de España innegociable.'
            ],
            'Las comunidades autónomas más ricas deberían aportar más para ayudar a las más pobres.' => [
                4,
                'Apoya la solidaridad entre españoles.',
                'Recolza la solidaritat entre espanyols.',
                'Espainiarren arteko elkartasuna babesten du.',
                'Apoia a solidariedade entre españois.'
            ],
            'Madrid tiene demasiados privilegios respecto al resto de territorios.' => [
                2,
                'No considera que Madrid tenga privilegios excesivos.',
                'No considera que Madrid tingui privilegis excessius.',
                'Ez du uste Madrilek pribilegio gehiegi dituenik.',
                'Non considera que Madrid teña privilexios excesivos.'
            ],

            // ===== ECONOMÍA Y FISCALIDAD =====
            'Los ricos y grandes empresas deberían pagar muchos más impuestos.' => [
                2,
                'Critica la presión fiscal excesiva. Posiciones liberales.',
                'Critica la pressió fiscal excessiva. Posicions liberals.',
                'Zerga-presio gehiegizkoa kritikatzen du. Posizio liberalak.',
                'Critica a presión fiscal excesiva. Posicións liberais.'
            ],
            'El Estado debería controlar sectores clave como la energía o la banca.' => [
                2,
                'Prefiere libre mercado con menos intervención estatal.',
                'Prefereix lliure mercat amb menys intervenció estatal.',
                'Merkatu librea nahiago du estatu-esku-hartze gutxiagorekin.',
                'Prefire libre mercado con menos intervención estatal.'
            ],
            'Es mejor bajar impuestos aunque haya menos servicios públicos.' => [
                4,
                'Propone bajada de impuestos y reducción del gasto político.',
                'Proposa baixada d\'impostos i reducció de la despesa política.',
                'Zergen jaitsiera eta gastu politikoaren murrizketa proposatzen ditu.',
                'Propón baixada de impostos e redución do gasto político.'
            ],
            'Debería haber un impuesto especial a las grandes fortunas y herencias.' => [
                2,
                'Contrario a aumentar fiscalidad. Defiende bajar impuestos.',
                'Contrari a augmentar fiscalitat. Defensa baixar impostos.',
                'Fiskaltasuna handitzeko kontra. Zergak jaistea defendatzen du.',
                'Contrario a aumentar fiscalidade. Defende baixar impostos.'
            ],
            'El Estado debería crear una banca pública para competir con los bancos privados.' => [
                2,
                'Prefiere competencia privada y libre mercado.',
                'Prefereix competència privada i lliure mercat.',
                'Lehia pribatua eta merkatu librea nahiago ditu.',
                'Prefire competencia privada e libre mercado.'
            ],

            // ===== EMPLEO Y TRABAJO =====
            'El salario mínimo debería seguir subiendo aunque algunas empresas tengan dificultades.' => [
                2,
                'Prioriza la competitividad empresarial.',
                'Prioritza la competitivitat empresarial.',
                'Enpresa-lehiakortasuna lehenesten du.',
                'Prioriza a competitividade empresarial.'
            ],
            'Se debería trabajar 4 días a la semana cobrando lo mismo.' => [
                2,
                'Escéptico con regulación laboral impuesta.',
                'Escèptic amb regulació laboral imposada.',
                'Ezarritako lan-araudiarekin eszeptikoa.',
                'Escéptico con regulación laboral imposta.'
            ],
            'Los sindicatos tienen demasiado poder en España.' => [
                5,
                'Muy crítico con los sindicatos y la clase política.',
                'Molt crític amb els sindicats i la classe política.',
                'Oso kritikoa sindikatuekin eta klase politikoarekin.',
                'Moi crítico cos sindicatos e a clase política.'
            ],
            'Las empresas deberían obligatoriamente publicar los salarios de sus empleados.' => [
                3,
                'Apoya transparencia general pero respeta libertad empresarial.',
                'Recolza transparència general però respecta llibertat empresarial.',
                'Gardentasun orokorra babesten du baina enpresa-askatasuna errespetatzen du.',
                'Apoia transparencia xeral pero respecta liberdade empresarial.'
            ],

            // ===== INMIGRACIÓN =====
            'Se debería controlar más la inmigración irregular, con más deportaciones.' => [
                5,
                'Posiciones muy restrictivas en inmigración.',
                'Posicions molt restrictives en immigració.',
                'Oso jarrera murriztaileak immigrazioan.',
                'Posicións moi restritivas en inmigración.'
            ],
            'Los inmigrantes con papeles deberían tener los mismos derechos a ayudas que los españoles.' => [
                2,
                'Propone prioridad nacional en ayudas.',
                'Proposa prioritat nacional en ajudes.',
                'Lehentasun nazionala proposatzen du laguntzetan.',
                'Propón prioridade nacional en axudas.'
            ],
            'España necesita inmigrantes para pagar las pensiones y cubrir trabajos.' => [
                1,
                'No comparte este argumento. Prioriza otras soluciones.',
                'No comparteix aquest argument. Prioritza altres solucions.',
                'Ez du argudio hau partekatzen. Beste konponbide batzuk lehenesten ditu.',
                'Non comparte este argumento. Prioriza outras solucións.'
            ],
            'Los menores no acompañados (menas) deben ser acogidos y formados.' => [
                1,
                'Posiciones muy restrictivas con menores no acompañados.',
                'Posicions molt restrictives amb menors no acompanyats.',
                'Jarrera oso murriztaileak adingabe laguntzaile gabekoekin.',
                'Posicións moi restritivas con menores non acompañados.'
            ],

            // ===== MEDIO AMBIENTE =====
            'Luchar contra el cambio climático debe ser prioritario aunque cueste dinero.' => [
                2,
                'Escéptico con la agenda climática. Prioriza economía.',
                'Escèptic amb l\'agenda climàtica. Prioritza economia.',
                'Klima-agendarekin eszeptikoa. Ekonomia lehenesten du.',
                'Escéptico coa axenda climática. Prioriza economía.'
            ],
            'Se deberían prohibir los coches de combustión para 2035.' => [
                1,
                'Rechaza prohibiciones. Defiende libertad de elección.',
                'Rebutja prohibicions. Defensa llibertat d\'elecció.',
                'Debekuak baztertzen ditu. Aukeratzeko askatasuna defendatzen du.',
                'Rexeita prohibicións. Defende liberdade de elección.'
            ],
            'La energía nuclear es necesaria para garantizar el suministro eléctrico.' => [
                4,
                'Apoya mantener y desarrollar energía nuclear.',
                'Recolza mantenir i desenvolupar energia nuclear.',
                'Energia nuklearra mantentzea eta garatzea babesten du.',
                'Apoia manter e desenvolver enerxía nuclear.'
            ],
            'Los toros y otros espectáculos con animales deberían prohibirse.' => [
                1,
                'Defiende tradiciones españolas como la tauromaquia.',
                'Defensa tradicions espanyoles com la tauromàquia.',
                'Espainiako tradizioak defendatzen ditu, zezenketa barne.',
                'Defende tradicións españolas como a tauromaquia.'
            ],

            // ===== MODELO SOCIAL =====
            'Hacen falta más políticas de igualdad entre hombres y mujeres.' => [
                1,
                'Rechaza las políticas de género actuales.',
                'Rebutja les polítiques de gènere actuals.',
                'Egungo genero-politikak baztertzen ditu.',
                'Rexeita as políticas de xénero actuais.'
            ],
            'El aborto debe seguir siendo un derecho legal y gratuito.' => [
                2,
                'Posiciones conservadoras en temas sociales.',
                'Posicions conservadores en temes socials.',
                'Jarrera kontserbadoreak gai sozialetan.',
                'Posicións conservadoras en temas sociais.'
            ],
            'El matrimonio entre personas del mismo sexo debe estar reconocido.' => [
                3,
                'No se ha pronunciado claramente. Posición moderada.',
                'No s\'ha pronunciat clarament. Posició moderada.',
                'Ez da argi adierazi. Posizio moderatua.',
                'Non se pronunciou claramente. Posición moderada.'
            ],

            // ===== EDUCACIÓN Y SANIDAD =====
            'La sanidad pública debe reforzarse aunque haya que subir impuestos.' => [
                3,
                'Apoya sanidad pública pero sin subir impuestos.',
                'Recolza sanitat pública però sense pujar impostos.',
                'Osasun publikoa babesten du baina zergak igo gabe.',
                'Apoia sanidade pública pero sen subir impostos.'
            ],
            'Los padres deberían poder elegir qué contenidos estudian sus hijos en temas como sexualidad.' => [
                5,
                'Defiende firmemente el control parental en educación.',
                'Defensa fermament el control parental en educació.',
                'Hezkuntzako guraso-kontrola tinko defendatzen du.',
                'Defende firmemente o control parental en educación.'
            ],
            'La salud mental debería tener la misma cobertura pública que la física.' => [
                3,
                'Apoya mejorar servicios sin aumentar gasto público.',
                'Recolza millorar serveis sense augmentar despesa pública.',
                'Zerbitzuak hobetzea babesten du gastu publikoa handitu gabe.',
                'Apoia mellorar servizos sen aumentar gasto público.'
            ],

            // ===== VIVIENDA =====
            'El gobierno debería regular los precios del alquiler para que no suban tanto.' => [
                2,
                'Prefiere libre mercado en vivienda.',
                'Prefereix lliure mercat en habitatge.',
                'Merkatu librea nahiago du etxebizitzan.',
                'Prefire libre mercado en vivenda.'
            ],
            'Debería construirse más vivienda pública para alquiler social.' => [
                3,
                'Posición moderada. Prefiere facilitar acceso privado.',
                'Posició moderada. Prefereix facilitar accés privat.',
                'Posizio moderatua. Sarbide pribatua erraztea nahiago du.',
                'Posición moderada. Prefire facilitar acceso privado.'
            ],
            'Los grandes propietarios de viviendas vacías deberían pagar un impuesto especial.' => [
                2,
                'Contrario a más impuestos sobre la propiedad.',
                'Contrari a més impostos sobre la propietat.',
                'Jabetzaren gaineko zerga gehiagoren aurka.',
                'Contrario a máis impostos sobre a propiedade.'
            ],
            'Ocupar casas vacías debería tener penas más duras.' => [
                5,
                'Propone tolerancia cero con la ocupación ilegal.',
                'Proposa tolerància zero amb l\'ocupació il·legal.',
                'Legez kanpoko okupazioarekin tolerantzia zero proposatzen du.',
                'Propón tolerancia cero coa ocupación ilegal.'
            ],

            // ===== SEGURIDAD Y JUSTICIA =====
            'Las penas de cárcel deberían ser más duras para delitos graves.' => [
                5,
                'Favorable a endurecer penas. Mano dura contra el crimen.',
                'Favorable a endurir penes. Mà dura contra el crim.',
                'Zigorrak gogortzeko aldekoa. Eskua gogorra krimenaren aurka.',
                'Favorable a endurecer penas. Man dura contra o crime.'
            ],
            'Se debe reconocer y compensar a las víctimas de la dictadura franquista.' => [
                2,
                'Crítico con las leyes de memoria histórica actuales.',
                'Crític amb les lleis de memòria històrica actuals.',
                'Egungo memoria historikoaren legeekin kritikoa.',
                'Crítico coas leis de memoria histórica actuais.'
            ],
            'La policía debería tener más medios y poder para mantener el orden.' => [
                5,
                'Muy favorable a reforzar las fuerzas de seguridad.',
                'Molt favorable a reforçar les forces de seguretat.',
                'Oso aldekoa segurtasun-indarrak indartzeko.',
                'Moi favorable a reforzar as forzas de seguridade.'
            ],
            'Los indultos a políticos condenados deberían estar más limitados.' => [
                5,
                'Muy crítico con los indultos a políticos corruptos.',
                'Molt crític amb els indults a polítics corruptes.',
                'Oso kritikoa politikari ustelei emandako indultuekin.',
                'Moi crítico cos indultos a políticos corruptos.'
            ],

            // ===== LENGUA E IDENTIDAD =====
            'El castellano debería ser la única lengua obligatoria en las escuelas de toda España.' => [
                5,
                'Defiende el castellano como única lengua vehicular.',
                'Defensa el castellà com a única llengua vehicular.',
                'Gaztelania hizkuntza bideratzaile bakarra bezala defendatzen du.',
                'Defende o castelán como única lingua vehicular.'
            ],
            'Se deberían poder usar el catalán, euskera y gallego en el Congreso.' => [
                1,
                'Rechaza el uso de lenguas cooficiales en el Congreso.',
                'Rebutja l\'ús de llengües cooficials al Congrés.',
                'Hizkuntza koofizialak Kongresuan erabiltzea baztertzen du.',
                'Rexeita o uso de linguas cooficiais no Congreso.'
            ],
            'Me siento más de mi región (catalán, vasco, gallego...) que español.' => [
                1,
                'Defiende la identidad española por encima de regionalismos.',
                'Defensa la identitat espanyola per sobre de regionalismes.',
                'Espainiako nortasuna defendatzen du eskualde-nortasunen gainetik.',
                'Defende a identidade española por enriba de rexionalismos.'
            ],
            'Las lenguas regionales deben protegerse y promoverse con recursos públicos.' => [
                2,
                'Prioriza el castellano. Crítico con inmersión lingüística.',
                'Prioritza el castellà. Crític amb immersió lingüística.',
                'Gaztelania lehenesten du. Hizkuntza-murgiltzearekin kritikoa.',
                'Prioriza o castelán. Crítico con inmersión lingüística.'
            ],

            // ===== PENSIONES Y BIENESTAR =====
            'Las pensiones deben subir siempre al menos lo que sube la vida (IPC).' => [
                4,
                'Apoya revalorización de pensiones con el IPC.',
                'Recolza revaloració de pensions amb l\'IPC.',
                'Pentsioek KPIarekin birbalioztatzea babesten du.',
                'Apoia revalorización de pensións co IPC.'
            ],
            'Los jubilados con pensiones altas deberían pagar más impuestos para ayudar al sistema.' => [
                2,
                'Contrario a aumentar impuestos a pensionistas.',
                'Contrari a augmentar impostos a pensionistes.',
                'Pentsionisten zergak handitzearen aurka.',
                'Contrario a aumentar impostos a pensionistas.'
            ],
            'Las pensiones mínimas deberían subir hasta garantizar una vida digna.' => [
                4,
                'Defiende pensiones dignas para los españoles.',
                'Defensa pensions dignes per als espanyols.',
                'Pentsio duinak defendatzen ditu espainiarrentzat.',
                'Defende pensións dignas para os españois.'
            ],
            'Se debería poder complementar la pensión pública con planes de pensiones privados incentivados fiscalmente.' => [
                4,
                'Apoya libertad de ahorro y planes privados.',
                'Recolza llibertat d\'estalvi i plans privats.',
                'Aurrezteko askatasuna eta plan pribatuak babesten ditu.',
                'Apoia liberdade de aforro e plans privados.'
            ],

            // ===== INSTITUCIONES =====
            'España debería votar en referéndum si quiere seguir siendo una monarquía o ser una república.' => [
                2,
                'No prioriza este debate. Enfocado en otros temas.',
                'No prioritza aquest debat. Enfocat en altres temes.',
                'Ez du eztabaida hau lehenesten. Beste gai batzuetan zentratua.',
                'Non prioriza este debate. Enfocado noutros temas.'
            ],
            'El Rey debería poder ser juzgado por delitos como cualquier ciudadano.' => [
                4,
                'Defiende igualdad ante la ley. Nadie por encima.',
                'Defensa igualtat davant la llei. Ningú per sobre.',
                'Legearen aurreko berdintasuna defendatzen du. Inor ez gainetik.',
                'Defende igualdade ante a lei. Ninguén por enriba.'
            ],
            'Los partidos políticos reciben demasiado dinero público.' => [
                5,
                'Muy crítico con la financiación de partidos. Eje central de su discurso.',
                'Molt crític amb el finançament de partits. Eix central del seu discurs.',
                'Oso kritikoa alderdien finantzaketarekin. Bere diskurtsoaren ardatz nagusia.',
                'Moi crítico co financiamento de partidos. Eixe central do seu discurso.'
            ],

            // ===== AGRICULTURA Y RURAL =====
            'El campo español necesita más apoyo y menos burocracia de la UE.' => [
                5,
                'Muy favorable a apoyar agricultores contra burocracia.',
                'Molt favorable a donar suport als agricultors contra burocràcia.',
                'Oso aldekoa nekazariak burokraziaren aurka laguntzeko.',
                'Moi favorable a apoiar agricultores contra burocracia.'
            ],
            'La agricultura debería ser más ecológica aunque produzca menos.' => [
                2,
                'Prioriza productividad. Crítico con imposiciones ecologistas.',
                'Prioritza productivitat. Crític amb imposicions ecologistes.',
                'Produktibitatea lehenesten du. Ekologisten inposizioekin kritikoa.',
                'Prioriza produtividade. Crítico con imposicións ecoloxistas.'
            ],
            'El lobo y otras especies protegidas deben poder cazarse para proteger al ganado.' => [
                4,
                'Apoya a ganaderos. Favorable al control poblacional.',
                'Recolza els ramaders. Favorable al control poblacional.',
                'Abeltzainak babesten ditu. Populazio-kontrolaren aldekoa.',
                'Apoia aos gandeiros. Favorable ao control poboacional.'
            ],

            // ===== EUROPA Y MUNDO =====
            'La Unión Europea debería tener más poder sobre los países miembros.' => [
                1,
                'Posiciones euroescépticas. Defiende soberanía nacional.',
                'Posicions euroescèptiques. Defensa sobirania nacional.',
                'Jarrera euroszeptikoak. Subiranotasun nazionala defendatzen du.',
                'Posicións euroescépticas. Defende soberanía nacional.'
            ],
            'España debería poder ignorar normas europeas cuando perjudiquen sus intereses.' => [
                5,
                'Defiende primacía de la soberanía nacional sobre la UE.',
                'Defensa primacia de la sobirania nacional sobre la UE.',
                'Subiranotasun nazionalaren lehentasuna defendatzen du EBren gainetik.',
                'Defende primacía da soberanía nacional sobre a UE.'
            ],
            'Las restricciones medioambientales europeas perjudican a la economía española.' => [
                5,
                'Muy crítico con las normativas verdes europeas.',
                'Molt crític amb les normatives verdes europees.',
                'Oso kritikoa Europako arau berdeekin.',
                'Moi crítico coas normativas verdes europeas.'
            ],
        ];

        foreach ($positions as $questionText => $data) {
            $question = Question::where('text', $questionText)->first();

            if ($question) {
                // Verificar que no exista ya la posición
                if (!PartyPosition::where('party_id', $party->id)->where('question_id', $question->id)->exists()) {
                    PartyPosition::create([
                        'party_id' => $party->id,
                        'question_id' => $question->id,
                        'position' => $data[0],
                        'justification' => $data[1],
                        'justification_ca' => $data[2],
                        'justification_eu' => $data[3],
                        'justification_gl' => $data[4],
                        'weight' => 3,
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $party = Party::where('slug', 'salf')->first();

        if ($party) {
            PartyPosition::where('party_id', $party->id)->delete();
        }
    }
};
