@foreach($empleados as $emp)
<div class="modal fade" id="modal-detalle-{{ $emp->iEmpID }}" tabindex="-1" role="dialog" aria-labelledby="modalDetalleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetalleLabel">Detalles de {{ $emp->persona->cPerNombre }} {{ $emp->persona->cPerApellido }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Teléfono:</strong> {{ $emp->persona->cPerTelefono }}</p>
                <p><strong>Fecha de Nacimiento:</strong> {{ $emp->persona->cPerFNacimiento->format('Y-m-d') }}</p>
                <p><strong>Dirección:</strong> {{ $emp->persona->cPerDireccion }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach
