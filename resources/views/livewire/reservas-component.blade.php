<div class="content p-4">
    <h1 class="text-dark mb-4">Reservas</h1>
    <div class="d-flex justify-content-between align-items-center my-2">
        <button class="btn btn-primary" wire:click="abrirModalCrear">Nueva Reserva</button>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Habitación</th>
                    <th scope="col">Huésped</th>
                    <th scope="col">Fecha Entrada</th>
                    <th scope="col">Fecha Salida</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Total</th>
                    <th scope="col">Fecha Reserva</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fila de ejemplo -->
                <tr>
                    <th scope="row">1</th>
                    <td>Habitación 101</td>
                    <td>Juan Pérez</td>
                    <td>01/03/2024</td>
                    <td>03/03/2024</td>
                    <td><span class="badge bg-success">Confirmada</span></td>
                    <td>$150.00</td>
                    <td>28/02/2024</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-warning btn-sm" title="Editar">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" title="Cancelar">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    </td>
                </tr>
                <!-- Más filas de ejemplo -->
                <tr>
                    <th scope="row">2</th>
                    <td>Habitación 102</td>
                    <td>María García</td>
                    <td>05/03/2024</td>
                    <td>07/03/2024</td>
                    <td><span class="badge bg-warning">Pendiente</span></td>
                    <td>$200.00</td>
                    <td>01/03/2024</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-warning btn-sm" title="Editar">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" title="Cancelar">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal para Nueva Reserva -->
        @if($isCreateModalOpen)
            <div class="modal fade show d-block" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nueva Reserva</h5>
                            <button type="button" class="btn-close" wire:click="cerrarModalCrear"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <!-- Selección de Habitación -->
                                <div class="mb-3">
                                    <label class="form-label">Habitación</label>
                                    <select class="form-select">
                                        <option value="">Seleccione una habitación</option>
                                        <option value="1">Habitación 101 - Individual</option>
                                        <option value="2">Habitación 102 - Doble</option>
                                        <option value="3">Habitación 103 - Suite</option>
                                    </select>
                                </div>

                                <!-- Datos del Huésped -->
                                <div class="mb-3">
                                    <label class="form-label">Nombre del Huésped</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Documento</label>
                                    <input type="text" class="form-control">
                                </div>

                                <!-- Fechas -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Fecha Entrada</label>
                                        <input type="date" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Fecha Salida</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>

                                <!-- Estado de la Reserva -->
                                <div class="mb-3">
                                    <label class="form-label">Estado</label>
                                    <select class="form-select">
                                        <option value="pendiente">Pendiente</option>
                                        <option value="confirmada">Confirmada</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="cerrarModalCrear">Cancelar</button>
                            <button type="button" class="btn btn-primary">Guardar Reserva</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
        @endif
    </div>
</div>
