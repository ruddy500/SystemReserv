<?php

namespace App\Http\Controllers;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class AvisosController extends Controller
{
    public function mostrar(){
        $correos = Usuarios::all();
        $emisor = "Administrador";
      //  $periodos = Periodos::all();
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('avisos.aviso', compact('menu','correos','emisor'));
    }
}