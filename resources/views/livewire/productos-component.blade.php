<div>
<div class="content p-4">
            <h1 class="text-dark mb-4">Productos</h1>
            <div class="d-flex justify-content-between align-items-center my-2">
                <button class="btn btn-primary" wire:click="abrirModalCrear">Registrar</button>
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
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Stock minimo</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Fecha de creacion</th>
                            <th scope="col">Fecha de modificacion</th>
                            <th scope="col" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Papel Higiénico</td>
                        <td>Rollo de papel higiénico de doble hoja.</td>
                        <td>$1.50</td>
                        <td>65</td>
                        <td>40</td>
                        <td>Productos de Higiene</td>
                        <td>18-01-2020</td>
                        <td>20-10-2024</td>
                            <td class="text-center">
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

</div>
</div>
