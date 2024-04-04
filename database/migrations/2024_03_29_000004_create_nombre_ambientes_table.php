<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNombreAmbientesTable extends Migration
{
       public function up()
    {
        Schema::create('nombre_ambientes', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre',50);
            $table->boolean('Usado')->default(false);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nombre_ambientes');
    }
}
