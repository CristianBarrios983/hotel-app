<div class="container py-5">

    <!-- Mensajes -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white text-center">
                        <h4 class="mb-0">Configuración del Hotel</h4>
                    </div>
                    <div class="card-body">
                        <form action="/guardar-configuracion" method="POST">
                            <!-- Nombre del Hotel -->
                            <div class="mb-3">
                                <label for="nombre_hotel" class="form-label">Nombre del Hotel</label>
                                <input type="text" class="form-control" id="nombre_hotel" name="nombre_hotel" required>
                            </div>

                            <!-- Razón Social -->
                            <div class="mb-3">
                                <label for="razon_social" class="form-label">Razón Social</label>
                                <input type="text" class="form-control" id="razon_social" name="razon_social" required>
                            </div>

                            <!-- CUIT -->
                            <div class="mb-3">
                                <label for="cuit" class="form-label">CUIT</label>
                                <input type="text" class="form-control" id="cuit" name="cuit" required>
                            </div>

                            <!-- Correo Electrónico -->
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>

                            <!-- Teléfono -->
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                            </div>

                            <!-- Direccion -->
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Direccion</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                            </div>

                            <!-- Sitio Web -->
                            <div class="mb-3">
                                <label for="sitio_web" class="form-label">Sitio Web</label>
                                <input type="text" class="form-control" id="sitio_web" name="sitio_web" required>
                            </div>

                            <!-- Otros Detalles -->
                            <div class="mb-3">
                                <label for="otros_detalles" class="form-label">Otros Detalles</label>
                                <textarea class="form-control" id="otros_detalles" name="otros_detalles" rows="3"></textarea>
                            </div>

                            <!-- Botón de Guardar -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Guardar Configuración</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>