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

            $table->foreignId('DiaId')
                 ->nullable()
                 ->constrained('dias')
                 ->cascadeOnUpdate()
                 ->nullOnDelete();
            
            $table->foreignId('PeriodoId')
            ->nullable()
            ->constrained('periodos')
            ->cascadeOnUpdate()
            ->nullOnDelete();
        
            
            
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
