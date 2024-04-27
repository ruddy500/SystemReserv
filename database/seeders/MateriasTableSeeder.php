<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materias;

class MateriasTableSeeder extends Seeder
{
    
    public function run()
    {
        Materias::create(['Nombre'=>"Elementos de programacion",
                          'Grupo' =>1,
                          'Inscritos'=>90,
                        ]);
        
        Materias::create(['Nombre'=>"Elementos de programacion",
                          'Grupo' =>2,
                          'Inscritos'=>80,
                        ]);

        Materias::create(['Nombre'=>"Elementos de programacion",
                          'Grupo' =>3,
                          'Inscritos'=>70,
                        ]);
        Materias::create(['Nombre'=>"Ecuaciones Diferenciales",
                          'Grupo' =>10,
                          'Inscritos'=>90,
                        ]);
        Materias::create(['Nombre'=>"Calculo 2",
                          'Grupo' =>11,
                          'Inscritos'=>60,  
                        ]);
        Materias::create(['Nombre'=>"Calculo 1",
                          'Grupo' =>9,
                          'Inscritos'=>50,
                        ]);
        Materias::create(['Nombre'=>"Ecuaciones Diferenciales",
                          'Grupo' =>3,
                          'Inscritos'=>40,
                        ]);
        Materias::create(['Nombre'=>"Aplicacion de Sistemas Operativos",
                          'Grupo' =>14,
                          'Inscritos'=>60,
                        ]);
        Materias::create(['Nombre'=>"Estadistica 2",
                          'Grupo' =>7,
                          'Inscritos'=>70,
                        ]);
        Materias::create(['Nombre'=>"Simulacion de Sistemas",
                          'Grupo' =>8,
                          'Inscritos'=>80,
                        ]);
}
}
