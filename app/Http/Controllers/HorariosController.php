<?php

namespace App\Http\Controllers;

use App\Models\Dias;
use App\Models\Horarios;
use App\Models\Ambientes;
use Illuminate\Http\Request;

class HorariosController extends Controller
{
   
    public function añadirHorario(Request $request)
    {   //dd($request->all());
    
      //$input = $request->except('_token'); // Excluye el campo _token de los datos
      $periodosId = $request->periodos;
      
      $ambienteId = $request->ambiente;

      $diaId = $request->dia;  
      $dia = Dias::find($diaId);
      
      if (!$dia->Usado) {
          // Asociar los períodos al día
        $dia->periodos()->attach($periodosId);
        
        $horarios = Horarios::where('dias_id',$diaId)->get();

        //dd($horario);
        foreach ($horarios as $horario){
          $horario ->ambientes_id = $ambienteId;
          $horario->save();
         }
         $dia->Usado = true;
         $dia->save();
         
      }
      //dd($ambiente->horarios()->get());
        return redirect()->back()->with('success', 'Horario guardado exitosamente.');
    }

}