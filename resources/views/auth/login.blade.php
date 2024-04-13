<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>Sistema de reservas FcyT</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
                        <a class="fcytLogin">
                            <img src="{{ asset('imagenes/fcyt-Login.png') }}" alt="l" class="logo-fcyt">
                        </a>
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form>
						<div class="input-group mb-3">
                            <!--estos son iconos por si llega a poner -->
							<!--<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>-->
							<input type="text" name="" class="form-control input_user" value="" placeholder="Ingrese Correo electronico">
						</div>
						<div class="input-group mb-2">
                            <!--estos son iconos por si llega a poner -->
							<!--<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>-->
							<input type="password" name="" class="form-control input_pass" value="" placeholder="Ingrese Contraseña">
						</div>
                        <!--esto es el campo de recordar contraseña -->
						<!--<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Recordar contraseña</label>
							</div>
						</div> -->
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="button" name="button" class="btn login_btn">Iniciar Sesion</button>
				   </div>
					</form>
				</div>
		
				<!--<div class="mt-4">
					<div class="d-flex justify-content-center links">
						<a href="#">Olvidaste tu Contraseña?</a>
					</div> -->

				</div>
			</div>
		</div>
	</div>
</body>
</html>
