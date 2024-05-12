<?php

namespace App\Http\Controllers;

use App\Models\TipoAmbientes;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use App\Models\Materias;
use App\Models\Motivos;
use App\Models\Reservas;
use App\Models\Periodos;

use App\Models\DocentesMaterias;
use App\Models\Fechas;
use App\Models\Horarios;
use App\Models\MateriasSeleccionado;
use App\Models\PeriodosSeleccionado;
use Illuminate\Validation\ValidationException;




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
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.individual.registrar', compact('menu'));
    }
    public function registrarGrupal()
    {
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.grupal.registrar', compact('menu'));
    }
    public function formFinalIndividual()
    {
        $periodos = Periodos::all();
        $motivos = Motivos::all();
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.individual.formFinal', compact('menu', 'periodos', 'motivos'));
    }
    public function formFinalGrupal()
    {
        // $periodosGrupal = Periodos::all();
       
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.grupal.formFinal', compact('menu'));
    }
    public function verIndividual($idReserva)
    {   //mi metodo 
        $reservas = Reservas::all(); 
        $materias = Materias::all();
        $seleccionadas= MateriasSeleccionado ::all();
        $periodos=  PeriodosSeleccionado ::all(); 
        $motivo = Motivos ::all();
        $fecha = Fechas ::all();
        $periodo=  Periodos ::all();
        $tam = $seleccionadas->count();
        $tamP= $periodos->count();
        $reserva = Reservas::find($idReserva);
        $motivoReserva = $reserva->motivo->Nombre;
        $idDocente = $reserva->docentes_id;
        $nombre = Usuarios::find($idDocente);
        $docente =$nombre->name;
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.individual.ver', compact('menu','materias','seleccionadas','periodos','tam','periodo','tamP','idReserva','motivoReserva','docente','reserva'));
    }
    public function verGrupal($idReserva)
    {
        // dd($idReserva);
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.grupal.ver', compact('menu','idReserva'));
    }
    public function editar($idReserva)
    {
        $periodos = Periodos::all();
        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.editar', compact('menu','periodos','idReserva'));
    }

    public function consultarMaterias(Request $request)
    {   
        $idDocente = $request->idUsuario;
        $tipoFormulario = $request->tipoFormulario;
        $materiaSelec = $request->materia; //nombre de materia
      //recolecta las materias seleccionada
        //dd($materias);
        if($tipoFormulario == "individual"){
        // dd($materias,"individual");
           $docenteMateriasFiltrado = DocentesMaterias::where('docentes_id',$idDocente)->get();
           $materias = [];
           
           foreach ($docenteMateriasFiltrado as $docenteMateria) {
            
                $idMateria = $docenteMateria->materias_id;
                $materia = Materias::where('id',$idMateria)->first();
                $nombreMateria = $materia->Nombre;

                if($nombreMateria == $materiaSelec){
                    $materias[] = $materia;
                }
                
            } 
            
            return redirect()->route('reservas.registrarIndividual')->with('materias', $materias)->withInput();
        }else{
            //tipo de formulario grupal 
            //return view('reservas.grupal.registrar', compact('menu','materias'));
            $materias = Materias::where('Nombre', $materiaSelec)->get(); 
            return redirect()->route('reservas.registrarGrupal')->with('materias', $materias)->withInput();
        }

        
    }

    public function enviarMaterias(Request $request)
    {
        $tipoFormulario = $request->tipoFormulario;
       
        $motivos = Motivos::all();
        $menu = view('componentes/menu'); // Crear la vista del menú

        // dd($materias);
        if($tipoFormulario == "individual"){
            // dd("entra a individual");
            $lista = array_map('intval', $request->options);
            $periodos = Periodos::all();
          
            return view('reservas.individual.formFinal', compact('menu', 'periodos', 'lista', 'motivos'));
        }else{
            // dd("entra a grupal");
            $periodosGrupal = Periodos::all();
            $materias = array_map('intval', $request->options); //covierte el arreglo en enteros.
            return view('reservas.grupal.formFinal', compact('menu', 'materias', 'periodosGrupal', 'motivos'));
  
        }
      }

    public function guardarIndividual(Request $request)
    {
        // obtenemos el id del tipoAmbiente
        $inttipoAmbiente = $request->input('tipoAmbiente');
        // dd($tipoAmbiente);
        // buscamos el tipo Ambiente por su id
        $tipoambiente = TipoAmbientes::find($inttipoAmbiente);
        // dd($tipoambiente);

        $options = $request->input('options');
        $fecha = $request->input('fecha');

        $materias = json_decode($request->input('lista'), true);

        



        // llenamos los periodos en el horario
        for ($i = 0; $i < count($options); $i++) {
            $id = $options[$i];
            $periodoSeleccionado = new PeriodosSeleccionado();

            $periodoSeleccionado->periodos_id = $id;
            // Guardar en la base de datos
            $periodoSeleccionado->save();
        }

        $cantidadIngresada = $request->cantidad;
        $motivoSeleccionado = $request->motivo;
        // dd($motivoSeleccionado);

        // vamos a buscar en  el Motivo lo que se ingreso
        $motivo = Motivos::find($motivoSeleccionado);
        // dd($motivo);
        // aqui traemos el id del Motivo
        $id_Motivo = $motivo->id;

        // aqui vamos a interactuar con la base de datos
        $reserva = new Reservas();
        $reserva->CantEstudiante = $cantidadIngresada;
        $reserva->motivos_id = $id_Motivo;
        $reserva->docentes_id = $request->usuario;
        $reserva->Estado = "pendiente";
        $reserva->Tipo = "individual";
        $reserva->fecha = $fecha;
        $reserva->TipoAmbiente = $tipoambiente->Nombre;
        $reserva->save();

        $totalEstudiantes = 0;
        // aqui se va añadir materias seleccionado a la base de datos
        for ($i = 0; $i < count($materias); $i++) {
            $valor = $materias[$i];

            $materiaSeleccionada = new MateriasSeleccionado();
            $materiaSeleccionada->materias_id = $valor;
            $materiaSeleccionada->reservas_id = $reserva->id;
            $materia = Materias::where('id', $valor)->first();
            $totalEstudiantes = $totalEstudiantes + $materia->Inscritos;

            //Guardar en la base de datos
            $materiaSeleccionada->save();
        }

        // ahora traemos el ultimo registro de la reserva
        $ultimoRegistro = Reservas::orderBy('id', 'desc')->first();
        $ultimoRegistro->TotalEstudiantes = $totalEstudiantes;
        $ultimoRegistro->save();


        // llenaremos los campos en Periodos seleccionados
        $ultimoRegistro = Reservas::orderBy('id', 'desc')->first();
        $ultimoId = $ultimoRegistro->id;
        // Actualiza las filas donde reservas_id es NULL con el ID de la reserva deseada
        PeriodosSeleccionado::whereNull('reservas_id')->update(['reservas_id' => $ultimoId]);

        // redirigimos a la ruta 
        return redirect()->route('reservas.principal');
    }


    public function guardarGrupal(Request $request)
    {

        // obtenemos el id del tipoAmbiente
        $inttipoAmbiente = $request->input('tipoAmbiente');
        // dd($tipoAmbiente);
        // buscamos el tipo Ambiente por su id
        $tipoambiente = TipoAmbientes::find($inttipoAmbiente);
        // dd($tipoambiente);


        $options = $request->input('options');
        $fecha = $request->input('fecha');

       



        // llenamos los periodos en el horario
        for ($i = 0; $i < count($options); $i++) {
            $id = $options[$i];
            $periodoSeleccionado = new PeriodosSeleccionado();

            $periodoSeleccionado->periodos_id = $id;
            // Guardar en la base de datos
            $periodoSeleccionado->save();
        }

        $materias = json_decode($request->input('materias'), true);

        $cantidadIngresada = $request->cantidad;
        $motivoSeleccionado = $request->motivo;
        // dd($motivoSeleccionado);

        // vamos a buscar en  el Motivo lo que se ingreso
        $motivo = Motivos::find($motivoSeleccionado);
        // dd($motivo);
        // aqui traemos el id del Motivo
        $id_Motivo = $motivo->id;
        //dd($id_Motivo);




        // aqui vamos a interactuar con la base de datos
        $reserva = new Reservas();
        $reserva->CantEstudiante = $cantidadIngresada;
        $reserva->motivos_id = $id_Motivo;
        $reserva->docentes_id = $request->usuario;
        $reserva->Estado = "pendiente";
        $reserva->Tipo = "grupal";
        $reserva->fecha = $fecha;
        $reserva->TipoAmbiente = $tipoambiente->Nombre;
        $reserva->save();

        $totalEstudiantes = 0;
        // aqui se va añadir materias seleccionado a la base de datos
        for ($i = 0; $i < count($materias); $i++) {
            $valor = $materias[$i];

            $materiaSeleccionada = new MateriasSeleccionado();
            $materiaSeleccionada->materias_id = $valor;
            $materiaSeleccionada->reservas_id = $reserva->id;
            $materia = Materias::where('id', $valor)->first();
            $totalEstudiantes = $totalEstudiantes + $materia->Inscritos;

            //Guardar en la base de datos
            $materiaSeleccionada->save();
        }

        // ahora traemos el ultimo registro de la reserva
        $ultimoRegistro = Reservas::orderBy('id', 'desc')->first();
        $ultimoRegistro->TotalEstudiantes = $totalEstudiantes;
        $ultimoRegistro->save();

        // llenaremos los campos en Periodos seleccionados
        $ultimoRegistro = Reservas::orderBy('id', 'desc')->first();
        $ultimoId = $ultimoRegistro->id;
        // Actualiza las filas donde reservas_id es NULL con el ID de la reserva deseada
        PeriodosSeleccionado::whereNull('reservas_id')->update(['reservas_id' => $ultimoId]);


        // redirigimos a la ruta 
        return redirect()->route('reservas.principal');
    }
    
    public function actualizarReserva(Request $request, $idReserva){
        //dd($idReserva);
        try{

            $reservaEditado = Reservas::find($idReserva);
       
            $reservaEditado->fecha = $request->fecha;
            //dd($reservaEditado);
          //  $reservaEditado->Ubicacion = $request->descripcion;
            $reservaEditado->save();

               // Utiliza el método `where` para encontrar los registros con la clave foránea deseada
        $periodoReserva = PeriodosSeleccionado::where('reservas_id', $idReserva)->get();

        // Utiliza el método `delete` en cada registro encontrado
        foreach ($periodoReserva as $registro) {
            $registro->delete();
        }
            $options = $request->input('options');

        // llenamos los periodos en el horario
        for ($i = 0; $i < count($options); $i++) {
            $id = $options[$i];
            $periodoSeleccionado = new PeriodosSeleccionado();

            $periodoSeleccionado->reservas_id = $idReserva;
            $periodoSeleccionado->periodos_id = $id;
            // Guardar en la base de datos
            $periodoSeleccionado->save();
        }

       
            return redirect('reservas')->with('success', 'Reserva Actualizado exitosamente.');
       
        } catch (ValidationException $e) {
            // Manejar errores de validación
            return redirect('reservas')->withErrors($e->validator->errors());
        } catch (\Exception $e) {
            // Manejar otros tipos de excepciones, como la excepción de tipo \Exception
            return redirect('reservas')->with('error', 'Ha ocurrido un error interno');
        }
        }




    public function eliminarPendiente($idReserva) {
        // dd($idReserva);
        $reserva = Reservas::find($idReserva);// Busca la reserva por su ID
        //dd($idReserva);
        if ($reserva) {  // Verifica si se encontró la reserva
            
            $reserva->delete(); // Elimina la reserva

            return redirect()->route('reservas.pendientesDocente')->with('success', 'Solicitud de reserva eliminada exitosamente');

        } else {

            return redirect()->route('reservas.pendientesDocente')->with('error' , 'Solicitud de reserva No eliminada');
        }
    }
}
