<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use App\Models\NombreAmbientes;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AmbientesController extends Controller
{

         /*Ambientes::with('horarios'): Imagina que tienes una caja llena de ‘Ambientes’. 
        Cada ‘Ambiente’ tiene un listado de ‘horarios’ asociados. Con esta parte del código
        , estás diciendo: “Quiero todos los ‘Ambientes’, 
        y también quiero que cada ‘Ambiente’ traiga su listado de ‘horarios’”.*/
        
        //$ambientes= Ambientes::with('horarios')->get();
        //$ambientes= Ambientes::has('horarios')->get(); te devuelven los ambientes que si tienen al menos una relacion con horarios
    
    public function guardar(Request $request)
    { 
        //dd($request->all());
        
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
    
                return redirect()->back()->with('success', 'Ambiente registrado exitosamente.');
                 
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

    public function verAmbiente()
    {  
        $ambientes= Ambientes::all();
        //dd($ambientes);
         //Obtener el tamaño de la colección de ambientes
        $tamAmbientes = $ambientes->count();
        $nombreambientes = NombreAmbientes::all();

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('ambientes.ver', compact('nombreambientes','ambientes', 'menu'));
    }
    
    public function editarAmbiente()
    {  
        $ambientes= Ambientes::all();
        //dd($ambientes);
         //Obtener el tamaño de la colección de ambientes
        $tamAmbientes = $ambientes->count();
        $nombreambientes = NombreAmbientes::all();

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('ambientes.editar', compact('nombreambientes','ambientes', 'menu'));
    }
     
 /*   public function editarAmbiente(Request $request, $id)
    {
    // Buscar el ambiente que se desea editar
    $ambiente = Ambientes::findOrFail($id);

     //Validar los datos del formulario
    $request->validate([
        'capacidad' => 'required|numeric|min:30|max:200',
        'descripcion' => 'required|string|min:10|max:50',
    ]);

    // Actualizar los datos del ambiente
    $ambiente->Capacidad = $request->capacidad;
    $ambiente->Ubicacion = $request->descripcion;
    $ambiente->save();

    // Redirigir a una ruta o devolver una respuesta JSON
    return redirect()->route('inicio')->with('success', 'Ambiente editado exitosamente');
}
*/





}