<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function mostrar(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('inicio',['menu' => $menu]);
    }
}
