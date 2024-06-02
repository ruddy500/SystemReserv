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
