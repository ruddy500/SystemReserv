<?php

namespace Database\Seeders;


use App\Models\Usuarios;
use Illuminate\Database\Seeder;



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
        $user->name = 'Administrador';
        $user->email = 'Administrador@gmail.com';
        $user->password ='1234';
        $user->role = 'admin';
        $user->save();

        $user1 = new Usuarios;
        $user1->name = 'Leticia';
        $user1->email = 'leticia@gmail.com';
        $user1->password ='1234';
        $user1->role = 'docente';
        $user1->save();

        $user2 = new Usuarios;
        $user2->name = 'Catari';
        $user2->email = 'catari@gmail.com';
        $user2->password ='1234';
        $user2->role = 'docente';
        $user2->save();

        $user3 = new Usuarios;
        $user3->name = 'Cussi';
        $user3->email = 'cussi@gmail.com';
        $user3->password ='1234';
        $user3->role = 'docente';
        $user3->save();
        
        $user4 = new Usuarios;
        $user4->name = 'Henry';
        $user4->email = 'henry@gmail.com';
        $user4->password ='1234';
        $user4->role = 'docente';
        $user4->save();
       
    }

}
