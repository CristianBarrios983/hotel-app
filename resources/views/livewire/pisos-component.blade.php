<div class="content p-4">
            <h1 class="text-dark mb-4">Pisos</h1>
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
                            <th scope="col">Numero de piso</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Fecha de creacion</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($pisos as $piso)
                        <tr>
                            <th scope="row">{{ $piso->id }}</th>
                            <td>{{ $piso->numero }}</td>
                            <td>{{ $piso->descripcion }}</td>
                            <td>{{ $piso->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal" wire:click="abrirModalEditar({{ $piso->id }})">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" title="Eliminar" wire:click="eliminar({{ $piso->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>


                        <!-- Modal para Editar Tipo de Habitación -->
                        

                    @endforeach
                    </tbody>
                </table>



                <!-- Modal para Registrar Tipo de Habitación -->
        
            </div>
        </div>


        

