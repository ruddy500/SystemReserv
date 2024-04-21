<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasAmbienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas_ambiente', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('ambientes_id')
                ->nullable()
                ->constrained('ambientes')
                ->cascadeOnDelete();
        
            $table->foreignId('reservas_id')
                ->nullable()
                ->constrained('reservas')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas_ambiente');
    }
}
