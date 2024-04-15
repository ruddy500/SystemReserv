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
          Usuarios::create(['nombre'=>"juan",
                            'email'=>"juan@gmail.com",
                            'password' => Hash::make("hola123")
         ]);
       
    }
}
