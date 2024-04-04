<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use App\Models\NombreAmbientes;
use Illuminate\Http\Request;

class NombreAmbientesController extends Controller
{
 
    public function mostrar()
    {  
        $ambientes= Ambientes::all();
        //dd($ambientes);
         //Obtener el tamaño de la colección de ambientes
        $tamAmbientes = $ambientes->count();
        $nombreambientes = NombreAmbientes::all();

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('ambientes.index', compact('nombreambientes','tamAmbientes','ambientes', 'menu'));
    }
}
