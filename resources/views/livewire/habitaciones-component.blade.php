<div class="content p-4">
            <h1 class="text-dark mb-4">Habitaciones</h1>
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
                            <th scope="col">#</th>
                            <th scope="col">Número de Habitación</th>
                            <th scope="col">Capacidad</th>
                            <th scope="col">Tamaño (m²)</th>
                            <th scope="col">Vistas</th>
                            <th scope="col">Tipo de Cama</th>
                            <th scope="col">Precio por Noche</th>
                            <th scope="col">Disponibilidad</th>
                            <th scope="col">Tipo de Habitación</th>
                            <th scope="col">Piso</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>101</td>
                            <td>2</td>
                            <td>25</td>
                            <td>Mar</td>
                            <td>King Size</td>
                            <td>$120</td>
                            <td class="text-success">Disponible</td>
                            <td>Suite</td>
                            <td>1</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" title="Eliminar">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Más filas de muestra -->
                    </tbody>
                </table>


                <!-- Modal para Registrar Habitaciones -->
                @if($isCreateModalOpen)
                    <div class="modal fade show d-block" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Crear Habitacion</h5>
                                    <button type="button" class="btn-close" wire:click="cerrarModalCrear" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="numeroHabitacion" class="form-label">Numero Habitacion</label>
                                            <input type="text" class="form-control" wire:model="numeroHabitacion">
                                            @error('numeroHabitacion') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="capacidad" class="form-label">Capacidad</label>
                                            <input type="number" class="form-control" wire:model="capacidad">
                                            @error('capacidad') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="tamanio" class="form-label">Tamaño (m²)</label>
                                            <input type="number" class="form-control" wire:model="tamanio">
                                            @error('tamanio') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="vistas" class="form-label">Vistas (Opcional)</label>
                                            <input type="text" class="form-control" wire:model="vistas">
                                            @error('vistas') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="tipo_cama" class="form-label">Tipo de Cama</label>
                                            <select class="form-select" id="tipo_cama" name="tipo_cama" wire:model="tipo_cama">
                                                <option value="">Selecciona un tipo de cama</option>
                                                <option value="Individual">Individual</option>
                                                <option value="Doble">Doble</option>
                                                <option value="Queen">Queen</option>
                                                <option value="King">King</option>
                                            </select>
                                            @error('tipo_cama') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="precio" class="form-label">Precio por Noche</label>
                                            <input type="number" class="form-control" wire:model="precio">
                                            @error('precio') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <!-- Lista desplegable para el Tipo de Habitación -->
                                        <div class="mb-3">
                                            <label for="tipo_habitacion" class="form-label">Tipo de Habitación</label>
                                            <select id="tipo_habitacion" class="form-control" wire:model="tipo_habitacion_id">
                                                <option value="">Selecciona un tipo de habitación</option>
                                                @foreach($tiposHabitacion as $tipo)
                                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre_tipo }}</option>
                                                @endforeach
                                            </select>
                                            @error('tipo_habitacion_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Lista desplegable para el Piso -->
                                        <div class="mb-3">
                                            <label for="piso" class="form-label">Piso</label>
                                            <select id="piso" class="form-control" wire:model="piso_id">
                                                <option value="">Selecciona un piso</option>
                                                @foreach($pisos as $piso)
                                                    <option value="{{ $piso->id }}">Piso {{ $piso->numero_piso }}</option>
                                                @endforeach
                                            </select>
                                            @error('piso_id') <span class="text-danger">{{ $message }}</span> @enderror
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