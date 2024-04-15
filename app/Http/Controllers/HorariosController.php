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
            // Obtener fecha de la vista en formato "d-m-y"
            $fechita = $request->fecha;
            $fechaEntera = strtotime($fechita);
    
            // Obtener día, mes y año de la fecha seleccionada
            $dia_fecha = date("d", $fechaEntera);
            $mes_fecha = date("m", $fechaEntera);
            $anio_fecha = date("y", $fechaEntera);
    
            // Verificar si ya existe un horario para la misma fecha y período
            $horarioExistente = Horarios::where('fechas_id', function($query) use ($dia_fecha, $mes_fecha, $anio_fecha) {
                $query->select('id')
                    ->from('fechas')
                    ->where('dia', $dia_fecha)
                    ->where('mes', $mes_fecha)
                    ->where('anio', $anio_fecha);
            })->where('periodos_id', $request->periodos[0])->exists();
    
            if ($horarioExistente) {
                return response()->json(['message' => 'Ya existe un horario para esta fecha y período'], 400);
            }
    
            // Si no existe, crear un nuevo horario
            $nuevaFecha = new Fechas();
            $nuevaFecha->dia = $dia_fecha;
            $nuevaFecha->mes = $mes_fecha;
            $nuevaFecha->anio = $anio_fecha;
            $nuevaFecha->save();
    
            $id_nuevaFecha = $nuevaFecha->id;
            $ambienteId = $request->ambiente;
            $periodosId = $request->periodos;
    
            $nuevoHorario = new Horarios();
            $nuevoHorario->fechas_id = $id_nuevaFecha;
            $nuevoHorario->ambientes_id = $ambienteId;
            $nuevoHorario->periodos_id = $periodosId[0];
            $nuevoHorario->save();
    
            return response()->json(['message' => 'Horario añadido correctamente'], 200);
    
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al añadir horario: ' . $e->getMessage()], 500);
        }
    }