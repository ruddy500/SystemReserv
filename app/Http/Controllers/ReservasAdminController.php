<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservasAdminController extends Controller
{
 
    public function mostrar()
    {  

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.admin.asignadas', compact('menu'));
    }

    public function asignadas()
    {
        // Lógica para mostrar las reservas asignadas
        $menu = view('componentes/menu');
        return view('reservas.admin.asignadas', compact('menu'));
    }

    public function pendientes()
    {
        // Lógica para mostrar las reservas pendientes
        $menu = view('componentes/menu');
        return view('reservas.admin.pendientes', compact('menu'));
    }
    
}