<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosNotificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_notificacion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('usuarios_id')
                ->nullable()
                ->constrained('usuarios')
                ->cascadeOnDelete() // Acción en eliminación
                ->cascadeOnUpdate(); // Acción en actualización
            
            $table->foreignId('notificaciones_id')
                ->nullable()
                ->constrained('notificaciones')
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
        Schema::dropIfExists('usuarios_notificacion');
    }
}
