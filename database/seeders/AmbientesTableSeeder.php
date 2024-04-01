<?php

namespace Database\Seeders;

use App\Models\Ambientes;
use Illuminate\Database\Seeder;

class AmbientesTableSeeder extends Seeder
{
       public function run()
    {
        $ambientes = [
            ['Nombre' => '691 A', 'Capacidad' => 100],
            ['Nombre' => '691 B', 'Capacidad' => 100],
            ['Nombre' => '69" C', 'Capacidad' => 80],
            ['Nombre' => '692 A', 'Capacidad' => 80],
            ['Nombre' => '690 A', 'Capacidad' => 50],
            ['Nombre' => '690 B', 'Capacidad' => 300],
            // Agrega aquí más ambientes si los necesitas
        ];

        foreach ($ambientes as $ambiente) {
            Ambientes::create([
                'Nombre' => $ambiente['Nombre'],
                'Capacidad' => $ambiente['Capacidad'],
            ]);
        }
    }
}
