<?php

namespace Database\Seeders;

use App\Models\NombreAmbientes;
use Illuminate\Database\Seeder;

class NombreAmbientesTableSeeder extends Seeder
{
       public function run()
    {
        $nombreAmbientes = ['690 A','690 B','690 C','690 D','691 A','691 B','691 C','691 D','691 E'];
            // Agrega aquí más ambientes si los necesitas

        foreach ($nombreAmbientes as $nombreAmbiente) {
            NombreAmbientes::create(['Nombre'=>$nombreAmbiente]);
        
        }
    }
}
