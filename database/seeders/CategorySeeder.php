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
        ];

        foreach ($categories as $category) {
            Category::create($category + ['is_active' => true]);
        }
    }
}
