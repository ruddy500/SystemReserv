<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon; // Asegúrate de usar Carbon para manipular fechas fácilmente


class Correo extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $subject; // Añadir una propiedad para el asunto
    public $tipoMensaje;
    public $idReserva;
    public $datosReserva;

    public function __construct($details, $subject,$tipoMensaje,$idReserva,$datosReserva)
    {   
        $this->details = $details;
        $this->subject = $subject; // Asignar el asunto proporcionado
        $this->tipoMensaje = $tipoMensaje;
        $this->idReserva = $idReserva;
        $this->datosReserva = $datosReserva;
    }

    public function getFechaEnvio(){
        // Obtener la fecha y hora actual en la zona horaria de Bolivia
        $fechaEnvio = Carbon::now('America/La_Paz');

        // Formatear la fecha de envío
        $fechaEnvioFormateada = $fechaEnvio->locale('es')->isoFormat('dddd, D [de] MMMM');
        $horaEnvio = $fechaEnvio->format('H:i');

        return [
         'horaEnvio' => $horaEnvio,
         'fechaEnvioFormateada' => $fechaEnvioFormateada
     ];
 }


    public function build()
    {
        //entra aqui como segundo
        $fechaEnvio = $this->getFechaEnvio();

        switch ($this->tipoMensaje) {
            case 'asignar':
                $view = 'mensajes.mensajeAsignacion';
                break;
            case 'sugerir':
                $view = 'mensajes.mensajeSugerencia';
                break;

            default:
                $view = 'mensajes.mensajeRechazo'; // Vista por defecto
                break;
        }
        
        // version funcional
        // return $this->subject($this->subject) // Usar el asunto proporcionado
        //         ->view($view);

        // pasando detalles
        return $this->subject($this->subject)
                    ->view($view)
                    ->with([
                        'details' => $this->details,
                        'idReserva' => $this->idReserva,
                        'fechaEnvio' => $fechaEnvio,
                        'datosReserva'=> $this->datosReserva,

                    ]);

        // return $this->subject($this->subject) // Usar el asunto proporcionado
        //             ->view('mensajes.mensaje');
    }
}
