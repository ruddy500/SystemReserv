<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes_materias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('docentes_id')
            ->nullable()
            ->constrained('usuarios')
            ->cascadeOnDelete() // Acción en eliminación
            ->cascadeOnUpdate(); // Acción en actualización
            
            $table->foreignId('materias_id')
            ->nullable()
            ->constrained('materias')
            ->cascadeOnDelete() // Acción en eliminación
            ->cascadeOnUpdate(); // Acción en actualización
            
      
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docentes_materias');
    }
}
