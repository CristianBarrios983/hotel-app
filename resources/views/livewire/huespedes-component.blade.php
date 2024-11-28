<div class="content p-4">
            <h1 class="mb-4">Huespedes</h1>
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
                            <th scope="col">Apellido</th>
                            <th scope="col">Fecha de nacimiento</th>
                            <th scope="col">Nacionalidad</th>
                            <th scope="col">tipo de documento</th>
                            <th scope="col">Nro de documento</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Fecha creacion</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($huespedes as $huesped)
                        <tr>
                            <td>{{ $huesped->nombre }}</td>
                            <td>{{ $huesped->apellido }}</td>
                            <td>{{ $huesped->fecha_nacimiento ? \Carbon\Carbon::parse($huesped->fecha_nacimiento)->format('d/m/Y') : 'No disponible' }}</td>
                            <td>{{ $huesped->nacionalidad }}</td>
                            <td>{{ $huesped->tipo_documento }}</td>
                            <td>{{ $huesped->numero_documento }}</td>
                            <td>{{ $huesped->email }}</td>
                            <td>{{ $huesped->telefono }}</td>
                            <td>{{ $huesped->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm" title="Editar" ata-bs-toggle="modal" wire:click="abrirModalEditar({{ $huesped->id }})">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="eliminar({{ $huesped->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>


                        @if($isEditModalOpen)
                            <div class="modal fade show d-block" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Huesped</h5>
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
                                                    <label for="apellido" class="form-label">Apellido</label>
                                                    <input type="text" class="form-control" wire:model="apellido">
                                                    @error('apellido') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                                    <input type="date" class="form-control" wire:model="fecha_nacimiento">
                                                    @error('fecha_nacimiento') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                                    <input type="text" class="form-control" wire:model="nacionalidad">
                                                    @error('nacionalidad') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                                                    <select class="form-select" wire:model="tipo_documento">
                                                        <option value="">Selecciona un tipo de documento</option>
                                                        <option value="DNI">DNI</option>
                                                        <option value="PASAPORTE">Pasaporte</option>
                                                        <option value="OTRO">Otro</option>
                                                    </select>
                                                    @error('tipo_documento') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="numero_documento" class="form-label">Número de Documento</label>
                                                    <input type="text" class="form-control" wire:model="numero_documento">
                                                    @error('numero_documento') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" wire:model="email">
                                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telefono" class="form-label">Teléfono</label>
                                                    <input type="text" class="form-control" wire:model="telefono">
                                                    @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" wire:click="cerrarModalEditar">Cancelar</button>
                                            <button type="button" class="btn btn-primary" wire:click="actualizar">Actualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-backdrop fade show"></div>
                        @endif

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        

        <!-- Modal para Registrar Huéspedes -->
        @if($isCreateModalOpen)
            <div class="modal fade show d-block" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Crear Huésped</h5>
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
                                    <label for="apellido" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" wire:model="apellido">
                                    @error('apellido') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" wire:model="fecha_nacimiento">
                                    @error('fecha_nacimiento') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nacionalidad" class="form-label">Nacionalidad (Opcional)</label>
                                    <input type="text" class="form-control" wire:model="nacionalidad">
                                    @error('nacionalidad') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                                    <select class="form-select" id="tipo_documento" wire:model="tipo_documento">
                                        <option value="">Selecciona un tipo de documento</option>
                                        <option value="DNI">DNI</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                        <option value="Carnet de Identidad">Carnet de Identidad</option>
                                    </select>
                                    @error('tipo_documento') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="numero_documento" class="form-label">Número de Documento</label>
                                    <input type="text" class="form-control" wire:model="numero_documento">
                                    @error('numero_documento') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" wire:model="email">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono (Opcional)</label>
                                    <input type="tel" class="form-control" wire:model="telefono">
                                    @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
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
