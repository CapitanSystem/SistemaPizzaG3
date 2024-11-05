<!-- Modal para Detalles de la Compra -->
@foreach ($compras as $compra)
<div class="modal fade" id="modalDetalles{{ $compra->iComID }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $compra->iComID }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $compra->iComID }}">Detalles de Compra #{{ $compra->iComID }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @foreach ($compra->detalles as $detalle)
                        <li class="list-group-item">
                            <strong>Producto:</strong> {{ $detalle->producto->cProNombre }} <br>
                            <strong>Cantidad:</strong> {{ $detalle->iDetComCantidad }} <br>
                            <strong>Subtotal:</strong> {{ $detalle->fDetComSubTotal }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach
