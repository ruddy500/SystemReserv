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
use App\Models\Eventos;
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
        
        $reservaMateria = Reservas::with('materiasSeleccionado')->find($idReserva);

        if ($reservaMateria) {
            $numeros = $reservaMateria->materiasSeleccionado->pluck('materias_id')->toArray();
        }
        $materia = Materias::find($numeros[0]);





        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('reservas.individual.ver', compact('menu','materias','seleccionadas','periodos','tam','periodo','tamP','idReserva','motivoReserva','docente','reserva','materia'));
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
     
        // Procesar la reserva si no hay conflictos de fecha
        $inttipoAmbiente = $request->input('tipoAmbiente');
        $tipoambiente = TipoAmbientes::find($inttipoAmbiente);
    
        $options = $request->input('options');
        $materias = json_decode($request->input('lista'), true);
    
        // Llenar los periodos en el horario
        foreach ($options as $id) {
            $periodoSeleccionado = new PeriodosSeleccionado();
            $periodoSeleccionado->periodos_id = $id;
            $periodoSeleccionado->save();
        }
    
        $cantidadIngresada = $request->cantidad;
        $motivoSeleccionado = $request->motivo;
    
        // Obtener el motivo seleccionado
        $motivo = Motivos::find($motivoSeleccionado);
    
        $reserva = new Reservas();
        $reserva->CantEstudiante = $cantidadIngresada;
        $reserva->motivos_id = $motivo->id;
        $reserva->docentes_id = $request->usuario;
        $reserva->Estado = "pendiente";
        $reserva->Tipo = "individual";
        $reserva->fecha = $request->fecha;
        $reserva->TipoAmbiente = $tipoambiente->Nombre;
        $reserva->save();
    
        $totalEstudiantes = 0;
    
        // Añadir materias seleccionadas a la base de datos
        foreach ($materias as $valor) {
            $materiaSeleccionada = new MateriasSeleccionado();
            $materiaSeleccionada->materias_id = $valor;
            $materiaSeleccionada->reservas_id = $reserva->id;
            $materia = Materias::find($valor);
            $totalEstudiantes += $materia->Inscritos;
            $materiaSeleccionada->save();
        }
    
        // Actualizar el total de estudiantes en la reserva
        $reserva->TotalEstudiantes = $totalEstudiantes;
        $reserva->save();
    
        // Actualizar las filas donde reservas_id es NULL con el ID de la reserva deseada
        PeriodosSeleccionado::whereNull('reservas_id')->update(['reservas_id' => $reserva->id]);
    

    
        return redirect()->route('reservas.principal');
    }
    
    public function guardarGrupal(Request $request)
{

    // Creación de la reserva
    // Obtención de datos del formulario
    $inttipoAmbiente = $request->input('tipoAmbiente');
    $tipoambiente = TipoAmbientes::find($inttipoAmbiente);

    $options = $request->input('options');
    $fecha = $request->input('fecha');
    $cantidadIngresada = $request->input('cantidad');
    $motivoSeleccionado = $request->input('motivo');

    // Guardar periodos seleccionados
    foreach ($options as $id) {
        $periodoSeleccionado = new PeriodosSeleccionado();
        $periodoSeleccionado->periodos_id = $id;
        $periodoSeleccionado->save();
    }

    // Obtener docentes y materias
    $materias = json_decode($request->input('materias'), true);
    $docentesId = $this->getDocentes($materias);

    // Guardar reserva
    $reserva = new Reservas();
    $reserva->CantEstudiante = $cantidadIngresada;
    $reserva->motivos_id = $motivoSeleccionado;
    $reserva->docentes_id = $request->input('usuario');
    $reserva->docentes_grupal = $docentesId;
    $reserva->Estado = "pendiente";
    $reserva->Tipo = "grupal";
    $reserva->fecha = $fecha;
    $reserva->TipoAmbiente = $tipoambiente->Nombre;
    $reserva->save();

    // Guardar materias seleccionadas
    $totalEstudiantes = 0;
    foreach ($materias as $valor) {
        $materiaSeleccionada = new MateriasSeleccionado();
        $materiaSeleccionada->materias_id = $valor;
        $materiaSeleccionada->reservas_id = $reserva->id;
        $materia = Materias::find($valor);
        if ($materia) {
            $totalEstudiantes += $materia->Inscritos;
            $materiaSeleccionada->save();
        }
    }

    // Actualizar el total de estudiantes en la reserva
    $reserva->TotalEstudiantes = $totalEstudiantes;
    $reserva->save();

    // Actualizar periodos seleccionados con el ID de la reserva
    PeriodosSeleccionado::whereNull('reservas_id')->update(['reservas_id' => $reserva->id]);

    return redirect()->route('reservas.principal');
}

    public function getDocentes($materiasId){
      $docentes = [];

      foreach ($materiasId as $materiaId) {
        $docenteId = DocentesMaterias::where('materias_id',$materiaId)->first();
        $docentes[]= $docenteId->docentes_id;

      }
      $docentesUnicos = array_unique($docentes);
        return $docentesUnicos;
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
