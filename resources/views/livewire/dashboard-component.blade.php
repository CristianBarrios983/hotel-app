<div class="content p-4">
        <h1 class="mb-4">Bienvenido al Sistema del Hotel</h1>
        
        <div class="row">
          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header">
                Estado de Ocupación
              </div>
              <div class="card-body">
                <p class="card-text">Habitaciones ocupadas: <strong>{{ $habitacionesOcupadas }}</strong> / Total: <strong>{{ $totalHabitaciones }}</strong></p>
                <p class="card-text">Ocupación: <strong>{{ round($porcentajeOcupacion) }}%</strong></p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header">
                Tareas Pendientes
              </div>
              <div class="card-body">
                @if($tareasPendientes->isEmpty())
                  <p class="card-text">No hay tareas pendientes.</p>
                @else
                <ul>
                  @foreach($tareasPendientes as $tarea)
                    <li>{{ $tarea->descripcion }}</li>
                  @endforeach
                  </ul>
                @endif
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header">
                Reservas Recientes
              </div>
              <div class="card-body">
                @if($reservasRecientes->isEmpty())
                  <p class="card-text">No hay reservas recientes.</p>
                @else
                <ul class="list-unstyled">
                  @foreach($reservasRecientes as $reserva)
                    <li class="mb-2">
                      <strong>{{ $reserva->huesped->nombre }} {{ $reserva->huesped->apellido }}</strong><br>
                      <small>
                        Check-in: {{ \Carbon\Carbon::parse($reserva->check_in)->format('d/m/Y') }}<br>
                        Habitación: {{ $reserva->habitacion->numero_habitacion }}
                      </small>
                    </li>
                  @endforeach
                </ul>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header">
                Reportes Rápidos
              </div>
              <div class="card-body">
                <p class="card-text">Ingresos del día: <strong>${{ number_format($ingresosHoy, 2) }}</strong></p>
                <p class="card-text">Total de ingresos este mes: <strong>${{ number_format($ingresosMes, 2) }}</strong></p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header">
                Alertas y Notificaciones
              </div>
              <div class="card-body">
                <p>No hay alertas pendientes.</p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header">
                Accesos Rápidos
              </div>
              <div class="card-body">
                <ul>
                  <li><a href="{{ route('crear-reserva') }}">Registrar Nueva Reserva</a></li>
                  <li><a href="{{ route('habitaciones') }}">Gestionar Habitaciones</a></li>
                  <li><a href="{{ route('servicios') }}">Gestionar Servicios</a></li>
                  <li><a href="{{ route('check-in') }}">Check-in de Huésped</a></li>
                  <li><a href="{{ route('check-out') }}">Check-out de Huésped</a></li>
                  <li><a href="{{ route('mantenimiento') }}">Registrar Mantenimiento</a></li>
                  <li><a href="{{ route('huespedes') }}">Registro de Huésped</a></li>
                  <li><a href="{{ route('productos') }}">Control de Inventario</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>