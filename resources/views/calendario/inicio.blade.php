@extends('calendario/principal')

@section('contenido-inicio')
<div class="container">
        <!-- Contenedor donde se mostrará el calendario -->
        <div id='calendar'></div>
</div>
<!-- sin este script no se podra visulizar el calendario POR LO QUE ES NECESARIO-->
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: 'es', // Para mostrar el calendario en español
          events: [
                    { title: 'Evento 1', start: '2024-06-01' },
                    { title: 'Evento 2', start: '2024-06-07', end: '2024-06-10' },
                ]//ESTOS SON EVENTOS DE PRUEBA, LOS EVENTOS DEBEN CREARSE DESDE UN CONTROLADOR
        })
        calendar.render()
      })
    </script>
@endsection