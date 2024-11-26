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
                    <th scope="col">Habitación</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Personal</th>
                    <th scope="col">Fecha de Solicitud</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Estado</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mantenimientos as $mantenimiento)
                <tr>
                    <td>Habitación {{ $mantenimiento->habitacion->numero_habitacion }}</td>
                    <td>{{ $mantenimiento->descripcion }}</td>
                    <td>{{ $mantenimiento->personal }}</td>
                    <td>{{ $mantenimiento->created_at->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge {{ $mantenimiento->prioridad === 'alta' ? 'bg-danger' : 
                            ($mantenimiento->prioridad === 'media' ? 'bg-warning' : 'bg-info') }}">
                            {{ ucfirst($mantenimiento->prioridad) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ 
                            $mantenimiento->estado === 'pendiente' ? 'bg-secondary' : 
                            ($mantenimiento->estado === 'en_proceso' ? 'bg-primary' : 'bg-success') 
                        }}">
                            {{ str_replace('_', ' ', ucfirst($mantenimiento->estado)) }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if($mantenimiento->estado === 'pendiente')
                            <button type="button" class="btn btn-sm btn-primary" title="En Proceso" 
                                wire:click="cambiarEstado({{ $mantenimiento->id }}, 'en_proceso')">
                                <i class="bi bi-gear-fill"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-success" title="Completado" 
                                wire:click="cambiarEstado({{ $mantenimiento->id }}, 'completado')">
                                <i class="bi bi-check-circle-fill"></i>
                            </button>
                            <a href="#" class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal" 
                                wire:click="abrirModalEditar({{ $mantenimiento->id }})">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" title="Eliminar" 
                                wire:click="eliminar({{ $mantenimiento->id }})">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        @elseif($mantenimiento->estado === 'en_proceso')
                            <button type="button" class="btn btn-sm btn-success" title="Completado" 
                                wire:click="cambiarEstado({{ $mantenimiento->id }}, 'completado')">
                                <i class="bi bi-check-circle-fill"></i>
                            </button>
                        @else
                            <span class="text-muted">Tarea completada</span>
                        @endif
                    </td>
                </tr>

                @if($isEditModalOpen)
                <div class="modal fade show d-block" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Mantenimiento</h5>
                                <button type="button" class="btn-close" wire:click="cerrarModalEditar" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="habitacion_id" class="form-label">Habitación</label>
                                        <select class="form-select" wire:model="habitacion_id">
                                            <option value="">Seleccione una habitación</option>
                                            @foreach($habitaciones as $habitacion)
                                                <option value="{{ $habitacion->id }}">
                                                    Habitación {{ $habitacion->numero_habitacion }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('habitacion_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea class="form-control" wire:model="descripcion" rows="3"></textarea>
                                        @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="personal" class="form-label">Personal Asignado</label>
                                        <select class="form-select" wire:model="personal">
                                            <option value="">Seleccione personal</option>
                                            <option value="Personal 1">Personal 1</option>
                                            <option value="Personal 2">Personal 2</option>
                                            <option value="Personal 3">Personal 3</option>
                                            <option value="Personal 4">Personal 4</option>
                                        </select>
                                        @error('personal') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="prioridad" class="form-label">Prioridad</label>
                                        <select class="form-select" wire:model="prioridad">
                                            <option value="">Seleccione prioridad</option>
                                            <option value="alta">Alta</option>
                                            <option value="media">Media</option>
                                            <option value="baja">Baja</option>
                                        </select>
                                        @error('prioridad') <span class="text-danger">{{ $message }}</span> @enderror
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
                                    <label for="habitacion_id" class="form-label">Habitación</label>
                                    <select class="form-select" wire:model="habitacion_id">
                                        <option value="">Seleccione una habitación</option>
                                        @foreach($habitaciones as $habitacion)
                                            <option value="{{ $habitacion->id }}">Habitación {{ $habitacion->numero_habitacion }}</option>
                                        @endforeach
                                    </select>
                                    @error('habitacion_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" wire:model="descripcion" rows="3"></textarea>
                                    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="personal" class="form-label">Personal Asignado</label>
                                    <select class="form-select" wire:model="personal">
                                        <option value="">Seleccione personal</option>
                                        <option value="Personal 1">Personal 1</option>
                                        <option value="Personal 2">Personal 2</option>
                                        <option value="Personal 3">Personal 3</option>
                                        <option value="Personal 4">Personal 4</option>
                                    </select>
                                    @error('personal') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="prioridad" class="form-label">Prioridad</label>
                                    <select class="form-select" wire:model="prioridad">
                                        <option value="">Seleccione prioridad</option>
                                        <option value="alta">Alta</option>
                                        <option value="media">Media</option>
                                        <option value="baja">Baja</option>
                                    </select>
                                    @error('prioridad') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="cerrarModalCrear">Cancelar</button>
                            <button type="button" class="btn btn-primary" wire:click="registrarMantenimiento">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
        @endif
    </div>
</div>


<!-- Vista alternativa -->
<!-- <div class="content p-4">
  <h1 class="text-dark mb-4">Módulo de Mantenimiento</h1>

  <div class="row"> -->
    <!-- Estado de Mantenimiento -->
    <!-- <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-header">
          Estado de Mantenimiento
        </div>
        <div class="card-body">
          <p class="card-text">Habitaciones pendientes de mantenimiento: <strong>5</strong></p>
          <p class="card-text">Áreas comunes en mantenimiento: <strong>2</strong></p>
        </div>
      </div>
    </div> -->

    <!-- Mantenimientos Pendientes -->
    <!-- <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-header">
          Mantenimientos Pendientes
        </div>
        <div class="card-body">
          <ul>
            <li>Reparación de aire acondicionado - Habitación 305</li>
            <li>Reemplazo de bombilla - Pasillo 2</li>
            <li>Revisión de fontanería - Habitación 202</li>
          </ul>
        </div>
      </div>
    </div> -->

    <!-- Historial de Mantenimientos -->
    <!-- <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-header">
          Historial de Mantenimiento
        </div>
        <div class="card-body">
          <ul>
            <li>Reparación de cerradura - Habitación 101 (Realizado el 12/11/2024)</li>
            <li>Revisión de calefacción - Habitación 205 (Realizado el 10/11/2024)</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
     Accesos Rápidos -->
    <!-- <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-header">
          Accesos Rápidos
        </div>
        <div class="card-body">
          <ul>
            <li><a href="#mantenimientosPendientes">Ver Mantenimientos Pendientes</a></li>
            <li><a href="#historialMantenimientos">Ver Historial de Mantenimiento</a></li>
            <li><a href="#registrarMantenimiento" data-bs-toggle="modal" data-bs-target="#modalRegistrarMantenimiento">Registrar Nuevo Mantenimiento</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div> --> 

  <!-- Modal para Registrar Nuevo Mantenimiento -->
  <!-- <div class="modal fade" id="modalRegistrarMantenimiento" tabindex="-1" aria-labelledby="modalRegistrarMantenimientoLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalRegistrarMantenimientoLabel">Registrar Nuevo Mantenimiento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="habitacion" class="form-label">Habitación/Área</label>
              <input type="text" class="form-control" id="habitacion" placeholder="Ej. Habitación 305">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción del Problema</label>
              <textarea class="form-control" id="descripcion" rows="3" placeholder="Describa el problema"></textarea>
            </div>
            <div class="mb-3">
              <label for="prioridad" class="form-label">Prioridad</label>
              <select class="form-control" id="prioridad">
                <option>Alta</option>
                <option>Media</option>
                <option>Baja</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Mantenimiento</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> --> 
