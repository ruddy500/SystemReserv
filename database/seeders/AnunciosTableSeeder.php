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
        $anuncio->Titulo="¡Bienvenido al Sistema de Reservas Fcyt!";
        $anuncio->Contenido="Este sistema ha sido diseñado para facilitar la gestión y reserva de aulas en la Facultad de Ciencias y Tecnología (Fcyt). 
                                Te invitamos a explorar todas las funcionalidades del Sistema de Reservas Fcyt y aprovechar al máximo esta herramienta diseñada para mejorar la organización y utilización de los recursos académicos de nuestra facultad.";
        $anuncio->Fecha=$fecha;
        $anuncio->Hora=$hora;
        $anuncio->save();

        $anuncio = new Anuncios();
        $anuncio->Titulo="¡Bienvenido al Semestre 2/2024!";
        $anuncio->Contenido="Nos complace darte la bienvenida a un nuevo semestre académico lleno de oportunidades y desafíos. Este semestre promete ser una etapa 
                                enriquecedora en tu formación, donde podrás expandir tus conocimientos, desarrollar nuevas habilidades y participar en diversas actividades académicas y extracurriculares.";
        $anuncio->Fecha=$fecha;
        $anuncio->Hora=$hora;
        $anuncio->save();
        
    }
}