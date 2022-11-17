<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('index')}}" class="nav-link ">Home</a>
      </li>
      
      <!--{{--
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('contacto')}}" class="nav-link">Contact</a>
      </li>
      --}}
      -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
         
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
      <li class="nav-item" title="Salir">
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
      @csrf
      <button type="submit" class="btn btn-outline nav-link"><i class="fas fa-sign-out-alt" ></i></button>
      </form>
        
      </li>
    </ul>
  </nav>

  
