<div class="container py-5">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white text-center">
                    <h4 class="mb-0">Editar Perfil</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="actualizarPerfil">
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" wire:model="nombre">
                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo" wire:model="correo">
                            @error('correo') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Número de Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" wire:model="telefono">
                            @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Dirección -->
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" wire:model="direccion">
                            @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                        </div>
                    </form>

                    <!-- Sección para Cambiar Contraseña -->
                    <hr class="my-4">
                    <h5 class="text-center">Cambiar Contraseña</h5>
                    <form wire:submit.prevent="cambiarContrasena">
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" wire:model="contrasena">
                            @error('contrasena') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contrasena_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="contrasena_confirmation" wire:model="contrasena_confirmation">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning">Cambiar Contraseña</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
