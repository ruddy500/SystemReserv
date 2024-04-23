<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;

class SessionsController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store() {
        
        if(auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'Credenciales Incorrectas, por favor intenta de nuevo',
            ]);

        } else {

            if(auth()->user()->role == 'admin') {
                return redirect()->route('inicio');
            } else {
                return redirect()->route('inicio');
            
            }
        }
    }

    //para cerrar sesion
    public function destroy() {
        auth()->logout();
    
        return redirect()->to('/')->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
        ]);
    }
}
