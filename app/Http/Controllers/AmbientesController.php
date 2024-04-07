<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use App\Models\Dias;
use App\Models\Periodos;
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
        //me da el id del  ambiente seleccionado
        $ambienteID = $request->ambiente;
        //busca el nombre del ambiente por medio de ese id 
        $nombreAmbiente = NombreAmbientes::find($ambienteID); 

        try {        
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

    public function añadirHorario(Request $request)
    {
          // Validar los datos del formulario
    $request->validate([
        'dia' => 'required|exists:dias,id',
        'horario' => 'required|array',
        'horario.*' => 'exists:periodos,id',
        'ambiente' => 'required|exists:ambientes,id',
    ]);

    // Obtener los datos del formulario
    $diaId = $request->dia;
    $periodos = $request->horario;
    $ambienteId = $request->ambiente;

    // Obtener el día y asociar los períodos al día
    $dia = Dias::find($diaId);
    $dia->periodos()->sync($periodos);

    // Obtener el ambiente específico y asociar los períodos al ambiente
    $ambienteEspecifico = Ambientes::find($ambienteId);
    foreach ($periodos as $periodoId) {
        $ambienteEspecifico->horarios()->attach($periodoId);
    }

    return redirect()->back()->with('success', 'Horario guardado exitosamente.');
    }

    // public function añadirHorario(Request $request){
        
    //     $diaId = $request->dia; // ID del día
    //     $dia = Dias::find($diaId);// Obtén el modelo Dia
    //     //dd($request->ambiente); obtiene el id del ambiente que se quiere añadir horario
        
    //     if (!$dia->Usado) {
    //     $dia->Usado = true;
    //     $dia->save();
    //     // Adjunta los periodos al día
    //     $periodoIds = $request->periodo; // IDs de los periodos seleccionados
    //     $dia->periodos()->attach($periodoIds);
    
    //     // Obtén el ID del ambiente desde la solicitud
    //     $ambienteId = $request->ambiente;
    
    //     // Obtén el modelo Ambiente
    //     $ambiente = Ambientes::find($ambienteId);
    //     $horarioIds = $request->horario;
    //     // Adjunta los períodos al ambiente en la tabla pivote
    //     $ambiente->horarios()->attach($horarioIds); //hice un cambio de diaId
    //     //dd($request->periodos);
    //     return redirect()->back();
    
    //     }else{
    //         return redirect()->back();
    //     }
        

    // }

    public function verAmbiente($nombre)
    {  
        // $ambientes= Ambientes::all();
        // //dd($ambientes);
        //  //Obtener el tamaño de la colección de ambientes
        // $tamAmbientes = $ambientes->count();
        // $nombreambientes = NombreAmbientes::all();

        // $menu = view('componentes/menu'); // Crear la vista del menú
        // return view('ambientes.ver', compact('nombreambientes','ambientes', 'menu'));
        try {
            
            $nombre = Ambientes::find($nombre); 
            // $nombre = $nombre;
            $menu = view('componentes/menu'); // Crear la vista del menú
            return view('ambientes.ver', compact('nombre', 'menu'));
        } catch (\Exception $e) {
            // Manejar la excepción
            return redirect()->back()->with('error', 'Ha ocurrido un error al mostrar el ambiente.');
        }
    }
    
    public function editarAmbiente($idAmbiente)
    {  
        try {
            
            $idAmbiente = Ambientes::find($idAmbiente);
            $menu = view('componentes/menu'); // Crear la vista del menú
            return view('ambientes.editar', compact('idAmbiente', 'menu'));
            } 
        catch (\Exception $e) 
            {
                // Manejar la excepción
                return redirect()->back()->with('error', 'Ha ocurrido un error al editar ambiente el ambiente.');
            }
    }

//     public function actualizarAmbiente(Request $request, $idAmbiente){
//    // dd($request->all());      
//         $ambienteEditado = Ambientes::find($idAmbiente);
//         $ambienteEditado->Capacidad = $request->capacidad;
//         $ambienteEditado->Ubicacion = $request->descripcion;
//         $ambienteEditado->save();
    
//         return redirect('ambientes')->with('success', 'Ambiente Actualizado exitosamente.');
//     }




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