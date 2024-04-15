<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/inicio';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function logear(Request $request){
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //dd(Auth::attempt($credentials));

        if (Auth::attempt($credentials)) {
            // La autenticación ha sido exitosa
            $user = Auth::user();
            // Haz lo que necesites después de autenticar al usuario, por ejemplo, redirigirlo a una página de inicio
            return view('/inicio');
        }
    
        // La autenticación ha fallado
        // Redirigir de vuelta con un mensaje de error
        //return redirect()->back()->with('error', 'Credenciales incorrectas. Por favor, intenta nuevamente.');
    
        

    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
