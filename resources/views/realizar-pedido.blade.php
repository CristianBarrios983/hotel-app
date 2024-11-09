@extends('layouts.app') 

@section('content')

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
                        <select class="form-select" id="proveedor">
                            <option value="">Seleccione un proveedor</option>
                            <option value="1">Proveedor A</option>
                            <option value="2">Proveedor B</option>
                            <option value="3">Proveedor C</option>
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
                            <tr>
                                <td>Producto A</td>
                                <td>$10.00</td>
                                <td>50</td>
                                <td>
                                    <input type="number" class="form-control" min="1" max="50" value="1" style="width: 80px;">
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="agregarProducto('Producto A', 10, 1)">
                                        <i class="bi bi-cart-plus"></i> Añadir
                                    </button>
                                </td>
                            </tr>
                            <!-- Repetir filas según los productos -->
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
                            <!-- Productos añadidos aparecerán aquí -->
                        </tbody>
                    </table>
                    <!-- Total del Pedido -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <span><strong>Total:</strong></span>
                        <span class="fs-4 text-success" id="totalPedido">$0.00</span>
                    </div>
                    <button class="btn btn-success w-100 mt-3">
                        <i class="bi bi-check-circle"></i> Confirmar Pedido
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

        

@endsection