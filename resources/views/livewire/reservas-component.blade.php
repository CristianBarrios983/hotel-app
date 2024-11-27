<div class="content p-4">
    <h1 class="mb-4">Reservas</h1>
    <div class="d-flex justify-content-between align-items-center my-2">
        <a href="/crear-reserva" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Reserva
        </a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover" id="myTable">
            <thead class="table-dark">
                <tr>
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
                @foreach($reservas as $reserva)
                    <tr>
                        <td>Habitación {{ $reserva->habitacion->numero_habitacion }}</td>
                        <td>{{ $reserva->huesped->nombre }} {{ $reserva->huesped->apellido }}</td>
                        <td>{{ \Carbon\Carbon::parse($reserva->check_in)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reserva->check_out)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ 
                                $reserva->estado === 'confirmada' ? 'warning' : 
                                ($reserva->estado === 'pendiente' ? 'secondary' : 
                                ($reserva->estado === 'no_show' ? 'info' : 
                                ($reserva->estado === 'check_in' ? 'primary' :
                                ($reserva->estado === 'check_out' ? 'success' :
                                ($reserva->estado === 'cancelada' ? 'danger' : 'dark'))))) 
                            }}">
                                {{ ucfirst(str_replace('_', ' ', $reserva->estado)) }}
                            </span>
                        </td>
                        <td>${{ number_format($reserva->total, 2) }}</td>
                        <td>{{ $reserva->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            @if($reserva->estado === 'pendiente' || $reserva->estado === 'confirmada')
                                <!-- Si está pendiente, mostrar botón de confirmar -->
                                @if($reserva->estado === 'pendiente')
                                    <a href="#" 
                                       class="btn btn-success btn-sm" 
                                       title="Confirmar Reserva"
                                       wire:click.prevent="confirmarReserva({{ $reserva->id }})">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </a>
                                @endif
                                
                                <!-- Botón de No Show disponible en ambos estados -->
                                <a href="#" 
                                   class="btn btn-info btn-sm" 
                                   title="Marcar No Show"
                                   wire:click.prevent="marcarNoShow({{ $reserva->id }})">
                                    <i class="bi bi-person-x-fill"></i>
                                </a>
                                
                                <!-- Resto de botones solo si está pendiente -->
                                @if($reserva->estado === 'pendiente')
                                    <a href="#" 
                                       class="btn btn-warning btn-sm" 
                                       title="Editar"
                                       wire:click.prevent="abrirModalEditar({{ $reserva->id }})">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="#" 
                                       class="btn btn-danger btn-sm" 
                                       title="Cancelar"
                                       wire:click.prevent="cancelarReserva({{ $reserva->id }})">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </a>
                                @endif
                            @elseif($reserva->estado === 'no_show')
                                <span class="text-muted">No se presentó</span>
                            @else
                                <span class="text-muted">Reserva cancelada</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
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
