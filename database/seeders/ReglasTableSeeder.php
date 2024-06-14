<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reglas;
use Carbon\Carbon;
class ReglasTableSeeder extends Seeder
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

        $anuncio = new Reglas();
        $anuncio->Regla="Al hacer uso del servicio, se entiende que el solicitante acepta las condiciones del presente reglamento.";
        $anuncio->Fecha=$fecha;
        $anuncio->Hora=$hora;
        $anuncio->save();

        $anuncio = new Reglas();
        $anuncio->Regla="Revisa en tiempo real la disponibilidad de las aulas para fechas y horarios específicos.";
        $anuncio->Fecha=$fecha;
        $anuncio->Hora=$hora;
        $anuncio->save();

        $anuncio = new Reglas();
        $anuncio->Regla="En caso de que no vaya hacer uso del espacio, debe cancelar la reserva en el sistema antes de su reserva.";
        $anuncio->Fecha=$fecha;
        $anuncio->Hora=$hora;
        $anuncio->save();

        $anuncio = new Reglas();
        $anuncio->Regla="Cada usuario es responsable del equipo, máquinas, herramienta que utiliza, de su custodia y cuidado durante el periodo de préstamo.";
        $anuncio->Fecha=$fecha;
        $anuncio->Hora=$hora;
        $anuncio->save();

        $anuncio = new Reglas();
        $anuncio->Regla="Es deber del ingeniero mencionarle a sus estudiantes, las normas de comportamiento y de uso y cuidado de los ambientes.";
        $anuncio->Fecha=$fecha;
        $anuncio->Hora=$hora;
        $anuncio->save();
        
    }
}