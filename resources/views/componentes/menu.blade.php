@if(auth()->check())
@extends('index')
@section('menu')
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
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
     
                         @else
                         <a href="{{ route('inicio') }}" class="nav_link active" title="Inicio" onclick="activarBoton(this)"onclick="activarBoton(this)"> <i class="bi bi-house"></i> <span class="nav_name">Inicio</span> </a>  
                         <a href="{{ route('reservas.principal') }}" class="nav_link" title="Reserva" onclick="activarBoton(this)"><i class="bi bi-journal-check"></i><span class="nav_name">Reservas</span> </a>
                         @endif
                     @endif
                    
                     <div id="menu">
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
                    </div>
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




