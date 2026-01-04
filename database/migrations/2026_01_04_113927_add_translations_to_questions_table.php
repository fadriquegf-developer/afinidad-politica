<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->text('explanation_ca')->nullable()->after('explanation');
            $table->text('explanation_eu')->nullable()->after('explanation_ca');
            $table->text('explanation_gl')->nullable()->after('explanation_eu');

            $table->text('explanation_simple_ca')->nullable()->after('explanation_simple');
            $table->text('explanation_simple_eu')->nullable()->after('explanation_simple_ca');
            $table->text('explanation_simple_gl')->nullable()->after('explanation_simple_eu');
        });
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn([
                'explanation_ca',
                'explanation_eu',
                'explanation_gl',
                'explanation_simple_ca',
                'explanation_simple_eu',
                'explanation_simple_gl'
            ]);
        });
    }
};
