<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Party;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Verificar que no exista ya el partido
        if (!Party::where('slug', 'salf')->exists()) {
            Party::create([
                'name' => 'Se Acabó La Fiesta',
                'short_name' => 'SALF',
                'slug' => 'salf',
                'color' => '#785a46',
                'ideology' => 'Populismo antisistema',
                'description' => 'Partido político fundado en 2024 por Alvise Pérez. Se define por la defensa de la libertad, la transparencia de las administraciones públicas, el Estado de Derecho y la lucha contra la corrupción política.',
                'territorial_scope' => 'nacional',
                'website' => 'https://www.seacabolafiesta.com',
                'is_active' => true,
                'order' => 10,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Party::where('slug', 'salf')->delete();
    }
};
