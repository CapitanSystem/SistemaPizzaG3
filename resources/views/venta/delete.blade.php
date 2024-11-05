<!--MODAL ELIMINAR VENTA-->
<div class="modal fade" id="modal-eliminar-{{ $venta->iVentID }}">
    <div class="modal-dialog">
        <form action="{{ route('venta.destroy', $venta->iVentID) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold">Eliminar Venta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Deseas eliminar la venta con el ID {{ $venta->iVentID }} de {{ $venta->cliente->persona->cPerNombre }}?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger font-weight-bold">Eliminar</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- FIN MODAL ELIMINAR VENTA -->
