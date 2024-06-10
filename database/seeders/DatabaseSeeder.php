<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call([
            NombreAmbientesTableSeeder::class,
            PeriodosTableSeeder::class,
            UsuariosTableSeeder::class,
            MateriasTableSeeder::class,
            DocentesMateriasTableSeeder::class,
            MotivosTableSeeder::class,
            TipoAmbientesTableSeeder::class,
            AnunciosTableSeeder::class,
            // Agrega aquí cualquier otra clase seeder que hayas creado
        ]);
    }
}
