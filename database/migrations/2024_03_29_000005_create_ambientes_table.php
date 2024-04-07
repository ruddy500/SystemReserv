<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Ubicacion',100)->nullable();
            $table->integer('Capacidad')->nullable();
            $table->boolean('Habilitado')->default(true);
            $table->foreignId('nombre_ambientes_id')
                ->nullable()
                ->constrained('nombre_ambientes')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            //$table->timestamps();
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ambientes');
    }
}
