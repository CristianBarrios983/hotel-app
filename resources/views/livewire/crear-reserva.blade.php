<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Nueva Reserva</h3>
        </div>
        
        <div class="card-body">
            <!-- Mensajes -->
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

            <form wire:submit.prevent="guardarReserva">
                <!-- Selección de Habitación -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Habitación</label>
                        <select class="form-select" wire:model="habitacion_id">
                            <option value="">Seleccione una habitación</option>
                            @foreach($habitacionesDisponibles as $habitacion)
                                <option value="{{ $habitacion->id }}">
                                    Habitación {{ $habitacion->numero_habitacion }}
                                </option>
                            @endforeach
                        </select>
                        @error('habitacion_id') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Fechas Check-in/Check-out -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Check-in</label>
                        <input type="datetime-local" class="form-control" wire:model="check_in">
                        @error('check_in') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Check-out</label>
                        <input type="datetime-local" class="form-control" wire:model="check_out">
                        @error('check_out') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Datos del Huésped -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5>Datos del Huésped</h5>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Seleccionar Huésped Existente</label>
                        <select class="form-select" wire:model="huesped_id">
                            <option value="">Nuevo huésped</option>
                            @foreach($huespedes as $huesped)
                                <option value="{{ $huesped->id }}">
                                    {{ $huesped->nombre }} {{ $huesped->apellido }}
                                </option>
                            @endforeach
                        </select>
                        @error('huesped_id') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Estado inicial -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Estado</label>
                        <select class="form-select" wire:model="estado">
                            <option value="pendiente">Pendiente</option>
                            <option value="confirmada">Confirmada</option>
                        </select>
                        @error('estado') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label class="form-label">Observaciones</label>
                        <textarea class="form-control" wire:model="observaciones" rows="3"></textarea>
                        @error('observaciones') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            Crear Reserva
                        </button>
                        <a href="{{ route('recepcion') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
