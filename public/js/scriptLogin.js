const passwordInput = document.getElementById('password');
const togglePassword = document.getElementById('login-eye');

togglePassword.addEventListener('click', function() {
  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordInput.setAttribute('type', type);
  
  // Cambiar el icono dependiendo del tipo de contraseña
  if (type === 'password') {
    togglePassword.classList.remove('bi-eye-fill');
    togglePassword.classList.add('bi-eye-slash-fill');
  } else {
    togglePassword.classList.remove('bi-eye-slash-fill');
    togglePassword.classList.add('bi-eye-fill');
  }
});
/*
document.querySelector(".login__form").addEventListener("submit", function(event) {
  event.preventDefault(); // Prevenir la recarga de la página

  // Aquí debes verificar las credenciales. Esto es solo un ejemplo.
  var email = document.querySelector("#email").value;
  var password = document.querySelector("#password").value;

  if (email !== "usuario@ejemplo.com" || password !== "1234") {
    // Si las credenciales son incorrectas, mostrar el mensaje de error
    var errorMessage = document.querySelector("#error-message");
    errorMessage.textContent = "Credenciales incorrectas";
    errorMessage.style.display = "block";
  } else {
    // Si las credenciales son correctas, enviar el formulario
    this.submit();
  }
});*/
