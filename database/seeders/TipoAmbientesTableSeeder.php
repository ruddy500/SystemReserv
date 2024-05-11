<?php

namespace Database\Seeders;

use App\Models\TipoAmbientes;
use Illuminate\Database\Seeder;

class TipoAmbientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoAmbientes = ['Auditorio','Laboratorio','Aula comun'];
        // Agrega aquí más ambientes si los necesitas

        foreach ($tipoAmbientes as $tipoAmbiente) {
            TipoAmbientes::create(['Nombre'=>$tipoAmbiente]);
    
        }
    }
}
