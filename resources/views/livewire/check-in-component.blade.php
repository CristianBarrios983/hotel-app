<div class="content p-4">
    <h1 class="text-dark mb-4">Check-In</h1>

    <!-- Lista de Llegadas del Día -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Llegadas Programadas - 12/03/2024</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <th>Habitación</th>
                            <th>Huésped</th>
                            <th>Noches</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>14:00</td>
                            <td>101</td>
                            <td>Juan Pérez</td>
                            <td>3</td>
                            <td><span class="badge bg-warning">Pendiente</span></td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#checkInModal">
                                    <i class="bi bi-check-circle"></i> Check-In
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>15:30</td>
                            <td>204</td>
                            <td>María García</td>
                            <td>2</td>
                            <td><span class="badge bg-warning">Pendiente</span></td>
                            <td>
                                <button class="btn btn-success btn-sm">
                                    <i class="bi bi-check-circle"></i> Check-In
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de Check-in -->
    <div class="modal fade" id="checkInModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Check-in</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Resumen de la Reserva -->
                    <div class="mb-4">
                        <h6 class="fw-bold">Detalles de la Reserva</h6>
                        <p><strong>Huésped:</strong> Juan Pérez</p>
                        <p><strong>Habitación:</strong> 101</p>
                        <p><strong>Entrada:</strong> 12/03/2024</p>
                        <p><strong>Salida:</strong> 15/03/2024</p>
                    </div>

                    <!-- Confirmación -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="confirmIdentidad">
                        <label class="form-check-label" for="confirmIdentidad">
                            Identidad verificada
                        </label>
                    </div>

                    <!-- Observaciones -->
                    <div class="mb-3">
                        <label class="form-label">Observaciones (opcional)</label>
                        <textarea class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Confirmar Check-in
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
