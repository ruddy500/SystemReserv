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
      //  dd($request->all());
        //ids del boton editar
        $idAmbiente = $request -> ambiente_id;
        $idFecha = $request -> fechaId;
        $idPeriodo = $request -> periodo_id;
        //dd($idAmbiente);
       //dd($idFecha,$idFecha,$idPeriodo);
      //ids de dia seleccionado y horario
        $idFechaSelec = $request -> fecha;
        $idPeriodoSelec = $request -> horario;

        $ambiente = Ambientes::findOrFail($idAmbiente);
        $horarioEsp = $ambiente->horarios()
              ->where('fechas_id', $idFecha)
              ->where('periodos_id', $idPeriodo)
              ->first();

            if ($horarioEsp) {
      
                // Cambia y guarda el estado
                $horarioEsp->fechas_id =  $idFechaSelec;
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

                    // Verificar si ya existe un horario para la misma fecha y período
        $horariosExistente = Horarios::where('fechas_id', function($query) use ($dia_fecha, $mes_fecha, $anio_fecha) {
            $query->select('id')
                ->from('fechas')
                ->where('dia', $dia_fecha)
                ->where('mes', $mes_fecha)
                ->where('anio', $anio_fecha);
        })->whereIn('periodos_id', $request->periodos)->exists();

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
            $id_nuevaFecha = $nuevaFecha->id;
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