<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\Correo;
use Illuminate\Http\Request;

class CorreoController extends Controller
{

    public function enviarCorreo(Request $request)
    {
        // Recibir datos del formulario
        $asunto = $request->input('asunto');
        $mensaje = $request->input('mensaje');
        $correoDestino = $request->input('enviar');

        // Detalles para el correo
        $details = [
            'title' => $asunto,
            'body' => $mensaje
        ];

        // Enviar correo
        Mail::to($correoDestino)->send(new Correo($details, $asunto));

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.admin.principal', compact('menu'));
    }
}