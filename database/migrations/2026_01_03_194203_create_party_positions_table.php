<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('party_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('party_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('position')->comment('1-5: muy en contra a muy a favor');
            $table->text('justification')->nullable();
            $table->text('justification_ca')->nullable();
            $table->text('justification_eu')->nullable();
            $table->text('justification_gl')->nullable();
            $table->tinyInteger('weight')->default(3)->comment('1-5: importancia');
            $table->timestamps();

            $table->unique(['party_id', 'question_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_positions');
    }
};
