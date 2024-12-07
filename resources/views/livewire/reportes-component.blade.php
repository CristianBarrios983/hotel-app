<div class="container my-5">
    <!-- Filtros Generales -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Filtros</h5>
                    <div class="row g-3">
                        <!-- Rango de Fechas -->
                        <div class="col-md-4">
                            <label class="form-label">Rango de Fechas</label>
                            <div class="input-group">
                                <input type="date" class="form-control" wire:model="fechaInicio">
                                <span class="input-group-text">hasta</span>
                                <input type="date" class="form-control" wire:model="fechaFin">
                            </div>
                        </div>

                        <!-- Filtro Rápido de Período -->
                        <div class="col-md-2">
                            <label class="form-label">Período</label>
                            <select class="form-select" wire:model="periodo">
                                <option value="hoy">Hoy</option>
                                <option value="semana">Esta Semana</option>
                                <option value="mes">Este Mes</option>
                                <option value="año">Este Año</option>
                            </select>
                        </div>

                        <!-- Tipo de Habitación -->
                        <div class="col-md-2">
                            <label class="form-label">Tipo Habitación</label>
                            <select class="form-select" wire:model="tipoHabitacion">
                                <option value="">Todas</option>
                                <option value="individual">Individual</option>
                                <option value="doble">Doble</option>
                                <option value="suite">Suite</option>
                            </select>
                        </div>

                        <!-- Tipo de Servicio -->
                        <div class="col-md-2">
                            <label class="form-label">Servicios</label>
                            <select class="form-select" wire:model="tipoServicio">
                                <option value="">Todos</option>
                                <option value="limpieza">Limpieza</option>
                                <option value="restaurant">Restaurant</option>
                                <option value="lavanderia">Lavandería</option>
                            </select>
                        </div>

                        <!-- Botón de Aplicar Filtros -->
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-primary w-100" wire:click="aplicarFiltros">
                                Aplicar Filtros
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reportes de Ocupación -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">Reportes de Ocupación</h4>
            <div class="row">
                <!-- Tarjetas de Estadísticas -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Tasa de Ocupación</h6>
                            <h2>{{ $porcentajeOcupacion }}%</h2>
                        </div>
                    </div>
                </div>
                <!-- Más tarjetas... -->
                
                <!-- Contenedor para Gráfico -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Tendencia de Ocupación</h6>
                            <p class="text-muted">Gráfico de ocupación</p>
                            <div class="text-center" style="height: 300px">
                                @if($ocupacionDiaria->isEmpty())
                                    <p>No hay datos de ocupación disponibles.</p>
                                @else
                                    <div class="w-100 h-100">
                                        <canvas id="ocupacionChart"></canvas>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reportes Financieros -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">Reportes Financieros</h4>
            <div class="row">
                <!-- Tarjeta de Ingresos Mensuales -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Ingresos del Mes</h6>
                            <h2>${{ number_format($ingresosMes, 2) }}</h2>
                        </div>
                    </div>
                </div>
                <!-- Contenedor para Gráfico -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Tendencia de Ingresos</h6>
                            <p class="text-muted">Gráfico de ingresos</p>
                            <div style="height: 300px">
                                @if($ingresosMensuales->isEmpty())
                                    <p>No hay datos de ingresos disponibles.</p>
                                @else
                                    <div class="w-100 h-100">
                                        <canvas id="ingresosChart"></canvas>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reportes de Clientes -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">Reportes de Clientes</h4>
            <div class="row">
                <!-- Estadísticas de Clientes -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Huéspedes Frecuentes</h6>
                            <h2>{{ $huéspedesFrecuentes }}</h2>
                        </div>
                    </div>
                </div>
                <!-- Contenedor para Gráfico -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Procedencia de Huéspedes</h6>
                            <p class="text-muted">Gráfico de procedencia</p>
                            <div style="height: 300px">
                                @if($procedenciaHuespedes->isEmpty())
                                    <p>No hay datos de ingresos disponibles.</p>
                                @else
                                    <div class="w-100 h-100">
                                        <canvas id="procedenciaChart"></canvas>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reportes de Productos -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">Reportes de Productos</h4>
            <div class="row">
                <!-- Estadísticas de Productos -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Productos Frecuentes</h6>
                            <h2>{{ $totalProductosFrecuentes }}</h2> <!-- Muestra el total de productos frecuentes -->
                        </div>
                    </div>
                </div>
                <!-- Contenedor para Gráfico -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Uso de Productos</h6>
                            <div style="height: 300px">
                                @if($productosMasSolicitados->isEmpty())
                                    <p>No hay datos de ingresos disponibles.</p>
                                @else
                                    <div class="w-100 h-100">
                                        <canvas id="productosChart"></canvas>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reportes de Servicios -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">Reportes de Servicios</h4>
            <div class="row">
                <!-- Estadísticas de Servicios -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Servicios Frecuentes</h6>
                            <h2>{{ $totalServiciosFrecuentes }}</h2> <!-- Muestra el total de servicios frecuentes -->
                        </div>
                    </div>
                </div>
                <!-- Contenedor para Gráfico -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Uso de Servicios</h6>
                            <div style="height: 300px">
                                @if($serviciosMasSolicitados->isEmpty())
                                    <p>No hay datos de ingresos disponibles.</p>
                                @else
                                    <div class="w-100 h-100">
                                        <canvas id="serviciosChart"></canvas>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        const ocupacion = document.getElementById('ocupacionChart');
        const ocupacionData = @json($ocupacionDiaria); // Pasar datos de PHP a JavaScript

        new Chart(ocupacion, {
            type: 'line', // Cambiar a gráfico de líneas
            data: {
                labels: Object.keys(ocupacionData), // Fechas
                datasets: [{
                    label: 'Ocupación Diaria',
                    data: Object.values(ocupacionData), // Totales
                    borderWidth: 1,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false // No llenar el área bajo la línea
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
</script>


<script>
    const ingresos = document.getElementById('ingresosChart');
    const ingresosData = @json($ingresosMensuales);

    new Chart(ingresos, {
        type: 'line',
        data: {
            labels: Object.keys(ingresosData), // Meses
            datasets: [{
                label: 'Ingresos Mensuales',
                data: Object.values(ingresosData), // Totales
                borderWidth: 1,
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
        const procedencia = document.getElementById('procedenciaChart');
        const procedenciaData = @json($procedenciaHuespedes); // Pasar datos de PHP a JavaScript

        new Chart(procedencia, {
            type: 'bar', // Cambiar a 'pie' si decides usar un gráfico de pastel
            data: {
                labels: Object.keys(procedenciaData), // Procedencias
                datasets: [{
                    label: 'Huéspedes por Procedencia',
                    data: Object.values(procedenciaData), // Totales
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
</script>


<script>
        const productos = document.getElementById('productosChart');
        const productosData = @json($productosMasSolicitados); // Pasar datos de PHP a JavaScript

        new Chart(productos, {
            type: 'pie', // Cambiado a gráfico circular
            data: {
                labels: Object.keys(productosData), // Nombres de productos
                datasets: [{
                    label: 'Productos Más Solicitados',
                    data: Object.values(productosData), // Totales
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        // Agrega más colores si es necesario
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        // Agrega más colores si es necesario
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw; // Muestra el nombre y el total
                            }
                        }
                    }
                }
            }
        });
</script>

<script>
        const servicios = document.getElementById('serviciosChart');
        const serviciosData = @json($serviciosMasSolicitados); // Pasar datos de PHP a JavaScript

        new Chart(servicios, {
            type: 'pie', // Cambiado a gráfico circular
            data: {
                labels: Object.keys(serviciosData), // Nombres de servicios
                datasets: [{
                    label: 'Servicios Más Solicitados',
                    data: Object.values(serviciosData), // Totales
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        // Agrega más colores si es necesario
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        // Agrega más colores si es necesario
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw; // Muestra el nombre y el total
                            }
                        }
                    }
                }
            }
        });
</script>