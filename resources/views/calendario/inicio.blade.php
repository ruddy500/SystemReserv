@extends('calendario/principal')

@section('contenido-inicio')
{{-- {{ dd(get_defined_vars()) }} --}}
<div class="container">
        <!-- Contenedor donde se mostrará el calendario -->
        <div id='calendar'></div>
</div>

{{-- <script>
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
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener los eventos y configuraciones pasados desde el controlador
        const eventos = @json($eventos);
        const configuraciones = @json($configuraciones);
  
        // Combinar los eventos y configuraciones en una sola lista
        const todosLosEventos = [...eventos, ...configuraciones];
  
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es', // Para mostrar el calendario en español
            events: todosLosEventos, // Aquí se pasan los eventos y configuraciones combinados
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