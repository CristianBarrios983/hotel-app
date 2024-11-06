<div>
<div class="content p-4">
            <h1 class="text-dark mb-4">Proveedores</h1>
            <div class="d-flex justify-content-between align-items-center my-2">
                <button class="btn btn-primary">Registrar</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre de Proveedor</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Email</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Fecha de creacion</th>
                            <th scope="col" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($proveedores as $proveedor)
                        <tr>
                        <th scope="row">{{ $proveedor->id }}</th>
                        <td>{{ $proveedor->nombre_proveedor }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>{{ $proveedor->email }}</td>
                        <td>{{ $proveedor->direccion }}</td>
                        <td>{{ $proveedor->descripcion }}</td>
                        <td>{{ $proveedor->categoria_id }}</td>
                        <td>{{ $proveedor->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal" wire:click="abrirModalEditar({{ $proveedor->id }})">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="eliminar({{ $proveedor->id }})">
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

</div>
