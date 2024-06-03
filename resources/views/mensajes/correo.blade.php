@extends('index')

@section('mensajes/correo')

<div class="container mt-3">
    <div class="card vercard">
        <h3 class="card-header">Enviar mensaje email</h3>
        <div class="card-body bg-content">
            <div class="cuerpo-correo">
                <form method="POST" action="{{ url('/enviar-correo') }}">
                    @csrf <!-- Agregar el token CSRF -->
                    <input type="hidden" name="tipo_seleccionado" value={{ $tipoSeleccionado }}>
                    <input type="hidden" name="ambientes_seleccionado" value={{ $checkboxValues }}>
                    
                    {{-- se esta enviando el id De la Reserva --}}
                    <input type="hidden" name="idReserva" value={{ $idReserva }}>
                    <div class="form-group row mb-3">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">De:</label>
                        <div class="col-md-6 col-md-4">
                        <input type="text" value="{{$correoEmisor}}" name="emisor" class="form-control" id="emisor"/>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Para:</label>
                        <div class="col-md-6 col-md-4">                        
                            <input type="email" id="enviar" name="enviar" value="{{$correoDestino}}" class="form-control" id="inputEmail" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Asunto:</label>
                        <div class="col-md-6 col-md-4">                        
                            <input type="text" name="asunto" value="{{$Asunto}}" class="form-control" id="asunto" />
                        </div>
                    </div> 
                    <div class="form-group mb-3">
            
                        <div class="col-md-12">
                            <textarea name="mensaje" class="form-control" id="mensaje"  rows="5">{{ $Contenido }}</textarea>
                        </div>                    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary submitBtn custom-btn"><i class="bi bi-send"></i> Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir el envío del formulario por defecto
            
            // Aquí podrías agregar validaciones adicionales antes de mostrar la mensaje de alerta
            
            Swal.fire({
                icon: 'success',
                title: '¡Mensaje enviado!',
                text: 'Tu mensaje se ha enviado correctamente.',
                showConfirmButton: false,
                timer: 2000, // Cerrar automáticamente después de 2 segundos
                didClose: () => {
                    // Agregar aquí el código para enviar el formulario después de cerrar la alerta
                    form.submit(); // Esto enviará el formulario
                }
            });
        });
    });
</script>
@endsection