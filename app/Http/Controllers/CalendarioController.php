<?php

namespace App\Http\Controllers;

use App\Models\Eventos;
use App\Models\ConfiguracionCalendario;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarioController extends Controller
{

    public function mostrar(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        $eventos = Eventos::all()->map(function ($evento) {
            return [
                'title' => $evento->Nombre,
                'start' => Carbon::parse($evento->FechaInicial)->toDateString(),
                'end' => Carbon::parse($evento->FechaFinal)->addDay()->toDateString(),
                // 'end' => Carbon::parse($evento->FechaFinal)->toDateString(),
                // 'display'=> 'background',
                // 'color'=>'#CCFFCC',// Color de fondo del evento (verde claro)
                'textColor' => 'white', 
            ];
        });

        $configuraciones = ConfiguracionCalendario::all()->map(function ($configuracion) {
            return [
                'title' => $configuracion->CicloExamen,
                'start' => Carbon::parse($configuracion->FechaInicial)->toDateString(),
                'end' => Carbon::parse($configuracion->FechaFinal)->addDay()->toDateString(),
                // 'end' => Carbon::parse($evento->FechaFinal)->toDateString(),
                'display'=> 'background',
                'color'=>'#CCFFCC',// Color de fondo del evento (verde claro)
                'textColor' => 'white', 
            ];
        });
    
        return view('calendario.inicio', compact('menu','eventos','configuraciones'));
    }

    public function mostrarDocente(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        
        $eventos = Eventos::all()->map(function ($evento) {
            return [
                'title' => $evento->Nombre,
                'start' => Carbon::parse($evento->FechaInicial)->toDateString(),
                'end' => Carbon::parse($evento->FechaFinal)->addDay()->toDateString(),
                // 'end' => Carbon::parse($evento->FechaFinal)->toDateString(),
                // 'display'=> 'background',
                // 'color'=>'#CCFFCC',// Color de fondo del evento (verde claro)
                'textColor' => 'white', 
            ];
        });

        $configuraciones = ConfiguracionCalendario::all()->map(function ($configuracion) {
            return [
                'title' => $configuracion->CicloExamen,
                'start' => Carbon::parse($configuracion->FechaInicial)->toDateString(),
                'end' => Carbon::parse($configuracion->FechaFinal)->addDay()->toDateString(),
                // 'end' => Carbon::parse($evento->FechaFinal)->toDateString(),
                'display'=> 'background',
                'color'=>'#CCFFCC',// Color de fondo del evento (verde claro)
                'textColor' => 'white', 
            ];
        });
    
        return view('calendario.principalDocente', compact('menu','eventos','configuraciones'));
    }
    public function inicio(){
        $menu = view('componentes/menu'); // Crear la vista del menú

        $eventos = Eventos::all()->map(function ($evento) {
            return [
                'title' => $evento->Nombre,
                'start' => Carbon::parse($evento->FechaInicial)->toDateString(),
                'end' => Carbon::parse($evento->FechaFinal)->addDay()->toDateString(),
                // 'end' => Carbon::parse($evento->FechaFinal)->toDateString(),
                // 'display'=> 'background',
                // 'color'=>'#CCFFCC',// Color de fondo del evento (verde claro)
                'textColor' => 'white', 
            ];
        });

        $configuraciones = ConfiguracionCalendario::all()->map(function ($configuracion) {
            return [
                'title' => $configuracion->CicloExamen,
                'start' => Carbon::parse($configuracion->FechaInicial)->toDateString(),
                'end' => Carbon::parse($configuracion->FechaFinal)->addDay()->toDateString(),
                // 'end' => Carbon::parse($evento->FechaFinal)->toDateString(),
                'display'=> 'background',
                'color'=>'#CCFFCC',// Color de fondo del evento (verde claro)
                'textColor' => 'white', 
            ];
        });

        return view('calendario.inicio', compact('menu','eventos','configuraciones'));
    }
    public function evento(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        $eventos = Eventos::all();
        return view('calendario.evento', compact('menu','eventos'));
    }
    public function configuracion(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('calendario.configuracion', compact('menu'));
    }

    public function registrarEvento(Request $request){

        $nombre = $request->nombre_evento;
        $fechaIni = $request->fecha_inicial;
        $fechaFin = $request->fecha_final;

        $evento = new Eventos();
        $evento->Nombre = $nombre;
        $evento->FechaInicial = $fechaIni;
        $evento->FechaFinal = $fechaFin;
        $evento->save();

        // return view('calendario.evento', compact('menu'));
        return redirect()->route('calendario.evento');
    }

    public function configurarCalendario(Request $request){

        $fechaIniSemestre = $request->fecha_i;
        $fechaFinSemestre = $request->fecha_f;

        $fechaIniMesa = $request->fecha_ini_mesa;
        $fechaFinMesa = $request->fecha_fin_mesa;
        //$nombre = $request->nombre_evento;
        $fechaIni = $request->fecha_ini_primer;
        $fechaFin = $request->fecha_fin_primer;
      //  dd($fechaIni,$fechaFin);
        $fechaIni2 = $request->fecha_ini_segundo;
        $fechaFin2 = $request->fecha_fin_segundo;

        $fechaIni3 = $request->fecha_ini_tercero;
        $fechaFin3 = $request->fecha_fin_tercero;

        $confiSemestre = new ConfiguracionCalendario();
        $confiSemestre->CicloExamen = "Semestre";
        $confiSemestre->FechaInicial = $fechaIniSemestre;
        $confiSemestre->FechaFinal = $fechaFinSemestre;
        $confiSemestre->save();

        $confiMesa = new ConfiguracionCalendario();
        $confiMesa->CicloExamen = "Mesa";
        $confiMesa->FechaInicial = $fechaIniMesa;
        $confiMesa->FechaFinal = $fechaFinMesa;
        $confiMesa->save();

        $confi = new ConfiguracionCalendario();
        $confi->CicloExamen = "PrimerParcial";
        $confi->FechaInicial = $fechaIni;
        $confi->FechaFinal = $fechaFin;
        $confi->save();

        $confi2 = new ConfiguracionCalendario();
        $confi2->CicloExamen = "SegundoParcial";
        $confi2->FechaInicial = $fechaIni2;
        $confi2->FechaFinal = $fechaFin2;
        $confi2->save();

        $confi3 = new ConfiguracionCalendario();
        $confi3->CicloExamen = "Final";
        $confi3->FechaInicial = $fechaIni3;
        $confi3->FechaFinal = $fechaFin3;
        $confi3->save();
        // return view('calendario.evento', compact('menu'));
        return redirect()->route('calendario.configuracion');
    }

    public function eliminar(Request $request){
        $id = $request->input('id-evento');
        $evento = Eventos::find($id);// Busca el evento por su ID
        if($evento){
            $evento->delete();
            $menu = view('componentes/menu'); // Crear la vista del menú
            return redirect()->route('calendario.evento',compact('menu'))->with('success', '¡El evento ha sido eliminado');
        }else{
            $menu = view('componentes/menu'); // Crear la vista del menú
            return redirect()->route('calendario.evento',compact('menu'))->with('message', '¡Error al eliminar');
        }
    }
}