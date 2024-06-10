<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function mostrar(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('calendario.inicio', compact('menu'));
    }
    public function mostrarDocente(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('calendario.principalDocente', compact('menu'));
    }
    public function inicio(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('calendario.inicio', compact('menu'));
    }
    public function evento(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('calendario.evento', compact('menu'));
    }
    public function configuracion(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('calendario.configuracion', compact('menu'));
    }
}