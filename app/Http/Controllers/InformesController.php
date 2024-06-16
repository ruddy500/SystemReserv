<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Ambientes;
use App\Models\Reservas;
use App\Models\Usuarios;
use App\Models\Motivos;
use App\Models\MateriasSeleccionado;
use App\Models\Materias;
use App\Models\PeriodosSeleccionado;
use App\Models\Periodos;
use App\Models\ReservasAmbiente;
use App\Models\NombreAmbientes;
use App\Models\ConfiguracionCalendario;
use Illuminate\Support\Facades\DB;

class InformesController extends Controller
{
    // public function getMasUsadoAmb(){
     
    //   $reservasAsignadas = Reservas::where('Estado','asignado')->pluck('id');
      
    //   $reservasAmbientes = ReservasAmbiente::whereIn('reservas_id', $reservasAsignadas)->get();
     

    //   $conteoAmbientes = $reservasAmbientes->groupBy('ambientes_id')
    //     ->map->count();

    //   // Ordenar por la cantidad de repeticiones en orden descendente
    //   $conteoAmbientes = $conteoAmbientes->sortByDesc(function ($count) {
    //     return $count;
    //     });
    
    //     $idNombreAmbiente = $conteoAmbientes->keys()->first();
    //     $registroNombreID = NombreAmbientes::where('id',$idNombreAmbiente)->first();
    //     $ambiente = $registroNombreID->Nombre;

    //     $cantidadRepeticiones = $conteoAmbientes->first();

    // //   dd($ambienteMasRepetido,$cantidadRepeticiones);
    //   $datos = ['ambiente'=>$ambiente,
    //   'cantidadApariciones'=>$cantidadRepeticiones,
    // ];

    // // dd($datos);
    
    //   return $datos;
    // }

    public function getMasUsadoAmb(){
      $reservasAsignadas = Reservas::where('Estado', 'asignado')->pluck('id');
      
      $reservasAmbientes = ReservasAmbiente::whereIn('reservas_id', $reservasAsignadas)->get();
      
      $conteoAmbientes = $reservasAmbientes->groupBy('ambientes_id')
          ->map->count();
  
      // Ordenar por la cantidad de repeticiones en orden descendente
      $conteoAmbientes = $conteoAmbientes->sortByDesc(function ($count) {
          return $count;
      });
  
      $idNombreAmbiente = $conteoAmbientes->keys()->first();
      $datos = [];
      if ($idNombreAmbiente !== null) {
          $registroNombreID = NombreAmbientes::where('id', $idNombreAmbiente)->first();
  
          if ($registroNombreID !== null) {
              $ambiente = $registroNombreID->Nombre;
              $cantidadRepeticiones = $conteoAmbientes->first();
              
              $datos = [
                  'ambiente' => $ambiente,
                  'cantidadApariciones' => $cantidadRepeticiones,
              ];
  
          }
      }

      return $datos;
  }
  

    public function getMenosUsadoAmb(){
      
            $reservasAsignadas = Reservas::where('Estado','asignado')->pluck('id');
            $reservasAmbientes = ReservasAmbiente::whereIn('reservas_id', $reservasAsignadas)->get();
          //  dd($reservasAmbientes);
            $conteoAmbientes = $reservasAmbientes->groupBy('ambientes_id')
              ->map->count();
      
            // Ordenar por la cantidad de repeticiones en orden descendente
            $conteoAmbientes = $conteoAmbientes->sortBy(function ($count) {
              return $count;
              });
          
              $idNombreAmbiente = $conteoAmbientes->keys()->first();
              $datos = [];
              if($idNombreAmbiente !== null){
                $registroNombreID = NombreAmbientes::where('id',$idNombreAmbiente)->first();
                if($registroNombreID !== null){
                  $ambiente = $registroNombreID->Nombre;
          
                  $cantidadRepeticiones = $conteoAmbientes->first();
          
              //   dd($ambienteMasRepetido,$cantidadRepeticiones);
                  $datos = ['ambiente'=>$ambiente,
                      'cantidadApariciones'=>$cantidadRepeticiones,
                  ];
      

                }

              }
             
      return $datos;
    }
    public function mostrar(){
        $menu = view('componentes/menu'); // Crear la vista del menú
       
        
        // dd($reservasPorAmbiente);
        $ambienteMasUsado = $this->getMasUsadoAmb();
        $ambienteMenosUsado = $this->getMenosUsadoAmb();
        // dd($ambienteMasUsado,$ambienteMenosUsado);

        $datos = ['ambienteMasUsado'=>$ambienteMasUsado,
                  'ambienteMenosUsado'=>$ambienteMenosUsado,
                ];
// dd($datos);
        return view('informes.informe', compact('menu','datos'));
    }

