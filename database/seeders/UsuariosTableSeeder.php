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
        $user->name = 'Henrry Cavill';
        $user->email = 'adaenterprisesoft@gmail.com';
        $user->password ='1234';
        $user->role = 'admin';
        $user->save();

        $user1 = new Usuarios;
        $user1->name = 'Leticia Blanco Coca';
        $user1->email = 'jonathanasda@gmail.com';
        $user1->password ='1234';
        $user1->role = 'docente';
        $user1->save();

        $user2 = new Usuarios;
        $user2->name = 'Rosemary Torrico Bascope';
        $user2->email = 'floresmadai06@gmail.com';
        $user2->password ='1234';
        $user2->role = 'docente';
        $user2->save();

        $user3 = new Usuarios;
        $user3->name = 'Catari';
        $user3->email = 'quispemoyaa@gmail.com';
        $user3->password ='1234';
        $user3->role = 'docente';
        $user3->save();

        $user4 = new Usuarios;
        $user4->name = 'Cussi';
        $user4->email = 'arcayned6075@gmail.com';
        $user4->password ='1234';
        $user4->role = 'docente';
        $user4->save();
        
        $user5 = new Usuarios;
        $user5->name = 'Henry';
        $user5->email = 'bravoandres1706@gmail.com';
        $user5->password ='1234';
        $user5->role = 'docente';
        $user5->save();

        $user6 = new Usuarios;
        $user6->name = 'Corina Flores';
        $user6->email = 'corinaflores.v@fcyt.umss.edu.bo';
        $user6->password ='corinaflores';
        $user6->role = 'docente';
        $user6->save();

        $user7 = new Usuarios;
        $user7->name = 'Arnold Copa';
        $user7->email = 'carmelolamez99@gmail.com';
        $user7->password ='1234';
        $user7->role = 'docente';
        $user7->save();
       
    }

}
