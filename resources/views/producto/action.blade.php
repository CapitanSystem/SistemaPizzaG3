<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">
            <i class="fas fa-folder-plus me-2"></i>
            {{ $producto->iProID ? 'Editar Producto' : 'Nuevo Producto' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ $producto->iProID ? route('producto.update', $producto) : route('producto.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if($producto->iProID)
            @method('PUT')
            <input type="hidden" name="iProID" value="{{ $producto->iProID }}">
            @endif


            <div class="row">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre"
                        value="{{ old('nombre', $producto->cProNombre) }}" required placeholder="Ingrese el nombre del Producto">
                </div>
                <div class="col-md-6">
                    <label for="tamanio" class="form-label">Tamaño</label>
                    <input type="text" class="form-control" name="tamanio"
                        value="{{ old('tamanio', $producto->cProTamanio) }}" required placeholder="Tamaño del Producto">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="nombre">Categoría</label>
                    <select class="form-control" name="categoria_id" id="">
                        @foreach($categorias as $cat)
                        <option value="{{$cat->iCatID}}" {{ (old('categoria_id', $producto->iProCategoriaID) == $cat->iCatID) ? 'selected' : '' }}>
                            {{$cat->cCatNombre}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="precioC">Precio Compra</label>
                        <input type="number" class="form-control" step="0.01" min="0" name="precioC" value="{{$producto->fProPrecioCompra}}"
                            placeholder="Ingrese Precio Compra">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="precioV">Precio Venta</label>
                        <input type="number" class="form-control" step="0.01" min="0" name="precioV" value="{{$producto->fProPrecioVenta}}"
                            placeholder="Ingrese Precio Venta">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Imagen</label>
                        <input type="file" class="form-control" name="imagen">
                    </div>
                    @if($producto->cProImagen)
                    <div>
                        <img class="img-rounded" width="100" height="100"
                            src="{{asset('productos/'.$producto->cProImagen)}}" alt="{{$producto->cProImagen}}">
                    </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Stock</label>
                        <input type="number" class="form-control" name="stock" value="{{$producto->iProStock}}"
                            placeholder="Ingrese Stock">
                    </div>

                </div>

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
