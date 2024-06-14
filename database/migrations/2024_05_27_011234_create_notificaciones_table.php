<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_actual_sistema')->nullable();
            $table->enum('Estado', ['leido','no leido'])->nullable();
            $table->enum('Tipo', ['sugerencia', 'rechazado','asignacion','difusion'])->nullable();
            $table->integer('reservas_id')->nullable();
            $table->text('contenidoDifusion')->nullable();
            $table->enum('EstadoDocenteRosemary', ['leido','no leido'])->default('no leido'); // Valor por defecto
            $table->enum('EstadoDocenteLeticia', ['leido','no leido'])->default('no leido'); // Valor por defecto
            $table->enum('EstadoDocenteCatari', ['leido','no leido'])->default('no leido'); // Valor por defecto
            $table->enum('EstadoDocenteCussi', ['leido','no leido'])->default('no leido'); // Valor por defecto
            $table->enum('EstadoDocenteHenry', ['leido','no leido'])->default('no leido'); // Valor por defecto
            $table->enum('EstadoDocenteCorina', ['leido','no leido'])->default('no leido'); // Valor por defecto
            $table->dateTime('fecha_respuesta_Sugerencia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificaciones');
    }
}
