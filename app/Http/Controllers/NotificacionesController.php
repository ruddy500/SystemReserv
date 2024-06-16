<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reservas;
use App\Models\Notificaciones;
use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente

use Illuminate\Support\Facades\Mail;
use App\Mail\Sugerencia;

use App\Models\Ambientes;
use App\Models\Usuarios;
use App\Models\Motivos;
use App\Models\MateriasSeleccionado;
use App\Models\Materias;
use App\Models\PeriodosSeleccionado;
use App\Models\Periodos;
use App\Models\ReservasAmbiente;
use App\Models\NombreAmbientes;
use App\Models\TipoAmbientes;
use App\Models\DocentesMaterias;
use App\Models\Fechas;
use App\Models\Horarios;

class NotificacionesController extends Controller
{ 
    //CONTROLADORES DOCENTE
    public function mostrarLista(){
        $menu = view('componentes/menu'); // Crear la vista del menú
        // dd(auth()->user()->name);
        $notificaciones = Notificaciones::all();
      
        // Inicializar un arreglo para almacenar los IDs
        $idsLeidos = [];
        // Inicializar la variable para contar notificaciones no leídas
        $datoDocente = 0;

        $idsLeidosMasivo=[];

        // dd(count($notificaciones));
        
        for ($i = 0; $i < count($notificaciones); $i++) {
            $tipo = $notificaciones[$i]->Tipo;
            if($tipo==="difusion"){
                if(auth()->user()->name ==="Henry"){
                        
                    if ($notificaciones[$i]->EstadoDocenteHenry === 'leido'  ) {
                        // Si el estado es 'leido', guardar el id en el arreglo
                        $idsLeidosMasivo[] = $notificaciones[$i]->id;
                    }
                }
                if(auth()->user()->name ==="Rosemary Torrico Bascope"){
                        
                    if ($notificaciones[$i]->EstadoDocenteRosemary === 'leido'  ) {
                        // Si el estado es 'leido', guardar el id en el arreglo
                        $idsLeidosMasivo[] = $notificaciones[$i]->id;
                    }
                }
                if(auth()->user()->name ==="Leticia Blanco Coca"){
                        
                    if ($notificaciones[$i]->EstadoDocenteLeticia === 'leido'  ) {
                        // Si el estado es 'leido', guardar el id en el arreglo
                        $idsLeidosMasivo[] = $notificaciones[$i]->id;
                    }
                }
                if(auth()->user()->name ==="Catari"){
                        
                    if ($notificaciones[$i]->EstadoDocenteCatari === 'leido'  ) {
                        // Si el estado es 'leido', guardar el id en el arreglo
                        $idsLeidosMasivo[] = $notificaciones[$i]->id;
                    }
                }
                if(auth()->user()->name ==="Cussi"){
                        
                    if ($notificaciones[$i]->EstadoDocenteCussi === 'leido'  ) {
                        // Si el estado es 'leido', guardar el id en el arreglo
                        $idsLeidosMasivo[] = $notificaciones[$i]->id;
                    }
                }
                if(auth()->user()->name ==="Corina Flores"){
                        
                    if ($notificaciones[$i]->EstadoDocenteCorina === 'leido'  ) {
                        // Si el estado es 'leido', guardar el id en el arreglo
                        $idsLeidosMasivo[] = $notificaciones[$i]->id;
                    }
                }


            }
            
        }
        // dd($idsLeidosMasivo);
        
            for ($i = 0; $i < count($notificaciones); $i++) {
                $tipo = $notificaciones[$i]->Tipo;
                
                if($tipo != "difusion"){
                    $reserva= Reservas::find($notificaciones[$i]->reservas_id);
                    $docente=Usuarios::find($reserva->docentes_id);
                    // ********************************Manejaremos Reservas Grupales************************
                    if(auth()->user()->name ==="Rosemary Torrico Bascope"){
                        
                        if($reserva->Tipo ==='grupal'){
                            if(count($reserva->docentes_grupal)>1){

                                $idNombre1=$reserva->docentes_grupal[0];
                                $idNombre2=$reserva->docentes_grupal[1];

                                $nombre1 =Usuarios::find($idNombre1)->name;
                                $nombre2 =Usuarios::find($idNombre2)->name;
                        

                                if ($notificaciones[$i]->EstadoDocenteRosemary === 'leido' && ($nombre1 === auth()->user()->name || $nombre2 === auth()->user()->name )) {
                                // Si el estado es 'leido', guardar el id en el arreglo
                                    $idsLeidos[] = $notificaciones[$i]->reservas_id;
                                }
                            }

                            
                        }
                        
                    }

                    if(auth()->user()->name ==="Leticia Blanco Coca"){
                        // dd(count($reserva->docentes_grupal));
                        if($reserva->Tipo ==='grupal'){
                            if(count($reserva->docentes_grupal)>1){
                                $idNombre1=$reserva->docentes_grupal[0];
                                $idNombre2=$reserva->docentes_grupal[1];

                                $nombre1 =Usuarios::find($idNombre1)->name;
                                $nombre2 =Usuarios::find($idNombre2)->name;
                        

                                if ($notificaciones[$i]->EstadoDocenteLeticia === 'leido' && ($nombre1 === auth()->user()->name || $nombre2 === auth()->user()->name )) {
                                // Si el estado es 'leido', guardar el id en el arreglo
                                    $idsLeidos[] = $notificaciones[$i]->reservas_id;
                            }
                            }
                            
                        }  
                    }

                    if(auth()->user()->name ==="Corina Flores"){
                        
                        if($reserva->Tipo ==='grupal'){

                            if(count($reserva->docentes_grupal)>1){
                                $idNombre1=$reserva->docentes_grupal[0];
                                $idNombre2=$reserva->docentes_grupal[1];

                                $nombre1 =Usuarios::find($idNombre1)->name;
                                $nombre2 =Usuarios::find($idNombre2)->name;
                        

                                if ($notificaciones[$i]->EstadoDocenteCorina === 'leido' && ($nombre1 === auth()->user()->name || $nombre2 === auth()->user()->name )) {
                                // Si el estado es 'leido', guardar el id en el arreglo
                                    $idsLeidos[] = $notificaciones[$i]->reservas_id;
                                }

                            }

                            
                        }
                    }

                    if(auth()->user()->name ==="Catari"){
                        
                        if($reserva->Tipo ==='grupal'){

                            if(count($reserva->docentes_grupal)>1){
                                $idNombre1=$reserva->docentes_grupal[0];
                                $idNombre2=$reserva->docentes_grupal[1];

                                $nombre1 =Usuarios::find($idNombre1)->name;
                                $nombre2 =Usuarios::find($idNombre2)->name;
                        

                                if ($notificaciones[$i]->EstadoDocenteCatari === 'leido' && ($nombre1 === auth()->user()->name || $nombre2 === auth()->user()->name )) {
                                // Si el estado es 'leido', guardar el id en el arreglo
                                    $idsLeidos[] = $notificaciones[$i]->reservas_id;
                                }

                            }

                            
                        }
                    }

                    if(auth()->user()->name ==="Cussi"){
                        
                        if($reserva->Tipo ==='grupal'){

                            if(count($reserva->docentes_grupal)>1){
                                $idNombre1=$reserva->docentes_grupal[0];
                                $idNombre2=$reserva->docentes_grupal[1];

                                $nombre1 =Usuarios::find($idNombre1)->name;
                                $nombre2 =Usuarios::find($idNombre2)->name;
                        

                                if ($notificaciones[$i]->EstadoDocenteCussi === 'leido' && ($nombre1 === auth()->user()->name || $nombre2 === auth()->user()->name )) {
                                // Si el estado es 'leido', guardar el id en el arreglo
                                    $idsLeidos[] = $notificaciones[$i]->reservas_id;
                                }

                            }

                            
                        }
                    }

                    if(auth()->user()->name ==="Henry"){
                        
                        if($reserva->Tipo ==='grupal'){

                            if(count($reserva->docentes_grupal)>1){
                                $idNombre1=$reserva->docentes_grupal[0];
                                $idNombre2=$reserva->docentes_grupal[1];

                                $nombre1 =Usuarios::find($idNombre1)->name;
                                $nombre2 =Usuarios::find($idNombre2)->name;
                        

                                if ($notificaciones[$i]->EstadoDocenteHenry === 'leido' && ($nombre1 === auth()->user()->name || $nombre2 === auth()->user()->name )) {
                                // Si el estado es 'leido', guardar el id en el arreglo
                                    $idsLeidos[] = $notificaciones[$i]->reservas_id;
                                }

                            }

                            
                        }
                    }

                    if(auth()->user()->name ==="Rosemary Torrico Bascope"){
                        
                        if ($notificaciones[$i]->EstadoDocenteRosemary === 'leido' && $docente->name === auth()->user()->name  ) {
                            // Si el estado es 'leido', guardar el id en el arreglo
                            $idsLeidos[] = $notificaciones[$i]->reservas_id;
                        }
                    }
                    if(auth()->user()->name ==="Leticia Blanco Coca"){
                        
                        if ($notificaciones[$i]->EstadoDocenteLeticia === 'leido' && $docente->name === auth()->user()->name  ) {
                            // Si el estado es 'leido', guardar el id en el arreglo
                            $idsLeidos[] = $notificaciones[$i]->reservas_id;
                        }
                    }
                    if(auth()->user()->name ==="Catari"){
                        
                        if ($notificaciones[$i]->EstadoDocenteCatari === 'leido' && $docente->name === auth()->user()->name  ) {
                            // Si el estado es 'leido', guardar el id en el arreglo
                            $idsLeidos[] = $notificaciones[$i]->reservas_id;
                        }
                    }
                    if(auth()->user()->name ==="Cussi"){
                        
                        if ($notificaciones[$i]->EstadoDocenteCussi === 'leido' && $docente->name === auth()->user()->name  ) {
                            // Si el estado es 'leido', guardar el id en el arreglo
                            $idsLeidos[] = $notificaciones[$i]->reservas_id;
                        }
                    }
                    if(auth()->user()->name ==="Henry"){
                        
                        if ($notificaciones[$i]->EstadoDocenteHenry === 'leido' && $docente->name === auth()->user()->name  ) {
                            // Si el estado es 'leido', guardar el id en el arreglo
                            $idsLeidos[] = $notificaciones[$i]->reservas_id;
                        }
                    }
                    if(auth()->user()->name ==="Corina Flores"){
                        
                        if ($notificaciones[$i]->EstadoDocenteCorina === 'leido' && $docente->name === auth()->user()->name  ) {
                            // Si el estado es 'leido', guardar el id en el arreglo
                            $idsLeidos[] = $notificaciones[$i]->reservas_id;
                        }
                    }

                    
                }
                
            }

            $user = auth()->user(); // Obtener el usuario autenticado una vez
            $userName = $user->name;
            
            // Mapear los nombres de usuario a los campos de estado
            $estadoDocenteFields = [
                "Rosemary Torrico Bascope" => "EstadoDocenteRosemary",
                "Leticia Blanco Coca" => "EstadoDocenteLeticia",
                "Catari" => "EstadoDocenteCatari",
                "Cussi" => "EstadoDocenteCussi",
                "Henry" => "EstadoDocenteHenry",
                "Corina Flores" => "EstadoDocenteCorina"
            ];
            
            // Verificar si el usuario autenticado tiene un campo de estado correspondiente
            // if (isset($estadoDocenteFields[$userName])) {
            //     $estadoField = $estadoDocenteFields[$userName];

            //     // Iterar sobre las notificaciones
            //     foreach ($notificaciones as $notificacion) {
            //         if ($notificacion->Tipo !== "difusion") {
            //             $reserva = Reservas::find($notificacion->reservas_id);
            //             if ($reserva) {
            //                 $docente = Usuarios::find($reserva->docentes_id);
            //                 if ($docente && $docente->name === $userName) {
            //                     if ($notificacion->$estadoField === 'leido') {
            //                         // Si el estado es 'leido', guardar el id en el arreglo
            //                         $idsLeidos[] = $notificacion->reservas_id;
            //                     }
            //                 }
            //             }
            //         }
                    
            //     }
            // }

            // dd($idsLeidos);  aqui se lee los id de las reservas de un solo docente
             // Contar las notificaciones no leídas de difusion
            /* foreach ($notificaciones as $notificacion) {
                $tipo = $notificacion->Tipo;
                if($tipo != "difusion"){
                    $reserva= Reservas::find($notificacion->reservas_id);
                    $docente=Usuarios::find($reserva->docentes_id);
                    if(auth()->user()->name ==="Rosemary Torrico Bascope"){
                        if ($notificacion->EstadoDocenteRosemary === 'no leido'&& $docente->name === auth()->user()->name) {
                            $datoDocente += 1;
                        }
                    }
                    if(auth()->user()->name ==="Leticia Blanco Coca"){
                        if ($notificacion->EstadoDocenteLeticia === 'no leido'&& $docente->name === auth()->user()->name) {
                            $datoDocente += 1;
                            // dd($datoDocente);
                        }
                    }
                    if(auth()->user()->name ==="Catari"){
                        if ($notificacion->EstadoDocenteCatari === 'no leido'&& $docente->name === auth()->user()->name) {
                            $datoDocente += 1;
                            // dd($datoDocente);
                        }
                    }
                    if(auth()->user()->name ==="Henry"){
                        if ($notificacion->EstadoDocenteHenry === 'no leido'&& $docente->name === auth()->user()->name) {
                            $datoDocente += 1;
                            // dd($datoDocente);
                        }
                    }
                    if(auth()->user()->name ==="Corina Flores"){
                        if ($notificacion->EstadoDocenteCorina === 'no leido'&& $docente->name === auth()->user()->name) {
                            $datoDocente += 1;
                            // dd($datoDocente);
                        }
                    }
                
                }
                
            } */
           // Inicializar contador
    $datoDocente = 0;

    // Verificar si el usuario autenticado tiene un campo de estado correspondiente
    if (isset($estadoDocenteFields[$userName])) {
        $estadoField = $estadoDocenteFields[$userName];

        // Iterar sobre las notificaciones
        foreach ($notificaciones as $notificacion) {
            if ($notificacion->Tipo !== "difusion") {
                $reserva = Reservas::find($notificacion->reservas_id);
                if ($reserva) {
                    $docente = Usuarios::find($reserva->docentes_id);
                    if ($docente && $docente->name === $userName) {
                        if ($notificacion->$estadoField === 'no leido') {
                            // Incrementar contador si el estado es 'no leido'
                            $datoDocente += 1;
                        }
                    }
                }
            }
        }


    }
    $datoMasivo=0;
    foreach ($notificaciones as $notificacion) {
                $tipo = $notificacion->Tipo;
                if($tipo === "difusion"){
                    if(auth()->user()->name ==="Rosemary Torrico Bascope"){
                        if ($notificacion->EstadoDocenteRosemary === 'no leido') {
                            $datoDocente += 1;
                            
                        }
                    }
                    if(auth()->user()->name ==="Leticia Blanco Coca"){
                        if ($notificacion->EstadoDocenteLeticia === 'no leido') {
                            $datoDocente += 1;
                            // dd($datoDocente);
                        }
                    }
                    if(auth()->user()->name ==="Catari"){
                        if ($notificacion->EstadoDocenteCatari === 'no leido') {
                            $datoDocente += 1;
                            // dd($datoDocente);
                        }
                    }
                    if(auth()->user()->name ==="Henry"){
                        if ($notificacion->EstadoDocenteHenry === 'no leido'){
                            $datoDocente += 1;
                            // dd($datoDocente);
                        }
                    }
                    if(auth()->user()->name ==="Corina Flores"){
                        if ($notificacion->EstadoDocenteCorina === 'no leido') {
                            $datoDocente += 1;
                            
                            // dd($datoDocente);
                        }
                    }
                    if(auth()->user()->name ==="Cussi"){
                        if ($notificacion->EstadoDocenteCussi === 'no leido') {
                            $datoDocente += 1;
                            
                            // dd($datoDocente);
                        }
                    }
                
                }
                
            }

            // dd($datoMasivo);
        

        // Guarda el valor actualizado en la sesión
        session(['datoDocente' => $datoDocente]);

    
        return view('notificaciones.lista',compact('menu','idsLeidos','idsLeidosMasivo'));
    }
    public function mostrarSugerencia($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        if(auth()->user()->name ==="Rosemary Torrico Bascope"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteRosemary='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Leticia Blanco Coca"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteLeticia='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Catari"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCatari='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Cussi"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCussi='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Henry"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteHenry='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Corina Flores"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCorina='leido';
            $notificacion->save();
        }
        return view('notificaciones.sugerencia',compact('menu','reservaId','notificacionId'));
    }
    public function mostrarAsignacion($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        if(auth()->user()->name ==="Rosemary Torrico Bascope"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteRosemary='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Leticia Blanco Coca"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteLeticia='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Catari"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCatari='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Cussi"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCussi='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Henry"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteHenry='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Corina Flores"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCorina='leido';
            $notificacion->save();
        }
        
        
        return view('notificaciones.asignacion',compact('menu','reservaId','notificacionId'));
    }
    public function mostrarRechazo($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        if(auth()->user()->name ==="Rosemary Torrico Bascope"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteRosemary='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Leticia Blanco Coca"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteLeticia='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Catari"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCatari='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Cussi"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCussi='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Henry"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteHenry='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Corina Flores"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCorina='leido';
            $notificacion->save();
        }
        return view('notificaciones.rechazo',compact('menu','reservaId','notificacionId'));
    }
    public function mostrarDifusion($notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú

        $timezone = 'America/La_Paz';
        $notificacion = Notificaciones::where('id', $notificacionId)->first();

        $fecha = Carbon::parse($notificacion->fecha_actual_sistema)->setTimezone($timezone);
        $fechaActual = Carbon::now($timezone);
        $contenidoDifusion = json_decode($notificacion->contenidoDifusion, true);

        // Ahora puedes acceder a 'asunto' y 'mensaje' desde $contenidoDifusion
        $asunto = $contenidoDifusion['asunto'];
        $mensaje = $contenidoDifusion['mensaje'];

        $fechaFormateada = $fecha->locale('es')->isoFormat('dddd, D [de] MMMM');
        $diferencia = $fecha->diffForHumans($fechaActual);
        // dd("hola");
        if(auth()->user()->name ==="Rosemary Torrico Bascope"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteRosemary='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Leticia Blanco Coca"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteLeticia='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Catari"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCatari='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Cussi"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCussi='leido';
            $notificacion->save();
        }
        if(auth()->user()->name ==="Henry"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteHenry='leido';
            // dd("stop");
            $notificacion->save();
        }
        if(auth()->user()->name ==="Corina Flores"){
            $notificacion= Notificaciones::find($notificacionId);
            $notificacion->EstadoDocenteCorina='leido';
            $notificacion->save();
        }

        return view('notificaciones.difusion',compact('menu','notificacionId','fechaFormateada','diferencia','mensaje','asunto'));
    }

