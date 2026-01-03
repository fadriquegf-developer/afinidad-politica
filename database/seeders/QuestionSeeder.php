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
        $this->createQuestion($categories['modelo-territorial'], 'España debería ser un estado más centralizado, reduciendo el poder de las comunidades autónomas.', [
            'psoe' => [2, 'El PSOE defiende el Estado de las Autonomías actual.'],
            'pp' => [3, 'El PP apoya las autonomías pero con más coordinación estatal.'],
            'vox' => [5, 'VOX propone eliminar las autonomías y centralizar competencias.'],
            'sumar' => [1, 'Sumar defiende un modelo federal plurinacional.'],
            'erc' => [1, 'ERC quiere más autogobierno, no menos.'],
            'junts' => [1, 'Junts rechaza cualquier recentralización.'],
            'pnv' => [1, 'El PNV defiende el autogobierno vasco.'],
            'bildu' => [1, 'Bildu defiende la soberanía de Euskal Herria.'],
            'alianca-catalana' => [1, 'Aliança defiende la independencia de Catalunya.'],
        ]);

        $this->createQuestion($categories['modelo-territorial'], 'Las regiones con lengua y cultura propias deberían tener derecho a decidir su independencia.', [
            'psoe' => [2, 'El PSOE rechaza la autodeterminación pero apoya el diálogo.'],
            'pp' => [1, 'El PP se opone firmemente a cualquier referéndum de independencia.'],
            'vox' => [1, 'VOX considera la unidad de España innegociable.'],
            'sumar' => [3, 'Sumar reconoce la plurinacionalidad pero con matices.'],
            'erc' => [5, 'ERC defiende el derecho a la autodeterminación.'],
            'junts' => [5, 'Junts apoya el derecho a decidir de Catalunya.'],
            'pnv' => [4, 'El PNV defiende el derecho a decidir del pueblo vasco.'],
            'bildu' => [5, 'Bildu defiende el derecho a decidir de Euskal Herria.'],
            'alianca-catalana' => [5, 'Aliança defiende la independencia unilateral si es necesario.'],
        ]);

        // ECONOMÍA Y FISCALIDAD
        $this->createQuestion($categories['economia-fiscalidad'], 'Los impuestos a las grandes fortunas y empresas deberían aumentar significativamente.', [
            'psoe' => [4, 'El PSOE apoya más impuestos a rentas altas.'],
            'pp' => [2, 'El PP prefiere bajar impuestos para estimular la economía.'],
            'vox' => [1, 'VOX propone una bajada generalizada de impuestos.'],
            'sumar' => [5, 'Sumar propone una reforma fiscal progresiva fuerte.'],
            'erc' => [4, 'ERC apoya mayor fiscalidad a las grandes fortunas.'],
            'junts' => [3, 'Junts tiene posiciones más liberales en economía.'],
            'pnv' => [3, 'El PNV defiende el Concierto Económico vasco.'],
            'bildu' => [5, 'Bildu defiende una fiscalidad muy progresiva.'],
            'alianca-catalana' => [2, 'Aliança tiene posiciones económicas liberales.'],
        ]);

        $this->createQuestion($categories['economia-fiscalidad'], 'El Estado debería intervenir más en la economía, incluyendo nacionalizaciones de sectores estratégicos.', [
            'psoe' => [3, 'El PSOE apoya intervención moderada del Estado.'],
            'pp' => [2, 'El PP prefiere menos intervención estatal.'],
            'vox' => [2, 'VOX defiende la economía de mercado con protección nacional.'],
            'sumar' => [5, 'Sumar propone un Estado más interventor y empresas públicas.'],
            'erc' => [4, 'ERC apoya mayor presencia pública en sectores clave.'],
            'junts' => [2, 'Junts prefiere menos intervención estatal.'],
            'pnv' => [3, 'El PNV apoya un modelo mixto.'],
            'bildu' => [5, 'Bildu defiende la economía social y pública.'],
            'alianca-catalana' => [2, 'Aliança prefiere el libre mercado.'],
        ]);

        // EMPLEO Y TRABAJO
        $this->createQuestion($categories['empleo-trabajo'], 'El salario mínimo debería seguir subiendo aunque algunas empresas tengan dificultades.', [
            'psoe' => [4, 'El PSOE ha impulsado subidas del SMI.'],
            'pp' => [2, 'El PP prefiere vincular el SMI a la productividad.'],
            'vox' => [2, 'VOX critica las subidas del SMI.'],
            'sumar' => [5, 'Sumar propone seguir subiendo el SMI hasta el 60% del salario medio.'],
            'erc' => [4, 'ERC apoya subidas del salario mínimo.'],
            'junts' => [3, 'Junts tiene posiciones moderadas.'],
            'pnv' => [4, 'El PNV apoya mejorar los salarios.'],
            'bildu' => [5, 'Bildu defiende subidas salariales importantes.'],
            'alianca-catalana' => [2, 'Aliança prioriza la competitividad empresarial.'],
        ]);

        $this->createQuestion($categories['empleo-trabajo'], 'Se debería implantar la jornada laboral de 4 días semanales.', [
            'psoe' => [3, 'El PSOE está abierto a estudiar la reducción de jornada.'],
            'pp' => [2, 'El PP lo ve inviable actualmente.'],
            'vox' => [1, 'VOX se opone a reducir la jornada laboral por ley.'],
            'sumar' => [5, 'Sumar propone implantar la semana de 4 días.'],
            'erc' => [4, 'ERC apoya la reducción de jornada.'],
            'junts' => [3, 'Junts tiene posiciones moderadas.'],
            'pnv' => [3, 'El PNV apoya explorar nuevos modelos.'],
            'bildu' => [5, 'Bildu defiende la reducción de la jornada laboral.'],
            'alianca-catalana' => [2, 'Aliança prefiere que lo decidan empresas y trabajadores.'],
        ]);

        // INMIGRACIÓN
        $this->createQuestion($categories['inmigracion'], 'La inmigración irregular debería controlarse con más firmeza, incluyendo deportaciones más rápidas.', [
            'psoe' => [3, 'El PSOE apuesta por control respetando derechos humanos.'],
            'pp' => [4, 'El PP propone mayor control de la inmigración irregular.'],
            'vox' => [5, 'VOX propone deportaciones masivas.'],
            'sumar' => [2, 'Sumar prioriza los derechos humanos y vías legales.'],
            'erc' => [2, 'ERC defiende políticas de acogida.'],
            'junts' => [3, 'Junts tiene posiciones moderadas.'],
            'pnv' => [3, 'El PNV apoya inmigración ordenada.'],
            'bildu' => [2, 'Bildu defiende los derechos de los migrantes.'],
            'alianca-catalana' => [5, 'Aliança propone deportar inmigrantes ilegales.'],
        ]);

        $this->createQuestion($categories['inmigracion'], 'Los inmigrantes con papeles deberían tener los mismos derechos que los españoles a ayudas sociales.', [
            'psoe' => [4, 'El PSOE defiende la integración con igualdad.'],
            'pp' => [3, 'El PP apoya derechos tras cumplir requisitos.'],
            'vox' => [1, 'VOX propone "prioridad nacional" en ayudas.'],
            'sumar' => [5, 'Sumar defiende igualdad de derechos.'],
            'erc' => [5, 'ERC defiende derechos universales.'],
            'junts' => [4, 'Junts apoya la integración.'],
            'pnv' => [4, 'El PNV defiende la integración.'],
            'bildu' => [5, 'Bildu defiende igualdad de derechos.'],
            'alianca-catalana' => [2, 'Aliança prioriza a los catalanes.'],
        ]);

        // MEDIO AMBIENTE
        $this->createQuestion($categories['medio-ambiente'], 'La lucha contra el cambio climático debe ser prioritaria, aunque implique costes económicos a corto plazo.', [
            'psoe' => [4, 'El PSOE impulsa la transición ecológica.'],
            'pp' => [3, 'El PP apoya transición "ordenada".'],
            'vox' => [1, 'VOX rechaza el "ecologismo radical".'],
            'sumar' => [5, 'Sumar sitúa la emergencia climática como prioridad.'],
            'erc' => [5, 'ERC apoya transición ecológica ambiciosa.'],
            'junts' => [4, 'Junts apoya políticas medioambientales.'],
            'pnv' => [4, 'El PNV defiende el Pacto Verde Europeo.'],
            'bildu' => [5, 'Bildu sitúa la emergencia climática como prioridad.'],
            'alianca-catalana' => [3, 'Aliança tiene posiciones moderadas.'],
        ]);

        $this->createQuestion($categories['medio-ambiente'], 'Se debería prohibir la venta de coches de combustión para 2035.', [
            'psoe' => [4, 'El PSOE apoya los objetivos europeos.'],
            'pp' => [2, 'El PP pide flexibilidad en los plazos.'],
            'vox' => [1, 'VOX rechaza las restricciones.'],
            'sumar' => [5, 'Sumar apoya acelerar la electromovilidad.'],
            'erc' => [4, 'ERC apoya la transición al vehículo eléctrico.'],
            'junts' => [3, 'Junts tiene posiciones moderadas.'],
            'pnv' => [4, 'El PNV apoya la transición ordenada.'],
            'bildu' => [5, 'Bildu defiende la descarbonización.'],
            'alianca-catalana' => [3, 'Aliança tiene posiciones moderadas.'],
        ]);

        // MODELO SOCIAL
        $this->createQuestion($categories['modelo-social'], 'Las políticas de igualdad de género son necesarias para corregir discriminaciones históricas.', [
            'psoe' => [5, 'El PSOE ha impulsado leyes de igualdad.'],
            'pp' => [3, 'El PP apoya igualdad pero critica algunas leyes.'],
            'vox' => [1, 'VOX rechaza la "ideología de género".'],
            'sumar' => [5, 'Sumar tiene el feminismo como eje central.'],
            'erc' => [5, 'ERC defiende políticas feministas.'],
            'junts' => [4, 'Junts apoya la igualdad de género.'],
            'pnv' => [4, 'El PNV apoya las políticas de igualdad.'],
            'bildu' => [5, 'Bildu tiene el feminismo como eje transversal.'],
            'alianca-catalana' => [2, 'Aliança tiene posiciones tradicionales.'],
        ]);

        $this->createQuestion($categories['modelo-social'], 'El aborto debería seguir siendo legal y accesible en la sanidad pública.', [
            'psoe' => [5, 'El PSOE defiende el derecho al aborto.'],
            'pp' => [3, 'El PP acepta la ley actual pero con matices.'],
            'vox' => [1, 'VOX se opone al aborto.'],
            'sumar' => [5, 'Sumar defiende el aborto como derecho.'],
            'erc' => [5, 'ERC defiende el derecho al aborto.'],
            'junts' => [4, 'Junts respeta el derecho al aborto.'],
            'pnv' => [3, 'El PNV tiene posiciones moderadas.'],
            'bildu' => [5, 'Bildu defiende los derechos reproductivos.'],
            'alianca-catalana' => [2, 'Aliança tiene posiciones restrictivas.'],
        ]);

        $this->createQuestion($categories['modelo-social'], 'La eutanasia debería seguir siendo legal para personas con enfermedades incurables.', [
            'psoe' => [5, 'El PSOE aprobó la ley de eutanasia.'],
            'pp' => [2, 'El PP se abstuvo en la votación.'],
            'vox' => [1, 'VOX se opone a la eutanasia.'],
            'sumar' => [5, 'Sumar defiende el derecho a muerte digna.'],
            'erc' => [5, 'ERC apoya la ley de eutanasia.'],
            'junts' => [4, 'Junts apoya la ley de eutanasia.'],
            'pnv' => [3, 'El PNV tiene posiciones divididas.'],
            'bildu' => [5, 'Bildu defiende el derecho a decidir.'],
            'alianca-catalana' => [2, 'Aliança tiene posiciones tradicionales.'],
        ]);

        // EDUCACIÓN Y SANIDAD
        $this->createQuestion($categories['educacion-sanidad'], 'La sanidad pública debería reforzarse aunque implique subir impuestos.', [
            'psoe' => [4, 'El PSOE defiende reforzar la sanidad pública.'],
            'pp' => [3, 'El PP apoya la sanidad pública y la privada.'],
            'vox' => [2, 'VOX propone libertad de elección.'],
            'sumar' => [5, 'Sumar propone blindar la sanidad pública.'],
            'erc' => [5, 'ERC defiende la sanidad pública universal.'],
            'junts' => [4, 'Junts apoya la sanidad pública catalana.'],
            'pnv' => [4, 'El PNV defiende Osakidetza.'],
            'bildu' => [5, 'Bildu defiende sanidad 100% pública.'],
            'alianca-catalana' => [3, 'Aliança tiene posiciones moderadas.'],
        ]);

        $this->createQuestion($categories['educacion-sanidad'], 'Los padres deberían poder elegir que sus hijos no reciban educación sexual en la escuela.', [
            'psoe' => [1, 'El PSOE defiende la educación sexual obligatoria.'],
            'pp' => [3, 'El PP apoya el "pin parental" en ciertos contenidos.'],
            'vox' => [5, 'VOX defiende el pin parental.'],
            'sumar' => [1, 'Sumar rechaza el pin parental.'],
            'erc' => [1, 'ERC rechaza el pin parental.'],
            'junts' => [2, 'Junts rechaza el pin parental.'],
            'pnv' => [2, 'El PNV rechaza el pin parental.'],
            'bildu' => [1, 'Bildu rechaza el pin parental.'],
            'alianca-catalana' => [4, 'Aliança apoya el control parental.'],
        ]);

        // VIVIENDA
        $this->createQuestion($categories['vivienda'], 'El Estado debería regular y limitar los precios del alquiler.', [
            'psoe' => [4, 'El PSOE apoya la regulación de alquileres.'],
            'pp' => [2, 'El PP prefiere incentivos fiscales.'],
            'vox' => [1, 'VOX rechaza intervenir en el mercado.'],
            'sumar' => [5, 'Sumar propone regular los alquileres.'],
            'erc' => [5, 'ERC apoya la regulación de alquileres.'],
            'junts' => [3, 'Junts tiene posiciones moderadas.'],
            'pnv' => [3, 'El PNV tiene posiciones moderadas.'],
            'bildu' => [5, 'Bildu defiende regular los alquileres.'],
            'alianca-catalana' => [2, 'Aliança prefiere el libre mercado.'],
        ]);

        $this->createQuestion($categories['vivienda'], 'Se debería aumentar significativamente la construcción de vivienda pública.', [
            'psoe' => [4, 'El PSOE propone más vivienda pública.'],
            'pp' => [3, 'El PP apoya medidas mixtas.'],
            'vox' => [2, 'VOX prefiere facilitar la compra privada.'],
            'sumar' => [5, 'Sumar propone un parque público de vivienda.'],
            'erc' => [5, 'ERC apoya la vivienda pública.'],
            'junts' => [3, 'Junts tiene posiciones moderadas.'],
            'pnv' => [4, 'El PNV apoya ampliar Etxebide.'],
            'bildu' => [5, 'Bildu defiende vivienda pública masiva.'],
            'alianca-catalana' => [3, 'Aliança tiene posiciones moderadas.'],
        ]);

        // SEGURIDAD Y JUSTICIA
        $this->createQuestion($categories['seguridad-justicia'], 'Las penas de cárcel deberían endurecerse para delitos graves.', [
            'psoe' => [3, 'El PSOE apoya reinserción y proporcionalidad.'],
            'pp' => [4, 'El PP propone endurecer penas.'],
            'vox' => [5, 'VOX propone prisión permanente revisable ampliada.'],
            'sumar' => [2, 'Sumar prioriza la reinserción.'],
            'erc' => [2, 'ERC apuesta por reinserción.'],
            'junts' => [3, 'Junts tiene posiciones moderadas.'],
            'pnv' => [3, 'El PNV tiene posiciones moderadas.'],
            'bildu' => [2, 'Bildu apuesta por la reinserción.'],
            'alianca-catalana' => [4, 'Aliança propone más dureza.'],
        ]);

        $this->createQuestion($categories['seguridad-justicia'], 'Se debería reconocer y reparar a las víctimas del franquismo.', [
            'psoe' => [5, 'El PSOE aprobó la Ley de Memoria Democrática.'],
            'pp' => [2, 'El PP critica la ley de memoria.'],
            'vox' => [1, 'VOX rechaza las leyes de memoria histórica.'],
            'sumar' => [5, 'Sumar defiende ampliar la memoria democrática.'],
            'erc' => [5, 'ERC apoya la memoria histórica.'],
            'junts' => [4, 'Junts apoya la memoria histórica.'],
            'pnv' => [4, 'El PNV apoya reconocer a las víctimas.'],
            'bildu' => [5, 'Bildu defiende la memoria histórica.'],
            'alianca-catalana' => [3, 'Aliança tiene posiciones moderadas.'],
        ]);

        // LENGUA E IDENTIDAD
        $this->createQuestion($categories['lengua-identidad'], 'El castellano debería ser la única lengua vehicular en la educación en toda España.', [
            'psoe' => [2, 'El PSOE defiende el bilingüismo.'],
            'pp' => [3, 'El PP quiere garantizar el castellano.'],
            'vox' => [5, 'VOX propone el castellano como única lengua vehicular.'],
            'sumar' => [1, 'Sumar defiende las lenguas cooficiales.'],
            'erc' => [1, 'ERC defiende la inmersión en catalán.'],
            'junts' => [1, 'Junts defiende el catalán como lengua vehicular.'],
            'pnv' => [1, 'El PNV defiende el euskera.'],
            'bildu' => [1, 'Bildu defiende el euskera como lengua vehicular.'],
            'alianca-catalana' => [1, 'Aliança defiende el catalán.'],
        ]);

        $this->createQuestion($categories['lengua-identidad'], 'Las lenguas cooficiales deberían poder usarse en el Congreso de los Diputados.', [
            'psoe' => [4, 'El PSOE ha permitido el uso en el Congreso.'],
            'pp' => [2, 'El PP se opone al uso de lenguas cooficiales.'],
            'vox' => [1, 'VOX rechaza las lenguas cooficiales en el Congreso.'],
            'sumar' => [5, 'Sumar apoya el uso de todas las lenguas.'],
            'erc' => [5, 'ERC defiende usar el catalán en el Congreso.'],
            'junts' => [5, 'Junts defiende usar el catalán.'],
            'pnv' => [5, 'El PNV defiende usar el euskera.'],
            'bildu' => [5, 'Bildu defiende usar el euskera.'],
            'alianca-catalana' => [5, 'Aliança defiende el uso del catalán.'],
        ]);
    }

    private function createQuestion(Category $category, string $text, array $positions): void
    {
        $question = Question::create([
            'category_id' => $category->id,
            'text' => $text,
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
