<?php

namespace App\Http\Controllers;

use App\Models\Eventos;
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
                // 'end' => Carbon::parse($evento->FechaFinal)->addDay()->toDateString(),
                'end' => Carbon::parse($evento->FechaFinal)->toDateString(),
                'display'=> 'background',
                'color'=>'#CCFFCC',// Color de fondo del evento (verde claro)
                'textColor' => '#000000', 
            ];
        });
    
        return view('calendario.inicio', compact('menu','eventos'));
    }

    public function mostrarDocente(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        
        $eventos = Eventos::all()->map(function ($evento) {
            return [
                'title' => $evento->Nombre,
                'start' => Carbon::parse($evento->FechaInicial)->toDateString(),
                // 'end' => Carbon::parse($evento->FechaFinal)->addDay()->toDateString(),
                'end' => Carbon::parse($evento->FechaFinal)->toDateString(),
                'display'=> 'background',
                'color'=>'#CCFFCC',// Color de fondo del evento (verde claro)
                'textColor' => '#000000', 
            ];
        });
    
        return view('calendario.principalDocente', compact('menu','eventos'));
    }
    public function inicio(){
        $menu = view('componentes/menu'); // Crear la vista del menú

        return view('calendario.inicio', compact('menu'));
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
}