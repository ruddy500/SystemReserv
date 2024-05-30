@extends('index')

@section('informes/informe')
<div class="container mt-3">
    <div class="card vercard">
        <h3 class="card-header">Informe de uso de ambientes</h3>
        <div class="card-body bg-content">
            <div class="Ambientesusados">
                <label class="col-form-label">Ambientes asignados gestión 1/2024:</label>
            </div>
            <!-- TABLA DE AMBIENTES ASIGNADOS O USADOS -->
            <div class="table-responsive margin" style="max-height: 350px; overflow-y: auto;">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="bg-custom-lista">
                        <tr>
                            <th class="text-center h4 text-white">Ambiente</th>
                            <th class="text-center h4 text-white">Fecha</th>
                            <th class="text-center h4 text-white">Periodo</th>
                            <th class="text-center h4 text-white">Materia</th>
                            <th class="text-center h4 text-white">Motivo</th>
                            <th class="text-center h4 text-white">Docente</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <thead class="bg-custom-lista-fila-blanco">
                            <tr>
                                <th class="text-center h4 text-black">690 A</th>
                                <th class="text-center h4 text-black">20-05-2024</th>
                                <th class="text-center h4 text-black">08:15 - 09:45</th>
                                <th class="text-center h4 text-black">Algoritmos</th>
                                <th class="text-center h4 text-black">Examen primer parcial</th>
                                <th class="text-center h4 text-black">Leticia Blanco Coca</th>
                            </tr>
                            <tr>
                                <th class="text-center h4 text-black">690 A</th>
                                <th class="text-center h4 text-black">20-05-2024</th>
                                <th class="text-center h4 text-black">08:15 - 09:45</th>
                                <th class="text-center h4 text-black">Elementos de programación</th>
                                <th class="text-center h4 text-black">Examen primer parcial</th>
                                <th class="text-center h4 text-black">Leticia Blanco Coca</th>
                            </tr>
                        </thead>
                    </tbody>
                </table>
            </div>
            <!-- TOP 10 DE LOS AMBIENTES MAS USADOS -->
            <div class="Ambientesusados">
                <label class="col-form-label">Top 10 ambientes más usados:</label>
            </div>
            <div class="graficoUsoAmbientes">
                <div class="chart">
                    <!-- DATA-HEIGHT ES LAS VECES QUE SE USO UN AMBIENTE -->
                    <h2 class="chart-title">Ambientes</h2>
                    <div class="bar" data-height="80" data-tooltip="Auditorio">80</div>
                    <div class="bar" data-height="60" data-tooltip="690 A">60</div>
                    <div class="bar" data-height="40" data-tooltip="690 B">40</div>
                    <div class="bar" data-height="20" data-tooltip="691 B">20</div>
                    <div class="bar" data-height="70" data-tooltip="692 C">70</div>
                    <div class="bar" data-height="50" data-tooltip="692 D">50</div>
                    <div class="bar" data-height="30" data-tooltip="692 G">30</div>
                    <div class="bar" data-height="90" data-tooltip="693 A">90</div>
                    <div class="bar" data-height="10" data-tooltip="693 B">10</div>
                    <div class="bar" data-height="55" data-tooltip="Laboratorio">55</div>
                </div>
            </div>
            <div class="modal-footer btn-imprimir">
                <button type="submit" class="btn btn-primary submitBtn custom-btn">Imprimir pdf</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const bars = document.querySelectorAll('.bar');
        bars.forEach((bar, index) => {
            const height = bar.getAttribute('data-height');
            setTimeout(() => {
                bar.style.height = height * 3 + 'px';
            }, index * 500);
        })
    })
</script>
@endsection