<!--MODAL ELIMINAR EMPLEADO-->
<div class="modal fade" id="modal-eliminar-{{$emp->iEmpID}}">
    <div class="modal-dialog">
        <form action="{{ route('empleado.destroy', $emp->iEmpID) }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold">Eliminar registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Deseas eliminar el registro de {{ $emp->persona->cPerNombre }} {{ $emp->persona->cPerApellido }}?
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
<!-- FIN MODAL ELIMINAR EMPLEADO -->
