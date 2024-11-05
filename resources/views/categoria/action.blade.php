<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">
            <i class="fas fa-folder-plus me-2"></i>
            {{ $categoria->iCatID ? 'Editar Categoría' : 'Nueva Categoría' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ $categoria->iCatID ? route('categoria.update', $categoria) : route('categoria.store') }}" method="post">
            @csrf
            @if($categoria->iCatID)
            @method('PUT')
            <input type="hidden" name="iCatID" value="{{ $categoria->iCatID }}">
            @endif

            <!-- Campo Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre"
                    value="{{ old('nombre', $categoria->cCatNombre) }}" required placeholder="Ingrese el nombre de la categoría">
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="nombre">Tipo</label>
                    <select class="form-control" name="tipo" id="" require>
                        <option value="C" {{ old('cCatTipo', $categoria->cCatTipo) == 'C' ? 'selected' : '' }}>Compra</option>
                        <option value="V" {{ old('cCatTipo', $categoria->cCatTipo) == 'V' ? 'selected' : '' }}>Venta</option>
                        <option value="A" {{ old('cCatTipo', $categoria->cCatTipo) == 'A' ? 'selected' : '' }}>Compra y Venta</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3"
                    placeholder="Ingrese una descripción opcional">{{ old('descripcion', $categoria->cCatDescripcion) }}</textarea>
            </div>

            @if($categoria->iCatID)
            <div class="mb-3">
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select class="form-control" name="estado" required>
                            <option value="A" {{ old('cCatEstado', $categoria->cCatEstado) == 'A' ? 'selected' : '' }}>Activo</option>
                            <option value="I" {{ old('cCatEstado', $categoria->cCatEstado) == 'I' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>
            @endif

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
