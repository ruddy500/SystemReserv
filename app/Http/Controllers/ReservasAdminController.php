<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;
use App\Models\Fechas;
use App\Models\Periodos;
use App\Models\PeriodosSeleccionado;
use App\Models\Horarios;
use App\Models\Ambientes;
use App\Models\Motivos;
use App\Models\TipoAmbientes;

class ReservasAdminController extends Controller
{
 
    public function mostrar()
    {  

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.admin.asignadas', compact('menu'));
    }

    public function asignadas()
    {
        // Lógica para mostrar las reservas asignadas
        $menu = view('componentes/menu');
        return view('reservas.admin.asignadas', compact('menu'));
    }

    public function pendientes()
    {
        // Lógica para mostrar las reservas pendientes
        $menu = view('componentes/menu');
        return view('reservas.admin.pendientes', compact('menu'));
    }
    
    
    public function buscarReservas(Request $request){
   
        // dd($request->all());
        $reservas = Reservas::all();
        $tamReservas = Reservas::count();
        // dd($tamReservas);

        $estadoCheckbox = $request->checkbox_estado;
        $buscadorContenido = $request->buscadorContenido;
        //dd($buscadorContenido);
        
        if(!empty($buscadorContenido)){
            if( $estadoCheckbox){
            
                $fechaInicial = $request ->fecha_inicial;
                $fechaFinal = $request ->fecha_final;
            
                $fechaCIni = \DateTime::createFromFormat('d-m-Y', $fechaInicial); 
                $fechaIni = $fechaCIni->format('Y-m-d');

                $fechaCFin = \DateTime::createFromFormat('d-m-Y', $fechaFinal);
                $fechaFin = $fechaCFin->format('Y-m-d');
                //  dd($fechaIni,$fechaFin);
                
                $reservasFiltradas = [];
                    
                for ($i=0; $i <$tamReservas ; $i++) { 
                    
                    $fechaString = $reservas[$i]->fecha;
                    $fechaReserva = date('Y-m-d', strtotime($fechaString));
                    // dd($fechaReserva);
                    // dd("Fechafin",$fechaFin,"Reserva",$fechaReserva,$fechaFin >= $fechaReserva);
                    $motivoId = $reservas[$i]->motivos_id;
                    $motivoRegistro = Motivos::where('id',$motivoId)->first();
                    $motivo = $motivoRegistro->Nombre;
                   // dd($motivoRegistro);
                    if (($fechaIni <= $fechaReserva) && ($fechaFin >= $fechaReserva) && $buscadorContenido == $motivo) {
                        
                        $reservasFiltradas[] = $reservas[$i];
                        
                    }
            
                }
               // dd($motivo);
                // dd($reservasFiltradas);
                return redirect()->route('reservas.pendientes')->with('reservasFiltradas',$reservasFiltradas);
            }else{
                
                $reservasFiltradas = [];
                for ($i=0; $i < $tamReservas ; $i++) { 
                    $motivoId = $reservas[$i]->motivos_id;
                    $motivoRegistro = Motivos::where('id',$motivoId)->first();
                    $motivo = $motivoRegistro->Nombre;

                    if($buscadorContenido == $motivo){
                      $reservasFiltradas[] = $reservas[$i];
                    }
                }
                
                //  dd($reservasFiltradas);
                return redirect()->route('reservas.pendientes')->with('reservasFiltradas',$reservasFiltradas);
            }
        }else{
            if( $estadoCheckbox){
            
                $fechaInicial = $request ->fecha_inicial;
                $fechaFinal = $request ->fecha_final;
            
                $fechaCIni = \DateTime::createFromFormat('d-m-Y', $fechaInicial); 
                $fechaIni = $fechaCIni->format('Y-m-d');

                $fechaCFin = \DateTime::createFromFormat('d-m-Y', $fechaFinal);
                $fechaFin = $fechaCFin->format('Y-m-d');
                //  dd($fechaIni,$fechaFin);
                
                $reservasFiltradas = [];
                    
                for ($i=0; $i <$tamReservas ; $i++) { 
                    
                    $fechaString = $reservas[$i]->fecha;
                    $fechaReserva = date('Y-m-d', strtotime($fechaString));
                    // dd($fechaReserva);
                    // dd("Fechafin",$fechaFin,"Reserva",$fechaReserva,$fechaFin >= $fechaReserva);
                    
                    if (($fechaIni <= $fechaReserva) && ($fechaFin >= $fechaReserva)) {
                        
                        $reservasFiltradas[] = $reservas[$i];
                        
                    }
            
                }
                // dd($reservasFiltradas);
                return redirect()->route('reservas.pendientes')->with('reservasFiltradas',$reservasFiltradas);
            }
            return redirect()->route('reservas.pendientes');
        }

            
    }

