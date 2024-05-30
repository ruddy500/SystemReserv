@extends('index')

@section('notificaciones/rechazo')
{{-- {{ dd(get_defined_vars()) }} --}}
<div class="container mt-3">
    <div class="card vercard">
        <!-- ASUNTO DE LA RECHAZO-->
        <h3 class="card-header">Rechazo de solicitud de reserva</h3>
        <div class="card-body bg-content">
            <!-- FECHA DE LLEGADA DE NOTIFICACION -->
            <div class="notifLLegada" style="display: flex; justify-content: flex-end;">
                <small class="fechaLlegada">Sab, 06 de Mayo (hace 17 horas)</small>
            </div>
            <!-- MENSAJE O MOTIVO INSERTADO AL ENVIAR CORREO -->
            <div class="contenido-mensaje" style="max-width: 30rem; margin: auto;">
                <p style="margin-bottom: 5px;">Estimado/a.</p>
                <p style="margin-bottom: 5px;">¡Esperamos que este mensaje le encuentre muy bien. Te escribimos desde el Sistema de Reservas FCyT.</p>
                <p style="margin-bottom: 5px;">Debido a la no existencia de ambientes para su solicitud de reserva se informa que su solicitud ha sido Rechazada.</p>
            </div>
            <hr>
            <div class="detalleReserva">
                <!-- DETALLE DE RESERVA -->
                <label for="detalle" class="col-form-label" style="font-weight: bold;">Detalle reserva (Poner si es individual o grupal):</label>
                <hr>
                <div class="tabla-Detalle">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td style="width: 50%;">Nombre docente</td>
                                <td style="width: 50%;">Leticia Blanco Coca</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Cantidad de estudiantes</td>
                                <td style="width: 50%;">85</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Motivo reserva</td>
                                <td style="width: 50%;">Examen primer parcial</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Fecha</td>
                                <td style="width: 50%;">05-06-2024</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Periodo</td>
                                <td style="width: 50%;">08:15-09:45</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Tipo de ambiente</td>
                                <td style="width: 50%;">Aula comun</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Materia</td>
                                <td style="width: 50%;">Elemento de programación</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Grupo(s)</td>
                                <td style="width: 50%;">1, 2, si es grupal poner el nombre del docente y su grupo aqui</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <!-- MENSAJE FINAL -->
            <div class="mensajeDespedida">
                <p style="margin-bottom: 5px;">Agradecemos tu atención y estamos aqui para cualquier consulta.</p>
                <p style="margin-bottom: 5px;">Atentamente, Administración.</p>
            </div>
            <hr>
            <!-- MENSAJE POR DEFECTO -->
            <div class="mensajeAda" style="max-width: 30rem; margin: auto;">
                <p class="tamAda" style="font-size: 0.9rem;">Este mensaje ha sido generado automaticamente por el sistema de reservas. Si no esperabas este correo, o tienes alguna duda, por favor contáctanos.</p>
            </div>
        </div>
    </div>
</div>
@endsection