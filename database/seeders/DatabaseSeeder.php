<?php

namespace Database\Seeders;

use App\Models\NombreAmbientes;
use App\Models\Usuarios;
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
        // \App\Models\User::factory(10)->create();
        $this->call([
            NombreAmbientesTableSeeder::class,
            PeriodosTableSeeder::class,
            UsuariosTableSeeder::class,
            // Agrega aquí cualquier otra clase seeder que hayas creado
        ]);
    }
}
