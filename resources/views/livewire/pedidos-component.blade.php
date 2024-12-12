<div class="content p-4">
    <h1 class="mb-4">Pedidos</h1>

    <!-- Mensajes -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Botón para crear un nuevo pedido -->
    <div class="d-flex justify-content-between align-items-center my-2">
        <a href="{{ route('crear-pedido') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear Pedido
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Pedido</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Fecha de pedido</th>
                    <th scope="col">Entrega de pedido</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Total de pedido</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->proveedor->nombre_proveedor }}</td>
                    <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                    <td>{{ $pedido->fecha_entrega ? \Carbon\Carbon::parse($pedido->fecha_entrega)->format('d/m/Y') : 'Sin fecha' }}</td>
                    <td>
                    <span class="badge {{ 
                        $pedido->estado_pedido === 'Entregado' ? 'bg-success' : 
                        ($pedido->estado_pedido === 'Pendiente' ? 'bg-warning' : 
                        'bg-danger') 
                    }}">
                        {{ $pedido->estado_pedido }}
                    </span>
                    </td>
                    <td>${{ number_format($pedido->total, 2) }}</td>
                    <td class="text-center">
                        <!-- Acciones -->
                        <a href="#" class="btn btn-info btn-sm" title="Ver Detalles" 
                        wire:click="verDetalles({{ $pedido->id }})">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        @if($pedido->estado_pedido !== 'Cancelado' && $pedido->estado_pedido !== 'Entregado')
                            <a href="#" class="btn btn-success btn-sm" title="Marcar como Entregado" wire:click="check({{ $pedido->id }})">
                                <i class="bi bi-check2-circle"></i> Entregado
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" title="Cancelar" wire:click="cancelar({{ $pedido->id }})">
                                Cancelar
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal de Detalles -->
    @if($isDetalleModalOpen)
    <div class="modal fade show d-block" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles del Pedido #{{ $pedidoSeleccionado->id }}</h5>
                    <button type="button" class="btn-close" wire:click="cerrarModalDetalle" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($pedidoSeleccionado)
                        <!-- Información del Pedido -->
                        <h6><strong>Proveedor:</strong> {{ $pedidoSeleccionado->proveedor->nombre_proveedor }}</h6>
                        <h6><strong>Fecha de Pedido:</strong> {{ $pedidoSeleccionado->created_at->format('d-m-Y') }}</h6>
                        <h6><strong>Fecha de Entrega:</strong> {{ $pedidoSeleccionado->fecha_entrega ? \Carbon\Carbon::parse($pedidoSeleccionado->fecha_entrega)->format('d-m-Y') : 'Sin fecha' }}</h6>
                        <h6><strong>Estado:</strong> {{ $pedidoSeleccionado->estado_pedido }}</h6>
                        <h6><strong>Total:</strong> ${{ number_format($pedidoSeleccionado->total, 2) }}</h6>

                        <!-- Tabla de Productos -->
                        <div class="mt-4">
                            <h6><strong>Productos:</strong></h6>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pedidoSeleccionado->detalles as $detalle)
                                        <tr>
                                            <td>{{ $detalle->producto->nombre }}</td>
                                            <td>{{ $detalle->cantidad }}</td>
                                            <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                                            <td>${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cerrarModalDetalle">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>

