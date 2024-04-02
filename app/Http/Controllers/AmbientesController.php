<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use Illuminate\Http\Request;

class AmbientesController extends Controller
{
    public function mostrar()
    {  
        $ambientes = Ambientes::all();
        $idAmbienteSeleccionado = $ambientes->isEmpty() ? null : $ambientes->first()->id;
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('ambientes.index', compact('ambientes', 'menu','idAmbienteSeleccionado'));
    }

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

}