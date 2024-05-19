<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MensajesController extends Controller
{
    // Métodos del controlador
    public function enviarCorreo(Request $request)
    {
        // dd($request->all());
        $idReserva = $request->input('idReserva');
        
        $checkboxValue = $request->input('checkboxValues');
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('mensajes.correo', compact('menu', 'idReserva',"checkboxValue"));
    }
}