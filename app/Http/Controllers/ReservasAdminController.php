<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;
use App\Models\Fechas;
use App\Models\Periodos;
use App\Models\PeriodosSeleccionado;
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
    
        
}