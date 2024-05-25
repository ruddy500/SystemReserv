<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    public function mostrarLista(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.lista',compact('menu'));
    }
}