<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materias;
use App\Models\Motivos;
use App\Models\Reservas;
use App\Models\Periodos;

use App\Models\DocentesMaterias;
use App\Models\MateriasSeleccionado;




class ReservasController extends Controller
{
 
    public function mostrar()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.asignadas', compact('menu'));
    }

    public function asignadas()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.asignadas', compact('menu'));
    }
    public function pendientes()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.pendientes', compact('menu'));
    }
    public function registrar()
    {  
        //parte de rudy
        $materias_docentes= DocentesMaterias::all(); //guarda la tabla materias docentes
        $materias= Materias::all(); //guarda la tabla materias
        $tam = $materias_docentes->count(); //tamanio de la tabla docentes_materias

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.individual.registrar', compact('menu','materias','materias_docentes','tam'));
    }
    public function registrarGrupal()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.grupal.registrar', compact('menu'));
    }
    public function formFinalIndividual()
    {  
        $periodos = Periodos::all();
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.individual.formFinal', compact('menu', 'periodos'));
    }
    public function formFinalGrupal()
    {  
        // $periodosGrupal = Periodos::all();
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.grupal.formFinal', compact('menu'));
    }
    public function verIndividual()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.individual.ver', compact('menu'));
    }
    public function verGrupal()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.grupal.ver', compact('menu'));
    }
    public function editar()
    {  
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.editar', compact('menu'));
    }

    public function consultarMaterias(Request $request ){
        
        $menu = view('componentes/menu'); // Crear la vista del menú
        $materiaSelec = $request->materia;//nombre de materia
        $materias = Materias::where('Nombre',$materiaSelec)->get();//recolecta las materias seleccionada
        //dd($materias);

        //return view('reservas.grupal.registrar', compact('menu','materias'));
        return redirect()->route('reservas.registrarGrupal')->with('materias', $materias)->withInput();
    }

    public function enviarMaterias(Request $request){
        $periodosGrupal = Periodos::all();
        $menu = view('componentes/menu'); // Crear la vista del menú
        $materias = array_map('intval', $request->options);//covierte el arreglo en enteros.
        // dd($materias);
        return view('reservas.grupal.formFinal',compact('menu','materias', 'periodosGrupal'));
    }
    
    public function guardarIndividual(Request $request){
        // dd($request->materias);
        $cantidadIngresada = $request->cantidad;
        $motivoSeleccionado = $request->input('motivo');
        // dd($motivoSeleccionado);

        // vamos a buscar en  el Motivo lo que se ingreso
        $motivo = Motivos::where('Nombre',$motivoSeleccionado)->first();
        // aqui traemos el id del Motivo
        $id_Motivo = $motivo->id;
        // dd($id_Motivo);



        // aqui vamos a interactuar con la base de datos
        $reserva = new Reservas();
        $reserva->CantEstudiante = $cantidadIngresada;
        $reserva->motivos_id = $id_Motivo;
        $reserva->docentes_id=$request->usuario;
        $reserva->Estado = "pendiente";
        $reserva->Tipo = "individual";
        $reserva->save();
        
        // redirigimos a la ruta 
        return redirect()->route('reservas.principal');
    }


    public function guardarGrupal(Request $request){
        $materias = json_decode($request->input('materias'), true);

        // dd($materias);
        $cantidadIngresada = $request->cantidad;
        $motivoSeleccionado = $request->input('motivo');
        // dd($motivoSeleccionado);

        // vamos a buscar en  el Motivo lo que se ingreso
        $motivo = Motivos::where('Nombre',$motivoSeleccionado)->first();
        // aqui traemos el id del Motivo
        $id_Motivo = $motivo->id;
        // dd($id_Motivo);



        // aqui vamos a interactuar con la base de datos
        $reserva = new Reservas();
        $reserva->CantEstudiante = $cantidadIngresada;
        $reserva->motivos_id = $id_Motivo;
        $reserva->docentes_id=$request->usuario;
        $reserva->Estado = "pendiente";
        $reserva->Tipo = "grupal";
        $reserva->save();
        
        $totalEstudiantes=0;
        // aqui se va añadir materias seleccionado a la base de datos
        for ($i=0; $i < count($materias) ; $i++) { 
                $valor = $materias[$i];

                $materiaSeleccionada = new MateriasSeleccionado();
                $materiaSeleccionada->materias_id=$valor;
                $materiaSeleccionada->reservas_id=$reserva->id;
                $materia = Materias::where('id', $valor)->first();
                $totalEstudiantes = $totalEstudiantes+$materia->Inscritos;
                
                //Guardar en la base de datos
                $materiaSeleccionada->save();
        }

        // ahora traemos el ultimo registro de la reserva
        $ultimoRegistro = Reservas::orderBy('id', 'desc')->first();
        $ultimoRegistro->TotalEstudiantes = $totalEstudiantes;
        $ultimoRegistro->save();

        

        // redirigimos a la ruta 
        return redirect()->route('reservas.principal');
    }
}