    public function generarPDF()
    {
        $reservasAmbientes = ReservasAmbiente::all();
        $configuraciones = ConfiguracionCalendario::all();


        $data = [];
        foreach ($reservasAmbientes as $reservasAmbiente) {
            $idReserva = $reservasAmbiente->reservas_id;
            $reserva = Reservas::where('id', $idReserva)->first();
            $idAmbiente = $reservasAmbiente->ambientes_id;
            $registroAmbiente = Ambientes::where('id', $idAmbiente)->first();
            $idNombreAmbiente = $registroAmbiente->nombre_ambientes_id;
            $registroNA = NombreAmbientes::where('id', $idNombreAmbiente)->first();
            $nombreAmbiente = $registroNA->Nombre;
            $fecha = $reserva->fecha;
            $motivoId = $reserva->motivos_id;
            $registroMotivo = Motivos::where('id', $motivoId)->first();
            $motivo = $registroMotivo->Nombre;
            $idDocente = $reserva->docentes_id;
            $registroDocente = Usuarios::where('id', $idDocente)->first();
            $nombreDocente = $registroDocente->name;
            $registrosMatSelec = MateriasSeleccionado::where('reservas_id', $idReserva)->get();
            $idMateria = $registrosMatSelec[0]->materias_id;
            $registroMateria = Materias::where('id', $idMateria)->first();
            $nombreMateria = $registroMateria->Nombre;
            $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id', $idReserva)->get();
            $tamPeriodosSeleccionado = count($periodosSeleccionados);
            $horaInicio = '';
            $horaFin = '';

            if ($tamPeriodosSeleccionado > 0) {
                $periodoId = $periodosSeleccionados[0]->periodos_id;
                $periodoBuscar = Periodos::where('id', $periodoId)->first();
                $partes_P = explode('-', $periodoBuscar->HoraIntervalo);
                $horaInicio = trim(str_replace(' ', '', $partes_P[0]));

                if ($tamPeriodosSeleccionado > 1) {
                    $periodoId2 = $periodosSeleccionados[1]->periodos_id;
                    $periodoBuscar2 = Periodos::where('id', $periodoId2)->first();
                    $partes_P2 = explode('-', $periodoBuscar2->HoraIntervalo);
                    $horaFin = trim(str_replace(' ', '', $partes_P2[1]));
                } else {
                    $horaFin = trim(str_replace(' ', '', $partes_P[1]));
                }
            }

            $data[] = [
                'nombreAmbiente' => $nombreAmbiente,
                'fecha' => $fecha,
                'horaInicio' => $horaInicio,
                'horaFin' => $horaFin,
                'nombreMateria' => $nombreMateria,
                'motivo' => $motivo,
                'nombreDocente' => $nombreDocente,

            ];
        }

        $ambienteMasUsado = $this->getMasUsadoAmb();
        $ambienteMenosUsado = $this->getMenosUsadoAmb();
        // dd($ambienteMasUsado,$ambienteMenosUsado);

        $datos = ['ambienteMasUsado'=>$ambienteMasUsado,
                  'ambienteMenosUsado'=>$ambienteMenosUsado,
                ];

        $pdf = PDF::loadView('informes.informe_pdf', compact('data','configuraciones','datos'));

        return $pdf->download('informe_uso_ambientes.pdf');
    }
}