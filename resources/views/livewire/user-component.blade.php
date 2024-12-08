<div class="content p-4">
            <h1 class="mb-4">Usuarios</h1>
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
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Fecha de creacion</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td class="text-success">Sin Rol</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal" wire:click="abrirModalEditar({{ $user->id }})">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="eliminar({{ $user->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Modal para Editar Usuario -->
                @if($isEditModalOpen)
                    <div class="modal fade show d-block" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Usuario</h5>
                                    <button type="button" class="btn-close" wire:click="cerrarModalEditar" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" wire:model="nombre">
                                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="correo" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" wire:model="correo">
                                            @error('correo') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="telefono" class="form-label">Número de Teléfono</label>
                                            <input type="tel" class="form-control" wire:model="telefono">
                                            @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="direccion" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" wire:model="direccion">
                                            @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <!-- Lista desplegable para rol (comentada para implementación futura) -->
                                        <div class="mb-3">
                                            <label for="rol" class="form-label">Rol</label>
                                            <select class="form-select" wire:model="rol">
                                                <option value="">Seleccionar rol</option>
                                                <option value="admin">Administrador</option>
                                                <option value="recepcionista">Recepcionista</option>
                                                <option value="mantenimiento">Mantenimiento</option>
                                            </select>
                                            @error('rol') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="contrasena" class="form-label">Nueva Contraseña (opcional)</label>
                                            <input type="password" class="form-control" wire:model="contrasena">
                                            @error('contrasena') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="contrasena_confirmation" class="form-label">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" wire:model="contrasena_confirmation">
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

                <!-- Modal para Registrar Usuario -->
                @if($isCreateModalOpen)
                    <div class="modal fade show d-block" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Crear Usuario</h5>
                                    <button type="button" class="btn-close" wire:click="cerrarModalCrear" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" wire:model="nombre">
                                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="correo" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" wire:model="correo">
                                            @error('correo') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="telefono" class="form-label">Número de Teléfono</label>
                                            <input type="tel" class="form-control" wire:model="telefono">
                                            @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="direccion" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" wire:model="direccion">
                                            @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <!-- Lista desplegable para rol (comentada para implementación futura) -->
                                        <div class="mb-3">
                                            <label for="rol" class="form-label">Rol</label>
                                            <select class="form-select" wire:model="rol">
                                                <option value="">Seleccionar rol</option>
                                                <option value="admin">Administrador</option>
                                                <option value="recepcionista">Recepcionista</option>
                                                <option value="mantenimiento">Mantenimiento</option>
                                            </select>
                                            @error('rol') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="contrasena" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" wire:model="contrasena" required>
                                            @error('contrasena') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="contrasena_confirmation" class="form-label">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" wire:model="contrasena_confirmation" required>
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
