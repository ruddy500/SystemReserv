<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anuncios;
use Carbon\Carbon;
class AnunciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = Carbon::now('America/La_Paz');
        $fecha = $carbon->format('d-m-Y');
        $hora = $carbon->format('H:i:s');

        $anuncio = new Anuncios();
        $anuncio->Titulo="Regla 1";
        $anuncio->Contenido="1. Al hacer uso del servicio, se entiende que el solicitante acepta las condiciones del presente reglamento y se 
                                compromete a dar el uso adecuado a los elementos entregados.";
        $anuncio->Fecha=$fecha;
        $anuncio->Hora=$hora;
        $anuncio->save();

        $anuncio = new Anuncios();
        $anuncio->Titulo="Regla 2";
        $anuncio->Contenido="2. Se da por entendido que el solicitante hará una correcta utilización de los equipos, máquinas, herramientas y demás elementos
                                que hagan parte de los espacios para el desempeño de las actividades académicas: clases, prácticas o presentación de exámenes.";
        $anuncio->Fecha=$fecha;
        $anuncio->Hora=$hora;
        $anuncio->save();

        $anuncio = new Anuncios();
        $anuncio->Titulo="Regla 3";
        $anuncio->Contenido="3. En caso de que no vaya hacer uso del espacio, debe cancelar la reserva en el sistema antes de su reserva.";
        $anuncio->Fecha=$fecha;
        $anuncio->Hora=$hora;
        $anuncio->save();
        
    }
}