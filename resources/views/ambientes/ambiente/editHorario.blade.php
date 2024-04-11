<!--{ { dd(get_defined_vars()) }}--> 
<?php 
use App\Models\Dias;
use App\Models\Periodos; 
    $periodos = Periodos::all();
    $dias = Dias::all();
 ?>
                
<div class="modal fade" id="formularioHorario" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('actualizar.horario') }}" method="POST">
          @csrf
          @method('PUT')
          <!-- Captura los datos enviados los el boton editar para poder usarlos en la ruta actualizar.horario -->
          <input type="hidden" name="dia_id" id="diaIdInput"> 
          <input type="hidden" name="periodo_id" id="periodoIdInput"> 
          <input type="hidden" name="ambiente_id" id="ambienteIdInput"> 
       
      
          <div class="modal-header">
            <h3 class="modal-title h3">Editar horario</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
        
            <div class="mb-3">
              <label for="dia" class="col-form-label h4">Día:</label>
              <select name="dia" class="selectpicker custom-select form-control btn-lg" title="Seleccione día" required>
                <!--captura los dias-->
                 @foreach ($dias as $dia)
                 <option value="{{ $dia->id }}"> {{ $dia->Dia }} </option>
                 @endforeach
                
             </select>
      </div>
            <div class="mb-3">
              <label for="horario" class="col-form-label h4">Horario:</label>
              <select name="horario" class="selectpicker custom-select form-control btn-lg" title="Seleccione horario" required>
                              
                @foreach ($periodos as $periodo)
                <option value= "{{ $periodo->id }}"> {{ $periodo->HoraIntervalo }} </option>
                @endforeach
    
                                
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-aceptar">Aceptar</button>
            <button id="cancelar2" type="button" class="btn btn-cancelar">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--Captura los datos de una fila con darle click al boton editar.
    Los datos que captura son diaId periodoId y ambienteId y lo envia al modal -->
  <script>
$(document).ready(function() {
  var modalOpened = false;

  $('#formularioHorario').on('show.bs.modal', function (event) {
    if (!modalOpened) {
      modalOpened = true;

      var button = $(event.relatedTarget); // Botón que activa el modal
      var diaId = button.data('dia-id'); // Obtener dia ID desde el botón
      var periodoId = button.data('periodo-id'); // Obtener periodo ID desde el botón
      var ambienteId = button.data('ambiente-id'); // Obtener ID del ambiente desde el botón

      // Imprimir los valores una sola vez
      console.log("Dia ID:", diaId);
      console.log("Periodo ID:", periodoId);
      console.log("Ambiente ID:", ambienteId);
      //envia los datos al modal 
      $('#diaIdInput').val(diaId);
      $('#periodoIdInput').val(periodoId);
      $('#ambienteIdInput').val(ambienteId);
   

    }
  });

  $('#formularioHorario').on('hide.bs.modal', function (event) {
    modalOpened = false;
  });
});</script>



<script>
    $('#cancelar2').on('click', function() {
        Swal.fire({
        title: "Cancelado",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#7066e0",
        confirmButtonText: "Aceptar" ,
        allowOutsideClick: false
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/ambientes/editar';
        }
        });
    });
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        text: '{{ session('success') }}',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif

@if(session('message'))
<script>
    Swal.fire({
        icon: 'warning',
        text: '{{ session('message') }}',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif
