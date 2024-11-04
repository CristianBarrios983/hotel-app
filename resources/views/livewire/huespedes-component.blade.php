<div>
<div class="content p-4">
            <h1 class="text-dark mb-4">Huespedes</h1>
            <div class="d-flex justify-content-between align-items-center my-2">
                <button class="btn btn-primary">Registrar</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Fecha de nacimiento</th>
                            <th scope="col">Nacionalidad</th>
                            <th scope="col">tipo de documento</th>
                            <th scope="col">Nro de documento</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Fecha creacion</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($huespedes as $huesped)
                        <tr>
                            <th scope="row">{{ $huesped->id }}</th>
                            <td>{{ $huesped->nombre }}</td>
                            <td>{{ $huesped->apellido }}</td>
                            <td>{{ $huesped->fecha_nacimiento->format('d/m/Y') }}</td>
                            <td>{{ $huesped->nacionalidad }}</td>
                            <td>{{ $huesped->tipo_documento }}</td>
                            <td>{{ $huesped->numero_documento }}</td>
                            <td>{{ $huesped->email }}</td>
                            <td>{{ $huesped->telefono }}</td>
                            <td>{{ $huesped->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal" wire:click="abrirModalEditar({{ $huesped->id }})>
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="eliminar({{ $huesped->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                        <!-- Más filas de muestra -->
                    </tbody>
                </table>
            </div>
        </div>
        
        
    </div>
</div>
