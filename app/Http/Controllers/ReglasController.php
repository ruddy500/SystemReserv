<?php

namespace App\Http\Controllers;

use App\Models\Reglas;
use App\Models\Anuncios;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReglasController extends Controller
{

    public function mostrarReglas(){
        $anuncios = Anuncios::all();
        $tam = $anuncios->count();

        $reglas = Reglas::all();
        $t = $reglas->count();

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('anuncios.tablaReglas', compact('menu','anuncios','tam','reglas','t'));
    }
     public function eliminar(Request $request){
        
         $id = $request->input('id-regla');
         $regla = Reglas::find($id);// Busca el anuncio por su ID

         if ($regla) {  // Verifica si se encontró el anuncio
             $regla->delete(); // Elimina el anuncio
             $menu = view('componentes/menu'); // Crear la vista del menú
             return redirect()->route('Anuncios.tablaReglas',compact('menu'))->with('success', '¡La regla ha sido eliminado');
            
         } else {
             $menu = view('componentes/menu'); // Crear la vista del menú
             return redirect()->route('Anuncios.tablaReglas',compact('menu'))->with('message', '¡Error al eliminar');
         }
    }




}
