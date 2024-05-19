<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MensajesController extends Controller
{
    // Métodos del controlador
    public function enviarCorreo()
    {
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('mensajes.correo', compact('menu'));
    }
}