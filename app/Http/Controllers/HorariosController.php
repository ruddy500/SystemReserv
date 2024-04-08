<?php

namespace App\Http\Controllers;

use App\Models\Dias;
use App\Models\Ambientes;
use App\Models\Periodos;
use Illuminate\Http\Request;

class HorariosController extends Controller
{
    // public function mostrarHorario($ambiente)
    // {  
    //     //dd($ambiente);
    //     $dias = Dias::all();
    //     $periodos = Periodos::all();


    //     $menu = view('componentes/menu'); // Crear la vista del menú
       
    //     //Envia los datos menu,dias,periodos a la vista ambientes.horario
    //     return view('ambientes.horario', compact('ambiente','menu','dias','periodos'));
    // }

   /* public function mostrarHorario($ambiente)
    {  
        //dd($ambiente);
       
        $ambienteEs = Ambientes::find($ambiente)->Periodos;

        $menu = view('componentes/menu'); // Crear la vista del menú
        
        //Envia los datos menu,dias,periodos a la vista ambientes.horario
        return view('ambientes.horario', compact('ambiente','menu','dias','periodos','ambienteEs'));
    }
    
  */


    public function añadirHorario(Request $request)
    {  
        //$ambiente = Ambientes::findOrFail($ambienteId);
       // $nombreAmbiente = $ambiente->nombre;
      $horarios = $request->horario;

     $intervalos = [];
      foreach ($horarios as $horario) {
        $modeloperiodo = Periodos::find($horario);
        $intervalos[]=$modeloperiodo -> HoraIntervalo;
      }
      
    $cadena= implode(', ',$intervalos);
    
    $diaId = $request->dia;
    $ambienteId = $ambiente;
    //dd($diaId,$ambiente);
    
    $dia = Dias::find($diaId);
    
    // Asociar los períodos al día
    $dia->periodos()->attach($horarios);
    
    $ambienteEspecifico = Ambientes::find($ambienteId);
    $ambienteEspecifico -> Periodos = $cadena;
    //$ambienteEspecifico->horarios()->sync($horarios);

    $ambienteEspecifico->save();

    // Asociar los períodos al ambiente específico
    $ambienteEspecifico->horarios()->attach($horarios);
    
        //dd($diaId,$periodos,$ambienteId);

        
        return redirect()->back()->with('success', 'Horario guardado exitosamente.');
    }

}

