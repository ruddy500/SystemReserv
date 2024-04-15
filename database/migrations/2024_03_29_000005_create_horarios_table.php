<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
        $table->id();
        $table->boolean('Estado')->default(true);
        
        $table->foreignId('fechas_id')
            ->nullable()
            ->constrained('fechas')
            ->cascadeOnDelete() // Acción en eliminación
            ->cascadeOnUpdate(); // Acción en actualización
        
        $table->foreignId('periodos_id')
            ->nullable()
            ->constrained('periodos')
            ->cascadeOnDelete() // Acción en eliminación
            ->cascadeOnUpdate(); // Acción en actualización
        
        $table->foreignId('ambientes_id')
            ->nullable()
            ->constrained('ambientes')
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
        Schema::dropIfExists('horarios');
    }

}
