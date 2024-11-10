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
                    <h6><strong>ID del Pedido:</strong> 1</h6>
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
             <a href="/crear-pedido" class="btn btn-primary">Crear Pedido</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
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
                    <tr>
                        <th scope="row">1</th>
                        <td>12</td>
                        <td>Higiene Total</td>
                        <td>20-10-2024</td>
                        <td>06-11-2024</td>
                        <td>Completado</td>
                        <td>$200</td>
                        <td class="text-center">
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
                </tbody>
            </table>
        </div>
    </div>
</div>
