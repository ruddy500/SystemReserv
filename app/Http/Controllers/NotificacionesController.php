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
    public function mostrarSugerencia($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.sugerencia',compact('menu','reservaId','notificacionId'));
    }
    public function mostrarAsignacion($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.asignacion',compact('menu','reservaId','notificacionId'));
    }
    public function mostrarRechazo($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.rechazo',compact('menu','reservaId','notificacionId'));
    }
    public function mostrarDifusion($notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('notificaciones.difusion',compact('menu','notificacionId'));
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