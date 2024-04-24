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

        // $reservas = Reservas::all();
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.pendientes', compact('menu'));
    }
    
    public function registrar()
    {  
        // $nomAm = NombreAmbientes::all();
        // dd($nomAm);
        $ambientes_registrados = Ambientes::all();
        //  foreach ($ambientes_registrados as &$ambienteR) {
        // //    // $ambienteR;   
        //      $ambiente = Ambientes::find($ambienteR->id); 
        //      $ambineteIds = $ambiente->nombre_ambientes_id;
        //      $nombreambientes = NombreAmbientes::find($ambineteIds);            
        // }
       // $hola = $ambientes_registrados->id;
     //  dd($nombreambientes);
        
        //  $periodo = Periodos::find($horario->periodos_id);
        // dd($nombreambientes);
         
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.registrar', compact('ambientes_registrados','menu'));

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
        $ambientes_registrados = Ambientes::all();

        $fecha = $request->input('fecha');

         $ambienteId = $request->input('ambiente');
         //dd($ambienteId);
         
         $ambiente = Ambientes::where('nombre_ambientes_id', $ambienteId)->first();
        // dd($ambiente->id);
         //dd($ambiente);
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
            } else{
                return redirect()->back()->with('message', 'No hay registros.'); 
            }    

       foreach ($horarios as $horario) {
        $periodo = Periodos::find($horario->periodos_id);
        $horario->nombre_periodo = $periodo ? $periodo->HoraIntervalo : 'No definido';
        //dd($horario);
    }
       //dd($nombreambientes,$menu,$horarios);
           return view('reservas.formulario.registrar', compact('nombreambientes','menu','horarios','ambienteId','ambientes_registrados'));
   
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
        
        if(!empty($options)){
            $tamOptions = count($options);
            //dd($tamOptions);  
            foreach ($options as &$option) {
                $option = explode("-", $option);                
            }
            //dd($options);
            //dd("entre a la parte no vacia");
            if($tamOptions == 1){
                $idFecha = intval($options[0][0]);
                $periodoId = intval($options[0][1]);
                $ambienteId = intval($options[0][2]);
                
                //dd($idFecha,$periodoId,$ambienteId);
                
               //dd($idFecha);
                $reserva = new Reservas();
                $reserva->fecha=$idFecha;
                $reserva->save();
                
                $reservaAmbiente = new ReservasAmbiente();
                $reservaAmbiente->ambientes_id = $ambienteId;
                $reservaAmbiente->save();

                $periodos = new PeriodosSeleccionado();
                $periodos -> reservas_id = $reserva->id;
                $periodos -> periodos_id = $periodoId;
                $periodos->save();
                //dd("reserva",$reserva,"reseraAmbiente",$reservaAmbiente,"periodos",$periodos);

            }else{
                $dato1 = $options[0];
                $dato2 = $options[1];
                //dd($dato1,$dato2);
                //dato1 su fecha su periodo y su ambiente
                $idFecha = intval($dato1[0]);
                $periodoId1 = intval($dato1[1]);
                $ambienteId = intval($dato1[2]);
                //dd("fecha",$idFecha,"periodo",$periodoId1,"ambiente",$ambienteId);
                //dd($fechaId1,$periodoId1,$ambienteId1);
                
                //$fechaId2 = intval(substr($dato2, 0, 1));
                $periodoId2 = intval($dato2[1]);
                //$ambienteId2 = intval(substr($dato2, 2, 1));
                //dd("fecha",$idFecha,"periodo1",$periodoId1,"periodo2",$periodoId2,"ambiente",$ambienteId);
                
                
                if ($periodoId1+1 == $periodoId2) {
                            
                    // guardar en la base datos
                    $reserva = new Reservas();
                    $reserva->fecha=$idFecha;
                    $reserva->save();

                    $reservaAmbiente = new ReservasAmbiente();
                    $reservaAmbiente->ambientes_id = $ambienteId;
                    $reservaAmbiente->save();

                    //guardar relacion de periodos en base de datos
                    $periodos = new PeriodosSeleccionado();
                    $periodos -> reservas_id = $reserva->id;
                    $periodos -> periodos_id = $periodoId1;
                    $periodos->save();

                
                    $periodos2 = new PeriodosSeleccionado();
                    $periodos2 -> reservas_id = $reserva->id;
                    $periodos2 -> periodos_id = $periodoId2;
                    $periodos2->save();
                    
                
                }else{
                    //'Escoja periodos contiguos'
                    return back()->with('success', 'Escoja periodos contiguos.');

                }
            
            
            }

            return redirect()->route('reservas.materias')->with('dato', $idFecha);
                
        }else{
            
                //escoja periodos
        }
        
        
    }

    //funcion para asignar a la tabla 
    public function guardar(Request $request)
    {  //dd($request->all());
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
            //$ultimaReserva = new Reservas();
            $ultimoRegistro = Reservas::orderBy('id', 'desc')->first();
            //dd($ultimoRegistro);
            $ultimoId = $ultimoRegistro->id;

            //$ultimoRegistroRA->reservas_id = $ultimoId;
            //$ultimoRegistroRA ->save();
            // Actualiza las filas donde reservas_id es NULL con el ID de la reserva deseada
            MateriasSeleccionado::whereNull('reservas_id')->update(['reservas_id' => $ultimoId]);
            //dd("revisa");

        } else {
            // Manejo de error: $options no es un array
            // Por ejemplo, podrías registrar un mensaje de error o redirigir con un mensaje de error.
        }
        
        
        // Redirigir al usuario a la ruta 'reservas.formFinal'
        return redirect()->route('reservas.formFinal');
    }

    public function guardarReserva(Request $request){
        //dd($request->all());
        $cantidadest=$request->cantidad;
        //print_r($request->cantidad);
        //dd($request->all());
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
        
            //necesitamos crear un nuevo registro
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

        return redirect()->back()->with('success', 'Se ha registrado con exito.');
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
    
// **************************************************************************************************************
public function actualizarReserva(Request $request) {
    
    $idReserva = intval($request->idReserva);
    $cantidadNueva = intval($request->cantidad);
    $motivoNuevo = $request->motivo;
    //dd($idReserva,$cantidadNueva,$motivoNuevo);
    
    // Encontrar la reserva por su ID
    $reserva = Reservas::findOrFail($idReserva);

    // Actualizar los campos cantidad y motivo
     $reserva->CantEstudiante = $cantidadNueva;
     $reserva->Motivo = $motivoNuevo;
    
    // Guardar los cambios en la base de datos
     $reserva->save();
    return redirect()->route('reservas.pendientesDocente')->with('success', 'Solicitud de reserva actualizada exitosamente');
    // Redireccionar o responder según sea necesario
}

    public function eliminarPendiente($idReserva) {
        // dd($idReserva);
        $reserva = Reservas::find($idReserva);// Busca la reserva por su ID
        //dd($idReserva);
        if ($reserva) {  // Verifica si se encontró la reserva
            
            $reserva->delete(); // Elimina la reserva

            return redirect()->route('reservas.pendientesDocente')->with('success', 'Solicitud de reserva eliminada exitosamente');

        } else {

            return redirect()->route('reservas.pendientesDocente')->with('error' , 'Solicitud de reserva No eliminada');
        }
    }
}

