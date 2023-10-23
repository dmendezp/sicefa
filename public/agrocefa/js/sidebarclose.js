
const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");


toggle.addEventListener("click" , () =>{
  sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
  sidebar.classList.remove("close");
})

modeSwitch.addEventListener("click" , () =>{
  body.classList.toggle("dark");
  
  if(body.classList.contains("dark")){
      modeText.innerText = "Light mode";
  }else{
      modeText.innerText = "Dark mode";
      
  }
});

// Añade un evento clic a los elementos que tienen la clase "has-dropdown"
document.querySelectorAll('.has-dropdown').forEach(function(element) {
  element.addEventListener('click', function() {
      // Alternar la clase "active" para mostrar o ocultar el menú desplegable
      this.classList.toggle('active');
  });
});
