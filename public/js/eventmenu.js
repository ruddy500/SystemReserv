document.addEventListener("DOMContentLoaded", function(event) {
    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
      const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)

      // Validate that all variables exist
      if(toggle && nav && bodypd && headerpd){
          // show navbar
          nav.classList.toggle('show-menu')
          bodypd.classList.toggle('body-pd')
          headerpd.classList.toggle('body-pd')
      }
    }

    showNavbar('header-toggle','nav-bar','body-pd','header')

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink(){
       if(linkColor){
         linkColor.forEach(l=> l.classList.remove('active'))
         this.classList.add('active')
       }
    }
    /*function colorLink() {
      event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
      $('.nav_link').removeClass('active'); // Remover la clase 'active' de todos los enlaces
      $(this).addClass('active'); // Agregar la clase 'active' al enlace clickeado
    }
    
    $('.nav_link').on('click', colorLink);*/

    linkColor.forEach(l=> l.addEventListener('click', colorLink))
  });