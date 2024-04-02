<?php

namespace Database\Seeders;

use App\Models\Ambientes;
use Illuminate\Database\Seeder;

class AmbientesTableSeeder extends Seeder
{
       public function run()
    {
        $ambientes = ['690 A','690 B','690 C','690 D','691 A','691 B','691 C','691 D','691 E'];
            // Agrega aquí más ambientes si los necesitas

        foreach ($ambientes as $ambiente) {
            Ambientes::create(['Nombre'=>$ambiente]);
        
        }
    }
}
