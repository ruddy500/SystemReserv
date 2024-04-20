<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodosSeleccionadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos_seleccionado', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reservas_id')
            ->nullable()
            ->constrained('reservas')
            ->cascadeOnDelete() // Acción en eliminación
            ->cascadeOnUpdate(); // Acción en actualización
        
            $table->integer('periodos_id')->nullable();//serian los periodos escogidos
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodos_seleccionado');
    }
}
