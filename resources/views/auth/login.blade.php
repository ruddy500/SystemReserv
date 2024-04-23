<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/login.css">

    <title>Sistema de Reservas FCyT</title>
</head>
<body>
    <div class="login">
        <img src="imagenes/FondoLogin.jpg" alt="login image" class="login__img">

        <form class="login__form" action=""  method="POST">
            @csrf
            <div class="LogoFcyt">
                <img src="{{ asset('imagenes/fcyt-Login.png') }}" alt="l" class="logo-fcyt">
            </div>

            @if ($errors->any())
               <div class="alert alert-danger">
                   {{ $errors->first() }}
               </div>
            @endif

            <div class="login__content">
                <div class="login__box">
                    <i class="bi bi-person-fill"></i>

                    <div class="login__box-input">
                        <input type="email" name="email" required autocomplete="email" required class="login__input" id="email" placeholder=" ">
                        <label for="login-email" class="login__label">Correo Electronico</label>
                    </div>
                </div>

                <div class="login__box">
                    <i class="bi bi-lock-fill"></i>

                    <div class="login__box-input">
                        <input type="password" name= "password" required autocomplete="current-password" required class="login__input" id="password" placeholder=" ">
                        <label for="login-pass" class="login__label">Contraseña</label>
                        <i class="bi bi-eye-slash-fill login__eye" id="login-eye"></i>
                    </div>
                </div>
            </div>
            <!-- <div class="login__check"> -->
				 <!--=============== Check para recordar contraseña ===============-->
               <!-- <div class="login__check-group"> -->
                  <!-- <input type="checkbox" class="login__check-input" id="login-check"> -->
                  <!-- <label for="login-check" class="login__check-label">Recordar Contraseña</label> -->
               <!-- </div> -->
				 <!--=============== refencia para recuperar contraseña ===============-->
               <!-- <a href="#" class="login__forgot">Olvidaste tu contraseña?</a> -->
            <!-- </div> -->

            <button type="submit" class="login__button">Iniciar Sesion</button>
        </form>
    </div>
    <script src="js/scriptLogin.js"></script>
</body>
</html>
