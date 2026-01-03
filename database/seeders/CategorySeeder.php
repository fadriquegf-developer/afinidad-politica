<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Modelo Territorial', 'slug' => 'modelo-territorial', 'icon' => '🏛️', 'color' => '#8B5CF6', 'description' => 'Organización del Estado, autonomías e independencia', 'order' => 1],
            ['name' => 'Economía y Fiscalidad', 'slug' => 'economia-fiscalidad', 'icon' => '💰', 'color' => '#F59E0B', 'description' => 'Impuestos, gasto público y modelo económico', 'order' => 2],
            ['name' => 'Empleo y Trabajo', 'slug' => 'empleo-trabajo', 'icon' => '💼', 'color' => '#3B82F6', 'description' => 'Derechos laborales, salarios y condiciones', 'order' => 3],
            ['name' => 'Inmigración', 'slug' => 'inmigracion', 'icon' => '🌍', 'color' => '#10B981', 'description' => 'Políticas migratorias e integración', 'order' => 4],
            ['name' => 'Medio Ambiente', 'slug' => 'medio-ambiente', 'icon' => '🌱', 'color' => '#22C55E', 'description' => 'Cambio climático y transición ecológica', 'order' => 5],
            ['name' => 'Modelo Social', 'slug' => 'modelo-social', 'icon' => '👥', 'color' => '#EC4899', 'description' => 'Igualdad, derechos LGTBI y valores sociales', 'order' => 6],
            ['name' => 'Educación y Sanidad', 'slug' => 'educacion-sanidad', 'icon' => '🏥', 'color' => '#EF4444', 'description' => 'Servicios públicos esenciales', 'order' => 7],
            ['name' => 'Vivienda', 'slug' => 'vivienda', 'icon' => '🏠', 'color' => '#F97316', 'description' => 'Acceso a vivienda y regulación del alquiler', 'order' => 8],
            ['name' => 'Seguridad y Justicia', 'slug' => 'seguridad-justicia', 'icon' => '⚖️', 'color' => '#6366F1', 'description' => 'Sistema judicial y seguridad ciudadana', 'order' => 9],
            ['name' => 'Lengua e Identidad', 'slug' => 'lengua-identidad', 'icon' => '🗣️', 'color' => '#8B5CF6', 'description' => 'Lenguas cooficiales e identidad cultural', 'order' => 10],
            ['name' => 'Pensiones y Bienestar', 'slug' => 'pensiones-bienestar', 'icon' => '👴', 'color' => '#9333EA', 'description' => 'Sistema de pensiones y protección social', 'order' => 11],
            ['name' => 'Instituciones', 'slug' => 'instituciones', 'icon' => '🏰', 'color' => '#DC2626', 'description' => 'Monarquía, república y forma de Estado', 'order' => 12],
            ['name' => 'Agricultura y Rural', 'slug' => 'agricultura-rural', 'icon' => '🌾', 'color' => '#65A30D', 'description' => 'Campo, ganadería y mundo rural', 'order' => 13],
            ['name' => 'Europa y Mundo', 'slug' => 'europa-mundo', 'icon' => '🇪🇺', 'color' => '#2563EB', 'description' => 'Unión Europea y relaciones internacionales', 'order' => 14],
        ];

        foreach ($categories as $category) {
            Category::create($category + ['is_active' => true]);
        }
    }
}
