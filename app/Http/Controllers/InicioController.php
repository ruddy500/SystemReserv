<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncios;
use App\Models\Reglas;
class InicioController extends Controller
{
    public function mostrar(){
        $anuncios = Anuncios::all();
        $tam = $anuncios->count();

        $reglas = Reglas::all();
        $t = $reglas->count();

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('inicio',compact('menu','anuncios','tam','reglas','t'));
    }
}
