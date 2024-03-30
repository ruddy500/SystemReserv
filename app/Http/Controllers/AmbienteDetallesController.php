<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmbienteDetallesController extends Controller
{
    public function verDetalles()
    {
        // $nombre = $request->query('nombre');
        // $capacidad = $request->query('capacidad');
        // $ubicacion = $request->query('ubicacion');

        return view('ambiente.verdetalles');
    }
}
