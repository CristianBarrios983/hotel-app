<div class="content p-4">
    <h1 class="mb-4">Check-In</h1>

    <!-- Lista de Llegadas del Día -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Llegadas Programadas - {{ now()->format('d/m/Y') }}</h5>
        </div>
        <div class="card-body">
            <!-- Mensajes de éxito/error -->
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
                <table class="table table-striped table-bordered table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <th>Habitación</th>
                            <th>Huésped</th>
                            <th>Noches</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservas as $reserva)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($reserva->check_in)->format('H:i') }}</td>
                                <td>Habitación {{ $reserva->habitacion->numero_habitacion }}</td>
                                <td>{{ $reserva->huesped->nombre }} {{ $reserva->huesped->apellido }}</td>
                                <td>{{ $reserva->noches }}</td>
                                <td>
                                    <span class="badge bg-warning text-capitalize">{{ $reserva->estado }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#checkInModal"
                                            wire:click="seleccionarReserva({{ $reserva->id }})">
                                        <i class="bi bi-check-circle"></i> Check-In
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No hay llegadas programadas para hoy
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Check-in -->
    @if($isModalOpen)
        <div class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Check-in</h5>
                        <button type="button" class="btn-close" wire:click="cerrarModal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Resumen de la Reserva -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Detalles de la Reserva</h6>
                            <p><strong>Huésped:</strong> {{ $reservaSeleccionada->huesped->nombre ?? '' }} {{ $reservaSeleccionada->huesped->apellido ?? '' }}</p>
                            <p><strong>Habitación:</strong> {{ $reservaSeleccionada->habitacion->numero_habitacion ?? '' }}</p>
                            <p><strong>Entrada:</strong> {{ $reservaSeleccionada ? \Carbon\Carbon::parse($reservaSeleccionada->check_in)->format('d/m/Y H:i') : '' }}</p>
                            <p><strong>Salida:</strong> {{ $reservaSeleccionada ? \Carbon\Carbon::parse($reservaSeleccionada->check_out)->format('d/m/Y H:i') : '' }}</p>
                            @if($reservaSeleccionada && $reservaSeleccionada->observaciones)
                                <p><strong>Observaciones:</strong> {{ $reservaSeleccionada->observaciones }}</p>
                            @endif
                        </div>

                        <!-- Confirmación -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" wire:model="identidadVerificada">
                            <label class="form-check-label">
                                Identidad verificada
                            </label>
                            @error('identidadVerificada') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cerrarModal">Cancelar</button>
                        <button type="button" class="btn btn-success" wire:click="confirmarCheckIn">
                            <i class="bi bi-check-circle"></i> Confirmar Check-in
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
