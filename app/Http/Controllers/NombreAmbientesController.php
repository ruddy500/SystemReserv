<?php

namespace App\Http\Controllers;

use App\Models\NombreAmbientes;
use Illuminate\Http\Request;

class NombreAmbientesController extends Controller
{
 
    public function mostrar()
    {  
        $nombreambientes = NombreAmbientes::all();

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('ambientes.index', compact('nombreambientes', 'menu'));
    }
}
