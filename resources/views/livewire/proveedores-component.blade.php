<div class="content p-4">
            <h1 class="mb-4">Proveedores</h1>
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
                            <th scope="col">Nombre de Proveedor</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Email</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Fecha de creacion</th>
                            <th scope="col" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($proveedores as $proveedor)
                        <tr>
                        <td>{{ $proveedor->nombre_proveedor }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>{{ $proveedor->email }}</td>
                        <td>{{ $proveedor->direccion }}</td>
                        <td>{{ $proveedor->descripcion }}</td>
                        <td>{{ $proveedor->categoria->nombre_categoria ?? 'Sin categoría' }}</td>
                        <td>{{ $proveedor->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal" wire:click="abrirModalEditar({{ $proveedor->id }})">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="eliminar({{ $proveedor->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Modal para Editar Proveedor -->
                        @if($isEditModalOpen)
                            <div class="modal fade show d-block" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Proveedor</h5>
                                            <button type="button" class="btn-close" wire:click="cerrarModalEditar" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="nombreProveedor" class="form-label">Nombre Proveedor</label>
                                                    <input type="text" class="form-control" wire:model="nombreProveedor">
                                                    @error('nombreProveedor') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telefono" class="form-label">Telefono</label>
                                                    <input type="text" class="form-control" wire:model="telefono">
                                                    @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" wire:model="email">
                                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="direccion" class="form-label">Direccion</label>
                                                    <input type="text" class="form-control" wire:model="direccion">
                                                    @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="descripcion" class="form-label">Descripción (Opcional)</label>
                                                    <input type="text" class="form-control" wire:model="descripcion">
                                                    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- Lista desplegable para Categorias -->
                                                <div class="mb-3">
                                                    <label for="categoria_id" class="form-label">Categoria</label>
                                                    <select id="categoria_id" class="form-control" wire:model="categoria_id">
                                                        <option value="">Selecciona una categoria</option>
                                                        @foreach($categorias as $categoria)
                                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('categoria_id') <span class="text-danger">{{ $message }}</span> @enderror
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

                <!-- Modal para Registrar Proveedores -->
                @if($isCreateModalOpen)
                    <div class="modal fade show d-block" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Crear Proveedor</h5>
                                    <button type="button" class="btn-close" wire:click="cerrarModalCrear" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="nombreProveedor" class="form-label">Nombre Proveedor</label>
                                            <input type="text" class="form-control" wire:model="nombreProveedor">
                                            @error('nombreProveedor') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="telefono" class="form-label">Telefono</label>
                                            <input type="text" class="form-control" wire:model="telefono">
                                            @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" wire:model="email">
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="direccion" class="form-label">Direccion</label>
                                            <input type="text" class="form-control" wire:model="direccion">
                                            @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="descripcion" class="form-label">Descripción (Opcional)</label>
                                            <input type="text" class="form-control" wire:model="descripcion">
                                            @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <!-- Lista desplegable para Categorias -->
                                        <div class="mb-3">
                                            <label for="categoria_id" class="form-label">Categoria</label>
                                            <select id="categoria_id" class="form-control" wire:model="categoria_id">
                                                <option value="">Selecciona una categoria</option>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                                                @endforeach
                                            </select>
                                            @error('categoria_id') <span class="text-danger">{{ $message }}</span> @enderror
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
