<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materias;

class MateriasTableSeeder extends Seeder
{
    
    public function run()
    {
        Materias::create(['Nombre'=>"Elementos de programacion",
                           'Grupo' =>1]);
        
        Materias::create(['Nombre'=>"Elementos de programacion",
                            'Grupo' =>2]);

        Materias::create(['Nombre'=>"Elementos de programacion",
                            'Grupo' =>3]);
        Materias::create(['Nombre'=>"Ecuaciones Diferenciales",
                            'Grupo' =>10]);
        Materias::create(['Nombre'=>"Calculo 2",
                            'Grupo' =>11]);
        Materias::create(['Nombre'=>"Calculo 1",
                            'Grupo' =>9]);
        Materias::create(['Nombre'=>"Ecuaciones Diferenciales",
                            'Grupo' =>3]);
        Materias::create(['Nombre'=>"Aplicacion de Sistemas Operativos",
                            'Grupo' =>14]);
        Materias::create(['Nombre'=>"Estadistica 2",
                            'Grupo' =>7]);
        Materias::create(['Nombre'=>"Simulacion de Sistemas",
                            'Grupo' =>8]);
}
}
