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
        DocentesMaterias::create(['docentes_id'=>2,'materias_id' =>2]);
        DocentesMaterias::create(['docentes_id'=>2,'materias_id' =>3]);
        DocentesMaterias::create(['docentes_id'=>2,'materias_id' =>1]);  //leticia gupos 1,2,3

        DocentesMaterias::create(['docentes_id'=>3,'materias_id' =>4]);   //catari
        DocentesMaterias::create(['docentes_id'=>3,'materias_id' =>5]);
        DocentesMaterias::create(['docentes_id'=>3,'materias_id' =>6]);
        DocentesMaterias::create(['docentes_id'=>3,'materias_id' =>7]);

        DocentesMaterias::create(['docentes_id'=>4,'materias_id' =>8]);  //cussi

        DocentesMaterias::create(['docentes_id'=>5,'materias_id' =>10]);  //henry
    }
}
