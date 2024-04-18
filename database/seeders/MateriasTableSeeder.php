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
}
}
