<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.registerP');
    }

    public function store() {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
        
        //datos que nos envia el formulario
        $user = Usuarios::create(request(['name','email','password']));
        auth()->login($user);
        return redirect()->to('/');

    }
}
