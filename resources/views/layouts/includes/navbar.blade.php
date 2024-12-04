<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/dashboard">Panel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/usuarios">Usuarios</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestión Hotelera
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/habitaciones">Listado de Habitaciones</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/pisos">Distribución de Pisos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/tipo_habitaciones">Categorías de Habitaciones</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/huespedes">Huespedes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Inventario
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/productos">Listado de Productos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/categorias">Categorías</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/proveedores">Proveedores</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/servicios">Servicios</a></li>
          </ul>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="/pedidos">Pedidos</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestión de Pedidos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/pedidos">Listado de Pedidos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/crear-pedido">Nuevo Pedido</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestión de Reservas
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/recepcion">Recepción</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/reservas">Listado de Reservas</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/check-in">Check In</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/check-out">Check Out</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/mantenimiento">Mantenimiento</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="/reportes">Reportes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/configuracion">Configuracion</a>
        </li>

        <!-- Settings Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-info" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name">
            </a>
            <ul class="dropdown-menu">
              <li class="nav-item">
                    <div class="form-check form-switch d-flex justify-content-center align-items-center">
                      <input class="form-check-input me-1 text-white" type="checkbox" role="switch" id="darkModeToggle">
                      <label class="form-check-label nav-link disabled align-items-center" for="flexSwitchCheckDefault"><i class="bi bi-moon-fill" id="icon"></i></label>
                  </div>
              </li>
                <li>
                    <a class="dropdown-item" href="{{ route('profile') }}" wire:navigate>
                        {{ __('Perfil') }}
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <livewire:logout-component />
                </li>
            </ul>
        </li>
      </ul>
      <!-- aqui va otra cosa -->
    </div>
  </div>
</nav>