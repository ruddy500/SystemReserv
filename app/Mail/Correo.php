<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Correo extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $subject; // Añadir una propiedad para el asunto
    public $tipoMensaje;
    public $idReserva;

    public function __construct($details, $subject,$tipoMensaje,$idReserva)
    {   
        $this->details = $details;
        $this->subject = $subject; // Asignar el asunto proporcionado
        $this->tipoMensaje = $tipoMensaje;
        $this->idReserva = $idReserva;
    }

    public function build()
    {
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
                        'idReserva' => $this->idReserva
                    ]);

        // return $this->subject($this->subject) // Usar el asunto proporcionado
        //             ->view('mensajes.mensaje');
    }
}
