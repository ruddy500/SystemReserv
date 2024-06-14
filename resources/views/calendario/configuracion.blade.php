@extends('calendario/principal')

@section('contenido-configuracion')
{{-- {{ dd(get_defined_vars()) }} --}}
<style>
    @media (max-width: 576px) {
        .row.mb-3 [class^="col"] {
            margin-top: 10px;
        }
    }
</style>
<div class="cont-config" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px;">
    <form id="formulario-configuraciongestion" action="{{ route('calendario.configurar.registrar') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        <!-- CAMPO DE GESTION ACADEMICA -->
        <div class="tituloConfiguracion">
            <label class="col-form-label" style="font-weight: bold;">Gestión académica y Periodo de exámenes</label>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="gestion-name" class="col-form-label h4">Gestión:</label>
                <input type="text" class="form-control" id="gestion" name="gestion" placeholder="{{ isset($configuraciones[0]->Gestion) ? $configuraciones[0]->Gestion : '1-20XX' }}">
    
                {{-- <input type="text" class="form-control" id="fechaini" placeholder="1-20XX"> --}}
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="row mb-3">
        
             <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechaInicial-name" class="col-form-label h4">Fecha inicial:</label>
                <div class="input-group date datepicker">
                    <input name="fecha_i" type="text" class="form-control" placeholder="{{ isset($configuraciones[0]->FechaInicial) ? $configuraciones[0]->FechaInicial : 'dd-mm-yyyy' }}" readonly>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div class="input-group date datepicker">
                    <input name="fecha_f" type="text" class="form-control" placeholder="{{ isset($configuraciones[0]->FechaFinal) ? $configuraciones[0]->FechaFinal : 'dd-mm-yyyy' }}" readonly>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>

            
        </div>
        <!-- CAMPO DE PRIMER PARCIAL EXAMENES DE MESA -->
        <div class="tituloConfiguracion">
            <label class="col-form-label" style="font-weight: bold;">Primer ciclo de exámenes de mesa</label>
        </div>
        <div class="row mb-3">

            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha inicial:</label>
                <div class="input-group date datepicker">
                    <input name="fecha_ini_mesa" type="text" class="form-control" placeholder="{{ isset($configuraciones[1]->FechaInicial) ? $configuraciones[1]->FechaInicial : 'dd-mm-yyyy' }}" readonly>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div class="input-group date datepicker">
                    <input name="fecha_fin_mesa" type="text" class="form-control" placeholder="{{ isset($configuraciones[1]->FechaFinal) ? $configuraciones[1]->FechaFinal : 'dd-mm-yyyy' }}" readonly>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>

        </div>
        <!-- CAMPO DE PRIMEROS PARCIALES -->
        <div class="tituloConfiguracion">
            <label class="col-form-label" style="font-weight: bold;">Primer ciclo de exámenes</label>
        </div>
        <div class="row mb-3">
            
            
            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha inicial:</label>
                <div class="input-group date datepicker">
                    <input name="fecha_ini_primer" type="text" class="form-control" placeholder="{{ isset($configuraciones[2]->FechaInicial) ? $configuraciones[2]->FechaInicial : 'dd-mm-yyyy' }}" readonly>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>

            

            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha final:</label>
                <div class="input-group date datepicker">
                    <input name="fecha_fin_primer" type="text" class="form-control" placeholder="{{ isset($configuraciones[2]->FechaFinal) ? $configuraciones[2]->FechaFinal : 'dd-mm-yyyy' }}" readonly>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>


        </div>
        <!-- CAMPO SEGUNDOS PARCIALES -->
        <div class="tituloConfiguracion">
            <label class="col-form-label" style="font-weight: bold;">Segundo ciclo de exámenes</label>
        </div>
        <div class="row mb-3">

            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha inicial:</label>
                <div class="input-group date datepicker">
                    <input name="fecha_ini_segundo" type="text" class="form-control" placeholder="{{ isset($configuraciones[3]->FechaInicial) ? $configuraciones[3]->FechaInicial : 'dd-mm-yyyy' }}" readonly>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha final:</label>
                <div class="input-group date datepicker">
                    <input name="fecha_fin_segundo" type="text" class="form-control" placeholder="{{ isset($configuraciones[3]->FechaFinal) ? $configuraciones[3]->FechaFinal : 'dd-mm-yyyy' }}" readonly>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>


        </div>
        <!-- CAMPO TERCEROS PARCIALES COMO FINAL, MESA, INSTANCIA Y ETC -->
        <div class="tituloConfiguracion">
            <label class="col-form-label" style="font-weight: bold;">Tercer ciclo de exámenes</label>
        </div>
        <div class="row mb-3">
            
            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha inicial:</label>
                <div class="input-group date datepicker">
                    <input name="fecha_ini_tercero" type="text" class="form-control" placeholder="{{ isset($configuraciones[4]->FechaInicial) ? $configuraciones[4]->FechaInicial : 'dd-mm-yyyy' }}" readonly>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha final:</label>
                <div class="input-group date datepicker">
                    <input name="fecha_fin_tercero" type="text" class="form-control" placeholder="{{ isset($configuraciones[4]->FechaFinal) ? $configuraciones[4]->FechaFinal : 'dd-mm-yyyy' }}" readonly>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>


        </div>
        <div class="botonGuardar" style="margin-top:20px; text-align: right;">
            <button type="submit" class="btn btn-primary custom-btn" id="guardarBtn">Guardar</button>
        </div>
    </form>
</div>
{{-- <script>
    document.getElementById('guardarBtn').addEventListener('click', function() {
        Swal.fire({
            text: 'Configuración guardada exitosamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'

        });
     
    });
</script> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Datepicker localization -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar los datepickers
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                language: 'es',
                autoclose: true,
                todayHighlight: true,
                startDate: '+0d'
            });

            // Configurar el evento del botón de guardar
            $('#guardarBtn').on('click', function() {
                Swal.fire({
                    text: 'Configuración guardada exitosamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            });
        });
    </script>
@endsection
