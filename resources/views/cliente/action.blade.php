<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">
            <i class="fas fa-user-plus me-2"></i>
            {{ $cliente->iCliID ? 'Editar Cliente' : 'Nuevo Cliente' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ $cliente->iCliID ? route('cliente.update', $cliente) : route('cliente.store') }}" method="post">
            @csrf
            @if($cliente->iCliID)
            @method('PUT')
            <input type="hidden" name="iCliID" value="{{ $cliente->iCliID }}">
            @endif

            <!-- Campos Nombre y Apellido -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cPerNombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="cPerNombre" id="cPerNombre"
                        value="{{ old('cPerNombre', $cliente->persona->cPerNombre) }}" required placeholder="Ingrese el nombre del cliente">
                </div>
                <div class="col-md-6">
                    <label for="cPerApellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="cPerApellido" id="cPerApellido"
                        value="{{ old('cPerApellido', $cliente->persona->cPerApellido) }}" required placeholder="Ingrese el apellido del cliente">
                </div>
            </div>

            <!-- Campos DNI y Email -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cPerDNI" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="cPerDNI" id="cPerDNI"
                        value="{{ old('cPerDNI', $cliente->persona->cPerDNI) }}" required placeholder="Ingrese el DNI del cliente" maxlength="8" pattern="\d{8}">
                </div>
                <div class="col-md-6">
                    <label for="cPerEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="cPerEmail" id="cPerEmail"
                        value="{{ old('cPerEmail', $cliente->persona->cPerEmail) }}" placeholder="Ingrese el email del cliente">
                </div>
            </div>

            <!-- Campos Fecha de Nacimiento y Teléfono -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cPerFNacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="cPerFNacimiento" id="cPerFNacimiento"
                        value="{{ old('cPerFNacimiento', $cliente->persona->cPerFNacimiento ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="cPerTelefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="cPerTelefono" id="cPerTelefono"
                        value="{{ old('cPerTelefono', $cliente->persona->cPerTelefono) }}" required placeholder="Ingrese el teléfono del cliente">
                </div>
            </div>

            <!-- Campo Dirección -->
            <div class="mb-3">
                <label for="cPerDireccion" class="form-label">Dirección</label>
                <textarea class="form-control" name="cPerDireccion" id="cPerDireccion" rows="2"
                    placeholder="Ingrese la dirección del cliente">{{ old('cPerDireccion', $cliente->persona->cPerDireccion) }}</textarea>
            </div>

            <!-- Botón de Guardar -->
            <div class="text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times"></i> Cerrar
        </button>
    </div>
</div>
