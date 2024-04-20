<?php

namespace App\Http\Controllers;
use App\Models\NombreAmbientes;
use App\Models\Ambientes;
use App\Models\Horarios;
use App\Models\Fechas;
use App\Models\Periodos;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
 
    public function mostrar()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.asignadas', compact('menu'));
    }

    public function asignadas()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.asignadas', compact('menu'));
    }
    public function pendientes()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.pendientes', compact('menu'));
    }
    public function registrar()
    {  
         $nombreambientes = NombreAmbientes::all();
         
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.registrar', compact('nombreambientes','menu'));

    }
    public function materias()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.materiasDocente', compact('menu'));
    }
    public function formFinal()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.formFinal', compact('menu'));
    }

    public function consultarPeriodos(Request $request)
    {


        // $fecha = $request->input('fecha');
         $ambienteId = $request->input('ambiente');
         $ambiente = Ambientes::where('nombre_ambientes_id', $ambienteId)->first();
         $fechita = $request->fecha;
         //dd($fechita);
        // dd($$request->fecha_id);
         $fechaEntera = strtotime($fechita);
         //obtener dia de la fecha seleccionada
         $dia_fecha = date("d", $fechaEntera);
         //obtener mes de la fecha seleccionada
         $mes_fecha = date("m", $fechaEntera);
         //obtener anio la fecha seleccionada
         $anio_fecha = date("y", $fechaEntera);
        // dd($request->ambiente);
        //$fecha = $request->input('fecha');


       // $fechita = $request->fecha;
        $fecha = Fechas::where('dia', $dia_fecha)
                    ->where('mes',$mes_fecha)
                    ->where('anio', $anio_fecha)
                    ->first();
        
        if ($fecha) {
            $horarios = Horarios::where('fechas_id', $fecha->id)
                                ->where('ambientes_id', $ambiente->id)
                                ->get();
            // dd($fecha->id, $ambiente->id);
             dd($horarios);
        }
       
    //  foreach ($horarios as $horario) {
    //     $periodo = Periodos::find($horario->periodos_id);
    //     $horario->nombre_periodo = $periodo ? $periodo->HoraIntervalo : 'No definido';
    // }
  // dd($horario->nombre_periodo);
        return view('reservas.formulario.horariosDisponibles', compact('horarios'));
    }
}