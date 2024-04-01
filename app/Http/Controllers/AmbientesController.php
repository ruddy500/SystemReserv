<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use Illuminate\Http\Request;

class AmbientesController extends Controller
{
    public function index()
    {
        //pagina de inicio

        /*Ambientes::with('horarios'): Imagina que tienes una caja llena de ‘Ambientes’. 
        Cada ‘Ambiente’ tiene un listado de ‘horarios’ asociados. Con esta parte del código
        , estás diciendo: “Quiero todos los ‘Ambientes’, 
        y también quiero que cada ‘Ambiente’ traiga su listado de ‘horarios’”.*/
        
        //$ambientes= Ambientes::with('horarios')->get();
        
       // return view("welcome",compact('ambientes'));

    }

    public function create()
    {
        //el formulario donde
        //nosotros agregamos datos
    }

    public function store(Request $request)
    {
        //sirve para guardar datos en la BD
    }

    public function show(Ambientes $ambientes)
    {
        //sirve para obtener un registro de nuestra tabla
    }

    public function edit(Ambientes $ambientes)
    {
        //sirve para traer los datos que se van editar 
        //y los coloca en un formuario
    }

    public function update(Request $request, Ambientes $ambientes)
    {
        //sirve para actualizar los datos en la BD
    }

    public function destroy(Ambientes $ambientes)
    {
        //sirve para eliminar un registro
    }
}
