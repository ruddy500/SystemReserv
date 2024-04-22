<?php

namespace App\Http\Controllers;

//use App\Models\Dias;
use App\Models\Fechas;
use App\Models\Horarios;
use App\Models\Ambientes;
use Illuminate\Http\Request;

class HorariosController extends Controller
{


    public function actualizarPeriodo(Request $request){
       
        //ids del boton editar
        // $fechaId = $fila->fechas_id;
        // $fechaD = Fechas::find($fechaId)->dia;

        $idAmbiente = $request -> ambiente_id;
      //  $idFecha = $request -> fecha_id;
        $idPeriodo = $request -> periodo_id;
        //dd($idAmbiente);
       //dd($idFecha,$idAmbiente,$idPeriodo);
      //ids de dia seleccionado y horario

       // $idFechaSelec = $request -> fecha;
        $idPeriodoSelec = $request -> horario;
       // dd($idPeriodoSelec);

        $idFecha = $request -> fecha_id;
        $idPeriodo = $request -> periodo_id;
       
        //fecha seleccionado estaba como string y se descompuso 
        $FechaSelec = $request -> fecha;

        //descompone la fecha 
        $partes_fecha = explode("-", $FechaSelec);
        //lo volvi integer
        $diaSelec = intval($partes_fecha[0]);
        $mesSelec = intval($partes_fecha[1]);
        //tome los ultimos digitos de año
        $año_ultimos_digitos = substr($partes_fecha[2], -2);
        //lo volvi integer
        $añoSelec = intval($año_ultimos_digitos);
        //id del periodo seleccionado
        $idPeriodoSelec = $request -> horario;
        
        $ambiente = Ambientes::findOrFail($idAmbiente);
        $horarioEsp = $ambiente->horarios()
            //  ->where('fechas_id', $idFecha)
              ->where('periodos_id', $idPeriodo)
              ->first();
            if ($horarioEsp) {
            
                // Cambia y guarda el estado
         //       $horarioEsp->fechas_id =  $idFechaSelec;
                $horarioEsp->periodos_id = $idPeriodoSelec;

      
                // Cambia y guarde la nueva fecha
                
                $fechaEsp = Fechas::findOrFail($idFecha);
                $fechaEsp->dia = $diaSelec;
                $fechaEsp->mes = $mesSelec;
                $fechaEsp->anio = $añoSelec;

                $fechaEsp->save();
                
                // Cambia y guarada el nuevo periodo id
                $horarioEsp -> periodos_id = $idPeriodoSelec;

                $horarioEsp -> save();

                // Responde con un mensaje de éxito (puedes personalizar según tu necesidad)
                return redirect()->back()->with('success','Horario actualizado correctamente');
            } else {
                // Si no se encuentra el horario específico, responde con un mensaje de error
                return redirect()->back()->with('message', 'El horario no existe.');   
            }

    }
    
   //es importante poner las variables en el mismo orden en el que se meten en la ruta
   public function cambiarEstado(Request $request,$idPeriodo,$idAmbiente,$idFecha){
        
    // Encuentra el ambiente por su ID
    $ambiente = Ambientes::findOrFail($idAmbiente);

    // Encuentra el horario específico por día y periodo
    $horarioEsp = $ambiente->horarios()
            ->where('fechas_id', $idFecha)
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
      //solucionar bug
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

            //dd($mes_fecha);

            //$registroAmbientes = Ambientes::all();
            //dd($registroAmbientes);
            

           // dd($request->ambiente);
           // dd($dia_fecha,$mes_fecha,$anio_fecha);

                    // Verificar si ya existe un horario para la misma fecha y período
        $horariosExistente = Horarios::where('fechas_id', function($query) use ($dia_fecha, $mes_fecha, $anio_fecha) {
            $query->select('id')
                ->from('fechas')
                ->where('dia', $dia_fecha)
                ->where('mes', $mes_fecha)
                ->where('anio', $anio_fecha);
        })->whereIn('periodos_id', $request->periodos)
        ->where('ambientes_id', $request->ambiente) // Agregar la condición del ambiente
        ->exists();
        // dd($request->periodos);
        // dd($request->ambiente);
        
        if ($horariosExistente) {
            // return response()->json(['message' => 'Al menos uno de los periodos ya está asignado para esta fecha'], 400);
            return redirect()->back()->with('message', 'El horario ya existe.');
        }


            $nuevaFecha = new Fechas();
            $nuevaFecha->dia = $dia_fecha;
            $nuevaFecha->mes =   $mes_fecha;
            $nuevaFecha->anio =   $anio_fecha;
           //guardamos en la tabla fecha el registro de la fecha q seleccionamos
            $nuevaFecha->save();
            //obtenemos el id de la nuevaFecha
           // $id_nuevaFecha = $nuevaFecha->id;
            $ambienteId = $request->ambiente;
        //    dd($ambienteId);
             //aqui captura los ids de los periodos que seleccionamos en la vista
             $periodosId = $request->periodos;           

                foreach ($periodosId as $periodoId) {
                    $nuevoHorario = new Horarios();
                    $nuevoHorario->fechas_id = $nuevaFecha->id;
                    $nuevoHorario->ambientes_id = $ambienteId;
                    $nuevoHorario->periodos_id = $periodoId;
                    $nuevoHorario->save();
                } 
                //dd($nuevoHorario);
                return redirect()->back()->with('success', 'Horarios guardados exitosamente.');
            }catch (\Exception $e) {
                return redirect()->back()->with('error', 'Ocurrió un error al procesar la solicitud.');
            }
    
} 

}