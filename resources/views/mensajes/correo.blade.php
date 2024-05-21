@extends('index')

@section('mensajes/correo')

<div class="container mt-3">
    <div class="card vercard">
        <h3 class="card-header">Enviar mensaje email</h3>
        <div class="card-body bg-content">
            <div class="cuerpo-correo">
                <form method="POST" action="{{ url('/enviar-correo') }}">
                    @csrf <!-- Agregar el token CSRF -->
                    <div class="form-group mb-3">
                        <label for="inputName">De:</label>
                        <input type="text" value="{{$correoEmisor}}" name="emisor" class="form-control" id="emisor"/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputEmail">Para:</label>
                        <input type="email" id="enviar" name="enviar" value="{{$correoDestino}}" class="form-control" id="inputEmail" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="asunto">Asunto:</label>
                        <input type="text" name="asunto" value="{{$Asunto}}" class="form-control" id="asunto" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="mensaje">Mensaje:</label>
                        <textarea name="mensaje" class="form-control" id="mensaje" placeholder="Ingrese su mensaje"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary submitBtn custom-btn"><i class="bi bi-send"></i> Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection