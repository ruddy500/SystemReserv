<?php

namespace App\Http\Controllers;
use App\Models\Anuncios;

use App\Models\Reglas;
use Illuminate\Http\Request;
use Carbon\Carbon;
class AnunciosController extends Controller
{
    public function mostrar(){
        $anuncios = Anuncios::all();
        $tam = $anuncios->count();

        $reglas = Reglas::all();
        $t = $reglas->count();

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('anuncios.index', compact('menu','anuncios','tam','reglas','t'));
    }

    public function guardar(Request $request){
        $titulo = $request->input('titulo-anuncio');
        $texto = $request->input('contenido-anuncio');
        //dd($titulo, $texto);
        $carbon = Carbon::now('America/La_Paz');
        $fecha = $carbon->format('d-m-Y');
        $hora = $carbon->format('H:i:s');
        //creamos la fila 
        $anuncio = new Anuncios();
        $anuncio->Titulo=$titulo;
        $anuncio->Contenido=$texto;
        $anuncio->Fecha=$fecha;
        $anuncio->Hora=$hora;
        $anuncio->save();

        $menu = view('componentes/menu'); // Crear la vista del menú
        return redirect()->route('anuncios.index',compact('menu'))->with('success', 'Anuncio registrado exitosamente.');
    }

    public function eliminar(Request $request){
        
        $id = $request->input('id-anuncio');
        $anuncio = Anuncios::find($id);// Busca el anuncio por su ID
        
        if ($anuncio) {  // Verifica si se encontró el anuncio
            $anuncio->delete(); // Elimina el anuncio
            $menu = view('componentes/menu'); // Crear la vista del menú
            return redirect()->route('anuncios.index',compact('menu'))->with('success', '¡El anuncio ha sido eliminado');
            
        } else {
            $menu = view('componentes/menu'); // Crear la vista del menú
            return redirect()->route('anuncios.index',compact('menu'))->with('message', '¡Error al eliminar');
        }
    }
}