<?php

namespace App\Http\Controllers;
use App\Models\NombreAmbientes;
use App\Models\Ambientes;
use App\Models\Horarios;
use App\Models\Fechas;
use App\Models\Periodos;
use Illuminate\Http\Request;
use App\Models\Materias;
use App\Models\MateriasSeleccionado;
use App\Models\Reservas;
use App\Models\DocentesMaterias;
use App\Models\PeriodosSeleccionado;
use App\Models\ReservasAmbiente;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ReservasController extends Controller
{
 
    public function mostrar()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.asignadas', compact('menu'));
    }

    public function asignadas()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.asignadas', compact('menu'));
    }
    public function pendientes()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.pendientes', compact('menu'));
    }
    public function registrar()
    {  
         $nombreambientes = NombreAmbientes::all();
    //      $ambienteId = $request->input('ambiente');
    //      $ambiente = Ambientes::where('nombre_ambientes_id', $ambienteId)->first();
    //      $fechita = $request->fecha;
    //      //dd($fechita);
    //     // dd($$request->fecha_id);
    //      $fechaEntera = strtotime($fechita);
    //      //obtener dia de la fecha seleccionada
    //      $dia_fecha = date("d", $fechaEntera);
    //      //obtener mes de la fecha seleccionada
    //      $mes_fecha = date("m", $fechaEntera);
    //      //obtener anio la fecha seleccionada
    //      $anio_fecha = date("y", $fechaEntera);
    //     // dd($request->ambiente);
    //     //$fecha = $request->input('fecha');


    //    // $fechita = $request->fecha;
    //     $fecha = Fechas::where('dia', $dia_fecha)
    //                 ->where('mes',$mes_fecha)
    //                 ->where('anio', $anio_fecha)
    //                 ->first();

    //                 //dd($ambiente->id);
        
    //     if ($fecha) {
    //         $horarios = Horarios::where('fechas_id', $fecha->id)
    //                             ->where('ambientes_id', $ambiente->id)
    //                             ->get();

    //                             dd($horarios);
         
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.registrar', compact('nombreambientes','menu'));

    }

    public function materias()
    {  //dd($fechaId);
         $materias_docentes= DocentesMaterias::all(); //guarda la tabla materias docentes
        $materias= Materias::all(); //guarda la tabla materias

        $tamMaterias = $materias->count();  //tamanio de materias docentes
        $tam = $materias_docentes->count(); //tamanio de la tabla docentes_materias

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.materiasDocente', compact('materias_docentes','tam','materias','tamMaterias','menu'));
    }
    public function formFinal()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.formFinal', compact('menu'));
    }

    public function consultarPeriodos(Request $request)
    {
        $menu = view('componentes/menu');

        $nombreambientes = NombreAmbientes::all();

        $fecha = $request->input('fecha');
         $ambienteId = $request->input('ambiente');
         
         $ambiente = Ambientes::where('nombre_ambientes_id', $ambienteId)->first();
        //  $reservasAmbiente = new ReservasAmbiente();
        //  $reservasAmbiente -> ambientes_id = $ambiente->id;
        //  $reservasAmbiente ->save();
         
         $fechita = $request->fecha;
         //dd($fechita);
        // dd($$request->fecha_id);
         $fechaEntera = strtotime($fechita);
         //obtener dia de la fecha seleccionada
         $dia_fecha = date("d", $fechaEntera);
         //obtener mes de la fecha seleccionada
         $mes_fecha = date("m", $fechaEntera);
         //obtener anio la fecha seleccionada
         $anio_fecha = date("y", $fechaEntera);
        // dd($request->ambiente);
        //$fecha = $request->input('fecha');

        // $horarios = new Horarios();
       // $fechita = $request->fecha;
        $fecha = Fechas::where('dia', $dia_fecha)
                    ->where('mes',$mes_fecha)
                    ->where('anio', $anio_fecha)
                    ->first();

                    //dd($ambiente->id);
        
        if ($fecha && $ambiente) {
            $horarios = Horarios::where('fechas_id', $fecha->id)
                                ->where('ambientes_id', $ambiente->id)
                                ->get();
                                $reservasAmbiente = new ReservasAmbiente();
                                $reservasAmbiente -> ambientes_id = $ambiente->id;
                                $reservasAmbiente ->save();
        }else{
            return redirect()->back()->with('message', 'No hay registros.'); 
        }
            //dd($fecha->id, $ambiente->id);
         //  dd($horarios);
      //     return view('reservas.formulario.registrar');
     
       foreach ($horarios as $horario) {
        $periodo = Periodos::find($horario->periodos_id);
        $horario->nombre_periodo = $periodo ? $periodo->HoraIntervalo : 'No definido';
        //dd($horario);
    }
       //dd($nombreambientes,$menu,$horarios);
           return view('reservas.formulario.registrar', compact('nombreambientes','menu','horarios','ambienteId'));
    }
        
        
       
    //  foreach ($horarios as $horario) {
    //     $periodo = Periodos::find($horario->periodos_id);
    //     $horario->nombre_periodo = $periodo ? $periodo->HoraIntervalo : 'No definido';
    // }
  // dd($horario->nombre_periodo);

    //FUNCION MOSTRAR VENTANA VER
    public function verReserva($idReserva)
    {   
        $seleccionado= MateriasSeleccionado::all(); //guarda la tabla materias_seleccionado 
        $materias= Materias::all(); //guarda la tabla materias

        $tamMaterias = $materias->count();  //tamanio de materias docentes
        $tam = $seleccionado->count(); //tamanio de la tabla materias_seleccionado
       
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.ver', compact('idReserva','tamMaterias','tam','seleccionado','materias','menu'));
    }

    public function store(Request $request)
    {   //dd($request->all());
        $options = $request->input('options');
        
        foreach ($options as &$option) {
            $option = intval(str_replace('-', '', $option));
            // $option = str_replace('-', '', $option);
        }
        $dato1 = $options[0];
        $dato2 = $options[1];
        
        $idPeriodo1 = $dato1%10;
        $idPeriodo2 = $dato2%10;

        $idFecha = intval($dato1 / 10);   //para recoger el id de la fecha en entero

        if ($idPeriodo1+1 == $idPeriodo2) {
            
            // guardar en la base datos
            $reserva = new Reservas();
            $reserva->fecha=$idFecha;
            $reserva->save();


            //guardar relacion de periodos en base de datos
            $periodos = new PeriodosSeleccionado();
            $periodos -> reservas_id = $reserva->id;
            $periodos -> periodos_id = $idPeriodo1;
            $periodos->save();

        
            $periodos2 = new PeriodosSeleccionado();
            $periodos2 -> reservas_id = $reserva->id;
            $periodos2 -> periodos_id = $idPeriodo2;
            $periodos2->save();
        // dd($idPeriodo1,$idPeriodo2);
        // dd($options);
        // dd($idFecha);
            return redirect()->route('reservas.materias')->with('dato', $idFecha);
            
        }
        
        // dd($idPeriodo1,$idPeriodo2);
        
        
    }

    //funcion para asignar a la tabla 
    public function guardar(Request $request)
    {  
        // $menu = view('componentes/menu'); // Crear la vista del menú
        // return view('reservas.ver', compact('menu'));
        $options = $request->input('options');
        $usuario = $request->usuario;
        


    
        if (is_array($options)) {
            for ($i=0; $i <count($options) ; $i++) { 
                $id = $options[$i];
                $materiaSeleccionada = new MateriasSeleccionado();
                // $materiasABuscar = Materias::find($id);
                // $usuarioAbuscar = Usuarios::find($usuario);
                $materiaSeleccionada->materias_id=$id;
                // Guardar en la base de datos
                $materiaSeleccionada->save();
    
                
            }
            

            //$ultimoRegistroRA = ReservasAmbiente::orderBy('id', 'desc')->first(); 
            $ultimaReserva = new Reservas();
            $ultimoRegistro = $ultimaReserva->orderBy('id', 'desc')->first();
            $ultimoId = $ultimoRegistro->id;
            //$ultimoRegistroRA->reservas_id = $ultimoId;
            //$ultimoRegistroRA ->save();
            // Actualiza las filas donde reservas_id es NULL con el ID de la reserva deseada
            MateriasSeleccionado::whereNull('reservas_id')->update(['reservas_id' => $ultimoId]);


        } else {
            // Manejo de error: $options no es un array
            // Por ejemplo, podrías registrar un mensaje de error o redirigir con un mensaje de error.
        }
        
        
        // Redirigir al usuario a la ruta 'reservas.formFinal'
        return redirect()->route('reservas.formFinal');
    }

    public function guardarReserva(Request $request){
        $cantidadest=$request->cantidad;
        print_r($request->cantidad);

        // Instanciar la clase Reserva
        //$reserva = new Reservas();

        // Obtener el último registro
        $ultimoRegistro = Reservas::orderBy('id', 'desc')->first();


        if ($ultimoRegistro) {
            // Actualizar el registro si existe
            $ultimoRegistro->CantEstudiante = $cantidadest; // Por ejemplo, asignar un valor a cantidadEstudiante
            $ultimoRegistro->Motivo = $request->motivo; // Por ejemplo, asignar un valor a motivo
            $ultimoRegistro->docentes_id = $request->usuario; // Por ejemplo, asignar un valor a motivo
            $ultimoRegistro->Estado = "pendiente"; // Por ejemplo, asignar un valor a motivo
            $ultimoRegistro->save();
            
            $ultimoRegistroRA = ReservasAmbiente::orderBy('id', 'desc')->first(); 
            $ultimoRegistroRA->reservas_id = $ultimoRegistro->id;
            $ultimoRegistroRA ->save();
        } 

        // $reserva = new Reservas();
        // $reserva->CantEstudiante = $cantidadest;
        // $reserva->Motivo = $request->motivo;
        // $reserva->docentes_id=$request->usuario;
        // $reserva->save();

        // print_r($request->motivo);
        // print_r($request->cantidad);

        // $materiaSeleccionada = new MateriasSeleccionado();

        // Actualiza las filas donde reservas_id es NULL con el ID de la reserva deseada
        // MateriasSeleccionado::whereNull('reservas_id')->update(['reservas_id' => $reserva->id]);

        return redirect()->route('reservas.principal');
    }

    public function cancelarReserva(){

        $ultimoRegistro = Reservas::orderBy('id', 'desc')->first();

        if ($ultimoRegistro) {
            $ultimoRegistro->delete();
            // El registro ha sido eliminado exitosamente
        }

        // $materiasSeleccionado = new MateriasSeleccionado();
        // // eliminar todas las meteriasSeleccionadas que tengan null
        // $materiasSeleccionado->whereNull('reservas_id')->delete();
        return redirect()->route('reservas.principal');
    }
}

