
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!----======== CSS ======== -->
  <link rel="stylesheet" href="{{ asset('agrocefa/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('agrocefa/css/estilos.css')}}">
  <link rel="stylesheet" href="{{ asset('agrocefa/css/footer.css') }}">
  <link rel="stylesheet" href="{{ asset('agrocefa/css/target.css') }}">
  <link rel="stylesheet" href="{{ asset('agrocefa/css/stilos.css') }}">

  
  <!----===== Boxicons CSS ===== -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
 
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://kit.fontawesome.com/dcb1bbced2.css" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/dcb1bbced2.js" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
  <!--<title>Dashboard Sidebar Menu</title>--> 
</head>
<body>
  
  <nav class="sidebar close">
      <header>
          <div class="image-text">
              <span class="image">
                  <!--<img src="logo.png" alt="">-->
              </span>

              <div class="text logo-text">
                <span class="profession text-center" ><center><i class="fas fa-tractor"></center></i></span>
                <span class="name">AGROCEFA</span>
                 
              </div>
          </div>

          <i class='bx bx-chevron-right toggle'></i>
      </header>

      <div class="menu-bar">
          <div class="menu">

              

              <ul class="menu-links">
                  <li class="nav-link">
                      <a href="#">
                          <i class='bx bx-user-check icon'></i>
                          <span class="text nav-text">Parametros</span>
                      </a>
                  </li>

                  <li class="nav-link">
                      <a href="{{route('agrocefa.inventory')}}">
                          <i class='bx bx-list-check icon'></i>
                          <span class="text nav-text">Inventario</span>
                      </a>
                  </li>

                  <li class="nav-link">
                      <a href="{{route('agrocefa.bodegas')}}">
                        <i class='bx bx-store-alt icon'></i>
                          <span class="text nav-text">Bodegas</span>
                      </a>
                  </li>

                  <li class="nav-link">
                      <a href="{{route('agrocefa.insumos')}}">
                          <i class='bx bx-leaf icon' ></i>
                          <span class="text nav-text">Insumos</span>
                      </a>
                  </li>

                  <li class="nav-link">
                      <a href="#">
                          <i class='bx bxs-hard-hat icon'></i>
                          <span class="text nav-text">Labores</span>
                      </a>
                  </li>
              </ul>
          </div>

          <div class="bottom-content">
            <li class="">
                <a href="{{ route('login')}}">
                    <i class='bx bx-lock-open icon'></i>
                    <span class="text nav-text">login</span>
                </a>
            </li>
            <li class="">
                  <a href="{{ route('cefa.welcome')}}">
                      <i class='bx bx-log-out icon' ></i>
                      <span class="text nav-text">SICEFA</span>
                  </a>
              </li> 
          </div>
      </div>

  </nav>

  <section class="home">
      <div class="text">AGROCEFA
        <a href="{{ route('agrocefa.index') }}" id="an">Inicio</a>
        <a href="" id="an1">Nosotros</a>
      </div>
      @yield('content')
  </section>
  <script>
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
  </script>

</body>
</html> 