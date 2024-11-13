<div class="content p-4">
            <h1 class="text-dark mb-4">Servicios</h1>
            <div class="d-flex justify-content-between align-items-center my-2">
                <button class="btn btn-primary" wire:click="abrirModalCrear">Registrar</button>
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
                            <th scope="col">Nombre servicio</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Disponibilidad</th>
                            <th scope="col">Fecha de creacion</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($servicios as $servicio)
                        <tr>
                            <td>{{ $servicio->nombre }}</td>
                            <td>{{ $servicio->descripcion }}</td>
                            <td>{{ $servicio->precio }}</td>
                            <td>{{ $servicio->disponibilidad }}</td>
                            <td>{{ $servicio->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal" wire:click="abrirModalEditar({{ $servicio->id }})">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="eliminar({{ $servicio->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>

                            @if($isEditModalOpen)
                            <div class="modal fade show d-block" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Servicio</h5>
                                            <button type="button" class="btn-close" wire:click="cerrarModalEditar" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="nombre" class="form-label">Nombre del Servicio</label>
                                                    <input type="text" class="form-control" wire:model="nombre">
                                                    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="descripcion" class="form-label">Descripción</label>
                                                    <textarea class="form-control" wire:model="descripcion"></textarea>
                                                    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="precio" class="form-label">Precio</label>
                                                    <input type="number" class="form-control" wire:model="precio">
                                                    @error('precio') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Disponibilidad</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" wire:model="disponibilidad" id="disponible" value="1">
                                                        <label class="form-check-label" for="disponible">Disponible</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" wire:model="disponibilidad" id="no_disponible" value="0">
                                                        <label class="form-check-label" for="no_disponible">No Disponible</label>
                                                    </div>
                                                    @error('disponibilidad') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" wire:click="cerrarModalEditar">Cancelar</button>
                                            <button type="button" class="btn btn-primary" wire:click="actualizar">Guardar Cambios</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-backdrop fade show"></div>
                        @endif


                    @endforeach
                    </tbody>
                </table>

                <!-- Modal para Registrar Servicio -->
                @if($isCreateModalOpen)
                    <div class="modal fade show d-block" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Crear Servicio</h5>
                                    <button type="button" class="btn-close" wire:click="cerrarModalCrear" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre del Servicio</label>
                                            <input type="text" class="form-control" wire:model="nombre">
                                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="descripcion" class="form-label">Descripción</label>
                                            <input type="text" class="form-control" wire:model="descripcion">
                                            @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="precio" class="form-label">Precio</label>
                                            <input type="number" class="form-control" wire:model="precio" step="0.01" min="0">
                                            @error('precio') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Disponibilidad</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" wire:model="disponibilidad" id="disponible" value="1">
                                                <label class="form-check-label" for="disponible">Disponible</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" wire:model="disponibilidad" id="no_disponible" value="0">
                                                <label class="form-check-label" for="no_disponible">No Disponible</label>
                                            </div>
                                            @error('disponibilidad') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" wire:click="cerrarModalCrear">Cancelar</button>
                                    <button type="button" class="btn btn-primary" wire:click="almacenar">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                @endif

            </div>
        </div>
        
