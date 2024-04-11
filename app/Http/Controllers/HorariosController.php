<?php

namespace App\Http\Controllers;

use App\Models\Dias;
use App\Models\Horarios;
use App\Models\Ambientes;
use Illuminate\Http\Request;

class HorariosController extends Controller
{


    public function actualizarPeriodo(Request $request){
        //dd($request->all());
        //ids del boton editar
        $idAmbiente = $request -> ambiente_id;
        $idDia = $request -> dia_id;
        $idPeriodo = $request -> periodo_id;
    
      //ids de dia seleccionado y horario
        $idDiaSelec = $request -> dia;
        $idPeriodoSelec = $request -> horario;

        $ambiente = Ambientes::findOrFail($idAmbiente);
        $horarioEsp = $ambiente->horarios()
              ->where('dias_id', $idDia)
              ->where('periodos_id', $idPeriodo)
              ->first();

            if ($horarioEsp) {
      
                // Cambia y guarda el estado
                $horarioEsp->dias_id =  $idDiaSelec;
                $horarioEsp->periodos_id = $idPeriodoSelec;

                $horarioEsp->save();
        
                // Responde con un mensaje de éxito (puedes personalizar según tu necesidad)
                return redirect()->back()->with('success','Horario actualizado correctamente');
            } else {
                // Si no se encuentra el horario específico, responde con un mensaje de error
                return redirect()->back()->with('message', 'El horario no existe.');   
            }

    }
    
   //es importante poner las variables en el mismo orden en el que se meten en la ruta
    public function cambiarEstado(Request $request,$idPeriodo,$idAmbiente,$idDia){
        
            // Encuentra el ambiente por su ID
            $ambiente = Ambientes::findOrFail($idAmbiente);

            // Encuentra el horario específico por día y periodo
            $horarioEsp = $ambiente->horarios()
                    ->where('dias_id', $idDia)
                    ->where('periodos_id', $idPeriodo)
                    ->first();

                
            // Verifica si el horario específico existe
            if ($horarioEsp) {
            
                // Cambia y guarda el estado
                $horarioEsp->Estado = $request->estado;
                $horarioEsp->save();

                // Responde con un mensaje de éxito (puedes personalizar según tu necesidad)
                return redirect()->back()->with('success','Estado actualizado correctamente');
            } else {
                // Si no se encuentra el horario específico, responde con un mensaje de error
                return redirect()->back()->with('message', 'Horario especifico no encontrado.');    
            }
    }


    public function añadirHorario(Request $request){ 
      
        try {
            $ambienteId = $request->ambiente;
            $diaId = $request->dia;
            $periodosId = $request->periodos;
             
            // Verificar si hay un solo periodo seleccionado
            if (count($periodosId) == 1){
                // Verificar si ya existe un horario para este día, ambiente y periodo
                $horarioExistente = Horarios::where('dias_id', $diaId)
                                            ->where('ambientes_id', $ambienteId)
                                            ->where('periodos_id', $periodosId[0])
                                            ->exists();
               
                if (!$horarioExistente) {
                    // Crear un nuevo horario
                    $nuevoHorario = new Horarios();
                       
                    if($diaId == 6){
                        $periodosComparar = [1,2,3,4];
                        //convertimos el periodoId en entero
                        $periodoIdConv = intval($periodosId[0]);
                      
                        if(in_array($periodoIdConv, $periodosComparar)){
                                
                            $nuevoHorario->dias_id = $diaId;
                            $nuevoHorario->ambientes_id = $ambienteId;
                            $nuevoHorario->periodos_id = $periodosId[0];
                            $nuevoHorario->save();

                        }else{
                            return redirect()->back()->with('message', 'No se puede crear ese horario para el dia sabado.');
                        }
                        
                    }else{
                            $nuevoHorario->dias_id = $diaId;
                            $nuevoHorario->ambientes_id = $ambienteId;
                            $nuevoHorario->periodos_id = $periodosId[0];
                            $nuevoHorario->save();
            
                        }
                        return redirect()->back()->with('success', 'Horario guardado exitosamente.');   
                    
                    } else {
                    return redirect()->back()->with('message', 'El horario ya existe.');
                }
            } else {
                // pido registro de horarios para este día , periodos  y ambiente.
                $horariosExistentes = Horarios::where('dias_id', $diaId)
                                                ->where('ambientes_id', $ambienteId)
                                                ->whereIn('periodos_id', $request->periodos)
                                                ->get();

                //obtiene los ids de los periodos en un array
                $horariosExistentes2 = Horarios::where('dias_id', $diaId)
                                                ->where('ambientes_id', $ambienteId)
                                                ->whereIn('periodos_id', $request->periodos)
                                                ->pluck('periodos_id')
                                                ->toArray();
                                         
                    if($diaId == 6){
                    $periodosComparar = [1,2,3,4];
                    //[1,2,3,4]
                    //dd(empty(array_diff($periodosComparar,$horariosExistentes2)));

                    if( !empty(array_diff($periodosComparar,$horariosExistentes2)) ){
                       

                        foreach ($periodosId as $periodoId) {
                        
                            $periodoIdConv = intval($periodoId);
                            // Verificar si el horario ya existe para este periodo
                            $horarioExistente = $horariosExistentes->firstWhere('periodos_id', $periodoId);
            
                            if (!$horarioExistente) {
                                // Crear un nuevo horario
                                if(in_array($periodoIdConv, $periodosComparar)){
                                   
                                    $nuevoHorario = new Horarios();
                                    $nuevoHorario->dias_id = $diaId;
                                    $nuevoHorario->ambientes_id = $ambienteId;
                                    $nuevoHorario->periodos_id = $periodoId;
                                    $nuevoHorario->save();
                                    
                                }
                            }
                        }
                        
                    }else{
                       return redirect()->back()->with('message', 'Esos horarios ya existen.');
                    }
                    
                }else{
                    
                    foreach ($periodosId as $periodoId) {
                        // Verificar si el horario ya existe para este periodo
                        $horarioExistente = $horariosExistentes->firstWhere('periodos_id', $periodoId);
        
                        if (!$horarioExistente) {
                            // Crear un nuevo horario
                            $nuevoHorario = new Horarios();
                            $nuevoHorario->dias_id = $diaId;
                            $nuevoHorario->ambientes_id = $ambienteId;
                            $nuevoHorario->periodos_id = $periodoId;
                            $nuevoHorario->save();
                        }
                    }
                    
                }
    
                return redirect()->back()->with('success', 'Horarios guardados exitosamente.');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al procesar la solicitud.');
        }
    }

}