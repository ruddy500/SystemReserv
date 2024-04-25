document.addEventListener("DOMContentLoaded", function(event) {
  const toggle = document.getElementById('header-toggle'),
        nav = document.getElementById('nav-bar'),
        bodypd = document.getElementById('body-pd'),
        headerpd = document.getElementById('header'),
        linkColor = document.querySelectorAll('.nav_link');

  const showNavbar = () => {
      // Check if the menu is currently expanded
      const isMenuExpanded = nav.classList.contains('show-menu');

      // If the menu is expanded, collapse it; otherwise, expand it
      nav.classList.toggle('show-menu', !isMenuExpanded);
      bodypd.classList.toggle('body-pd', !isMenuExpanded);
      headerpd.classList.toggle('body-pd', !isMenuExpanded);
  };

  if (toggle && nav && bodypd && headerpd) {
      toggle.addEventListener('click', showNavbar);
  }

  /*===== LINK ACTIVE =====*/
  window.onload = function() {
    var botones = document.getElementsByClassName("nav_link");
    var botonActivo = null;
    for (var i = 0; i < botones.length; i++) {
        if (window.location.href.indexOf(botones[i].href) >= 0) {
            // Si este botón corresponde a una ruta más específica que el botón activo actual,
            // entonces este botón se convierte en el nuevo botón activo
            if (botonActivo == null || botones[i].href.length > botonActivo.href.length) {
                if (botonActivo != null) {
                    botonActivo.classList.remove("active");
                }
                botonActivo = botones[i];
                botonActivo.classList.add("active");
            }
        } else {
            botones[i].classList.remove("active");
        }
    }
}


// ---**************************************************************

$(function () {
    $.fn.datepicker.dates['es'] = {
      days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      daysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
      daysMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
      months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      today: 'Hoy',
      clear: 'Limpiar',
      format: 'dd/mm/yyyy',
      titleFormat: "MM yyyy",
      weekStart: 1
    };

    $("#datepicker").datepicker({
      language: 'es',
      autoclose: true,
      todayHighlight: true,
    }).datepicker('update', new Date());
  });

});

$(document).ready(function() {
    $('#horario-select').selectpicker();
    $('.bs-select-all').text('Seleccionar todo');
    $('.bs-deselect-all').remove();
    $(window).resize(function() {
        // Re inicializar el selectpicker 
        setTimeout(function() {
            $('#horario-select').selectpicker('refresh');
        }, 100);
    });
});

document.getElementById('userAdminBtn').addEventListener('click', function() {
    var salirLink = document.getElementById('salirLink');
    if (salirLink.style.display === 'none') {
        salirLink.style.display = 'block';
    } else {
        salirLink.style.display = 'none';
    }
});

function activarBoton(elemento) {
    var botones = document.getElementsByClassName("menuBtn");
    for (var i = 0; i < botones.length; i++) {
        botones[i].classList.remove("active");
    }
    elemento.classList.add("active");
}
