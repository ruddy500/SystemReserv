<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AnunciosController extends Controller
{
    public function mostrar(){
      //  $periodos = Periodos::all();
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('anuncios.index', compact('menu'));
    }
}