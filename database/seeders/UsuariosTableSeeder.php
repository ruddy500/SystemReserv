<?php

namespace Database\Seeders;


use App\Models\Usuarios;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    
       
    }

}
