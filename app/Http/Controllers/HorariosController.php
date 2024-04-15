<?php

namespace App\Http\Controllers;

//use App\Models\Dias;
use App\Models\Fechas;
use App\Models\Horarios;
use App\Models\Ambientes;
use App\Models\Periodos;
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

            //obtener fecha de la vista en formato "d-m-y"
            $fechita = $request->fecha;
            //dd($fechita);
            $fechaEntera = strtotime($fechita);
            //obtener dia de la fecha seleccionada
            $dia_fecha = date("d", $fechaEntera);
            //obtener mes de la fecha seleccionada
            $mes_fecha = date("m", $fechaEntera);
            //obtener anio la fecha seleccionada
            $anio_fecha = date("y", $fechaEntera);

            $nuevaFecha = new Fechas();
            $nuevaFecha->dia = $dia_fecha;
            $nuevaFecha->mes =   $mes_fecha;
            $nuevaFecha->anio =   $anio_fecha;
           //guardamos en la tabla fecha el registro de la fecha q seleccionamos
            $nuevaFecha->save();
            //obtenemos el id de la nuevaFecha
            $id_nuevaFecha = $nuevaFecha->id;
            $ambienteId = $request->ambiente;
        //    dd($ambienteId);
             //aqui captura los ids de los periodos que seleccionamos en la vista
             $periodosId = $request->periodos;
            // dd($periodosId); 
             $fechaPeriodos = Fechas::find($id_nuevaFecha);
             $fechaPeriodos->periodos()->attach($periodosId);

             
            //dd($fechaPeriodos);
                 // Crear un nuevo horario
                 
                //  foreach ($request->periodos as $periodoId) {
                //     $nuevoHorario = new Horarios();
                //     $nuevoHorario->fechas_id = $id_nuevaFecha;
                //     $nuevoHorario->ambientes_id = $ambienteId;
                //     $nuevoHorario->periodos_id = $periodoId;
                //     $nuevoHorario->save();
                // }

                

                foreach ($periodosId as $periodoId) {
                    $nuevoHorario = new Horarios();
                    $nuevoHorario->fechas_id = $nuevaFecha->id;
                    $nuevoHorario->ambientes_id = $request->ambiente;
                    $nuevoHorario->periodos_id = $periodoId;
                    $nuevoHorario->save();
                }
                dd($nuevoHorario);

                    // $nuevoHorario = new Horarios();
                    // $nuevoHorario->fechas_id = $id_nuevaFecha;
                    // $nuevoHorario->ambientes_id = $ambienteId;
                    // dd($nuevoHorario->ambientes_id);
                    // $nuevoHorario->periodos_id = $periodosId[0];
                    // $nuevoHorario->save();
                    // dd($nuevoHorario->ambientes_id);

            // Verificar si hay un solo periodo seleccionado
            if (count($periodosId) == 1){
                // Verificar si ya existe un horario para este día, ambiente y periodo
                $horarioExistente = Horarios::where('fechas_id', $id_nuevaFecha)
                                            ->where('ambientes_id', $ambienteId)
                                            ->where('periodos_id', $periodosId[0])
                                            ->exists();
                                            dd($horarioExistente);
                if (!$horarioExistente) {
                    // Crear un nuevo horario
                    $nuevoHorario = new Horarios();
                       
                    if($diaId == 6){
                    //     $periodosComparar = [1,2,3,4];
                    //     //convertimos el periodoId en entero
                    //     $periodoIdConv = intval($periodosId[0]);
                      
                        if(in_array($periodoIdConv, $periodosComparar)){
                                
                    //         $nuevoHorario->dias_id = $diaId;
                    //         $nuevoHorario->ambientes_id = $ambienteId;
                    //         $nuevoHorario->periodos_id = $periodosId[0];
                    //         $nuevoHorario->save();
                            
                        }else{
                            return redirect()->back()->with('message', 'No se puede crear ese horario para el dia sabado.');
                        }
                        
                    }else{
                            $nuevoHorario->fechas_id = $id_nuevaFecha;
                            $nuevoHorario->ambientes_id = $ambienteId;
                            $nuevoHorario->periodos_id = $periodosId[0];
                            $nuevoHorario->save();
            
                        }
                        return redirect()->back()->with('success', 'Horario guardado exitosamente.');   
                    
                    }else {
                    return redirect()->back()->with('message', 'El horario ya existe.');
                }
            }else {
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