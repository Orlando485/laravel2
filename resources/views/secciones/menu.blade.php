<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>
    <img src="../../imagenes/logo.png" class="d-block" style="width: 10%;" alt="...">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item active">

          @if (Auth::guard('web')->guest())
        <li>&nbsp;&nbsp;</li>
        <li><a href="{{ route('login') }}">Acceso</a></li>
        <li>&nbsp;&nbsp;</li>
        <li><a href="{{ route('register') }}">Registro</a></li>
        @else

        <a class="nav-link active" href="/">Home
          <span class="visually-hidden">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('clientes.index')}}">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('perfiles.index')}}">Perfiles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('facturas.index')}}">Facturacion</a>
        </li>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('productos.index') }}">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('carrito') }}"><i class="bi bi-cart4" style="font-size: 1.2rem;"></i></a>
        </li>
        
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{Auth::User()->name}}</a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <a href="{{route('logout')}}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"> logout</a>
              <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                {{csrf_field()}}
              </form>
            </li>
          </ul>
        </li>
        @endif
      </ul>
    </div>
</nav>