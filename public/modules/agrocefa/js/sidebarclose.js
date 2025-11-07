const body = document.querySelector('body'),
    home = document.querySelector('.home'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle");



toggle.addEventListener("click" , () => {
  sidebar.classList.toggle("close");
});

sidebar.addEventListener("mouseenter" , () => {
  sidebar.classList.remove("close"); // Remueve la clase "close" para expandir el sidebar
});

sidebar.addEventListener("mouseleave", () => {
  sidebar.classList.add("close"); // Agrega la clase "close" para cerrar el sidebar
});

// Cierra el sidebar al hacer clic en el elemento con clase "home"
home.addEventListener("click" , () => {
  sidebar.classList.add("close");
});
