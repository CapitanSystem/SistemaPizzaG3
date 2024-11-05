<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">
            <i class="fas fa-user-plus me-2"></i>
            {{ $empleado->iEmpID ? 'Editar Empleado' : 'Nuevo Empleado' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ $empleado->iEmpID ? route('empleado.update', $empleado) : route('empleado.store') }}" method="post">
            @csrf
            @if($empleado->iEmpID)
            @method('PUT')
            <input type="hidden" name="iEmpID" value="{{ $empleado->iEmpID }}">
            @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cPerNombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="cPerNombre" id="cPerNombre"
                        value="{{ old('cPerNombre', $empleado->persona->cPerNombre) }}" required placeholder="Ingrese el nombre del empleado">
                </div>
                <div class="col-md-6">
                    <label for="cPerApellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="cPerApellido" id="cPerApellido"
                        value="{{ old('cPerApellido', $empleado->persona->cPerApellido) }}" required placeholder="Ingrese el apellido del empleado">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cPerDNI" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="cPerDNI" id="cPerDNI"
                        value="{{ old('cPerDNI', $empleado->persona->cPerDNI) }}" required placeholder="Ingrese el DNI del empleado" maxlength="8" pattern="\d{8}">
                </div>
                <div class="col-md-6">
                    <label for="cPerEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="cPerEmail" id="cPerEmail"
                        value="{{ old('cPerEmail', $empleado->persona->cPerEmail) }}" placeholder="Ingrese el email del empleado">
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cPerFNacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="cPerFNacimiento" id="cPerFNacimiento"
                        value="{{ old('cPerFNacimiento', $empleado->persona->cPerFNacimiento ? $empleado->persona->cPerFNacimiento->format('Y-m-d') : '') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="cPerTelefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="cPerTelefono" id="cPerTelefono"
                        value="{{ old('cPerTelefono', $empleado->persona->cPerTelefono) }}" required placeholder="Ingrese el teléfono del empleado">
                </div>
            </div>

            <div class="mb-3">
                <label for="cPerDireccion" class="form-label">Dirección</label>
                <textarea class="form-control" name="cPerDireccion" id="cPerDireccion" rows="2"
                    placeholder="Ingrese la dirección del empleado">{{ old('cPerDireccion', $empleado->persona->cPerDireccion) }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="cPerFNacimiento" class="form-label">Fecha de Inicio</label>
                    <input type="date" class="form-control" name="dEmpFechaInicio" id="dEmpFechaInicio"
                        value="{{ old('dEmpFechaInicio', $empleado->dEmpFechaInicio ? $empleado->dEmpFechaInicio->format('Y-m-d') : '') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="cPerFNacimiento" class="form-label">Fecha de Fin</label>
                    <input type="date" class="form-control" name="dEmpFechaFin" id="dEmpFechaFin"
                        value="{{ old('dEmpFechaFin', $empleado->dEmpFechaFin ? $empleado->dEmpFechaFin->format('Y-m-d') : '') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="fEmpSueldo" class="form-label">Sueldo</label>
                    <input type="number" class="form-control" name="fEmpSueldo" id="fEmpSueldo" step="0.01"
                        value="{{ old('fEmpSueldo', $empleado->fEmpSueldo) }}" required placeholder="Ingrese el sueldo del empleado">
                </div>
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
