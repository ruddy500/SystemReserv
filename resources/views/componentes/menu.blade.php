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
                    <a href="{{ route('inicio') }}" class="nav_link active"> <i class="bi bi-house"></i> <span class="nav_name">Inicio</span> </a> 
                    <a href="{{ route('ambientes.index') }}" class="nav_link"> <i class="bi bi-buildings"></i> <span class="nav_name">Ambientes</span> </a>
                </div>
            </div> 
        </nav>
    </div>
</body>
@endsection