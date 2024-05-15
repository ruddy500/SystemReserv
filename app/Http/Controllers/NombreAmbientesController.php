<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use App\Models\Dias;
use App\Models\NombreAmbientes;
use App\Models\Periodos;
use App\Models\TipoAmbientes;
use Illuminate\Http\Request;

class NombreAmbientesController extends Controller
{

    public function mostrar()
    {
        // seccion para eliminar duplicados de masivo
        // Paso 1: Obtener los registros únicos por nombre_id
        $uniqueIds = Ambientes::selectRaw('MIN(id) as id')
        ->groupBy('nombre_ambientes_id')
        ->pluck('id')
        ->toArray();
        // dd($uniqueIds);

        // Paso 2 : eliminar todos los registros duplicados
        Ambientes::whereNotIn('id', $uniqueIds)->delete();




        $ambientes = Ambientes::all();
        //dd($ambientes);
        //Obtener el tamaño de la colección de ambientes
        $tamAmbientes = $ambientes->count();
        $nombreambientes = NombreAmbientes::all();
        $tipoambientes = TipoAmbientes::all();

        $menu = view('componentes/menu'); // Crear la vista del menú

        return view('ambientes.index', compact('nombreambientes', 'ambientes', 'tamAmbientes', 'tipoambientes', 'menu'));
    }
}
