<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materias; 

use App\Models\DocentesMaterias;

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
        return view('reservas.formulario.registrar', compact('menu'));
    }
    public function materias()
    {   $materias_docentes= DocentesMaterias::all(); //guarda la tabla materias docentes
        $materias= Materias::all(); //guarda la tabla materias

        $tamMaterias = $materias->count();  //tamanio de materias docentes
        $tam = $materias_docentes->count(); //tamanio de la tabla docentes_materias

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.materiasDocente', compact('materias_docentes','tam','materias','tamMaterias','menu'));
    }
    public function formFinal()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.formulario.formFinal', compact('menu'));
    }
    //FUNCION MOSTRAR VENTANA VER
    public function verReserva()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.ver', compact('menu'));
    }
}