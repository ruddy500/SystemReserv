@extends('index')


@section('calendario/principal')
<div class="container mt-3">
	<div class="card  vercard">
		<h3 class="card-header">Calendario</h3>
		<div class="card-body">
            <div class="bs-component">
		        <div class="panel-body">
					<div class="row">
                        <div class="container">
                            <!-- Contenedor donde se mostrará el calendario -->
                            <div id='calendar'></div>
                        </div>
					</div>
	            </div>
        	</div>
        </div>
    </div>
</div>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es', // Para mostrar el calendario en español
                events: [
                    { title: 'Evento 1', start: '2024-06-01' },
                    { title: 'Evento 2', start: '2024-06-07', end: '2024-06-10' },
                ]//aqui se crean los eventos 
            });
            calendar.render();
        });
</script>
@endsection