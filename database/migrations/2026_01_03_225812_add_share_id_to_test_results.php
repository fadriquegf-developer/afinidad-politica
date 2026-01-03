<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('test_results', function (Blueprint $table) {
            $table->string('share_id', 12)->unique()->nullable()->after('session_id');
            $table->json('compass_position')->nullable()->after('results'); // Guardar posición en la brújula
        });

        // Generar share_id para registros existentes
        $results = \App\Models\TestResult::whereNull('share_id')->get();
        foreach ($results as $result) {
            $result->update([
                'share_id' => \Str::random(12)
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('test_results', function (Blueprint $table) {
            $table->dropColumn(['share_id', 'compass_position']);
        });
    }
};
