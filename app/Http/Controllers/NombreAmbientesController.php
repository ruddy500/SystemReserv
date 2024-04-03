<?php

namespace App\Http\Controllers;

use App\Models\NombreAmbientes;
use App\Models\Ambientes;
use Illuminate\Http\Request;

class NombreAmbientesController extends Controller
{
 
    // public function mostrar()
    // {  
    //     $nombreambientes = NombreAmbientes::all();

    //     $menu = view('componentes/menu'); // Crear la vista del menú
    //     return view('ambientes.index', compact('nombreambientes', 'menu'));
    // }

    public function mostrar()
    {  
        $nombreambientes = NombreAmbientes::all();
        $ambientes = Ambientes::all();

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('ambientes.index', compact('nombreambientes','ambientes', 'menu'));
    }
    public function mostrarHorario()
    {  
        $nombreambientes = NombreAmbientes::all();

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('ambientes.horario', compact('nombreambientes', 'menu'));
    }
    public function verAmbiente()
    {  
        $nombreambientes = NombreAmbientes::all();
        
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('ambientes.ver', compact('nombreambientes', 'menu'));
    }
    public function editarAmbiente()
    {  
        $nombreambientes = NombreAmbientes::all();
        
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('ambientes.editar', compact('nombreambientes', 'menu'));
    }
}
