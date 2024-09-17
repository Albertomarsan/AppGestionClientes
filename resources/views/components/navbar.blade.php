<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/home') }}">HOME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link disabled" >Usuarios</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('customers') }}">Clientes</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->email }}
          </a>
          <div class="dropdown-menu">
            
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" >
              @csrf
              @method('DELETE')
              <button class="dropdown-item btn btn-danger" type="submit">Desconectar</button>
            </form>
            <div class="dropdown-divider"></div>
            @if(isset(Auth::user()->customer))
              <a class="dropdown-item" href="{{ url("profile/". Auth::user()->customer->id) }}">Perfil</a>
            @endif
          </div>
        </li>
      </ul>
      
    </div>
  </nav>