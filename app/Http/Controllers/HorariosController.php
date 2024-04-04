<?php

namespace App\Http\Controllers;

use App\Models\Dias;
use App\Models\Horarios;
use App\Models\Periodos;
use Illuminate\Http\Request;

class HorariosController extends Controller
{
    public function mostrarHorario()
    {  
        //dd($ambientes);
        $dias = Dias::all();
        $periodos = Periodos::all();

        $menu = view('componentes/menu'); // Crear la vista del menú
        
        //Envia los datos menu,dias,periodos a la vista ambientes.horario
        return view('ambientes.horario', compact('menu','dias','periodos'));
    }

    public function añadirHorario(Request $request){
        //captura los id de dia selecciondado y de horario seleccionado
        $diaId = $request->dia;
        $horarioId = $request->horario;
        //dd($request->all());
        $horario = new Horarios;
        $horario->DiaId = $diaId ;
        $horario->PeriodoId = $horarioId;
        $horario->save();

        //$nombreAmbiente = NombreAmbientes::find($ambienteID);
       
        return redirect()->back();

    }
}
