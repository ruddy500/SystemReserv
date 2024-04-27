<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Motivos;

class MotivosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Motivos::create(['Nombre'=>"Examen primer parcial",
                        ]);
        Motivos::create(['Nombre'=>"Examen segundo parcial",
                        ]);
        Motivos::create(['Nombre'=>"Examen final",
                        ]);
        Motivos::create(['Nombre'=>"Examen segunda instancia",
                        ]);
        Motivos::create(['Nombre'=>"Taller",
                        ]);
        Motivos::create(['Nombre'=>"Seminario",
                        ]);
    }
}
