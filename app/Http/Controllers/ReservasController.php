<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materias;

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
        return view('reservas.individual.registrar', compact('menu'));
    }
    public function registrarGrupal()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.grupal.registrar', compact('menu'));
    }
    public function formFinalIndividual()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.individual.formFinal', compact('menu'));
    }
    public function formFinalGrupal()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.grupal.formFinal', compact('menu'));
    }

}
