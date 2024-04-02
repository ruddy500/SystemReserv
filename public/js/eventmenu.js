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
  function colorLink(event) {
      // Remove the 'active' class from all links
      linkColor.forEach(l => l.classList.remove('active'));

      // Add the 'active' class to the clicked link
      this.classList.add('active');

      // Save the current selection in session storage
      sessionStorage.setItem('selectedLink', this.href);
  }

  // Load the saved selection from session storage
  const selectedLink = sessionStorage.getItem('selectedLink');
  if (selectedLink) {
      // Remove the 'active' class from all links
      linkColor.forEach(l => l.classList.remove('active'));

      // Add the 'active' class to the saved link
      const linkElement = document.querySelector(`.nav_link[href="${selectedLink}"]`);
      if (linkElement) {
          linkElement.classList.add('active');
      }
  }

  linkColor.forEach(l => l.addEventListener('click', colorLink));
});
