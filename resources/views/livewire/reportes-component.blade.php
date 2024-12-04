<div class="container-fluid">
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
                            <h2>75%</h2>
                        </div>
                    </div>
                </div>
                <!-- Más tarjetas... -->
                
                <!-- Contenedor para Gráfico -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Tendencia de Ocupación</h6>
                            <div style="height: 300px">
                                <!-- Aquí irá el gráfico -->
                                <p class="text-muted">Gráfico de ocupación</p>
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
                <!-- Tarjetas de Ingresos -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Ingresos Mensuales</h6>
                            <h2>$15,000</h2>
                        </div>
                    </div>
                </div>
                <!-- Contenedor para Gráfico -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Tendencia de Ingresos</h6>
                            <div style="height: 300px">
                                <!-- Aquí irá el gráfico -->
                                <p class="text-muted">Gráfico de ingresos</p>
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
                            <h2>45</h2>
                        </div>
                    </div>
                </div>
                <!-- Contenedor para Gráfico -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Procedencia de Huéspedes</h6>
                            <div style="height: 300px">
                                <!-- Aquí irá el gráfico -->
                                <p class="text-muted">Gráfico de procedencia</p>
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
                            <h6>Servicios Más Solicitados</h6>
                            <h2>120</h2>
                        </div>
                    </div>
                </div>
                <!-- Contenedor para Gráfico -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Uso de Servicios</h6>
                            <div style="height: 300px">
                                <!-- Aquí irá el gráfico -->
                                <p class="text-muted">Gráfico de servicios</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
