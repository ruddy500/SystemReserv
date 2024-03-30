<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmbienteDetallesController extends Controller
{
    /* public function verDetalles()
    {
        // $nombre = $request->query('nombre');
        // $capacidad = $request->query('capacidad');
        // $ubicacion = $request->query('ubicacion');

        return view('ambiente.verdetalles');
    } */

    public function verDetalles($ubicacion, $nombre, $capacidad)
    {
        // Almacenar los datos en variables
        $ubicacion = $ubicacion;
        $nombre = $nombre;
        $capacidad = $capacidad;

        // Mostrar los datos en la vista
        return view('ambiente.verdetalles', compact('ubicacion', 'nombre', 'capacidad'));
    }
}