    public function verificar($idReserva)
    {   // Lógica para mostrar las reservas pendientes
        $reserva = Reservas::find($idReserva);
        $periodos=  PeriodosSeleccionado ::all();
        $periodo=  Periodos ::all();
        $tamP= $periodos->count();
        $menu = view('componentes/menu');
        return view('reservas.admin.verificar', compact('menu','idReserva','reserva','tamP','periodo','periodos'));
    }


    public function buscarAmbientesDisponibles(Request $request,$idReserva){
        //dd($idReserva);
        $registroReserva = Reservas::find($idReserva);
        $cantEst = $registroReserva->CantEstudiante;
        $totalEst = $registroReserva->TotalEstudiantes;
        $tipo_ubicacion = $request->buscarTipoUbi;
       $tipos = TipoAmbientes::all();
       $IDtipo = 0;
       foreach ($tipos as $tipo) {
        if($tipo->Nombre === $tipo_ubicacion){
            $IDtipo = $tipo->id;
        }
       }

             $fechaReserva = $request->fecha_reserva;
           // dd($fechaReserva);
            // dd($fechaReserva, $periodoReserva);
             $fechaEntera = strtotime($fechaReserva);
             //obtener dia de la fecha seleccionada
             $dia_fecha = date("d", $fechaEntera);
             //obtener mes de la fecha seleccionada
             $mes_fecha = date("m", $fechaEntera);
             //obtener anio la fecha seleccionada
             $anio_fecha = date("y", $fechaEntera);
             //dd($mes_fecha);
             $ambientesEncontrados = collect(); // Inicializamos una colección para almacenar los resultados
             $ambientesEncontrados2 = collect(); // Inicializamos una colección para almacenar los resultados
             $ambientesEncontradosComplet = collect();
             $ambientesDosPeriodos_uno = collect();
             $ambientesDosPeriodos_dos = collect();
             $ambientesDosPeriodosComplet = collect();

             $ambientesTIPO = collect();
             $ambientesTIPO_UBICACION = collect();
             $ambientesTIPO_UBICACION_Dos = collect();

        $fechass = Fechas::all();
        //dd($fechass);
      //capturamos el periodo
      $periodoss = Periodos::all();
    //   $aaa = periodo_reserva_uno;
        $periodoReserva = $request->periodo_reserva_uno;
       // dd($periodoReserva);
        $periodoReserva2 = $request->periodo_reserva_dos;
       // dd($periodoReserva2);
        if($periodoReserva2 === null){
            foreach ($periodoss as $periodo) {
                if($periodo->HoraIntervalo == $periodoReserva){
                    $idPeri = $periodo->id;
                 // dd($ambientesEncontrados); //ambientes q se encontro en la fecha q se quiere obtener
                }   
              } 
    
            //dd($idPeri);

          //   dd($ambientesEncontrados);
        foreach ($fechass as $fecha) {
            if($fecha->dia == $dia_fecha && $fecha->mes == $mes_fecha && $fecha->anio == $anio_fecha){
                $fechaRegistro = Fechas::find($fecha->id);
                $ambientesEncontrados = $ambientesEncontrados->merge(Horarios::where('fechas_id', $fechaRegistro->id)
                                                                            ->where('periodos_id', $idPeri)
                                                                            ->get());
            }   
        } 
        foreach($ambientesEncontrados as $amb){
           $ambienteID = $amb->ambientes_id;
           $ambient = Ambientes::find($ambienteID);
           $cap = $ambient->Capacidad;
           if($cap >= $cantEst && $cap <= $totalEst){
            $ambientesEncontradosComplet = $ambientesEncontradosComplet->merge(Horarios::where('fechas_id', $fechaRegistro->id)
            ->where('periodos_id', $idPeri)
            ->where('ambientes_id', $ambient->id)
            ->get());

           }
        }
       // dd($ambientesEncontradosComplet);
       foreach ($ambientesEncontradosComplet as $amb) {
        $ambienteID = $amb->ambientes_id;
        $ambient = Ambientes::find($ambienteID);
        $ubi = $ambient->Ubicacion;
    
        // Realizar la búsqueda por ubicación y tipo de ambiente por separado
        $ambientesPorUbicacion = Ambientes::where('Ubicacion', 'like', '%'.$ubi.'%')->get();
       // $ambientesPorTipo = TipoAmbientes::where('tipo_ambientes_id', $type)->get();
    
        // Fusionar los resultados en la colección $ambientesTIPO
        $ambientesTIPO = $ambientesTIPO->merge($ambientesPorUbicacion);
    }
    $existe_ubi = false;
    foreach ($ambientesTIPO as $amb) {
    if($amb->Ubicacion === $tipo_ubicacion){
        //$ambientesTIPO_UBICACION->push($amb);
        $existe_ubi = true;
    }else{
       // $existe_ubi = false;
        //NADA
    }
}
// dd($ambientesTIPO_UBICACION);
    if($IDtipo === 0 && $existe_ubi === false){ //No encontro tipo_ambiente
        foreach ($ambientesTIPO as $amb) {
            $ambientesTIPO_UBICACION->push($amb);
        }
    }else if($IDtipo != 0){
    foreach ($ambientesTIPO as $amb) {
        if($amb->tipo_ambientes_id === $IDtipo){
            $ambientesTIPO_UBICACION->push($amb);
        }
    }
}else{
    foreach ($ambientesTIPO as $amb) {
        if($amb->Ubicacion === $tipo_ubicacion){
            $ambientesTIPO_UBICACION->push($amb);
        }else{
            //NADA
        }
}
}

    //dd($ambientesTIPO_UBICACION);
        // Aquí tienes la colección de ambientes encontrados que coinciden con la fecha y el período
       //return redirect()->route('reservas.verificar',['idReserva' => $idReserva])->with('ambientesEncontradosComplet',$ambientesEncontradosComplet);
       return redirect()->route('reservas.verificar',['idReserva'=>$idReserva])->with('ambientesTIPO_UBICACION',$ambientesTIPO_UBICACION);
        
    }else{
            foreach ($periodoss as $periodo) {
                if($periodo->HoraIntervalo == $periodoReserva){
                    $idPeri = $periodo->id;
                    $idPeri2 = $idPeri + 1;
                 // dd($ambientesEncontrados); //ambientes q se encontro en la fecha q se quiere obtener
                }   
              } 
    
            //dd($idPeri);

          //   dd($ambientesEncontrados);
        foreach ($fechass as $fecha) {
            if($fecha->dia == $dia_fecha && $fecha->mes == $mes_fecha && $fecha->anio == $anio_fecha){
                $fechaRegistro = Fechas::find($fecha->id);
                $ambientesEncontrados = $ambientesEncontrados->merge(Horarios::where('fechas_id', $fechaRegistro->id)
                                                                            ->where('periodos_id', $idPeri)
                                                                            ->get());
            }   
        }
        //aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        foreach($ambientesEncontrados as $amb){
            $ambienteID = $amb->ambientes_id;
            $ambient = Ambientes::find($ambienteID);
            $cap = $ambient->Capacidad;
            // dd($cap);
            if($cap >= $cantEst && $cap <= $totalEst){
             $ambientesDosPeriodos_uno =  $ambientesDosPeriodos_uno->merge(Horarios::where('fechas_id', $fechaRegistro->id)
             ->where('periodos_id', $idPeri)
             ->where('ambientes_id', $ambient->id)
             ->get());
            }
         }
        
        foreach ($fechass as $fecha) {
            if($fecha->dia == $dia_fecha && $fecha->mes == $mes_fecha && $fecha->anio == $anio_fecha){
                $fechaRegistro = Fechas::find($fecha->id);
                $ambientesEncontrados2 = $ambientesEncontrados2->merge(Horarios::where('fechas_id', $fechaRegistro->id)
                                                                            ->where('periodos_id', $idPeri2)
                                                                            ->get());
            }   
        }
        
        foreach($ambientesEncontrados2 as $amb){
            $ambienteID = $amb->ambientes_id;
            $ambient = Ambientes::find($ambienteID);
            $cap = $ambient->Capacidad;
            // dd($cap);
            if($cap >= $cantEst && $cap <= $totalEst){
             $ambientesDosPeriodos_dos =  $ambientesDosPeriodos_dos->merge(Horarios::where('fechas_id', $fechaRegistro->id)
             ->where('periodos_id', $idPeri2)
             ->where('ambientes_id', $ambient->id)
             ->get());
            }
         }
            // Obtener el tamaño máximo entre ambas colecciones
            $maxSize = max($ambientesDosPeriodos_uno->count(), $ambientesDosPeriodos_dos->count());

            // Interceptar ambas colecciones
            for ($i = 0; $i < $maxSize; $i++) {
                // Agregar elementos de la primera colección si existen
                if ($i < $ambientesDosPeriodos_uno->count()) {
                    $ambientesDosPeriodosComplet->push($ambientesDosPeriodos_uno[$i]);
                }
                // Agregar elementos de la segunda colección si existen
                if ($i < $ambientesDosPeriodos_dos->count()) {
                    $ambientesDosPeriodosComplet->push($ambientesDosPeriodos_dos[$i]);
                }
            }


            foreach ($ambientesDosPeriodosComplet as $amb) {
                $ambienteID = $amb->ambientes_id;
                $ambient = Ambientes::find($ambienteID);
                $ubi = $ambient->Ubicacion;
            
                // Realizar la búsqueda por ubicación y tipo de ambiente por separado
                $ambientesPorUbicacion = Ambientes::where('Ubicacion', 'like', '%'.$ubi.'%')->get();
               // $ambientesPorTipo = TipoAmbientes::where('tipo_ambientes_id', $type)->get();
            
                // Fusionar los resultados en la colección $ambientesTIPO
                $ambientesTIPO = $ambientesTIPO->merge($ambientesPorUbicacion);
            }

            $existe_ubi = false;
            foreach ($ambientesTIPO as $amb) {
            if($amb->Ubicacion === $tipo_ubicacion){
                //$ambientesTIPO_UBICACION->push($amb);
                $existe_ubi = true;
            }else{
            // $existe_ubi = false;
                //NADA
            }
            }
            // dd($ambientesTIPO_UBICACION);
            if($IDtipo === 0 && $existe_ubi === false){ //No encontro tipo_ambiente
                foreach ($ambientesTIPO as $amb) {
                    $ambientesTIPO_UBICACION_Dos->push($amb);
                }
            }else if($IDtipo != 0){
            foreach ($ambientesTIPO as $amb) {
                if($amb->tipo_ambientes_id === $IDtipo){
                    $ambientesTIPO_UBICACION_Dos->push($amb);
                }
            }
            }else{
            foreach ($ambientesTIPO as $amb) {
                if($amb->Ubicacion === $tipo_ubicacion){
                    $ambientesTIPO_UBICACION_Dos->push($amb);
                }else{
                    //NADA
                }
            }
            }

        return redirect()->route('reservas.verificar',['idReserva'=>$idReserva])->with('ambientesTIPO_UBICACION_Dos',$ambientesTIPO_UBICACION_Dos);

        }
    }      
}
