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
        $user = new Usuarios;
        $user->name = 'Admin';
        $user->email = 'Admin@gmail.com';
        $user->password ='1234';
        $user->save();

        $user1 = new Usuarios;
        $user1->name = 'Docente';
        $user1->email = 'Docen@gmail.com';
        $user1->password ='1234';
        $user1->save();
        
        // \App\Models\User::factory(10)->create();
        $this->call([
            NombreAmbientesTableSeeder::class,
            DiasTableSeeder::class,
            PeriodosTableSeeder::class,
            UsuariosTableSeeder::class,
            // Agrega aquí cualquier otra clase seeder que hayas creado
        ]);
        
        
        
    }
    // public function createUser(){
    //     $user = Usuarios::create(request('Jurgen','jurgen@gmail.com',bcrypt('1234')));
    // }
}
