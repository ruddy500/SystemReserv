<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MensajesController extends Controller
{
    // Métodos del controlador
    public function enviarCorreo(Request $request)
    {
        //aqui se esta recuperando el idReserva , los ambientes seleccionados 
        //y un diferenciador que sera de tipo string con los valores de asignar , sugerir y rechazar
        //aqui se haran las modificaciones con un if then else
        //tambien se tendra que enviar a la vista un tipo de identificador para hacer 
        //los diferentes tipos de mensaje
        
        // dd($request->all());
        $idReserva = $request->input('idReserva');
        
        $checkboxValue = $request->input('checkboxValues');

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('mensajes.correo', compact('menu', 'idReserva','checkboxValue'));
    }
}