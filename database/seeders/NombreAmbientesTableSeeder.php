<?php

namespace Database\Seeders;

use App\Models\NombreAmbientes;
use Illuminate\Database\Seeder;

class NombreAmbientesTableSeeder extends Seeder
{
    public function run()
    {
        $nombreAmbientes = ['690 A','690 B','690 C','690 D','691 A','691 B','691 C','691 D','691 E','692 A','692 B','692 C','692 D','692 E','693 A','693 B','693 C','693 D','693 E','Auditorio','660','661','606','607','608','609','612','613','614','615','616','616 A','617','617 B','617 C','618','619','619 A','620','620 B','621','621 A','622','623','624','625 C','625 D'];
            // Agrega aquí más ambientes si los necesitas

        foreach ($nombreAmbientes as $nombreAmbiente) {
            NombreAmbientes::create(['Nombre'=>$nombreAmbiente]);
        
        }
    }
}
