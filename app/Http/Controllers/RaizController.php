<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RaizController extends Controller
{
    public function mostrar(){    
        
        return view('componentes/menu');  
      //return view('componentes/menu');
    }
}
