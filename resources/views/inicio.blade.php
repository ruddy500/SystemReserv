@if(auth()->check())
@extends('index')


@section('inicio')
{{-- {{ dd(get_defined_vars()) }} --}}
<style>
    .list-group-item-dark {
      font-weight: bold;
      text-align: center;
    }
    .list-group-item {
      text-align: center;
    }
    .ml-3 { 
      margin-left: 1rem; 
    }
    .profileUser {
      width: 80px; /*ancho */
      height: 90px; 
    }
    .bienvenida-sistema{
        margin-top: 25px;
    }
    .fotofacultad {
      max-width: 100%; /* Establece el ancho máximo al 100% del contenedor padre */
      height: auto; /* Mantiene la relación de aspecto de la imagen */
    }
    .logo-umss {
        margin-top: 10px;
      width: 80px; 
      height: 100px; /* altura */
    }
    .anuncio-inicio{
        margin-top: 0.5cm; /* Separación de medio centímetro arriba */
        margin-bottom: 0.5cm;
    }
    .header-anuncio{
        color:$orange-100 ;
    }
    .c-anuncio {
      background-color:#ffeeba;
      margin-top: 15px;
    }
    .texto-bienv p {
        margin: 3px 0; /* Reduce el margen entre los párrafos */
    }

    @media (min-width: 1350px) {
        .container-inicio {
            margin-left: -65px; 
        }
    }
  </style>
<!-- Contenedor principal -->
<div class="container-inicio">
    <div class="container mt-5">
        <div class="row">
            <!-- Panel de INICIO -->
            <div class="col-md-9">
                <div class="card custom-width mt-3">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center;">Bienvenidos al sistema de reservas  de la FCyT</h5>
                        <!-- BIENVENIDA DEL SISTEMA -->
                        <div class="container bienvenida-sistema">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="texto-bienv">
                                        <p><small>La Facultad de Ciencias y Tecnología de la Universidad Mayor de San Simón (UMSS) fue fundada en la década del 60 como un Instituto de Ciencias Básicas.</small></p>
                                        <p><small>En 1972, se creó la Facultad de Ciencias Puras y Naturales, que posteriormente se convirtió en la Facultad de Ciencias y Tecnología en 1979.</small></p>
                                        <p><small>Esta facultad alberga programas académicos en diversas áreas científicas y tecnológicas, incluyendo ingeniería eléctrica, industrial y mecánica, entre otros.</small></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="picture-fcyt">
                                        <img src="{{ asset('imagenes/fcytPicture.jpg') }}" alt="l" class="fotofacultad">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- LISTA DE ANUNCIOS -->
                        <div class="lista-anuncios">
                            @for ($i=0;$i<$tam;$i++)
                                <div class="card c-anuncio">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="bi bi-exclamation-triangle"></i>    {{$anuncios[$i]->Titulo}}</h5>
                                        <p class="card-text"> {{$anuncios[$i]->Contenido}}</p>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <!-- Panel de INFORMACION GENERAL DEL USUARIO -->
            <div class="col-md-3">
                <div class="card custom-width mt-3">
                    <h3 class="card-header">Información personal</h3>
                    <div class="card-body bg-content">
                        <div class="panel-body center-block">
                            <div class="text-center">
                                <img src="{{ asset('imagenes/iconUser.png') }}" alt="l" class="profileUser">
                            </div>
                            <!-- DATOS INFORMACION USUARIO -->
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-dark">Tipo de usuario</li>
                                <li class="list-group-item">{{auth()->user()->role}}</li>
                                <li class="list-group-item list-group-item-dark">Nombre de usuario</li>
                                <li class="list-group-item">{{auth()->user()->name}}</li>
                                <li class="list-group-item list-group-item-dark">Email</li>
                                <li class="list-group-item">{{auth()->user()->email}}</li>
                            </ul>
                            <div class="text-center">
                                <img src="{{ asset('imagenes/logoUmss-01.png') }}" alt="l" class="logo-umss">
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    
@else
@php
header("Location: " . route('login.index'));
exit();
@endphp
@endif
