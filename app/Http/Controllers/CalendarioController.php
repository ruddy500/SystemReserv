<?php

namespace App\Http\Controllers;

use App\Models\Eventos;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function mostrar(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('calendario.inicio', compact('menu'));
    }
    public function mostrarDocente(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('calendario.principalDocente', compact('menu'));
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