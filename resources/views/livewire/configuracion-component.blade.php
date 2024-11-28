<div class="container py-5">
    
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white text-center">
                    <h4 class="mb-0">
                        @if($configuracionExistente)
                            Editar Configuración del Hotel
                        @else
                            Configuración Inicial del Hotel
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    @if($configuracionExistente)
                        <!-- Mostrar información actual -->
                        <div class="mb-4">
                            <h5>Información Actual</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nombre del Hotel:</th>
                                        <td>{{ $nombre_hotel }}</td>
                                    </tr>
                                    <tr>
                                        <th>Razón Social:</th>
                                        <td>{{ $razon_social }}</td>
                                    </tr>
                                    <tr>
                                        <th>CUIT:</th>
                                        <td>{{ $cuit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Correo Electrónico:</th>
                                        <td>{{ $correo }}</td>
                                    </tr>
                                    <tr>
                                        <th>Teléfono:</th>
                                        <td>{{ $telefono }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dirección:</th>
                                        <td>{{ $direccion }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sitio Web:</th>
                                        <td>{{ $sitio_web }}</td>
                                    </tr>
                                    <tr>
                                        <th>Otros Detalles:</th>
                                        <td>{{ $otros_detalles }}</td>
                                    </tr>
                                </table>
                            </div>
                            <button wire:click="habilitarEdicion" class="btn btn-warning mb-3">
                                <i class="bi bi-pencil"></i> Editar Información
                            </button>
                        </div>
                    @endif

                    @if(!$configuracionExistente || $modoEdicion)
                        <form wire:submit.prevent="guardarConfiguracion">
                            <!-- Nombre del Hotel -->
                            <div class="mb-3">
                                <label for="nombre_hotel" class="form-label">Nombre del Hotel</label>
                                <input type="text" class="form-control" id="nombre_hotel" wire:model="nombre_hotel" required>
                            </div>

                            <!-- Razón Social -->
                            <div class="mb-3">
                                <label for="razon_social" class="form-label">Razón Social</label>
                                <input type="text" class="form-control" id="razon_social" wire:model="razon_social" required>
                            </div>

                            <!-- CUIT -->
                            <div class="mb-3">
                                <label for="cuit" class="form-label">CUIT</label>
                                <input type="text" class="form-control" id="cuit" wire:model="cuit" pattern="[0-9]{2}-[0-9]{8}-[0-9]" placeholder="XX-XXXXXXXX-X" required>
                            </div>

                            <!-- Correo Electrónico -->
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" wire:model="correo" required>
                            </div>

                            <!-- Teléfono -->
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" wire:model="telefono" required>
                            </div>

                            <!-- Direccion -->
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Direccion</label>
                                <input type="text" class="form-control" id="direccion" wire:model="direccion" required>
                            </div>

                            <!-- Sitio Web -->
                            <div class="mb-3">
                                <label for="sitio_web" class="form-label">Sitio Web</label>
                                <input type="text" class="form-control" id="sitio_web" wire:model="sitio_web" required>
                            </div>

                            <!-- Otros Detalles -->
                            <div class="mb-3">
                                <label for="otros_detalles" class="form-label">Otros Detalles</label>
                                <textarea class="form-control" id="otros_detalles" wire:model="otros_detalles" rows="3"></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ $configuracionExistente ? 'Actualizar' : 'Guardar' }} Configuración
                                </button>
                                @if($modoEdicion)
                                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                        Cancelar
                                    </a>
                                @endif
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>