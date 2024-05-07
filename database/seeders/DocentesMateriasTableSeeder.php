<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocentesMaterias;

class DocentesMateriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocentesMaterias::create(['docentes_id'=>3,'materias_id' =>1]);//elementos rosemary

        DocentesMaterias::create(['docentes_id'=>2,'materias_id' =>2]);// elementos leti
        DocentesMaterias::create(['docentes_id'=>2,'materias_id' =>3]);// elementos       
        DocentesMaterias::create(['docentes_id'=>2,'materias_id' =>4]);// intro
        DocentesMaterias::create(['docentes_id'=>2,'materias_id' =>5]);// arqui
        DocentesMaterias::create(['docentes_id'=>2,'materias_id' =>6]);// Tis
        DocentesMaterias::create(['docentes_id'=>2,'materias_id' =>7]);// algoritmos

        DocentesMaterias::create(['docentes_id'=>4,'materias_id' =>8]);   //catari
        DocentesMaterias::create(['docentes_id'=>4,'materias_id' =>9]);
        DocentesMaterias::create(['docentes_id'=>4,'materias_id' =>10]);
        DocentesMaterias::create(['docentes_id'=>4,'materias_id' =>11]);

        DocentesMaterias::create(['docentes_id'=>5,'materias_id' =>12]);  //cussi

        DocentesMaterias::create(['docentes_id'=>6,'materias_id' =>13]);  //henry

        DocentesMaterias::create(['docentes_id'=>7,'materias_id' =>14]);  //Corina
        DocentesMaterias::create(['docentes_id'=>7,'materias_id' =>15]);  //Corina
        DocentesMaterias::create(['docentes_id'=>7,'materias_id' =>16]);  //Corina
        DocentesMaterias::create(['docentes_id'=>7,'materias_id' =>17]);  //corina
        DocentesMaterias::create(['docentes_id'=>7,'materias_id' =>18]);  //Corina
    }
}
