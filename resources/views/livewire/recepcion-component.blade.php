
<div class="container my-5">
    <!-- Encabezado de la página -->
    <div class="content p-4">
        <h1 class="text-dark mb-4 text-center">Recepción - Panel de Habitaciones</h1>
    </div>

    <!-- Filtros de búsqueda -->
    <div class="row justify-content-center mb-4">
        <div class="col-auto">
            <div class="btn-group" role="group">
                <button class="btn btn-outline-primary" onclick="filtrarHabitaciones('todas')">Todas</button>
                <button class="btn btn-outline-success" onclick="filtrarHabitaciones('disponible')">Disponibles</button>
                <button class="btn btn-outline-danger" onclick="filtrarHabitaciones('ocupada')">Ocupadas</button>
                <button class="btn btn-outline-warning" onclick="filtrarHabitaciones('reservada')">Reservadas</button>
                <button class="btn btn-outline-info" onclick="filtrarHabitaciones('mantenimiento')">Mantenimiento</button>
            </div>
        </div>
    </div>

    <!-- Habitaciones -->
    <div class="row text-center">

        @foreach ($habitaciones as $habitacion)
        <div class="habitacion col-md-3 col-sm-6 mb-4" data-estado="{{ $habitacion->disponibilidad }}">
            <div class="card shadow-sm border-0">
                <div class="card-header {{ 
                    $habitacion->disponibilidad === 'disponible' ? 'bg-success' :
                    ($habitacion->disponibilidad === 'ocupada' ? 'bg-danger' :
                    ($habitacion->disponibilidad === 'reservada' ? 'bg-warning' : 
                    'bg-info')) }} text-white">
                    <h5 class="card-title mb-0">Habitación {{ $habitacion->numero_habitacion }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-muted text-capitalize">{{ $habitacion->disponibilidad }}</p>
                    <i class="bi {{ 
                        $habitacion->disponibilidad === 'disponible' ? 'bi-door-open-fill text-success' :
                        ($habitacion->disponibilidad === 'ocupada' ? 'bi-person-fill text-danger' :
                        ($habitacion->disponibilidad === 'reservada' ? 'bi-calendar-check-fill text-warning' : 
                        'bi-tools text-info')) }}" 
                        style="font-size: 2rem;"></i>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ $habitacion->disponibilidad === 'disponible' ? route('crear-reserva') : 'javascript:void(0)' }}"
                       wire:click="{{ $habitacion->disponibilidad !== 'disponible' ? 'mostrarDetalles('.$habitacion->id.')' : '' }}"
                       class="btn {{ 
                           $habitacion->disponibilidad === 'disponible' ? 'btn-outline-primary' :
                           ($habitacion->disponibilidad === 'ocupada' ? 'btn-outline-danger' :
                           ($habitacion->disponibilidad === 'reservada' ? 'btn-outline-warning' : 
                           'btn-outline-info')) }}" 
                       title="{{ 
                           $habitacion->disponibilidad === 'disponible' ? 'Hacer Reserva' :
                           ($habitacion->disponibilidad === 'ocupada' ? 'Ver Huésped Actual' :
                           ($habitacion->disponibilidad === 'reservada' ? 'Ver Reserva / Check-in' : 
                           'En Mantenimiento')) }}">
                        <i class="bi {{ 
                            $habitacion->disponibilidad === 'disponible' ? 'bi-key-fill' :
                            ($habitacion->disponibilidad === 'ocupada' ? 'bi-person-badge' :
                            ($habitacion->disponibilidad === 'reservada' ? 'bi-eye-fill' : 
                            'bi-wrench-adjustable')) }}"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($isModalOpen)
    <div class="modal fade show d-block" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Detalles de la {{ $habitacionSeleccionada->disponibilidad === 'ocupada' ? 'Estadía' : 'Reserva' }}
                    </h5>
                    <button type="button" class="btn-close" wire:click="cerrarModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($reservaActual)
                        <div class="mb-3">
                            <h6 class="fw-bold">Datos de la Habitación</h6>
                            <p><strong>Número:</strong> {{ $habitacionSeleccionada->numero_habitacion }}</p>
                            <p><strong>Tipo:</strong> {{ $habitacionSeleccionada->tipoHabitacion->nombre_tipo }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Datos del Huésped</h6>
                            <p><strong>Nombre:</strong> {{ $reservaActual->huesped->nombre }} {{ $reservaActual->huesped->apellido }}</p>
                            <p><strong>Check-in:</strong> {{ Carbon\Carbon::parse($reservaActual->check_in)->format('d/m/Y H:i') }}</p>
                            <p><strong>Check-out:</strong> {{ Carbon\Carbon::parse($reservaActual->check_out)->format('d/m/Y H:i') }}</p>
                            <p><strong>Noches:</strong> {{ $reservaActual->noches }}</p>
                            @if($reservaActual->observaciones)
                                <p><strong>Observaciones:</strong> {{ $reservaActual->observaciones }}</p>
                            @endif
                        </div>
                    @else
                        <p class="text-center">No se encontraron detalles de la reserva.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cerrarModal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
@endif
</div>


<script>
    function filtrarHabitaciones(estado) {
        const habitaciones = document.querySelectorAll('.habitacion');

        habitaciones.forEach(habitacion => {
            habitacion.style.display = "block";
        });

        habitaciones.forEach(habitacion => {

            if (estado === "todas"){
                habitacion.style.display = "block";
            }else{
                const estadoHabitacion = habitacion.dataset.estado;
                //console.log(estadoHabitacion);
                if(estadoHabitacion !== estado){
                    habitacion.style.display = "none";
                }
            }  

        });
    }
</script>