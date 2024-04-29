<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->integer('CantEstudiante')->nullable();
            $table->integer('TotalEstudiantes')->nullable();
            $table->enum('Tipo', ['individual', 'grupal'])->nullable();
            $table->enum('Estado', ['asignado', 'pendiente'])->nullable();
            $table->string('fecha',10)->nullable();

            $table->foreignId('motivos_id')
                ->nullable()
                ->constrained('motivos')
                ->cascadeOnDelete() // Acción en eliminación
                ->cascadeOnUpdate(); // Acción en actualización

            $table->foreignId('docentes_id')
                ->nullable()
                ->constrained('usuarios')
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
        Schema::dropIfExists('reservas');
    }
}
