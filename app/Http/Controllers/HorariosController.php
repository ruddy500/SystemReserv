<?php

namespace App\Http\Controllers;

use App\Models\Dias;
use App\Models\Ambientes;
use App\Models\Horarios;
use App\Models\Periodos;
use Illuminate\Http\Request;

class HorariosController extends Controller
{
    public function mostrarHorario($ambiente)
    {  
        //dd($ambiente);
        $dias = Dias::all();
        $periodos = Periodos::all();

        $menu = view('componentes/menu'); // Crear la vista del menú
        
        //Envia los datos menu,dias,periodos a la vista ambientes.horario
        return view('ambientes.horario', compact('ambiente','menu','dias','periodos'));
    }
    
    /*public function guardar2(Request $request){
            
        $selecciones = $request->horario;
        return view('ambientes/prueba', compact('selecciones'));
        }
    */

    public function añadirHorario(Request $request){
        
        $diaId = $request->dia; // ID del día
        $dia = Dias::find($diaId);// Obtén el modelo Dia
        //dd($request->ambiente);
        
        if (!$dia->Usado) {
        $dia->Usado = true;
        $dia->save();
        // Adjunta los periodos al día
        $periodoIds = $request->horario; // IDs de los periodos seleccionados
        $dia->periodos()->attach($periodoIds);
    
        // Obtén el ID del ambiente desde la solicitud
        $ambienteId = $request->ambiente;
    
        // Obtén el modelo Ambiente
        $ambiente = Ambientes::find($ambienteId);
    
        // Adjunta los períodos al ambiente en la tabla pivote
        $ambiente->horarios()->attach($diaId);

        
      
    
            return redirect()->back();
    
        }else{
            return redirect()->back();
        }
        

    }
}
