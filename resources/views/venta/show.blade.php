<!-- Modal para Detalles de la Venta -->
@foreach ($ventas as $venta)
<div class="modal fade" id="modalDetalles{{ $venta->iVentID }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $venta->iVentID }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $venta->iVentID }}">Detalles de Venta #{{ $venta->iVentID }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($venta->detalles->isEmpty())
                    <p>No hay detalles disponibles para esta venta.</p>
                @else
                    <ul class="list-group">
                        @foreach ($venta->detalles as $detalle)
                            <li class="list-group-item">
                                <strong>Producto:</strong> {{ $detalle->producto->cProNombre }} <br>
                                <strong>Cantidad:</strong> {{ $detalle->iDetCantidad }} <br>
                                <strong>Subtotal:</strong> {{ $detalle->fDetSubTotal }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach
