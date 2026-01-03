<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Si no existe share_id, añadirlo
        if (!Schema::hasColumn('test_results', 'share_id')) {
            Schema::table('test_results', function (Blueprint $table) {
                $table->string('share_id', 12)->unique()->nullable()->after('session_id');
            });
        }

        // Si no existe compass_position, añadirlo
        if (!Schema::hasColumn('test_results', 'compass_position')) {
            Schema::table('test_results', function (Blueprint $table) {
                $table->json('compass_position')->nullable()->after('results');
            });
        }

        // Añadir category_scores para el radar
        if (!Schema::hasColumn('test_results', 'category_scores')) {
            Schema::table('test_results', function (Blueprint $table) {
                $table->json('category_scores')->nullable()->after('compass_position');
            });
        }

        // Generar share_id para registros existentes que no lo tengan
        $results = \App\Models\TestResult::whereNull('share_id')->get();
        foreach ($results as $result) {
            $result->update([
                'share_id' => \Str::random(10)
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('test_results', function (Blueprint $table) {
            if (Schema::hasColumn('test_results', 'category_scores')) {
                $table->dropColumn('category_scores');
            }
        });
    }
};
