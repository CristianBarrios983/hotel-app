
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
        <!-- Habitación 101 (Disponible) -->
        <div class="habitacion col-md-3 col-sm-6 mb-4" data-estado="disponible">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Habitación 101</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-muted">Disponible</p>
                    <i class="bi bi-door-open-fill text-success" style="font-size: 2rem;"></i>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-outline-primary">Asignar</a>
                </div>
            </div>
        </div>

        <!-- Habitación 102 (Ocupada) -->
        <div class="habitacion col-md-3 col-sm-6 mb-4" data-estado="ocupada">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">Habitación 102</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-muted">Ocupada</p>
                    <i class="bi bi-person-fill text-danger" style="font-size: 2rem;"></i>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-outline-primary disabled">Asignar</a>
                </div>
            </div>
        </div>

        <!-- Habitación 103 (Reservada) -->
        <div class="habitacion col-md-3 col-sm-6 mb-4" data-estado="reservada">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-white">
                    <h5 class="card-title mb-0">Habitación 103</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-muted">Reservada</p>
                    <i class="bi bi-calendar-check-fill text-warning" style="font-size: 2rem;"></i>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-outline-primary">Ver Reserva</a>
                </div>
            </div>
        </div>

        <!-- Nueva habitación en mantenimiento -->
        <div class="habitacion col-md-3 col-sm-6 mb-4" data-estado="mantenimiento">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Habitación 104</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-muted">En Mantenimiento</p>
                    <i class="bi bi-tools text-info" style="font-size: 2rem;"></i>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-outline-primary disabled">En Mantenimiento</a>
                </div>
            </div>
        </div>
    </div>
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