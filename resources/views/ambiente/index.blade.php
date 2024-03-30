<h1>hola como estas </h1>

<a href="ambiente/create" class="btn btn-primary">+ Registrar ambiente</a>

<table>
    <tr>
        
        <th>Habilitar</th>
        <th>Nombre</th>
        <th>Ubicacion</th>
        <th>Capacidad</th>
        
        <th>Opciones</th>
    </tr>
    <tbody>
        @foreach($ambientes as $ambiente)
            <tr>
                <td>{{$ambiente->Habilitado}}</td>
                <td>{{$ambiente->Nombre}}</td>
                <td>{{$ambiente->Ubicacion}}</td>
                <td>{{$ambiente->Capacidad}}</td>
                <td>
                    <button>Horario</button>
                    {{-- <a href="/ambiente/verdetalles">Ver detalles</a> --}}
                    <a href="{{ route('ambiente.verdetalles', ['ubicacion' => $ambiente->Ubicacion, 'nombre' => $ambiente->Nombre, 'capacidad' => $ambiente->Capacidad]) }}">Ver detalles</a>
                    <button>Editar</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>