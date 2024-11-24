<div class="content p-4">
    <h1 class="text-dark mb-4">Check-Out</h1>

    <!-- Lista de Salidas del Día -->
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Salidas Programadas - 12/03/2024</h5>
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
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>12:00</td>
                            <td>101</td>
                            <td>Juan Pérez</td>
                            <td>3</td>
                            <td><span class="badge bg-success">Ocupada</span></td>
                            <td>$450.00</td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#checkOutModal">
                                    <i class="bi bi-box-arrow-right"></i> Check-Out
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>13:00</td>
                            <td>204</td>
                            <td>María García</td>
                            <td>2</td>
                            <td><span class="badge bg-success">Ocupada</span></td>
                            <td>$300.00</td>
                            <td>
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-box-arrow-right"></i> Check-Out
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Check-out -->
    <div class="modal fade" id="checkOutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Check-out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Resumen de Estancia -->
                    <div class="mb-4">
                        <h6 class="fw-bold">Resumen de Estancia</h6>
                        <p><strong>Huésped:</strong> Juan Pérez</p>
                        <p><strong>Habitación:</strong> 101</p>
                        <p><strong>Entrada:</strong> 09/03/2024</p>
                        <p><strong>Salida:</strong> 12/03/2024</p>
                    </div>

                    <!-- Resumen de Cargos -->
                    <div class="mb-4">
                        <h6 class="fw-bold">Resumen de Cargos</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tr>
                                    <td>Habitación (3 noches)</td>
                                    <td class="text-end">$450.00</td>
                                </tr>
                                <tr>
                                    <td>Consumos adicionales</td>
                                    <td class="text-end">$50.00</td>
                                </tr>
                                <tr class="fw-bold">
                                    <td>Total</td>
                                    <td class="text-end">$500.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Confirmaciones -->
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="confirmPago">
                        <label class="form-check-label" for="confirmPago">
                            Pago completado
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="confirmHabitacion">
                        <label class="form-check-label" for="confirmHabitacion">
                            Habitación revisada
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
                    <button type="button" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right"></i> Confirmar Check-out
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
