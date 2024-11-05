<!--MODAL ELIMINAR-->
<div class="modal fade" id="modal-eliminar-{{$cli->iCliID}}">
    <div class="modal-dialog">
        <form action="{{route('cliente.destroy',$cli->iCliID)}}" method="post">
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
                    Deseas eliminar el registro {{$cli->persona->cPerNombre}}?
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
<!-- FIN MODAL ELIMINAR -->
