<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use Illuminate\Http\Request;

class AmbientesController extends Controller
{
    
    public function editarAmbiente(Request $request, $id)
    {
    // Buscar el ambiente que se desea editar
    $ambiente = Ambientes::findOrFail($id);

    // Validar los datos del formulario
    $request->validate([
        'capacidad' => 'required|numeric|min:30|max:200',
        'descripcion' => 'required|string|min:10|max:50',
    ]);

    // Actualizar los datos del ambiente
    $ambiente->Capacidad = $request->capacidad;
    $ambiente->Ubicacion = $request->descripcion;
    $ambiente->save();

    // Redirigir a una ruta o devolver una respuesta JSON
    return redirect()->route('inicio')->with('success', 'Ambiente editado exitosamente');
}

    public function guardar(Request $request)
    {
        $ambiente = new Ambientes;

        $ambiente->nombre_ambientes_id = $request->ambiente;
        $ambiente->Capacidad = $request->capacidad;
        $ambiente->Ubicacion = $request->descripcion;

        $ambiente->save();

        return redirect('/ruta-a-la-que-quieres-redirigir');
    }






}