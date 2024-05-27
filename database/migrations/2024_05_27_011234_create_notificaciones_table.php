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
            $table->string('fecha_actual_sistema',10)->nullable();
            $table->enum('Estado', ['aceptado', 'rechazado','sin responder'])->nullable();

            $table->foreignId('reservas_id')// hay que ver si es necesario esta llave foranea
                ->nullable()
                ->constrained('reservas')
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
        Schema::dropIfExists('notificaciones');
    }
}
