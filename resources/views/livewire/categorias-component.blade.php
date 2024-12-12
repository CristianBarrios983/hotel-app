<div class="content p-4">
    <h1 class="mb-4">Categorias</h1>
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
                    <th scope="col">Nombre categoria</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Fecha de creacion</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nombre_categoria }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td>{{ $categoria->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal" wire:click="abrirModalEditar({{ $categoria->id }})">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="eliminar({{ $categoria->id }})">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal para Editar Categorias (fuera del foreach) -->
        @if($isEditModalOpen)
            <div class="modal fade show d-block" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Categoria</h5>
                            <button type="button" class="btn-close" wire:click="cerrarModalEditar" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="nombreCategoria" class="form-label">Nombre Categoria</label>
                                    <input type="text" class="form-control" wire:model="nombreCategoria">
                                    @error('nombreCategoria') <span class="text-danger">{{ $message }}</span> @enderror
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

        <!-- Modal para Registrar Categorias -->
        @if($isCreateModalOpen)
            <div class="modal fade show d-block" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Crear Categoria</h5>
                            <button type="button" class="btn-close" wire:click="cerrarModalCrear" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="nombreCategoria" class="form-label">Nombre Categoria</label>
                                    <input type="text" class="form-control" wire:model="nombreCategoria">
                                    @error('nombreCategoria') <span class="text-danger">{{ $message }}</span> @enderror
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