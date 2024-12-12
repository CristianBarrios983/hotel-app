<div class="content p-4">
    <h1 class="mb-4">Check-Out</h1>

    <div class="card">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Salidas Programadas - {{ now()->format('d/m/Y') }}</h5>
        </div>
        <div class="card-body">
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
                            <th>Hora Salida</th>
                            <th>Habitación</th>
                            <th>Huésped</th>
                            <th>Noches</th>
                            <th>Estado Habitación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservas as $reserva)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($reserva->check_out)->format('H:i') }}</td>
                                <td>Habitación {{ $reserva->habitacion->numero_habitacion }}</td>
                                <td>{{ $reserva->huesped->nombre }} {{ $reserva->huesped->apellido }}</td>
                                <td>{{ $reserva->noches }}</td>
                                <td>
                                    <span class="badge bg-primary text-capitalize">{{ $reserva->habitacion->disponibilidad }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" 
                                            wire:click="iniciarCheckOut({{ $reserva->id }})">
                                        <i class="bi bi-box-arrow-right"></i> Check-Out
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No hay salidas programadas para hoy
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación Check-out -->
    @if($isModalOpen)
        <div class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Check-out</h5>
                        <button type="button" class="btn-close" wire:click="cerrarModal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Detalles de la Reserva -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Detalles de la Reserva</h6>
                            <p><strong>Huésped:</strong> {{ $reservaSeleccionada->huesped->nombre ?? '' }} {{ $reservaSeleccionada->huesped->apellido ?? '' }}</p>
                            <p><strong>Habitación:</strong> {{ $reservaSeleccionada->habitacion->numero_habitacion ?? '' }}</p>
                            <p><strong>Check-in:</strong> {{ $reservaSeleccionada ? \Carbon\Carbon::parse($reservaSeleccionada->check_in)->format('d/m/Y H:i') : '' }}</p>
                            <p><strong>Check-out:</strong> {{ $reservaSeleccionada ? \Carbon\Carbon::parse($reservaSeleccionada->check_out)->format('d/m/Y H:i') : '' }}</p>
                            <p><strong>Noches:</strong> {{ $reservaSeleccionada->noches ?? '' }}</p>
                        </div>

                        <!-- Verificación de Habitación -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" wire:model="habitacionVerificada">
                            <label class="form-check-label">
                                Habitación verificada
                            </label>
                            @error('habitacionVerificada') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cerrarModal">Cancelar</button>
                        <button type="button" class="btn btn-warning" wire:click="procederAFacturacion">
                            <i class="bi bi-receipt"></i> Proceder a Facturación
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
