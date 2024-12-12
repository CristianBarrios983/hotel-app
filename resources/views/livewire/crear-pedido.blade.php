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

    <!-- Sección de Selección de Proveedor -->
    <div class="mb-4">
        <label for="proveedor" class="form-label">Proveedor</label>
        <select wire:model="proveedorSeleccionado" class="form-control">
            <option value="">Seleccione un proveedor</option>
            @foreach ($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_proveedor }}</option>
            @endforeach
        </select>
    </div>

    <!-- Sección de Productos -->
    <div>
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

    <!-- Resumen del Pedido -->
    <div>
        <h4>Resumen del Pedido</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
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
        <button class="btn btn-success mt-3" wire:click="registrarPedido">
            <i class="bi bi-check-circle"></i> Confirmar Pedido
        </button>
    </div>
</div>