    //CONTROLADORES ADMINISTRADOR
    public function mostrarListaAdmin(){
        
        $menu = view('componentes/menu'); // Crear la vista del menú

        // Obtener todas las notificaciones
        $notificaciones = Notificaciones::all();
    
        // Inicializar un arreglo para almacenar los IDs
        $idsLeidos = [];
        
        // Inicializar la variable para contar notificaciones no leídas
        $dato = 0;

        // dd(count($notificaciones));

            for ($i = 0; $i < count($notificaciones); $i++) {
                $tipo = $notificaciones[$i]->Tipo;
                if($tipo != "difusion"){
                    $reserva= Reservas::find($notificaciones[$i]->reservas_id);
                    if ($notificaciones[$i]->Estado === 'leido' && $reserva->Fuesugerido ==='si') {
                        // Si el estado es 'leido', guardar el id en el arreglo
                        $idsLeidos[] = $notificaciones[$i]->reservas_id;
                    }
                }
                
            }

            

            // Contar las notificaciones no leídas
            foreach ($notificaciones as $notificacion) {
                $tipo = $notificacion->Tipo;
                
                if($tipo != "difusion"){
                    $reserva= Reservas::find($notificacion->reservas_id);
                    if ($notificacion->Estado === 'no leido'&& $reserva->Fuesugerido ==='si') {
                        $dato += 1;
                    }
                }
                
            }
        

        
    // Guarda el valor actualizado en la sesión
    session(['datoAdmin' => $dato]);

        return view('notificaciones.admin.lista',compact('menu','idsLeidos'));
    }

