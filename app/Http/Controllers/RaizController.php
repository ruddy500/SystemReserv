<?php

namespace App\Http\Controllers;

use App\Models\Notificaciones;
use Illuminate\Http\Request;

class RaizController extends Controller
{
    public function mostrar(){    
        $notificaciones = Notificaciones::all();
      //   $dato=0;
      // if(auth()->user()->name==='Administrador'){
      //   foreach ($notificaciones as $notificacion) {
      //     if($notificacion->Estado==='no leido'){
      //       $dato=$dato+1;
      //     }
      //      // Guarda el valor en la sesión
      //      // Guarda el valor actualizado en la sesión
        
      //   }
      //   session(['dato' => $dato]);
        
       
      // }
        return view('componentes/menu');
      //return view('componentes/menu');
    }
}
