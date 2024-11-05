<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">
            <i class="fas fa-folder-plus me-2"></i>
            {{ $proveedor->iProID ? 'Editar Proveedor' : 'Nuevo Proveedor' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ $proveedor->iProID ? route('proveedor.update', $proveedor) : route('proveedor.store') }}" method="post">
            @csrf
            @if($proveedor->iProID)
            @method('PUT')
            <input type="hidden" name="iProID" value="{{ $proveedor->iProID }}">
            @endif


            <div class="mb-3">
                <label for="empresa" class="form-label">Empresa</label>
                <input type="text" class="form-control" name="empresa"
                    value="{{ old('empresa', $proveedor->cProEmpresa) }}" required placeholder="Ingrese el nombre de la Empresa">
            </div>

            <div class="mb-3">
                <label for="ruc" class="form-label">RUC</label>
                <input type="text" class="form-control" name="ruc"
                    value="{{ old('ruc', $proveedor->cProRucEmpresa) }}" required placeholder="Ingrese el RUC de la Empresa" maxlength="11" >
            </div>

            <div class="mb-3">
                <label for="razonSocial" class="form-label">Razon Social</label>
                <input type="text" class="form-control" name="razonSocial"
                    value="{{ old('razonSocial', $proveedor->cProRazonSocial) }}" required placeholder="Ingrese la Razon Social de la Empresa">
            </div>

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
