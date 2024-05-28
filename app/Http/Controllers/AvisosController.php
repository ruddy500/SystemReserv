<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvisosController extends Controller
{
    public function mostrar(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('avisos.aviso', compact('menu'));
    }
}