@if(auth()->check())
@extends('index')
@section('menu')
{{-- {{dd(get_defined_vars())}} --}}

<body id="body-pd">
    
    <header class="header" id="header">
        <!-- <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div> -->
        <div class="notificaciones">
            @if (auth()->check())
                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('notificaciones.admin.lista') }}" class="notificaciones-link" id="notificaciones-icon">
                        <i class="bi bi-bell-fill"></i>
                        {{-- <span class="notification-count">{{ session('datoAdmin', 0) }}</span> --}}
                        @if (session('datoAdmin', 0) != 0)
                            <span class="notification-count">{{ session('datoAdmin') }}</span>
                        @endif
                    </a>
                @else
                    <a href="{{ route('notificaciones.lista') }}" class="notificaciones-link" id="notificaciones-icon">
                        <i class="bi bi-bell-fill"></i>
                        {{-- <span class="notification-count">{{ session('datoDocente', 0) }}</span> --}}
                        @if (session('datoDocente', 0) != 0)
                            <span class="notification-count">{{ session('datoDocente') }}</span>
                        @endif
                    </a>
                @endif
            @endif
        </div>
        <div class="perfil-usuario">
            <i class="bi bi-person-circle" id="user-icon"></i>
            <div class="dropdpwn-menu" id="dropdown-menu">
                <!-- <a href="#" class="perfil-link dropdown-item"><i class="bi bi-person"></i><span>Perfil</span></a> -->
                <a href="{{route('login.destroy')}}" class="dropdown-item"><i class="bi bi-box-arrow-right"></i><span>Salir</span></a>
            </div>
        </div>
        <!-- <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div> -->
    </header>
    <div class="l-navbar show-menu" id="nav-bar">
        <nav class="nav">
            <div> 
                <div class="nav_name">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('imagenes/fcytlogo.png') }}" alt="l" class="logo-fcyt">
                    </a>
                </div>
                <div class="nav_list"> 
                     <!--añade el menu apropiado segun el rol que tenga -->
                     @if (auth()->check())
                         @if (auth()->user()->role == 'admin')
                         
                         <a href="{{ route('inicio') }}" class="nav_link active" title="Inicio" onclick="activarBoton(this)"> <i class="bi bi-house"></i> <span class="nav_name">Inicio</span> </a> 
                         <a href="{{ route('ambientes.index') }}" class="nav_link" title="Ambiente" onclick="activarBoton(this)"> <i class="bi bi-buildings"></i> <span class="nav_name">Ambientes</span> </a>
                         <a href="{{ route('reservas.admin.principal') }}" class="nav_link" title="Reserva" onclick="activarBoton(this)"><i class="bi bi-journal-check"></i><span class="nav_name">Reservas</span> </a>
                         <a href="{{ route('avisos.aviso') }}" class="nav_link" title="Avisos" onclick=""><i class="bi bi-megaphone"></i><span class="nav_name">Avisos</span> </a>
                         <a href="{{ route('informes.informe') }}" class="nav_link" title="Informes" onclick=""><i class="bi bi-file-earmark-pdf"></i><span class="nav_name">Informes</span> </a>
                         <a href="{{ route('Anuncios.tablaReglas') }}" class="nav_link" title="Anuncios" onclick=""><i class="bi bi-pin"></i><span class="nav_name">Anuncios</span> </a>
                         <a href="{{ route('calendario.principal') }}" class="nav_link" title="Calendario" onclick=""><i class="bi bi-calendar2-day"></i><span class="nav_name">Calendario</span> </a>
                         @else
                         <a href="{{ route('inicio') }}" class="nav_link active" title="Inicio" onclick="activarBoton(this)"onclick="activarBoton(this)"> <i class="bi bi-house"></i> <span class="nav_name">Inicio</span> </a>  
                         <a href="{{ route('reservas.principal') }}" class="nav_link" title="Reserva" onclick="activarBoton(this)"><i class="bi bi-journal-check"></i><span class="nav_name">Reservas</span> </a>
                         <a href="{{ route('calendario.principalDocente') }}" class="nav_link" title="Calendario" onclick=""><i class="bi bi-calendar2-day"></i><span class="nav_name">Calendario</span> </a>
                         @endif
                     @endif
                    
                     <!-- <div id="menu">
                        @if (auth()->user()->role == 'admin')
                            <button id="userAdminBtn">
                                <i class="bi bi-person-circle"></i>User: Admin
                            </button>
                            
                            <a href="{{route('login.destroy')}}" id="salirLink" style="display: none;">
                                <i class="bi bi-box-arrow-right"></i> Salir
                            </a>
                        @else
                            <button id="userAdminBtn">
                                <i class="bi bi-person-circle"></i>User: {{auth()->user()->name}}
                            </button>

                            <a href="{{route('login.destroy')}}" id="salirLink" style="display: none;">
                                <i class="bi bi-box-arrow-right"></i> Salir
                            </a>
                        @endif
                    </div> -->
                </div>
            </div> 
        </nav>
    </div>
</body>
@endsection
@else
    @php
    header("Location: " . route('login.index'));
    exit();
    @endphp
@endif




