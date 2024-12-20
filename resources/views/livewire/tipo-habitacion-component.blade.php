<div class="content p-4">
    <h1 class="mb-4">Tipos Habitaciones</h1>
    <div class="d-flex justify-content-between align-items-center my-2">
        <button class="btn btn-success" wire:click="abrirModalCrear">
            <i class="bi bi-plus-circle"></i> Registrar
        </button>
    </div>

    <!-- Mensajes -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nombre tipo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha de creación</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipos as $tipo)
                    <tr>
                        <td>{{ $tipo->nombre_tipo }}</td>
                        <td>{{ $tipo->descripcion }}</td>
                        <td>{{ $tipo->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal" wire:click="abrirModalEditar({{ $tipo->id }})">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="eliminar({{ $tipo->id }})">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal para Editar Tipo de Habitación -->
        @if($isEditModalOpen)
            <div class="modal fade show d-block" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Tipo de Habitación</h5>
                            <button type="button" class="btn-close" wire:click="cerrarModalEditar" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="nombreTipo" class="form-label">Nombre del Tipo</label>
                                    <input type="text" class="form-control" wire:model="nombreTipo">
                                    @error('nombreTipo') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción (Opcional)</label>
                                    <textarea class="form-control" wire:model="descripcion"></textarea>
                                    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
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

        <!-- Modal para Registrar Tipo de Habitación -->
        @if($isCreateModalOpen)
            <div class="modal fade show d-block" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Crear Tipo de Habitación</h5>
                            <button type="button" class="btn-close" wire:click="cerrarModalCrear" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="nombreTipo" class="form-label">Nombre Tipo</label>
                                    <input type="text" class="form-control" wire:model="nombreTipo">
                                    @error('nombreTipo') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción (Opcional)</label>
                                    <input type="text" class="form-control" wire:model="descripcion">
                                    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
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


        
