<h1>aqui es donde crearemos</h1>

<form action="/ambiente" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Nombre</label>
        <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Ubicacion</label>
        <input id="ubicacion" name="ubicacion" type="text" class="form-control" tabindex="1">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Capacidad</label>
        <input id="capacidad" name="capacidad" type="number" class="form-control" tabindex="1">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Habilitado</label>
        <div class="form-check">
            <input id="habilitado" name="habilitado" type="checkbox" class="form-check-input" value="1" tabindex="3">
            <label class="form-check-label" for="habilitado">¿Habilitado?</label>
        </div>
    </div>

    <a href="/ambiente" class="btn btn-secondary" tabindex="5">Cancelar</a>

    <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>

</form>