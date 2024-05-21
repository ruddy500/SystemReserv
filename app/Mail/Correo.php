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

    public function __construct($details, $subject)
    {
        $this->details = $details;
        $this->subject = $subject; // Asignar el asunto proporcionado
    }

    public function build()
    {
        return $this->subject($this->subject) // Usar el asunto proporcionado
                    ->view('mensajes.mensaje');
    }
}
