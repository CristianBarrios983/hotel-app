<div class="content p-4">
    <h1 class="text-dark mb-4">Mantenimientos del Establecimiento</h1>

    <div class="d-flex justify-content-between align-items-center my-2">
        <button class="btn btn-primary" wire:click="abrirModalCrear">Registrar Nuevo Mantenimiento</button>
    </div>

    <!-- Mensajes -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Habitación/Área</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha de Solicitud</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ejemplo de una fila de mantenimiento (sin lógica de foreach) -->
                <tr>
                    <td>Habitación 101</td>
                    <td>Mantenimiento de aire acondicionado</td>
                    <td>15/11/2024</td>
                    <td>Alta</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal" wire:click="abrirModalEditar(1)">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="eliminar(1)">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Área Común</td>
                    <td>Reparación de lámparas</td>
                    <td>14/11/2024</td>
                    <td>Media</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal" wire:click="abrirModalEditar(2)">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="eliminar(2)">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
                <!-- Fin de ejemplo -->
            </tbody>
        </table>

        <!-- Modal para Registrar Nuevo Mantenimiento -->
        @if($isCreateModalOpen)
            <div class="modal fade show d-block" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Registrar Nuevo Mantenimiento</h5>
                            <button type="button" class="btn-close" wire:click="cerrarModalCrear" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="habitacionArea" class="form-label">Habitación/Área</label>
                                    <input type="text" class="form-control" wire:model="habitacionArea">
                                    @error('habitacionArea') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <input type="text" class="form-control" wire:model="descripcion">
                                    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="prioridad" class="form-label">Prioridad</label>
                                    <select class="form-control" wire:model="prioridad">
                                        <option value="Alta">Alta</option>
                                        <option value="Media">Media</option>
                                        <option value="Baja">Baja</option>
                                    </select>
                                    @error('prioridad') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="cerrarModalCrear">Cancelar</button>
                            <button type="button" class="btn btn-primary" wire:click="almacenar">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
        @endif
    </div>
</div>
