<!--MODAL ELIMINAR-->
<div class="modal fade" id="modal-eliminar-{{$pro->iProID}}">
    <div class="modal-dialog">
        <form action="{{route('producto.destroy',$pro->iProID)}}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content bg-white"> <!-- Cambiado a bg-white -->
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold">Eliminar registro</h4> <!-- Texto en negrita -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deseas eliminar el registro {{$pro->cProNombre}}?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button> <!-- Cambiado a btn-outline-dark -->
                    <button type="submit" class="btn btn-danger font-weight-bold">Eliminar</button> <!-- Botón rojo y texto en negrita -->
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- FIN MODAL ELIMINAR -->
