@extends('calendario/principal')

@section('contenido-configuracion')
<div class="cont-config" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px;">
    <form id="formulario-configuraciongestion" action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <!-- CAMPO DE GESTION ACADEMICA -->
        <div class="tituloConfiguracion">
            <label class="col-form-label" style="font-weight: bold;">Gestión académica y Periodo de exámenes</label>
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="gestion-name" class="col-form-label h4">Gestión:</label>
                    <input type="text" class="form-control" id="fechaini" placeholder="1-20XX">
                </div>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha inicial:</label>
                <div id="datepicker-gestionini" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
            <div class="col">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div id="datepicker-gestionfinal" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
        </div>
        <!-- CAMPO DE PRIMER PARCIAL EXAMENES DE MESA -->
        <div class="tituloConfiguracion">
            <label class="col-form-label" style="font-weight: bold;">Primer ciclo de exámenes de mesa</label>
        </div>
        <div class="row">
            <div class="col">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha inicial:</label>
                <div id="datepicker-ppmesaini" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
            <div class="col">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div id="datepicker-ppmesafinal" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
        </div>
        <!-- CAMPO DE PRIMEROS PARCIALES -->
        <div class="tituloConfiguracion">
            <label class="col-form-label" style="font-weight: bold;">Primer ciclo de exámenes</label>
        </div>
        <div class="row">
            <div class="col">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha inicial:</label>
                <div id="datepicker-ppini" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
            <div class="col">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div id="datepicker-ppfinal" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
        </div>
        <!-- CAMPO SEGUNDOS PARCIALES -->
        <div class="tituloConfiguracion">
            <label class="col-form-label" style="font-weight: bold;">Segundo ciclo de exámenes</label>
        </div>
        <div class="row">
            <div class="col">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha inicial:</label>
                <div id="datepicker-spini" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
            <div class="col">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div id="datepicker-spfinal" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
        </div>
        <!-- CAMPO TERCEROS PARCIALES COMO FINAL, MESA, INSTANCIA Y ETC -->
        <div class="tituloConfiguracion">
            <label class="col-form-label" style="font-weight: bold;">Tercer ciclo de exámenes</label>
        </div>
        <div class="row">
            <div class="col">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechainicial-name" class="col-form-label h4">Fecha inicial:</label>
                <div id="datepicker-tercerini" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
            <div class="col">
                <!-- CAMPO DE FECHA CON CALENDARIO -->
                <label for="fechafinal-name" class="col-form-label h4">Fecha final:</label>
                <div id="datepicker-tercerfinal" class="input-group date" data-date-format="dd-mm-yyyy">
                    <input name="fecha" class="form-control" type="text" readonly />
                    <span class="input-group-addon"></span>
                </div>
            </div>
        </div>
        <div class="botonGuardar" style="margin-top:20px; text-align: right;">
            <button type="button" class="btn btn-primary custom-btn">Guardar</button>
        </div>
    </form>
</div>
@endsection