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

    public function guardar(Request $request){

        $data = $request->all();
        // Eliminar el elemento "_token"
        unset($data['_token']);
    //    dd($data);

        foreach($data as $key => $value){
            //   dd($key,$value);
            $carbon = Carbon::now('America/La_Paz');
            $fecha = $carbon->format('d-m-Y');
            $hora = $carbon->format('H:i:s');
            //creamos la fila 
            $anuncio = new Reglas();
            $anuncio->Regla=$value;
            $anuncio->Fecha=$fecha;
            $anuncio->Hora=$hora;
            $anuncio->save();
        }

        $menu = view('componentes/menu'); // Crear la vista del menú
        return redirect()->route('Anuncios.tablaReglas',compact('menu'))->with('success', 'Reglas registrado exitosamente.');
    }

}
