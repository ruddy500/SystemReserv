@extends('reservas/principal')

@section('contenido-pendientes')
<div class="card-body bg-content" style="border-radius: 5px;">
    <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
        <table class="table table-striped table-hover table-bordered">
            <thead class="bg-custom-lista">
                <tr>
                    <th class="text-center h4 text-white">Fecha</th>
                    <th class="text-center h4 text-white">Hora inicio</th>
                    <th class="text-center h4 text-white">Hora fin</th>
                    <th class="text-center h4 text-white">Motivo</th>
                    <th class="text-center h4 text-white">Opciones</th>
                </tr>
            </thead>
            <!-- Fila Ploma -->
            <thead class="bg-custom-lista-fila-plomo">	
                <tr>
                    <th class="text-center h4 text-black">30-05-2024</th>
                    <th class="text-center h4 text-black">06:45</th>
                    <th class="text-center h4 text-black">09:45</th>
                    <th class="text-center h4 text-black">Examen de mesa</th>
                    <th class="text-center h4 text-black">
                        <div class="d-flex justify-content-center">
                            <!-- SI ES RESERVA INDIVIDUAL SE MUESTRA ESTA HOJA DE VER -->
                            <div class="circle2">
                                <a href="{{ route('reservas.verIndividual')}}" class="btn btn-fab" title="Ver"> 
                                    <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                </a>
                            </div>
                            <div class="circle3">
                                <a href="{{ route('reservas.editar')}}" class="btn btn-fab" title="Editar">
                                    <i class="fas fa-edit" style="color: white;"></i>  
                                </a>
                            </div>
                                    
                            <div class="circle5">
                                <a href="#" class="btn btn-fab eliminar-reserva" title="Eliminar"> 
                                    <i class="bi bi-trash3-fill" style="color: white;"></i>
                                    <input type="hidden" class="id-reserva" value="">
                                </a>						
                            </div>
            
                        </div>
                    </th>
                </tr>
            </thead> 
            <!-- Fila blanca -->
            <thead class="bg-custom-lista-fila-blanco">
                <tr>
                    <th class="text-center h4 text-black">30-04-2024</th>
                    <th class="text-center h4 text-black">11:15</th>
                    <th class="text-center h4 text-black">12:45</th>
                    <th class="text-center h4 text-black">Seminario</th>
                    <th class="text-center h4 text-black">
                        <div class="d-flex justify-content-center">
                            <!-- SI ES RESERVA GRUPAL SE MUESTRA ESTA HOJA DE VER -->
                            <div class="circle2">
                                <a href="{{ route('reservas.verGrupal')}}" class="btn btn-fab" title="Ver"> 
                                    <i class="bi bi-box-arrow-up-right" style="color: white;"></i>	
                                </a>
                            </div>
                            <div class="circle3">
                                <a href="{{ route('reservas.editar')}}" class="btn btn-fab" title="Editar">
                                    <i class="fas fa-edit" style="color: white;"></i>  
                                </a>
                            </div>
            
                            <div class="circle5">
                                <a href="#" class="btn btn-fab eliminar-reserva" title="Eliminar"> 
                                    <i class="bi bi-trash3-fill" style="color: white;"></i>
                                    <input type="hidden" class="id-reserva" value="">
                                </a>						
                            </div>

                        </div>
                    </th>
                </tr>
            </thead> 	
            
        </table>
    </div>
</div>
@endsection