    // para rechazar
    public function mostrarSugerenciaAdmin($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú
        $notificacion= Notificaciones::find($notificacionId);
        $notificacion->Estado='leido';
        $notificacion->save();


        return view('notificaciones.admin.sugerenciaRechazo',compact('menu','reservaId','notificacionId'));
    }

    public function mostrarSugerenciaAdminAsignacion($reservaId,$notificacionId){
        $menu = view('componentes/menu'); // Crear la vista del menú

        $notificacion= Notificaciones::find($notificacionId);
        $notificacion->Estado='leido';
        $notificacion->save();
        return view('notificaciones.admin.sugerenciaAsignacion',compact('menu','reservaId','notificacionId'));
    }

    public function sugerenciaRechazo(Request $request)
    {
        // dd("hola mundo");
        //enviar el correo
        $this->enviarCorreo($request,false);
        // dd($request->input('fecha_actual'));
        // Obtén los datos del formulario
        $notificacionId = $request->input('notificacion_id');
        $idReserva = $request->input('reserva_id');

        $reserva = Reservas::find($idReserva); //extraemos la reserva actual

        $reserva->Estado = "rechazado";
        $reserva->Fuesugerido='si';
        $reserva->save();

        $notificacion= Notificaciones::find($notificacionId);
        $notificacion->fecha_respuesta_Sugerencia=$request->input('fecha_actual2');
        // $notificacion->Estado='leido';
        $notificacion->save();

        // $periodoSeleccionado = PeriodosSeleccionado::find()
        $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$idReserva)->get();
        $reservasAmbiente = ReservasAmbiente::where('reservas_id',$idReserva)->get();
        // dd($reservasAmbiente);

