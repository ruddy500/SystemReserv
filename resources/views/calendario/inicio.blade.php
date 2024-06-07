@extends('calendario/principal')

@section('style')
	<link href="{!! asset('css/FullCalendar/jquery-ui.min.css') !!}" rel="stylesheet"/>				
	<link href="{!! asset('css/FullCalendar/fullcalendar.css') !!}" rel="stylesheet"/>
	<link href="{!! asset('css/FullCalendar/fullcalendar.print.min.css') !!}" rel="stylesheet" media='print' />
	<style>
		.cuerpo {
			margin: 40px 0px;
			padding: 0;
			font-size: 14px;
		}
		#calendar {
			max-width: 1000px;
			margin: 0 auto;
		}
	</style>  
@endsection
@section('contenido-inicio')
<div class="row">
		<div class="col-md-10 col-md-offset-1">
				<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
				</div>
			<div class="cuerpo">
				<div id='calendar'></div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="{!! asset('js/FullCalendar/moment.min.js') !!}"></script>
	<script src="{!! asset('js/FullCalendar/fullcalendar.js') !!}"></script>
	<script src="{!! asset('js/FullCalendar/es.js') !!}"></script>
	<script>
	$(document).ready(function() {
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			eventRender: function(event, element, view ){
				if(event.rendering === "background"){
				    element.append('<div class="text-center" style="color:'+event.textColor+'; margin-top: 30px;"><strong>'+event.title+'</strong></div>');
				}
			},
			eventClick:  function(event, jsEvent, view) {
                $('#modalTitle').html(event.title);
                $('#start').html(moment(event.start).format('h:mm a'));
                $('#end').html(moment(event.end).format('h:mm a'));
                $('#type').html(event.type);
                $('#eventInfo').html(event.eventInfo);
                $('#detalle').modal();
                return false;
            }
		});
		
	});

</script> 
@endsection