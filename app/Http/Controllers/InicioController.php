<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncios;
use App\Models\Reglas;
use App\Models\Notificaciones;
use App\Models\Reservas;
use App\Models\Usuarios;
class InicioController extends Controller
{
    public function mostrar(){
        $anuncios = Anuncios::all();
        $tam = $anuncios->count();

        $reglas = Reglas::all();
        $t = $reglas->count();


        // mostrar notificacion correctamente al iniciar
        $notificaciones = Notificaciones::all();
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
        // **************************SECCION DOCENTE****************************
        // Inicializar la variable para contar notificaciones no leídas
        $dato = 0;
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

        $menu = view('componentes/menu'); // Crear la vista del menú
        return view('inicio',compact('menu','anuncios','tam','reglas','t'));
    }
}
