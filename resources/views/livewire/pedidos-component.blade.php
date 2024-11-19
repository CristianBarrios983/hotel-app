@if ($viewMode === 'list')
    <!-- Aqui va la vista principal de pedidos -->
    <div>
        <!-- Modal de Detalles -->
        <div class="modal fade" id="detallePedidoModal" tabindex="-1" aria-labelledby="detallePedidoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detallePedidoLabel">Detalles del Pedido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Información del Pedido -->
                        <h6><strong>Proveedor:</strong> Higiene Total</h6>
                        <h6><strong>Fecha de Pedido:</strong> 20-10-2024</h6>
                        <h6><strong>Fecha de Entrega:</strong> 06-11-2024</h6>
                        <h6><strong>Estado:</strong> Completado</h6>
                        <h6><strong>Total:</strong> $200</h6>

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
                                    <tr>
                                        <td>Jabón Antibacterial</td>
                                        <td>10</td>
                                        <td>$5.00</td>
                                        <td>$50.00</td>
                                    </tr>
                                    <tr>
                                        <td>Shampoo</td>
                                        <td>5</td>
                                        <td>$30.00</td>
                                        <td>$150.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla con botón para Ver Detalles -->
        <div class="content p-4">
            <h1 class="text-dark mb-4">Pedidos</h1>
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
                            <td>{{ $pedido->fecha_entrega->format('d-m-Y') }}</td>
                            <td>{{ $pedido->estado_pedido }}</td>
                            <td>${{ number_format($pedido->total, 2) }}</td>
                            <td class="text-center">
                                <!-- Acciones -->
                                <a href="#" class="btn btn-info btn-sm" title="Ver Detalles" data-bs-toggle="modal" data-bs-target="#detallePedidoModal">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="#" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" title="Eliminar">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
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
            <h1 class="text-dark mb-4">Realizar Pedido</h1>

            <!-- Mensajes -->
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
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
                                <select class="form-select" id="proveedor" wire:model="proveedor_id">
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
                            <button class="btn btn-success w-100 mt-3">
                                <i class="bi bi-check-circle"></i> Confirmar Pedido
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

