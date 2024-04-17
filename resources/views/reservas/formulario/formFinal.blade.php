@extends('reservas/principal')

@section('contenido-registrar')
<div class="card-body bg-content">
    <div class="mb-3">
        <div class="mb-3">
            <label for="cantidad-name" class="col-form-label h4">Cantidad de estudiantes:</label>
            <input type="number" name= "cantidad" class="form-control" id="cantidad-name">
        </div>
        <div class="mb-3">
            <label for="motivo-text" class="col-form-label h4">Motivo:</label>
            <textarea class="form-control" name="motivo" id="motivo-text" required minlength="5" maxlength="50" ></textarea>                       
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-aceptar">Aceptar</button>
            <button id="cancelar" type="button" class="btn btn-cancelar" >Cancelar</button>
        </div>
    </div>
</div>
@endsection