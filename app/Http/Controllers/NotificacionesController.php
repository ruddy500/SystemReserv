<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    //CONTROLADORES DOCENTE
    public function mostrarLista(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.lista',compact('menu'));
    }
    public function mostrarSugerencia(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.sugerencia',compact('menu'));
    }
    public function mostrarAsignacion(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.asignacion',compact('menu'));
    }
    public function mostrarRechazo(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.rechazo',compact('menu'));
    }
    public function mostrarDifusion(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.difusion',compact('menu'));
    }

    //CONTROLADORES ADMINISTRADOR
    public function mostrarListaAdmin(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.admin.lista',compact('menu'));
    }
    public function mostrarSugerenciaAdmin(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.admin.sugerencia',compact('menu'));
    }

}