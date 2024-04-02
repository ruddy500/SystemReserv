<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use Illuminate\Http\Request;

class AmbientesController extends Controller
{
    public function mostrar()
    {  
        $ambientes = Ambientes::all();
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('ambientes.index', compact('ambientes', 'menu'));
    }
}