<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RaizController extends Controller
{
    public function mostrar(){    
        
        return view('auth/login');  
      //return view('componentes/menu');
    }
}
