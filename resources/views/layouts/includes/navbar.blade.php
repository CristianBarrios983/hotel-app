<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        @can('ver panel')
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Panel</a>
          </li>
        @endcan

        @can('ver usuarios')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('usuarios') }}">Usuarios</a>
          </li>
        @endcan

        @canany(['ver habitaciones', 'ver pisos', 'ver tipos habitaciones', 'ver huespedes'])
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gestión Hotelera
            </a>
            <ul class="dropdown-menu">
              @can('ver habitaciones')
                <li><a class="dropdown-item" href="{{ route('habitaciones') }}">Habitaciones</a></li>
              @endcan
              @can('ver pisos')
                <li><a class="dropdown-item" href="{{ route('pisos') }}">Pisos</a></li>
              @endcan
              @can('ver tipos habitaciones')
                <li><a class="dropdown-item" href="{{ route('tipo_habitaciones') }}">Categorías</a></li>
              @endcan
              @can('ver huespedes')
                <li><a class="dropdown-item" href="{{ route('huespedes') }}">Huespedes</a></li>
              @endcan
            </ul>
          </li>
        @endcanany

        @canany(['ver productos', 'ver categorias', 'ver proveedores', 'ver servicios', 'ver pedidos'])
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Inventario
            </a>
            <ul class="dropdown-menu">
              @can('ver productos')
                <li><a class="dropdown-item" href="{{ route('productos') }}">Productos</a></li>
              @endcan
              @can('ver categorias')
                <li><a class="dropdown-item" href="{{ route('categorias') }}">Categorías</a></li>
              @endcan
              @can('ver proveedores')
                <li><a class="dropdown-item" href="{{ route('proveedores') }}">Proveedores</a></li>
              @endcan
              @can('ver servicios')
                <li><a class="dropdown-item" href="{{ route('servicios') }}">Servicios</a></li>
              @endcan
              @can('ver pedidos')
                <li><a class="dropdown-item" href="{{ route('pedidos') }}">Pedidos</a></li>
              @endcan
            </ul>
          </li>
        @endcanany

        @canany(['ver recepcion', 'ver reservas', 'ver checkin', 'ver checkout'])
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gestión de Reservas
            </a>
            <ul class="dropdown-menu">
              @can('ver recepcion')
                <li><a class="dropdown-item" href="{{ route('recepcion') }}">Recepción</a></li>
              @endcan
              @can('ver reservas')
                <li><a class="dropdown-item" href="{{ route('reservas') }}">Reservas</a></li>
              @endcan
              @can('ver checkin')
                <li><a class="dropdown-item" href="{{ route('check-in') }}">Check In</a></li>
              @endcan
              @can('ver checkout')
                <li><a class="dropdown-item" href="{{ route('check-out') }}">Check Out</a></li>
              @endcan
            </ul>
          </li>
        @endcanany

        @can('ver mantenimientos')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('mantenimiento') }}">Mantenimiento</a>
          </li>
        @endcan

        @can('ver reportes')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('reportes') }}">Reportes</a>
          </li>
        @endcan

        @can('ver configuracion')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('configuracion') }}">Configuración</a>
          </li>
        @endcan

        <!-- Settings Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-info" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name">
          </a>
          <ul class="dropdown-menu">
            <li class="nav-item">
              <div class="form-check form-switch d-flex justify-content-center align-items-center">
                <input class="form-check-input me-1 text-white" type="checkbox" role="switch" id="darkModeToggle">
                <label class="form-check-label nav-link disabled align-items-center" for="flexSwitchCheckDefault">
                  <i class="bi bi-moon-fill" id="icon"></i>
                </label>
              </div>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('perfil') }}" wire:navigate>{{ __('Perfil') }}</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><livewire:logout-component /></li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>
