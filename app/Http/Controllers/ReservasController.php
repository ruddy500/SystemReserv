<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materias;

class ReservasController extends Controller
{
 
    public function mostrar()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.asignadas', compact('menu'));
    }

    public function asignadas()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.asignadas', compact('menu'));
    }
    public function pendientes()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.pendientes', compact('menu'));
    }
    public function registrar()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.individual.registrar', compact('menu'));
    }
    public function registrarGrupal()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.grupal.registrar', compact('menu'));
    }
    public function formFinalIndividual()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.individual.formFinal', compact('menu'));
    }
    public function formFinalGrupal()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.grupal.formFinal', compact('menu'));
    }
    public function verIndividual()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.individual.ver', compact('menu'));
    }
    public function verGrupal()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.grupal.ver', compact('menu'));
    }
    public function editar()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.editar', compact('menu'));
    }

    public function consultarMaterias(Request $request ){
        
        $menu = view('componentes/menu'); // Crear la vista del menú
        $materiaSelec = $request->materia;//nombre de materia
        $materias = Materias::where('Nombre',$materiaSelec)->get();//recolecta las materias seleccionada
        //dd($materias);

        //return view('reservas.grupal.registrar', compact('menu','materias'));
        return redirect()->route('reservas.registrarGrupal')->with('materias', $materias)->withInput();
    }

    public function enviarMaterias(Request $request){

        $menu = view('componentes/menu'); // Crear la vista del menú
        $materias = array_map('intval', $request->options);//covierte el arreglo en enteros.
        // dd($materias);
        return view('reservas.grupal.formFinal',compact('menu','materias'));
    }
}
