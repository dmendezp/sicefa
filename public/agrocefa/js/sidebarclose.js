const body = document.querySelector('body'),
    home = document.querySelector('.home'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle");



toggle.addEventListener("click" , () => {
  sidebar.classList.toggle("close");
});

// Cierra el sidebar al hacer clic en el elemento con clase "home"
home.addEventListener("click" , () => {
  sidebar.classList.add("close");
});
