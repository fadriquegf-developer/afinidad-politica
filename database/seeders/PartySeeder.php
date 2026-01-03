<?php

namespace Database\Seeders;

use App\Models\Party;
use Illuminate\Database\Seeder;

class PartySeeder extends Seeder
{
    public function run(): void
    {
        $parties = [
            ['name' => 'Partido Socialista Obrero Español', 'short_name' => 'PSOE', 'slug' => 'psoe', 'color' => '#E30613', 'ideology' => 'Socialdemocracia', 'territorial_scope' => 'nacional', 'order' => 1],
            ['name' => 'Partido Popular', 'short_name' => 'PP', 'slug' => 'pp', 'color' => '#0066CC', 'ideology' => 'Conservadurismo liberal', 'territorial_scope' => 'nacional', 'order' => 2],
            ['name' => 'VOX', 'short_name' => 'VOX', 'slug' => 'vox', 'color' => '#66BC29', 'ideology' => 'Derecha nacionalista', 'territorial_scope' => 'nacional', 'order' => 3],
            ['name' => 'Sumar', 'short_name' => 'Sumar', 'slug' => 'sumar', 'color' => '#E51C55', 'ideology' => 'Izquierda verde', 'territorial_scope' => 'nacional', 'order' => 4],
            ['name' => 'Esquerra Republicana de Catalunya', 'short_name' => 'ERC', 'slug' => 'erc', 'color' => '#FFB232', 'ideology' => 'Independentismo catalán de izquierdas', 'territorial_scope' => 'autonomico', 'order' => 5],
            ['name' => 'Junts per Catalunya', 'short_name' => 'Junts', 'slug' => 'junts', 'color' => '#00C1B5', 'ideology' => 'Independentismo catalán liberal', 'territorial_scope' => 'autonomico', 'order' => 6],
            ['name' => 'Partido Nacionalista Vasco', 'short_name' => 'PNV', 'slug' => 'pnv', 'color' => '#409243', 'ideology' => 'Nacionalismo vasco democristiano', 'territorial_scope' => 'autonomico', 'order' => 7],
            ['name' => 'EH Bildu', 'short_name' => 'Bildu', 'slug' => 'bildu', 'color' => '#A3C940', 'ideology' => 'Independentismo vasco de izquierdas', 'territorial_scope' => 'autonomico', 'order' => 8],
            ['name' => 'Aliança Catalana', 'short_name' => 'Aliança', 'slug' => 'alianca-catalana', 'color' => '#003366', 'ideology' => 'Independentismo catalán de derechas', 'territorial_scope' => 'autonomico', 'order' => 9],
        ];

        foreach ($parties as $party) {
            Party::create($party + ['is_active' => true]);
        }
    }
}
