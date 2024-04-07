<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//use PHPUnit\Framework\Constraint\Constraint;

class CreateAmbienteHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambiente_horario', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('AmbienteId')
                ->references('id')
                ->on('ambientes')
                ->onDelete('cascade');
            
            
            $table->unsignedBigInteger('HorarioId')
                ->references('id')
                ->on('horarios')
                ->onDelete('cascade');




            // $table->foreignId('AmbienteId')
            // ->nullable()
            // ->constrained('ambientes')
            // ->cascadeOnUpdate()
            // ->cascadeOnDelete();
                
            // $table->foreignId('HorarioId')
            // ->nullable()
            // ->constrained('horarios')
            // ->cascadeOnUpdate()
            // ->cascadeOnDelete();

            // $table->foreignId('AmbienteId')
            //      ->nullable()
            //      ->constrained('ambientes')
            //      ->cascadeOnUpdate()
            //      ->nullOnDelete();
            
            // $table->foreignId('HorarioId')
            // ->nullable()
            // ->constrained('horarios')
            // ->cascadeOnUpdate()
            // ->nullOnDelete();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ambiente_horario');
    }
}
