@extends('index')

@section('mensajes/correo')

<?php
// dd($idReserva);
dd($checkboxValue);
?>


<div class="container mt-3">
    <div class="card vercard">
        <h3 class="card-header">Enviar mensaje email</h3>
        <div class="card-body bg-content">
            <div class="cuerpo-correo">
                <form role="form">
                    <div class="form-group mb-3">
                        <label for="inputName">De:</label>
                        <input type="email" class="form-control" id="inputName"/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputEmail">Para:</label>
                        <input type="email" class="form-control" id="inputEmail" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputAsunto">Asunto:</label>
                        <input type="text" class="form-control" id="inputEmail" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputMessage">Mensaje:</label>
                        <textarea class="form-control" id="inputMessage" placeholder="Ingrese su mensaje"></textarea>
                    </div>
                </form>
            </div>
            <!-- Modal Pie de Página -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary submitBtn custom-btn"><i class="bi bi-send"></i> Enviar</button>
            </div>
        </div>
    </div>
</div>
@endsection