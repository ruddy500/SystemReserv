const passwordInput = document.getElementById('login-pass');
const togglePassword = document.getElementById('login-eye');

togglePassword.addEventListener('click', function() {
  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordInput.setAttribute('type', type);
  
  // Cambiar el icono dependiendo del tipo de contraseña
  if (type === 'password') {
    togglePassword.classList.remove('bi-eye-slash-fill');
    togglePassword.classList.add('bi-eye-fill');
  } else {
    togglePassword.classList.remove('bi-eye-fill');
    togglePassword.classList.add('bi-eye-slash-fill');
  }
});
