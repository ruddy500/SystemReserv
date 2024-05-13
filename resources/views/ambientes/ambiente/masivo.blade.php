<!-- Modal -->
<div class="modal fade" id="registroAmbiente-masivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de ambientes masivo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{route('import.excel')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @include('componentes.validacion')
                        <div class="mb-3"> 
                            <label for="banner" class="form-label">Archivo Excel:</label>
                            <input type="file" class="form-control" id="archivo-ambientes" name="file" accept=".xlsx, .xls" required>
                            <div class="valid-feedback">Archivo seleccionado</div>
                            <div class="invalid-feedback">Seleccione Archivo</div>
                            <br>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-aceptar">Aceptar</button>
                            <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>