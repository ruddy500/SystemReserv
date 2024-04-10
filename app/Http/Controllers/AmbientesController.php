<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Models\Ambientes;
use App\Models\NombreAmbientes;
use App\Models\Dias;
use App\Models\Periodos;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class AmbientesController extends Controller
{

    public function cambiarEstado(Request $request, $id)
    {   
        // Encuentra el ambiente por su ID
        $ambiente = Ambientes::findOrFail($id);

        // Actualiza el estado "Habilitado" del ambiente según la solicitud
        $ambiente->Habilitado = $request->estado;
        $ambiente->save();

        // Responde con un mensaje de éxito (puedes personalizar según tu necesidad)
        return response()->json(['success' => true, 'message' => 'Estado actualizado correctamente']);
    }
    
    public function guardar(Request $request)
    {      
        //me da el id del  ambiente seleccionado
        $ambienteID = $request->ambiente;
        $nombreAmbiente = NombreAmbientes::find($ambienteID); 

        try {
            /* Genera errores de validacion
            $request->validate(['campo' => 'required',]);
            */

            /* Genera una excepción de tipo \Exception con un mensaje específico adjunto.
               Esta línea de código puede ser utilizada para simular un error interno o para indicar que ha ocurrido un problema inesperado en tu aplicación
            
               throw new \Exception("Este es un error interno generado de forma intencional.");
            */
            
            if(!$nombreAmbiente->Usado){
            
                $ambiente = new Ambientes;
                $ambiente->nombre_ambientes_id = $ambienteID;

                $ambiente->Capacidad = $request->capacidad;
                $ambiente->Ubicacion = $request->descripcion;
                $ambiente->save();                
                
                $nombreAmbiente->Usado = true;
                $nombreAmbiente->save();
    
                return redirect('ambientes')->with('success', 'Ambiente registrado exitosamente.');
                 
            }else{
                return redirect('ambientes')->with('message' , 'Existe el ambiente');
            }
                   
        } catch (ValidationException $e) {
            // Manejar errores de validación
            return redirect('ambientes')->withErrors($e->validator->errors());
        } catch (\Exception $e) {
            // Manejar otros tipos de excepciones, como la excepción de tipo \Exception
            return redirect('ambientes')->with('error', 'Ha ocurrido un error interno');
        }

    }

    public function verAmbiente($idAmbiente)
    {       $nombreRuta = Route::currentRouteName();
            $ambiente= Ambientes::find($idAmbiente); //captura un ambiente especifico
            $menu = view('componentes/menu'); // Crear la vista del menú
            
        try {
            
            if($nombreRuta== 'ambientes.horario'){
                
                $dias = Dias::all();
                $periodos = Periodos::all();
                return view('ambientes.horario', compact('ambiente','dias','periodos', 'menu'));
            }else{
                if($nombreRuta=='ambientes.ver'){
                    return view('ambientes.ver', compact('ambiente', 'menu'));
    
                }else{  
                    return view('ambientes.editar', compact('ambiente', 'menu'));}
                
            }

           } catch (\Exception $e) {
            // Manejar la excepción
            return redirect()->back()->with('error', 'Ha ocurrido un error al mostrar el ambiente.');
        }
    }


    public function actualizarAmbiente(Request $request, $idAmbiente){
        try{


           


            $ambienteEditado = Ambientes::find($idAmbiente);
       
            $ambienteEditado->Capacidad = $request->capacidad;
            $ambienteEditado->Ubicacion = $request->descripcion;
            $ambienteEditado->save();
       
            return redirect('ambientes')->with('success', 'Ambiente Actualizado exitosamente.');
       
        } catch (ValidationException $e) {
            // Manejar errores de validación
            return redirect('ambientes')->withErrors($e->validator->errors());
        } catch (\Exception $e) {
            // Manejar otros tipos de excepciones, como la excepción de tipo \Exception
            return redirect('ambientes')->with('error', 'Ha ocurrido un error interno');
        }
        }

}