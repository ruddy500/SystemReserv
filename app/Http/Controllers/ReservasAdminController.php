<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;
use App\Models\Fechas;
use App\Models\Periodos;
use App\Models\PeriodosSeleccionado;
use App\Models\Horarios;
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
    
    //********* En proceso ***********
    public function buscarReservas(Request $request){
   
        //dd($request->all());
        $reservas = Reservas::all();
        $tamReservas = Reservas::count();
        // dd($tamReservas);

        $estadoCheckbox = $request->checkbox_estado;
        
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
                //modificar
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
        }else{
           
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


    public function buscarAmbientesDisponibles(Request $request){
        // dd($fechass);
             //obtener fecha de la vista en formato "d-m-y"
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
        $fechass = Fechas::all();
        //dd($fechass);
      //capturamos el periodo
      $periodoss = Periodos::all();
        $periodoReserva = $request->periodo_reserva_uno;
        $periodoReserva2 = $request->periodo_reserva;
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
        
      //  dd($ambientesEncontrados);
        // Aquí tienes la colección de ambientes encontrados que coinciden con la fecha y el período
        return view('reservas.admin.verificar', compact('ambientesEncontrados'));
        // return view('reservas.admin.verificar', ['ambientesEncontrados' => $ambientesEncontrados]);
      //return redirect()->back()->with('ambientesEncontrados',$ambientesEncontrados);
      //return redirect()->route('reservas.verificar', ['idReserva' => $idReserva])->with('ambientesEncontrados', $ambientesEncontrados);
      //return view('reservas.verificar', ['ambientesEncontrados' => $ambientesEncontrados]);
       //return redirect()->route('reservas.verificar',['idReserva' => $idReserva])->with('ambientesEncontrados',$ambientesEncontrados);
        //return redirect('reservas.admin.verificar')->with('ambientesEncontrados',$ambientesEncontrados);
       // dd($ambientesEncontrados);
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
        
        foreach ($fechass as $fecha) {
            if($fecha->dia == $dia_fecha && $fecha->mes == $mes_fecha && $fecha->anio == $anio_fecha){
                $fechaRegistro = Fechas::find($fecha->id);
                $ambientesEncontrados2 = $ambientesEncontrados2->merge(Horarios::where('fechas_id', $fechaRegistro->id)
                                                                            ->where('periodos_id', $idPeri2)
                                                                            ->get());
            }   
        } 
        if($ambientesEncontrados != null && $ambientesEncontrados2 != null){
            dd($ambientesEncontrados,$ambientesEncontrados2);
        }
        // Aquí tienes la colección de ambientes encontrados que coinciden con la fecha y el período
       // dd($ambientesEncontrados);
        }
        //dd($periodoReserva,$periodoReserva2);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    }
    
        
}