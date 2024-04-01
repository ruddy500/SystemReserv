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
        // \App\Models\User::factory(10)->create();
        $this->call([
            AmbientesTableSeeder::class,
            DiasTableSeeder::class,
            PeriodosTableSeeder::class,
            // Agrega aquí cualquier otra clase seeder que hayas creado
        ]);
    }
}
