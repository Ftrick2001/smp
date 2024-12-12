<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // Agregamos ID explícitamente
            $table->foreignId('exam_id')
                ->cascadeOnUpdate()
                ->nullOnDelete()
                ->constrained();
            $table->string('question');
            $table->string('type');
            $table->json('options')->nullable();
            $table->string('correct_answer');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};