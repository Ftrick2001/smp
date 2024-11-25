<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Primero aseguramos que cualquier dato existente sea JSON válido
        DB::statement("UPDATE questions SET options = '{}' WHERE options IS NULL OR options = ''");

        // Luego modificamos la columna a JSON
        DB::statement('ALTER TABLE questions MODIFY options JSON NULL');
    }

    public function down()
    {
        DB::statement('ALTER TABLE questions MODIFY options LONGTEXT NULL');
    }
};