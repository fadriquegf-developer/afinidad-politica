<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Party;
use App\Models\Question;
use App\Models\PartyPosition;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    private $parties;

    public function run(): void
    {
        $this->parties = Party::all()->keyBy('slug');
        $categories = Category::all()->keyBy('slug');

        // MODELO TERRITORIAL
        $this->createQuestion(
            $categories['modelo-territorial'],
            'España debería ser un estado más centralizado, reduciendo el poder de las comunidades autónomas.',
            'Se refiere a si el gobierno central debería tener más poder sobre decisiones como sanidad, educación o impuestos, en lugar de que cada comunidad autónoma decida.',
            'Imagina que España es una casa con 17 habitaciones (comunidades). ¿Debería haber una sola persona decidiendo las reglas de toda la casa, o cada habitación puede tener sus propias reglas?',
            ['psoe' => [2, 'Defiende el Estado de las Autonomías actual.'], 'pp' => [3, 'Apoya autonomías pero con más coordinación.'], 'vox' => [5, 'Propone eliminar las autonomías.'], 'sumar' => [1, 'Defiende modelo federal plurinacional.'], 'erc' => [1, 'Quiere más autogobierno.'], 'junts' => [1, 'Rechaza cualquier recentralización.'], 'pnv' => [1, 'Defiende el autogobierno vasco.'], 'bildu' => [1, 'Defiende la soberanía vasca.'], 'alianca-catalana' => [1, 'Defiende la independencia.']]
        );

        $this->createQuestion(
            $categories['modelo-territorial'],
            'Las regiones con lengua y cultura propias deberían poder votar sobre su independencia.',
            'Se pregunta si territorios como Cataluña, País Vasco o Galicia deberían poder celebrar un referéndum para decidir si quieren ser países independientes.',
            'Es como preguntar: ¿debería una familia poder votar si quiere seguir viviendo en una comunidad de vecinos o prefiere irse a vivir sola?',
            ['psoe' => [2, 'Rechaza autodeterminación, apoya diálogo.'], 'pp' => [1, 'Se opone firmemente.'], 'vox' => [1, 'Unidad de España innegociable.'], 'sumar' => [3, 'Reconoce plurinacionalidad con matices.'], 'erc' => [5, 'Defiende derecho a autodeterminación.'], 'junts' => [5, 'Apoya derecho a decidir.'], 'pnv' => [4, 'Defiende derecho a decidir vasco.'], 'bildu' => [5, 'Defiende derecho a decidir.'], 'alianca-catalana' => [5, 'Defiende independencia unilateral.']]
        );

        $this->createQuestion(
            $categories['modelo-territorial'],
            'Las comunidades autónomas más ricas deberían aportar más para ayudar a las más pobres.',
            'Se refiere a la solidaridad entre territorios: si comunidades como Madrid o Cataluña deben contribuir más al fondo común para financiar servicios en comunidades con menos recursos.',
            'Como cuando en clase los que tienen más material lo comparten con los que tienen menos, para que todos puedan trabajar igual.',
            ['psoe' => [4, 'Defiende la solidaridad interterritorial.'], 'pp' => [4, 'Apoya la cohesión territorial.'], 'vox' => [4, 'Apoya solidaridad entre españoles.'], 'sumar' => [5, 'Defiende redistribución fuerte.'], 'erc' => [2, 'Critica el déficit fiscal catalán.'], 'junts' => [2, 'Reclama soberanía fiscal catalana.'], 'pnv' => [2, 'Defiende el Concierto Económico.'], 'bildu' => [3, 'Posición matizada.'], 'alianca-catalana' => [1, 'Rechaza financiar al resto de España.']]
        );

        // ECONOMÍA Y FISCALIDAD
        $this->createQuestion(
            $categories['economia-fiscalidad'],
            'Los ricos y grandes empresas deberían pagar muchos más impuestos.',
            'Se pregunta si las personas con grandes fortunas y las empresas multinacionales deberían contribuir más a las arcas públicas mediante impuestos más altos.',
            'Si en tu clase hay niños con muchas chuches y otros sin ninguna, ¿los que tienen muchas deberían dar más a la caja común para que haya para todos?',
            ['psoe' => [4, 'Apoya más impuestos a rentas altas.'], 'pp' => [2, 'Prefiere bajar impuestos.'], 'vox' => [1, 'Propone bajada generalizada.'], 'sumar' => [5, 'Propone reforma fiscal progresiva fuerte.'], 'erc' => [4, 'Apoya mayor fiscalidad a fortunas.'], 'junts' => [3, 'Posiciones más liberales.'], 'pnv' => [3, 'Posición moderada.'], 'bildu' => [5, 'Defiende fiscalidad muy progresiva.'], 'alianca-catalana' => [2, 'Posiciones económicas liberales.']]
        );

        $this->createQuestion(
            $categories['economia-fiscalidad'],
            'El Estado debería controlar sectores clave como la energía o la banca.',
            'Se refiere a si el gobierno debería tener empresas públicas en sectores estratégicos o incluso nacionalizar empresas privadas para controlar servicios esenciales.',
            'Como decidir si la tienda del pueblo debería ser de todos los vecinos juntos, o de una persona que la gestiona para ganar dinero.',
            ['psoe' => [3, 'Apoya intervención moderada.'], 'pp' => [2, 'Prefiere menos intervención.'], 'vox' => [2, 'Defiende mercado con protección nacional.'], 'sumar' => [5, 'Propone empresas públicas.'], 'erc' => [4, 'Apoya presencia pública en sectores clave.'], 'junts' => [2, 'Prefiere menos intervención.'], 'pnv' => [3, 'Apoya modelo mixto.'], 'bildu' => [5, 'Defiende economía social y pública.'], 'alianca-catalana' => [2, 'Prefiere libre mercado.']]
        );

        $this->createQuestion(
            $categories['economia-fiscalidad'],
            'Es mejor bajar impuestos aunque haya menos servicios públicos.',
            'Se pregunta qué prefieres: pagar menos impuestos pero tener sanidad, educación y servicios más limitados, o pagar más pero tener mejores servicios para todos.',
            'Es como elegir entre quedarte tu paga entera pero traer tu propia comida al cole, o poner parte para que haya un comedor con comida para todos.',
            ['psoe' => [2, 'Defiende servicios públicos fuertes.'], 'pp' => [4, 'Propone bajar impuestos.'], 'vox' => [5, 'Propone bajada drástica de impuestos.'], 'sumar' => [1, 'Defiende servicios públicos universales.'], 'erc' => [2, 'Apoya servicios públicos.'], 'junts' => [3, 'Posición moderada.'], 'pnv' => [3, 'Posición equilibrada.'], 'bildu' => [1, 'Defiende servicios públicos fuertes.'], 'alianca-catalana' => [4, 'Posiciones liberales.']]
        );

        // EMPLEO Y TRABAJO
        $this->createQuestion(
            $categories['empleo-trabajo'],
            'El salario mínimo debería seguir subiendo aunque algunas empresas tengan dificultades.',
            'Se refiere a si el gobierno debe aumentar el sueldo mínimo legal para que los trabajadores ganen más, aunque algunas empresas pequeñas digan que no pueden pagarlo.',
            'Si todos los niños del barrio cobran 5€ por cortar el césped, ¿deberían cobrar 7€ aunque algunos vecinos digan que es muy caro?',
            ['psoe' => [4, 'Ha impulsado subidas del SMI.'], 'pp' => [2, 'Prefiere vincular SMI a productividad.'], 'vox' => [2, 'Critica subidas del SMI.'], 'sumar' => [5, 'Propone SMI al 60% del salario medio.'], 'erc' => [4, 'Apoya subidas del salario mínimo.'], 'junts' => [3, 'Posiciones moderadas.'], 'pnv' => [4, 'Apoya mejorar salarios.'], 'bildu' => [5, 'Defiende subidas salariales.'], 'alianca-catalana' => [2, 'Prioriza competitividad empresarial.']]
        );

        $this->createQuestion(
            $categories['empleo-trabajo'],
            'Se debería trabajar 4 días a la semana cobrando lo mismo.',
            'Se propone reducir la semana laboral de 5 a 4 días manteniendo el mismo salario, para mejorar la calidad de vida y la productividad de los trabajadores.',
            'Imagina que en vez de ir 5 días al cole, fueras solo 4 pero aprendieras lo mismo. ¿Estaría bien tener un día más para jugar?',
            ['psoe' => [3, 'Abierto a estudiar reducción.'], 'pp' => [2, 'Lo ve inviable actualmente.'], 'vox' => [1, 'Se opone a reducir jornada por ley.'], 'sumar' => [5, 'Propone semana de 4 días.'], 'erc' => [4, 'Apoya reducción de jornada.'], 'junts' => [3, 'Posiciones moderadas.'], 'pnv' => [3, 'Apoya explorar nuevos modelos.'], 'bildu' => [5, 'Defiende reducción de jornada.'], 'alianca-catalana' => [2, 'Prefiere que lo decidan empresas.']]
        );

        $this->createQuestion(
            $categories['empleo-trabajo'],
            'Los sindicatos tienen demasiado poder en España.',
            'Se cuestiona si las organizaciones que defienden los derechos de los trabajadores tienen excesiva influencia en las decisiones económicas y laborales del país.',
            'Los sindicatos son como el delegado de clase que defiende a los alumnos. ¿Crees que el delegado tiene demasiado poder o debería tener más?',
            ['psoe' => [2, 'Colabora con los sindicatos.'], 'pp' => [4, 'Critica el poder sindical.'], 'vox' => [5, 'Muy crítico con los sindicatos.'], 'sumar' => [1, 'Defiende fortalecer los sindicatos.'], 'erc' => [2, 'Apoya el movimiento sindical.'], 'junts' => [3, 'Posición moderada.'], 'pnv' => [3, 'Relación pragmática.'], 'bildu' => [1, 'Muy vinculado al sindicalismo.'], 'alianca-catalana' => [4, 'Crítico con sindicatos.']]
        );

        // INMIGRACIÓN
        $this->createQuestion(
            $categories['inmigracion'],
            'Se debería controlar más la inmigración irregular, con más deportaciones.',
            'Se refiere a si España debe ser más estricta con las personas que entran sin papeles, devolviéndolas más rápido a sus países de origen.',
            'Imagina que en tu casa solo caben 10 personas. ¿Qué haces si llegan 15? ¿Buscas cómo ayudar a todos o dices que algunos tienen que irse?',
            ['psoe' => [3, 'Control respetando derechos humanos.'], 'pp' => [4, 'Propone mayor control.'], 'vox' => [5, 'Propone deportaciones masivas.'], 'sumar' => [2, 'Prioriza derechos humanos.'], 'erc' => [2, 'Defiende políticas de acogida.'], 'junts' => [3, 'Posiciones moderadas.'], 'pnv' => [3, 'Apoya inmigración ordenada.'], 'bildu' => [2, 'Defiende derechos de migrantes.'], 'alianca-catalana' => [5, 'Propone deportar inmigrantes ilegales.']]
        );

        $this->createQuestion(
            $categories['inmigracion'],
            'Los inmigrantes con papeles deberían tener los mismos derechos a ayudas que los españoles.',
            'Se pregunta si las personas extranjeras que viven legalmente en España deberían poder acceder a sanidad, educación y ayudas sociales igual que un ciudadano español.',
            'Si un niño nuevo llega a tu clase desde otro país, ¿debería poder usar el material y jugar en el recreo como todos, o debería esperar?',
            ['psoe' => [4, 'Defiende integración con igualdad.'], 'pp' => [3, 'Derechos tras cumplir requisitos.'], 'vox' => [1, 'Propone "prioridad nacional".'], 'sumar' => [5, 'Defiende igualdad de derechos.'], 'erc' => [5, 'Defiende derechos universales.'], 'junts' => [4, 'Apoya integración.'], 'pnv' => [4, 'Defiende integración.'], 'bildu' => [5, 'Defiende igualdad de derechos.'], 'alianca-catalana' => [2, 'Prioriza a los catalanes.']]
        );

        $this->createQuestion(
            $categories['inmigracion'],
            'España necesita inmigrantes para pagar las pensiones y cubrir trabajos.',
            'Se refiere a que con la baja natalidad española, hacen falta trabajadores de otros países que coticen para poder pagar las pensiones de los jubilados.',
            'En un equipo de fútbol, si se retiran jugadores y no nacen suficientes niños que jueguen, ¿no haría falta fichar jugadores de fuera para completar el equipo?',
            ['psoe' => [4, 'Reconoce contribución de inmigración.'], 'pp' => [3, 'Apoya inmigración regulada.'], 'vox' => [1, 'Cree que la solución es más natalidad.'], 'sumar' => [4, 'Valora positivamente la inmigración.'], 'erc' => [4, 'Apoya la inmigración.'], 'junts' => [3, 'Posiciones moderadas.'], 'pnv' => [4, 'Reconoce valor de inmigración.'], 'bildu' => [4, 'Defiende políticas de acogida.'], 'alianca-catalana' => [1, 'Cree que inmigración es un problema.']]
        );

        // MEDIO AMBIENTE
        $this->createQuestion(
            $categories['medio-ambiente'],
            'Luchar contra el cambio climático debe ser prioritario aunque cueste dinero.',
            'Se refiere a si debemos invertir recursos y cambiar nuestro modo de vida para frenar el calentamiento global, aunque a corto plazo suponga gastos o inconvenientes.',
            'Imagina que tu casa se está calentando mucho. ¿Gastarías dinero en arreglar el aire aunque sea caro, o esperarías a ver si se arregla solo?',
            ['psoe' => [4, 'Impulsa la transición ecológica.'], 'pp' => [3, 'Apoya transición "ordenada".'], 'vox' => [1, 'Rechaza el "ecologismo radical".'], 'sumar' => [5, 'Emergencia climática como prioridad.'], 'erc' => [5, 'Apoya transición ecológica ambiciosa.'], 'junts' => [4, 'Apoya políticas medioambientales.'], 'pnv' => [4, 'Defiende Pacto Verde Europeo.'], 'bildu' => [5, 'Emergencia climática como prioridad.'], 'alianca-catalana' => [3, 'Posiciones moderadas.']]
        );

        $this->createQuestion(
            $categories['medio-ambiente'],
            'Se deberían prohibir los coches de gasolina y diésel en 2035.',
            'La Unión Europea propone que a partir de 2035 no se puedan vender coches nuevos que funcionen con combustibles contaminantes, solo eléctricos.',
            'Es como si dijeran que dentro de unos años todos los coches de juguete tendrán que ser de pilas recargables, no de gasolina de mentira.',
            ['psoe' => [4, 'Apoya objetivos europeos.'], 'pp' => [2, 'Pide flexibilidad en plazos.'], 'vox' => [1, 'Rechaza restricciones a combustión.'], 'sumar' => [5, 'Apoya acelerar electromovilidad.'], 'erc' => [4, 'Apoya transición a eléctrico.'], 'junts' => [3, 'Posiciones moderadas.'], 'pnv' => [4, 'Apoya transición ordenada.'], 'bildu' => [5, 'Defiende descarbonización.'], 'alianca-catalana' => [3, 'Posiciones moderadas.']]
        );

        $this->createQuestion(
            $categories['medio-ambiente'],
            'Las centrales nucleares deberían mantenerse abiertas como energía limpia.',
            'Se debate si la energía nuclear, que no emite CO2 pero genera residuos radiactivos, debería seguir funcionando como alternativa a los combustibles fósiles.',
            'La nuclear es como una máquina que da mucha energía sin humo, pero deja basura especial que hay que guardar con mucho cuidado durante muchos años.',
            ['psoe' => [2, 'Mantiene plan de cierre.'], 'pp' => [4, 'Propone mantener nucleares.'], 'vox' => [4, 'Apoya energía nuclear.'], 'sumar' => [1, 'Apuesta por 100% renovables.'], 'erc' => [2, 'Crítica con nuclear.'], 'junts' => [3, 'Posiciones moderadas.'], 'pnv' => [3, 'Posiciones pragmáticas.'], 'bildu' => [1, 'Se opone a nuclear.'], 'alianca-catalana' => [4, 'Apoya reactores modulares.']]
        );

        // MODELO SOCIAL
        $this->createQuestion(
            $categories['modelo-social'],
            'Hacen falta más políticas de igualdad entre hombres y mujeres.',
            'Se refiere a si el gobierno debe seguir impulsando leyes y medidas para que mujeres y hombres tengan las mismas oportunidades en trabajo, salario y vida social.',
            'Como asegurarse de que en el patio tanto niños como niñas puedan jugar a todos los juegos y ninguno sea "solo para chicos" o "solo para chicas".',
            ['psoe' => [5, 'Ha impulsado leyes de igualdad.'], 'pp' => [3, 'Apoya igualdad pero critica algunas leyes.'], 'vox' => [1, 'Rechaza "ideología de género".'], 'sumar' => [5, 'Feminismo como eje central.'], 'erc' => [5, 'Defiende políticas feministas.'], 'junts' => [4, 'Apoya igualdad de género.'], 'pnv' => [4, 'Apoya políticas de igualdad.'], 'bildu' => [5, 'Feminismo como eje transversal.'], 'alianca-catalana' => [2, 'Posiciones tradicionales.']]
        );

        $this->createQuestion(
            $categories['modelo-social'],
            'El aborto debe seguir siendo un derecho legal y gratuito.',
            'Se pregunta si las mujeres deben poder decidir interrumpir su embarazo de forma legal y cubierta por la sanidad pública.',
            'Es una decisión muy personal sobre si una mujer puede elegir no tener un bebé cuando está embarazada, y si el médico puede ayudarla.',
            ['psoe' => [5, 'Defiende derecho al aborto.'], 'pp' => [3, 'Acepta ley actual con matices.'], 'vox' => [1, 'Se opone al aborto.'], 'sumar' => [5, 'Aborto como derecho fundamental.'], 'erc' => [5, 'Defiende derecho al aborto.'], 'junts' => [4, 'Respeta derecho al aborto.'], 'pnv' => [3, 'Posiciones moderadas.'], 'bildu' => [5, 'Defiende derechos reproductivos.'], 'alianca-catalana' => [2, 'Posiciones restrictivas.']]
        );

        $this->createQuestion(
            $categories['modelo-social'],
            'El matrimonio entre personas del mismo sexo debe estar reconocido.',
            'Se refiere a si dos hombres o dos mujeres deberían poder casarse legalmente y tener los mismos derechos que un matrimonio entre hombre y mujer.',
            'Es como preguntar si dos príncipes o dos princesas también pueden casarse y ser felices, no solo un príncipe con una princesa.',
            ['psoe' => [5, 'Aprobó el matrimonio igualitario.'], 'pp' => [4, 'Acepta el matrimonio igualitario.'], 'vox' => [2, 'Prefiere otras fórmulas legales.'], 'sumar' => [5, 'Defiende derechos LGTBI.'], 'erc' => [5, 'Defiende derechos LGTBI.'], 'junts' => [5, 'Apoya matrimonio igualitario.'], 'pnv' => [4, 'Apoya derechos LGTBI.'], 'bildu' => [5, 'Defiende derechos LGTBI.'], 'alianca-catalana' => [3, 'Posiciones más tradicionales.']]
        );

        // EDUCACIÓN Y SANIDAD
        $this->createQuestion(
            $categories['educacion-sanidad'],
            'La sanidad pública debe reforzarse aunque haya que subir impuestos.',
            'Se pregunta si prefieres pagar más impuestos para tener hospitales públicos mejor equipados con más médicos y menos esperas.',
            'Es como decidir si todos los niños del barrio ponen un poco más de su paga para tener un parque más grande y con mejores columpios.',
            ['psoe' => [4, 'Defiende reforzar sanidad pública.'], 'pp' => [3, 'Apoya sanidad pública y privada.'], 'vox' => [2, 'Propone libertad de elección.'], 'sumar' => [5, 'Propone blindar sanidad pública.'], 'erc' => [5, 'Defiende sanidad pública universal.'], 'junts' => [4, 'Apoya sanidad pública catalana.'], 'pnv' => [4, 'Defiende Osakidetza.'], 'bildu' => [5, 'Defiende sanidad 100% pública.'], 'alianca-catalana' => [3, 'Posiciones moderadas.']]
        );

        $this->createQuestion(
            $categories['educacion-sanidad'],
            'Los padres deberían poder elegir qué contenidos estudian sus hijos en temas como sexualidad.',
            'Se refiere al llamado "pin parental": si los padres pueden decidir que sus hijos no asistan a charlas sobre sexualidad, diversidad u otros temas en el colegio.',
            'Es como si tus padres pudieran decir que no vayas a algunas clases especiales porque prefieren explicarte esas cosas ellos en casa.',
            ['psoe' => [1, 'Defiende educación sexual obligatoria.'], 'pp' => [3, 'Apoya control parental en ciertos contenidos.'], 'vox' => [5, 'Defiende el pin parental.'], 'sumar' => [1, 'Rechaza el pin parental.'], 'erc' => [1, 'Rechaza el pin parental.'], 'junts' => [2, 'Rechaza el pin parental.'], 'pnv' => [2, 'Rechaza el pin parental.'], 'bildu' => [1, 'Rechaza el pin parental.'], 'alianca-catalana' => [4, 'Apoya control parental.']]
        );

        $this->createQuestion(
            $categories['educacion-sanidad'],
            'El Estado debería financiar los colegios privados y concertados.',
            'Se debate si el dinero público debe destinarse también a colegios privados mediante conciertos, o solo a la escuela pública.',
            'Imagina que el ayuntamiento tiene dinero para parques. ¿Debería darlo solo al parque público o también a un parque privado donde no todos pueden entrar?',
            ['psoe' => [3, 'Apoya conciertos con condiciones.'], 'pp' => [4, 'Defiende la concertada.'], 'vox' => [5, 'Defiende libertad de elección educativa.'], 'sumar' => [2, 'Prioriza escuela pública.'], 'erc' => [2, 'Prioriza escuela pública catalana.'], 'junts' => [3, 'Posición moderada.'], 'pnv' => [4, 'Apoya la concertada.'], 'bildu' => [2, 'Prioriza escuela pública.'], 'alianca-catalana' => [4, 'Apoya libertad de elección.']]
        );

        // VIVIENDA
        $this->createQuestion(
            $categories['vivienda'],
            'El gobierno debería limitar por ley el precio de los alquileres.',
            'Se refiere a si el Estado debe poner un tope máximo a lo que los propietarios pueden cobrar por alquilar sus pisos.',
            'Es como si en tu barrio hubiera una norma que dice que las chuches no pueden costar más de 1€, para que todos los niños puedan comprarlas.',
            ['psoe' => [4, 'Apoya regulación de alquileres.'], 'pp' => [2, 'Prefiere incentivos fiscales.'], 'vox' => [1, 'Rechaza intervenir en el mercado.'], 'sumar' => [5, 'Propone regular alquileres.'], 'erc' => [5, 'Apoya regulación de alquileres.'], 'junts' => [3, 'Posiciones moderadas.'], 'pnv' => [3, 'Posiciones moderadas.'], 'bildu' => [5, 'Defiende regular alquileres.'], 'alianca-catalana' => [2, 'Prefiere libre mercado.']]
        );

        $this->createQuestion(
            $categories['vivienda'],
            'Debería haber muchos más pisos públicos de alquiler asequible.',
            'Se propone que el gobierno construya o compre viviendas para alquilarlas a precios bajos a familias que no pueden pagar los precios del mercado.',
            'Como si el ayuntamiento tuviera casas para que las familias que no tienen mucho dinero puedan vivir pagando menos.',
            ['psoe' => [4, 'Propone más vivienda pública.'], 'pp' => [3, 'Apoya medidas mixtas.'], 'vox' => [2, 'Prefiere facilitar compra privada.'], 'sumar' => [5, 'Propone parque público de vivienda.'], 'erc' => [5, 'Apoya vivienda pública.'], 'junts' => [3, 'Posiciones moderadas.'], 'pnv' => [4, 'Apoya ampliar vivienda pública.'], 'bildu' => [5, 'Defiende vivienda pública masiva.'], 'alianca-catalana' => [3, 'Posiciones moderadas.']]
        );

        $this->createQuestion(
            $categories['vivienda'],
            'Ocupar casas vacías debería tener penas más duras.',
            'Se debate si las personas que entran a vivir en casas de otros sin permiso (ocupas) deberían recibir castigos más severos.',
            'Si alguien se mete a vivir en la casita del árbol de tu jardín sin pedirte permiso, ¿debería haber un castigo grande o pequeño?',
            ['psoe' => [3, 'Posición equilibrada.'], 'pp' => [4, 'Propone endurecer penas.'], 'vox' => [5, 'Propone tolerancia cero con ocupación.'], 'sumar' => [2, 'Distingue entre tipos de ocupación.'], 'erc' => [2, 'Posición matizada.'], 'junts' => [3, 'Posiciones moderadas.'], 'pnv' => [3, 'Posiciones moderadas.'], 'bildu' => [2, 'Posición matizada.'], 'alianca-catalana' => [5, 'Propone mano dura.']]
        );

        // SEGURIDAD Y JUSTICIA
        $this->createQuestion(
            $categories['seguridad-justicia'],
            'Las penas de cárcel deberían ser más duras para delitos graves.',
            'Se pregunta si los criminales que cometen delitos muy graves deberían pasar más tiempo en prisión del que pasan actualmente.',
            'Si alguien hace algo muy malo, ¿debería estar más tiempo castigado sin poder salir, o el tiempo que hay ahora está bien?',
            ['psoe' => [3, 'Apoya reinserción y proporcionalidad.'], 'pp' => [4, 'Propone endurecer penas.'], 'vox' => [5, 'Propone prisión permanente revisable.'], 'sumar' => [2, 'Prioriza la reinserción.'], 'erc' => [2, 'Apuesta por reinserción.'], 'junts' => [3, 'Posiciones moderadas.'], 'pnv' => [3, 'Posiciones moderadas.'], 'bildu' => [2, 'Apuesta por reinserción.'], 'alianca-catalana' => [4, 'Propone más dureza.']]
        );

        $this->createQuestion(
            $categories['seguridad-justicia'],
            'Se debe reconocer y compensar a las víctimas de la dictadura franquista.',
            'Se refiere a si el Estado debe investigar los crímenes del franquismo, exhumar fosas comunes y dar reparación a las familias de los represaliados.',
            'Hace muchos años hubo un gobierno malo que hizo daño a mucha gente. ¿Deberíamos ayudar a las familias de esas personas y recordar lo que pasó?',
            ['psoe' => [5, 'Aprobó Ley de Memoria Democrática.'], 'pp' => [2, 'Critica ley de memoria.'], 'vox' => [1, 'Rechaza leyes de memoria histórica.'], 'sumar' => [5, 'Defiende ampliar memoria democrática.'], 'erc' => [5, 'Apoya memoria histórica.'], 'junts' => [4, 'Apoya memoria histórica.'], 'pnv' => [4, 'Apoya reconocer a víctimas.'], 'bildu' => [5, 'Defiende memoria histórica.'], 'alianca-catalana' => [3, 'Posiciones moderadas.']]
        );

        $this->createQuestion(
            $categories['seguridad-justicia'],
            'La policía debería tener más medios y poder para mantener el orden.',
            'Se debate si las fuerzas de seguridad necesitan más recursos, agentes y capacidad de actuación para garantizar la seguridad ciudadana.',
            'Los policías son como los cuidadores del recreo. ¿Deberían tener más poder para poner orden, o ya tienen suficiente?',
            ['psoe' => [3, 'Posición equilibrada.'], 'pp' => [4, 'Apoya más medios policiales.'], 'vox' => [5, 'Propone más poder para las fuerzas de seguridad.'], 'sumar' => [2, 'Prioriza derechos ciudadanos.'], 'erc' => [2, 'Desconfía del Estado.'], 'junts' => [3, 'Apoya policía catalana.'], 'pnv' => [3, 'Apoya Ertzaintza.'], 'bildu' => [2, 'Crítico con fuerzas estatales.'], 'alianca-catalana' => [4, 'Apoya más seguridad.']]
        );

        // LENGUA E IDENTIDAD
        $this->createQuestion(
            $categories['lengua-identidad'],
            'El castellano debería ser la única lengua obligatoria en las escuelas de toda España.',
            'Se pregunta si solo el español debería ser obligatorio en colegios, o si en regiones como Cataluña, País Vasco o Galicia sus lenguas también deben ser obligatorias.',
            'Imagina que en tu cole se habla un idioma especial de tu pueblo. ¿Deberías aprenderlo junto con el español, o solo español?',
            ['psoe' => [2, 'Defiende el bilingüismo.'], 'pp' => [3, 'Quiere garantizar el castellano.'], 'vox' => [5, 'Castellano como única lengua vehicular.'], 'sumar' => [1, 'Defiende lenguas cooficiales.'], 'erc' => [1, 'Defiende inmersión en catalán.'], 'junts' => [1, 'Catalán como lengua vehicular.'], 'pnv' => [1, 'Defiende el euskera.'], 'bildu' => [1, 'Euskera como lengua vehicular.'], 'alianca-catalana' => [1, 'Defiende el catalán.']]
        );

        $this->createQuestion(
            $categories['lengua-identidad'],
            'Se deberían poder usar el catalán, euskera y gallego en el Congreso.',
            'Se refiere a si los diputados deberían poder hablar en sus lenguas cooficiales en el Parlamento español, con traducción simultánea.',
            'En una reunión de delegados de todos los coles de España, ¿cada uno debería poder hablar en el idioma de su pueblo o solo en español?',
            ['psoe' => [4, 'Ha permitido el uso en el Congreso.'], 'pp' => [2, 'Se opone al uso de cooficiales.'], 'vox' => [1, 'Rechaza lenguas cooficiales en Congreso.'], 'sumar' => [5, 'Apoya uso de todas las lenguas.'], 'erc' => [5, 'Defiende usar catalán en Congreso.'], 'junts' => [5, 'Defiende usar catalán.'], 'pnv' => [5, 'Defiende usar euskera.'], 'bildu' => [5, 'Defiende usar euskera.'], 'alianca-catalana' => [5, 'Defiende uso del catalán.']]
        );

        $this->createQuestion(
            $categories['lengua-identidad'],
            'Me siento más de mi región (catalán, vasco, gallego...) que español.',
            'Esta es una pregunta sobre identidad personal: si te identificas más con tu comunidad autónoma o con España como país.',
            'Es como preguntar si te sientes más de tu barrio o de tu ciudad. Puedes sentirte las dos cosas, más de una que de otra, o igual.',
            ['psoe' => [3, 'Reconoce identidades múltiples.'], 'pp' => [2, 'Prioriza identidad española.'], 'vox' => [1, 'España como única identidad.'], 'sumar' => [4, 'Reconoce plurinacionalidad.'], 'erc' => [5, 'Identidad catalana primero.'], 'junts' => [5, 'Identidad catalana primero.'], 'pnv' => [5, 'Identidad vasca primero.'], 'bildu' => [5, 'Identidad vasca primero.'], 'alianca-catalana' => [5, 'Identidad catalana primero.']]
        );
    }

    private function createQuestion(Category $category, string $text, string $explanation, string $explanationSimple, array $positions): void
    {
        $question = Question::create([
            'category_id' => $category->id,
            'text' => $text,
            'explanation' => $explanation,
            'explanation_simple' => $explanationSimple,
            'is_active' => true,
            'order' => Question::where('category_id', $category->id)->count() + 1,
        ]);

        foreach ($positions as $slug => $data) {
            if (!isset($this->parties[$slug])) continue;

            PartyPosition::create([
                'party_id' => $this->parties[$slug]->id,
                'question_id' => $question->id,
                'position' => $data[0],
                'justification' => $data[1],
                'weight' => 3,
            ]);
        }
    }
}