        $reserva = Reservas::find($idReserva);
        $fecha = $reserva->fecha;

        // Utilizamos explode para separar la cadena por el delimitador "-"
        $partes = explode("-", $fecha);

        // Asignamos los valores a las variables individuales
        $a = $partes[0]; // Día: 17
        $b = $partes[1]; // Mes: 06
        $mesCorto = substr($b, -1);
        // dd($mesCorto);
        $c = $partes[2]; // Año: 2024
        $anioCorto = substr($c, -2);
        // dd($anioCorto);
        $registro = Fechas::where('dia', $a)
                ->where('mes', $mesCorto)
                ->where('anio', $anioCorto)
                ->first();
        // dd($registro);
        $idFecha = $registro->id;
        // dd($idFecha);
        

        $idAmbiente1=$reservasAmbiente[0]->ambientes_id;
        $idAmbiente2=$reservasAmbiente[1]->ambientes_id;
        // dd(count($periodosSeleccionados));
        // dd($idAmbiente2);
        $horarios = Horarios::all();
        if(count($periodosSeleccionados)===1){
            $idPeriodo1=$periodosSeleccionados[0]->periodos_id;
            for ($i=0; $i < count($horarios); $i++) { 
                $fechaHorarioID = $horarios[$i]->fechas_id;
                $peridoHorarioID = $horarios[$i]->periodos_id;
                $ambienteHorarioID = $horarios[$i]->ambientes_id;
                if($fechaHorarioID===$idFecha && $peridoHorarioID ===$idPeriodo1 &&
                ($ambienteHorarioID===$idAmbiente1 ||$ambienteHorarioID===$idAmbiente2) ){
                    $horarios[$i]->Estado=1;
                    $horarios[$i]->save();

                }
            }
        }

