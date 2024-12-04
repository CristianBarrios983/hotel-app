<div class="container my-5">
   <div class="card shadow">
       <div class="card-header bg-primary text-white">
           <h3 class="mb-0">Generar Factura</h3>
       </div>

       <!-- Modal de productos -->
       @if($showProductModal)
        <div class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seleccionar Producto/Servicio</h5>
                        <button type="button" class="btn-close" wire:click="cerrarModalProductos"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Barra de búsqueda -->
                        <div class="mb-3">
                            <input type="text" 
                                    class="form-control" 
                                    placeholder="Buscar..."
                                    wire:model.live="search">
                        </div>

                        <!-- Tabs -->
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <a class="nav-link {{ $tipoSeleccionado == 'productos' ? 'active' : '' }}" 
                                   wire:click="$set('tipoSeleccionado', 'productos')" 
                                   href="javascript:void(0)">
                                   Productos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $tipoSeleccionado == 'servicios' ? 'active' : '' }}" 
                                   wire:click="$set('tipoSeleccionado', 'servicios')" 
                                   href="javascript:void(0)">
                                   Servicios
                                </a>
                            </li>
                        </ul>

                        <!-- Lista de items -->
                        <div class="list-group">
                            @forelse($items as $item)
                                <button type="button" 
                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                        wire:click="agregarItem({{ $item->id }})">
                                    <div>
                                        <h6 class="mb-1">{{ $item->nombre }}</h6>
                                        <small>{{ $item->descripcion }}</small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">
                                        S/. {{ number_format($item->precio, 2) }}
                                    </span>
                                </button>
                            @empty
                                <div class="list-group-item text-center text-muted">
                                    No se encontraron items
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showProductModal', false)">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
       @endif
       
       <div class="card-body">
           <!-- Mensajes de éxito/error -->
           @if (session()->has('message'))
               <div class="alert alert-success">
                   {{ session('message') }}
               </div>
           @endif

           @if (session()->has('error'))
               <div class="alert alert-danger">
                   {{ session('error') }}
               </div>
           @endif

           <!-- Datos de la Reserva -->
           <div class="row mb-4">
               <div class="col-12">
                   <h5>Datos de la Reserva</h5>
               </div>
               <div class="col-md-6">
                   <p><strong>Habitación:</strong> {{ $reserva->habitacion->numero_habitacion }} 
                       ({{ $reserva->habitacion->tipoHabitacion->nombre_tipo }})</p>
                   <p><strong>Huésped:</strong> {{ $reserva->huesped->nombre }} {{ $reserva->huesped->apellido }}</p>
               </div>
               <div class="col-md-6">
                   <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($reserva->check_in)->format('d/m/Y H:i') }}</p>
                   <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($reserva->check_out)->format('d/m/Y H:i') }}</p>
                   <p><strong>Noches:</strong> {{ $reserva->noches }}</p>
               </div>
           </div>
            <!-- Detalles de Facturación -->
           <div class="row mb-4">
               <div class="col-12">
                   <h5>Detalles de Facturación</h5>
                   <table class="table">
                       <thead>
                           <tr>
                               <th>Concepto</th>
                               <th>Cantidad</th>
                               <th>Precio Unitario</th>
                               <th>Subtotal</th>
                               <th></th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($detalles as $index => $detalle)
                           <tr>
                               <td>
                                   @if($index === 0)
                                       {{ $detalle['concepto'] }}
                                   @else
                                       <input type="text" class="form-control" 
                                              wire:model="detalles.{{ $index }}.concepto"
                                              wire:change="actualizarSubtotal({{ $index }})">
                                   @endif
                               </td>
                               <td>
                                   @if($index === 0)
                                       {{ $detalle['cantidad'] }}
                                   @else
                                       <input type="number" class="form-control" min="1"
                                              wire:model="detalles.{{ $index }}.cantidad"
                                              wire:change="actualizarSubtotal({{ $index }})">
                                   @endif
                               </td>
                               <td>
                                   @if($index === 0)
                                       {{ number_format($detalle['precio_unitario'], 2) }}
                                   @else
                                       <input type="number" step="0.01" class="form-control"
                                              wire:model="detalles.{{ $index }}.precio_unitario"
                                              wire:change="actualizarSubtotal({{ $index }})">
                                   @endif
                               </td>
                               <td>{{ number_format($detalle['subtotal'], 2) }}</td>
                               <td>
                                   @if($index > 0)
                                       <button type="button" class="btn btn-danger btn-sm" 
                                               wire:click="eliminarCargo({{ $index }})">
                                           <i class="bi bi-trash"></i>
                                       </button>
                                   @endif
                               </td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                   <button type="button" class="btn btn-secondary mb-3 me-2" wire:click="$set('showProductModal', true)">
                       <i class="bi bi-plus-circle"></i> Agregar Producto/Servicio
                   </button>
                   @error('detalles') 
                       <div class="alert alert-danger">
                           {{ $message }}
                       </div>
                   @enderror
               </div>
           </div>
            <!-- Total -->
           <div class="row mb-4">
               <div class="col-md-6">
                   <label class="form-label">Método de Pago</label>
                   <select class="form-select" wire:model="metodo_pago">
                       <option value="">Seleccione método de pago</option>
                       <option value="efectivo">Efectivo</option>
                       <option value="tarjeta">Tarjeta</option>
                       <option value="transferencia">Transferencia</option>
                   </select>
                   @error('metodo_pago') 
                       <span class="text-danger">{{ $message }}</span>
                   @enderror
               </div>
               <div class="col-md-6">
                   <div class="card">
                       <div class="card-body">
                           <h5>Resumen</h5>
                           <p><strong>Total:</strong> {{ number_format($total, 2) }}</p>
                           @error('total') 
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                       </div>
                   </div>
               </div>
           </div>
            <!-- Botones -->
           <div class="row">
               <div class="col-12">
                   <button type="button" class="btn btn-primary" wire:click="generarFactura">
                       <i class="bi bi-receipt"></i> Generar Factura
                   </button>
                   <a href="{{ route('check-out') }}" class="btn btn-secondary">
                       Cancelar
                   </a>
               </div>
           </div>
       </div>
   </div>
