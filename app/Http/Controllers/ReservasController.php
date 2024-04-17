<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservasController extends Controller
{
 
    public function mostrar()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.asignadas', compact('menu'));
    }

    public function asignadas()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.asignadas', compact('menu'));
    }
    public function pendientes()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.pendientes', compact('menu'));
    }
    public function registrar()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.registrar', compact('menu'));
    }
    public function materias()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.materiasDocente', compact('menu'));
    }
    public function formFinal()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.formFinal', compact('menu'));
    }
}