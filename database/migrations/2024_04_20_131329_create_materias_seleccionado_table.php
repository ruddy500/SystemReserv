<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasSeleccionadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias_seleccionado', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('reservas_id')
                ->nullable()
                ->constrained('reservas')
                ->cascadeOnDelete() // Acción en eliminación
                ->cascadeOnUpdate(); // Acción en actualización
            
            $table->integer('materias_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias_seleccionado');
    }
}
