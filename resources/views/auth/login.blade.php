<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesion</title>
</head>
<body>
    <h1>Iniciar Sesion</h1>
    <a href="{{route('register.index')}}">Register</a>
    <div>
    <form class="mt-4" method="POST" action="">
        @csrf
    
        <input type="email"  placeholder="Email"
        id="email" name="email">
    
        <input type="password"  placeholder="Password"
        id="password" name="password">
        
        @error('message')        
          <p>* {{ $message }}</p>
        @enderror

        
        
    
        <button type="submit" >Send</button>
    
    
      </form>
    </div>
</body>
</html>