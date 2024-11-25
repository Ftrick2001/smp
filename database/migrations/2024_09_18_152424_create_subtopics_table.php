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
        Schema::create('subtopics', function (Blueprint $table) {
            $table->id();
            $table  ->foreignId('lesson_id')
                    ->cascadeOnUpdate()
                    ->nullOnDelete()
                    ->constrained();
            $table->string('subtitle');
            $table->text('content');
            $table->text('thumbnail')
            ->nullable();
            $table->string('example')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtopics');
    }
};
