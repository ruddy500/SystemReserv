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
      
      //obtengo el horario con el dia y el ambiente especifico
      $horariosDiaAmbiente = Horarios::where('dias_id',$diaId)
                          ->where('ambientes_id',$ambienteId)->get();
      
      if ($horariosDiaAmbiente->isEmpty()) {
          // Asociar los períodos al día en la base de datos...pero no en la variable
        $dia->periodos()->attach($periodosId);
        //dd($horarios);
        $horariosDiaAmbiente = Horarios::where('dias_id',$diaId)->get();

        foreach ($horariosDiaAmbiente as $horario){
          
          if(is_null($horario ->ambientes_id)){
            $horario ->ambientes_id = $ambienteId;
            $horario->save();

          }
        
       }
         
      }
      //dd($ambiente->horarios()->get());
        return redirect()->back()->with('success', 'Horario guardado exitosamente.');
    }

}