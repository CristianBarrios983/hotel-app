@if ($viewMode === 'list')
    <!-- Aqui va la vista principal de pedidos -->
    <div>
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

        <!-- Tabla con botón para Ver Detalles -->
        <div class="content p-4">
            <h1 class="mb-4">Pedidos</h1>
            <div class="d-flex justify-content-between align-items-center my-2">
                <!-- <button class="btn btn-primary">Registrar</button> -->
                <a href="#" class="btn btn-primary" wire:click="cambiarVista('create')">Crear Pedido</a>
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
                                <a href="#" class="btn btn-info btn-sm"     title="Ver Detalles" 
                                wire:click="verDetalles({{ $pedido->id }})">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                @if($pedido->estado_pedido !== 'Cancelado' && $pedido->estado_pedido !== 'Entregado')
                                    <a href="#" class="btn btn-success btn-sm" title="Marcar como Entregado" wire:click="check({{ $pedido->id }})">
                                        <i class="bi bi-check2-circle"></i> Entregado
                                    </a>
                                    <!-- <a href="#" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a> -->
                                    <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="cancelar({{ $pedido->id }})">
                                        <!-- <i class="bi bi-trash-fill"></i> -->
                                        Cancelar
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@elseif ($viewMode === 'create')
    <!-- Aqui va la vista para crear pedido -->
    <div>
         <!-- Estilos -->
        <style>
            .card-header h4 {
                margin: 0;
            }

            #resumenPedido tr td {
                vertical-align: middle;
            }

            #resumenPedido tr td button {
                font-size: 0.8rem;
            }
        </style>

        <div class="content p-4">
            <h1 class="mb-4">Realizar Pedido</h1>

            <!-- Mensajes -->
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Mensaje de error generico -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="row">
                <!-- Sección de Selección de Proveedor -->
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <h4>Seleccionar Proveedor</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="proveedor" class="form-label">Proveedor</label>
                                <select wire:model="proveedorSeleccionado" class="form-control">
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_proveedor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección de Productos -->
                <div class="col-md-7">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4>Seleccionar Productos</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Cantidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>${{ number_format($producto->precio, 2) }}</td>
                                        <td>{{ $producto->stock }}</td>
                                        <td>
                                            <!-- Vincular la cantidad al atributo de Livewire -->
                                            <input 
                                                type="number" 
                                                class="form-control" 
                                                min="1" 
                                                max="{{ $producto->stock }}" 
                                                wire:model.defer="cantidad.{{ $producto->id }}" 
                                                value="1" 
                                                style="width: 80px;">
                                        </td>
                                        <td>
                                            <!-- Llamar al método Livewire sin usar `$` para cantidades -->
                                            <button 
                                                class="btn btn-primary btn-sm" 
                                                wire:click="agregarProducto({{ $producto->id }})">
                                                <i class="bi bi-cart-plus"></i> Añadir
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Sección de Resumen -->
                <div class="col-md-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h4>Resumen del Pedido</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="resumenPedido">
                                @foreach ($productosSeleccionados as $producto)
                                    <tr>
                                        <td>{{ $producto['nombre'] }}</td>
                                        <td>{{ $producto['cantidad'] }}</td>
                                        <td>${{ number_format($producto['subtotal'], 2) }}</td>
                                        <td>
                                            <button 
                                                class="btn btn-danger btn-sm" 
                                                wire:click="eliminarProducto({{ $producto['id'] }})">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Total del Pedido -->
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <span><strong>Total:</strong></span>
                                <span class="fs-4 text-success">
                                    ${{ number_format(array_sum(array_column($productosSeleccionados, 'subtotal')), 2) }}
                                </span>
                            </div>
                            <button class="btn btn-success w-100 mt-3" wire:click="registrarPedido">
                                <i class="bi bi-check-circle"></i> Confirmar Pedido
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

