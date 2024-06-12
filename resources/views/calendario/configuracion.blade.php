@extends('calendario/principal')

@section('contenido-configuracion')
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
                <input type="text" class="form-control" id="fechaini" placeholder="1-20XX">
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha inicial:</label>
                <div id="datepicker-gestionini" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha_i" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div id="datepicker-gestionfinal" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha_f" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
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
                <div id="datepicker-ppmesaini" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha_ini_mesa" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div id="datepicker-ppmesafinal" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha_fin_mesa" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
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
                <div id="datepicker-ppini" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha_ini_primer" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div id="datepicker-ppfinal" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha_fin_primer" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
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
                <div id="datepicker-spini" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha_ini_segundo" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div id="datepicker-spfinal" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha_fin_segundo" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
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
                <div id="datepicker-tercerini" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha_ini_tercero" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
            <div class="col-md-6">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div id="datepicker-tercerfinal" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha_fin_tercero" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
        </div>
        <div class="botonGuardar" style="margin-top:20px; text-align: right;">
            <button type="submit" class="btn btn-primary custom-btn" id="guardarBtn">Guardar</button>
        </div>
    </form>
</div>
<script>
    document.getElementById('guardarBtn').addEventListener('click', function() {
        Swal.fire({
            text: 'Configuración guardada exitosamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'

        });
    });
</script>
@endsection
