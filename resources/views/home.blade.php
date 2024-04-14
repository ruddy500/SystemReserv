<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaravelInicioSession</title>
</head>
<body>
    <h1>Bienvenidos a mi aplicacion</h1>

    <li>
        @if (auth()->check())
            <h1>Welcome {{auth()->user()->name}}</h1>
            <h1>Welcome {{auth()->user()->id}}</h1>
            <a href="{{route('login.destroy')}}">logOut</a>
            
        @else
            <a href="{{route('login.index')}}">logIn</a>
            <a href="{{route('register.index')}}">Register</a>
      
        @endif
        
    </li>
</body>
</html>