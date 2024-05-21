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
        $user->email = 'adaenterprisesoft@gmail.com';
        $user->password ='1234';
        $user->role = 'admin';
        $user->save();

        $user1 = new Usuarios;
        $user1->name = 'Leticia Blanco Coca';
        $user1->email = 'leticia@gmail.com';
        $user1->password ='1234';
        $user1->role = 'docente';
        $user1->save();

        $user2 = new Usuarios;
        $user2->name = 'Rosemary Torrico Bascope';
        $user2->email = 'rosemary@gmail.com';
        $user2->password ='1234';
        $user2->role = 'docente';
        $user2->save();

        $user3 = new Usuarios;
        $user3->name = 'Catari';
        $user3->email = 'catari@gmail.com';
        $user3->password ='1234';
        $user3->role = 'docente';
        $user3->save();

        $user4 = new Usuarios;
        $user4->name = 'Cussi';
        $user4->email = 'cussi@gmail.com';
        $user4->password ='1234';
        $user4->role = 'docente';
        $user4->save();
        
        $user5 = new Usuarios;
        $user5->name = 'Henry';
        $user5->email = 'henry@gmail.com';
        $user5->password ='1234';
        $user5->role = 'docente';
        $user5->save();

        $user6 = new Usuarios;
        $user6->name = 'Corina Flores';
        $user6->email = 'corina@gmail.com';
        $user6->password ='1234';
        $user6->role = 'docente';
        $user6->save();
       
    }

}
