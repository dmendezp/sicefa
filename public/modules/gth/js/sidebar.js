document.addEventListener("DOMContentLoaded", () => {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const navbar = document.querySelector('.navbar'); // Agregar la selección del navbar
    const content = document.querySelector('.content');

    sidebarToggle.addEventListener('click', () => {
      if (sidebar.style.left === '-250px' || sidebar.style.left === '') {
        sidebar.style.left = '0';
        content.style.marginLeft = '250px';
        navbar.style.marginLeft = '250px'; // Mover el navbar hacia la derecha
      } else {
        sidebar.style.left = '-250px';
        content.style.marginLeft = '0';
        navbar.style.marginLeft = '0'; // Volver a la posición original del navbar
      }
    });
  });
