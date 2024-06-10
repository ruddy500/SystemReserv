@extends('index')


@section('calendario/principalDocente')
<div class="container mt-3">
	<div class="card  vercard">
		<h3 class="card-header">Calendario</h3>
		<div class="card-body">
            <div class="bs-component">
		        <div class="panel-body">
					<div class="row">
                        <div id='calendar'></div>
					</div>
	            </div>
        	</div>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      // Obtener los eventos pasados desde el controlador
      const eventos = @json($eventos);
      const calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: 'es', // Para mostrar el calendario en español
          events: eventos, // Aquí se pasan los eventos obtenidos desde el controlador
          eventDidMount: function(info) {
              // Aplica el color de fondo específico a cada evento
              if (info.event.extendedProps.color) {
                  info.el.style.backgroundColor = info.event.extendedProps.color;
              }
              // Puedes agregar más estilos si es necesario
           
          }
      });
      calendar.render();
  });
</script>

@endsection