        if(count($periodosSeleccionados)===2){
            $idPeriodo1=$periodosSeleccionados[0]->periodos_id;
            $idPeriodo2=$periodosSeleccionados[1]->periodos_id;
            for ($i=0; $i < count($horarios); $i++) { 
                $fechaHorarioID = $horarios[$i]->fechas_id;
                $peridoHorarioID = $horarios[$i]->periodos_id;
                $ambienteHorarioID = $horarios[$i]->ambientes_id;
                if($fechaHorarioID===$idFecha && ($peridoHorarioID ===$idPeriodo1 || $peridoHorarioID ===$idPeriodo2) &&
                ($ambienteHorarioID===$idAmbiente1 ||$ambienteHorarioID===$idAmbiente2) ){
                    $horarios[$i]->Estado=1;
                    $horarios[$i]->save();

                }
            }
        }
        
        // dd($idPeriodo1);
        // $idPeriodo2=$periodosSeleccionados[1]->periodos_id;
        // Redireccionar o devolver una respuesta
        return redirect()->route('notificaciones.lista');
    }

    public function sugerenciaAceptada(Request $request)
    {
        //enviar el correo
        $this->enviarCorreo($request,true);

        // Obtén los datos del formulario
        $notificacionId = $request->input('notificacion_id');
        $idReserva = $request->input('reserva_id');

        $reserva = Reservas::find($idReserva); //extraemos la reserva actual

        $reserva->Estado = "asignado";
        $reserva->Fuesugerido='si';
        $reserva->save();

        $notificacion= Notificaciones::find($notificacionId);
        $notificacion->fecha_respuesta_Sugerencia=$request->input('fecha_actual');
        // $notificacion->Estado='leido';
        $notificacion->save();

        // Redireccionar o devolver una respuesta
        return redirect()->route('notificaciones.lista');
    }

    public function enviarCorreo(Request $request, bool $boolean)
    {
        // --Enviar Datos al Mensaje--
        $asunto = 'Asignación de Solicitud de Reserva';
        $estado = $boolean ? 'Aceptado' : 'Rechazado'; // operador ternario  // true=Aceptado //false=Rechazado
        //Obtencion de datos
        $idReserva = $request->input('reserva_id'); //obtenemos el id
        $reserva = Reservas::find($idReserva); //extraemos la reserva actual

        $notificacionId = $request->input('notificacion_id');
        $notificacion= Notificaciones::find($notificacionId);

        $tipoReserva = $reserva->Tipo ; //vamos a mostrar el tipo de la reserva

        //detalles de la reserva
        $docente = Usuarios::find($reserva->docentes_id)->name;
        $cantidad = $reserva->CantEstudiante;
        $motivo = Motivos::find($reserva->motivos_id)->Nombre;
        $fecha = $reserva->fecha;
        $periodo = $this->Periodo($idReserva);
        $ambiente = $reserva->TipoAmbiente;
        $materia = Materias::where('id', MateriasSeleccionado::where('reservas_id', $idReserva)->first()->materias_id)->first()->Nombre;
        $grupo = $this->Grupo($tipoReserva,$idReserva);

        //obtener esa webada del Andres
        $datosAmbientes = $this->Ambiente($idReserva);

        //detalle del ambiente 1
        $ambiente1 = $datosAmbientes['nombresAmbientes'][0];
        $capacidad1 = $datosAmbientes['capacidadesAmbientes'][0];
        $ubicacion1 = $datosAmbientes['ubicacionesAmbientes'][0];
        $tipo1 = $datosAmbientes['tiposAmbientes'][0];
        $periodo1 = $this->Periodo($idReserva);
        $fecha1 = Carbon::parse($notificacion->fecha_actual_sistema)->setTimezone('America/La_Paz');
        //detalle del ambiente 2
        $ambiente2 = $datosAmbientes['nombresAmbientes'][1];
        $capacidad2 = $datosAmbientes['capacidadesAmbientes'][1];
        $ubicacion2 = $datosAmbientes['ubicacionesAmbientes'][1];
        $tipo2 = $datosAmbientes['tiposAmbientes'][1];
        $periodo2 = $this->Periodo($idReserva);
        $fecha2 = Carbon::parse($notificacion->fecha_actual_sistema)->setTimezone('America/La_Paz');
        //emisor
        $emisor = 'Administrador';
        //correo al que se enviara
        $correoDestino = 'adaenterprisesoft@gmail.com';

        // Detalles para el correo
        $details = [
            'estado' => $estado,

            'docente' => $docente,
            'cantidad' => $cantidad,
            'motivo' => $motivo,
            'fecha' => $fecha,
            'periodo' => $periodo,
            'ambiente' => $ambiente,
            'materia' => $materia,
            'grupo' => $grupo,

            'ambiente1' => $ambiente1,
            'capacidad1' => $capacidad1,
            'ubicacion1' => $ubicacion1,
            'tipo1' => $tipo1,
            'periodo1' => $periodo1,
            'fecha1' => $fecha1,

            'ambiente2' => $ambiente2,
            'capacidad2' => $capacidad2,
            'ubicacion2' => $ubicacion2,
            'tipo2' => $tipo2,
            'periodo2' => $periodo2,
            'fecha2' => $fecha2,

            'emisor' => $emisor
        ];
        // Enviar correo
        $andres=$reserva->Tipo;
        if($andres=="grupal"){
            $correos=$reserva->docentes_grupal;
            $tamU=count($correos);

            $usuarios= Usuarios ::all(); //correos users
            $tamUs=$usuarios->count();

            for($i=0;$i<$tamU;$i++){
                $idDoc=$correos[$i];
                for($j=0;$j<$tamUs;$j++){
                    if($usuarios[$j]->id==$idDoc){
                        $emailU=$usuarios[$j]->email;
                        Mail::to($emailU)->send(new Sugerencia($details, $asunto));
                        //echo "$email<br>";
                    }
                }
            }
        }else{
            Mail::to($correoDestino)->send(new Sugerencia($details, $asunto));
        }
        
    }

    public function Ambiente($reservaId)
    {
        $registrosRA = ReservasAmbiente::where('reservas_id',$reservaId)->get();
        // Inicializar arrays para almacenar los datos
        $nombresAmbientes = [];
        $capacidadesAmbientes = [];
        $ubicacionesAmbientes = [];
        $tiposAmbientes = [];
                    
        // Iterar sobre cada registro y obtener los detalles correspondientes
        foreach ($registrosRA as $registroRA) {
            $idAmbiente = $registroRA->ambientes_id;
            $registroAmbiente = Ambientes::where('id', $idAmbiente)->first();
                    
            $idNombreAmb = $registroAmbiente->nombre_ambientes_id;
            $registroNombreAmb = NombreAmbientes::where('id', $idNombreAmb)->first();
            $nombreAmbiente = $registroNombreAmb->Nombre;
            $nombresAmbientes[] = $nombreAmbiente;
                    
            $capacidadAmbiente = $registroAmbiente->Capacidad;
            $capacidadesAmbientes[] = $capacidadAmbiente;
                    
            $ubicacionAmbiente = $registroAmbiente->Ubicacion;
            $ubicacionesAmbientes[] = $ubicacionAmbiente;
                    
            $idTipoAmb = $registroAmbiente->tipo_ambientes_id;
            $registroTipoAmb = TipoAmbientes::where('id', $idTipoAmb)->first();
            $tipoAmbiente = $registroTipoAmb->Nombre;
            $tiposAmbientes[] = $tipoAmbiente;
        }

        return [
            'nombresAmbientes' => $nombresAmbientes,
            'capacidadesAmbientes' => $capacidadesAmbientes,
            'ubicacionesAmbientes' => $ubicacionesAmbientes,
            'tiposAmbientes' => $tiposAmbientes,
        ];
    }

    public function Grupo($tipoReserva,$idReserva){
        $registrosMatSelec = MateriasSeleccionado::where('reservas_id',$idReserva)->get(); 
        $gruposMateria = [];
        $dato = "";
                           
        if ($tipoReserva == "individual"){
            foreach ($registrosMatSelec as $registroMatSelec){                     
                $idMateria = $registroMatSelec->materias_id;
                $materia = Materias::where('id',$idMateria)->first();
                $gruposMateria[] = $materia->Grupo;                  
            }
            $dato = implode(', ', $gruposMateria); 
        }else{
            foreach ($registrosMatSelec as $registroMatSelec){               
                $idMateria = $registroMatSelec->materias_id;
                $materia = Materias::where('id',$idMateria)->first();
                                        
                $registroDocMat = DocentesMaterias::where('materias_id',$idMateria)->first();
                $idDocente = $registroDocMat->docentes_id;
                $registroDocente = Usuarios::where('id',$idDocente)->first();
                $nombreDocente = $registroDocente->name;
                                        
                $grupo = $materia->Grupo;
                $gruposMateria[] = "$grupo, $nombreDocente";               
            }              
            $dato = implode(' | ', $gruposMateria);                  
        }
        return $dato;
    }

    public function Periodo($idReserva){
        $horaInicio = "";
        $horaFin = "";
        $periodosSeleccionados = PeriodosSeleccionado::where('reservas_id',$idReserva)->get();
        $tamPeriodosSeleccionado = count($periodosSeleccionados);

        if($tamPeriodosSeleccionado == 1){
            $periodoId = $periodosSeleccionados[0]->periodos_id;
                        
            $periodoBuscar = Periodos :: where('id',$periodoId)->first();
            $periodo = $periodoBuscar->HoraIntervalo;
            $partes_P = explode('-', $periodo);
                        
            $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
            $horaFin = trim(str_replace(' ', '', $partes_P[1]));
                    
        }
        else{

            $periodoId = $periodosSeleccionados[0]->periodos_id;
            $periodoId2 = $periodosSeleccionados[1]->periodos_id;

            $periodoBuscar = Periodos :: where('id',$periodoId)->first();     
            $periodoBuscar2 = Periodos :: where('id',$periodoId2)->first();

            $periodo = $periodoBuscar->HoraIntervalo;
            $periodo2 = $periodoBuscar2->HoraIntervalo;
                        
            $partes_P = explode('-', $periodo);
            $partes_P2 = explode('-', $periodo2);

            $horaInicio = trim(str_replace(' ', '', $partes_P[0]));
            $horaFin = trim(str_replace(' ', '', $partes_P2[1]));
            }

            $variable = $horaInicio . ' - ' . $horaFin;

        return $variable;
    
    }
}