<div class="modal fade" id="modal-eliminar-{{$user->iUsuID}}">
    <div class="modal-dialog">
        <form action="{{ route('usuario.destroy', $user->iUsuID) }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content bg-white"> <!-- Cambiado a bg-white -->
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold">Eliminar Usuario</h4> <!-- Texto en negrita -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Deseas eliminar el usuario {{ $user->cUsuUsuario }}?
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
