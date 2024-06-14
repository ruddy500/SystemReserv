@extends('index')

@section('anuncios')
<div class="container mt-3">
    <div class="card">
        <h3 class="card-header">Anuncios</h3>
        <div class="card-body">
            <div class="boton-anuncio">
                
                <a href="{{ route('Anuncios.tablaReglas') }}" class="btn btn-primary custom-btn borde">Reglas</a>

                <a href="{{ route('Anuncios.tablaAnuncios') }}" class="btn btn-primary custom-btn borde">Anuncios</a>

                <button type="button" class="btn btn-primary dropdown-toggle custom-btn" data-bs-toggle="dropdown" aria-expanded="false">
				Registrar
				</button>
				<ul class="dropdown-menu">
				<li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#formularioAnuncio" data-bs-whatever="@mdo">Anuncios Importantes</button></li>
			    <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#formularioReglas" data-bs-whatever="@mdo">Reglas de Ambientes</button></li>
				</ul>
            </div>
            <!-- INCLUYE EL MODAL DE REGISTRO DE ANUNCIO Y REGLAS-->
            @include('anuncios.registro')
            @include('anuncios.reglas')
            
            @yield('contenido-reglas')
			@yield('contenido-anuncios')
            
        </div>
    </div>
</div>
 
@endsection
