@extends('plantilla.app')

@section('contenido')
<!--CONTENIDO-->
<!-- TABLA -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Ventas
                            <button class="btn btn-primary" onclick="nuevo()"><i class="fas fa-file"></i> Nuevo</button>
                        </h5>
                    </div>
                    <div class="card-body">

                        @if(Session::has('mensaje'))
                        <div class="alert alert-info alert-dismissible fade show mt-2">
                            <span class="alert-icon"><i class="fa fa-info"></i></span>
                            <span class="alert-text">{{ Session::get('mensaje') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-2">
                            <span class="alert-icon"><i class="fa fa-info"></i></span>
                            <span class="alert-text">{{ Session::get('error') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="mt-2 table-responsive">
                            <table id="dataTable" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">#</th>
                                        <th style="width: 30%">Cliente</th>
                                        <th style="width: 20%">Monto Venta</th>
                                        <th style="width: 20%">Fecha</th>
                                        <th style="width: 20%">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($ventas) == 0)
                                    <tr>
                                        <td colspan="5">No hay resultados</td>
                                    </tr>
                                    @else
                                    @foreach($ventas as $venta)
                                    <tr>
                                        <td>{{ $venta->iVentID }}</td>
                                        <td>{{ $venta->cliente->persona->cPerDNI }} - {{ $venta->cliente->persona->cPerApellido }}</td>
                                        <td>{{ $venta->fVenTotal }}</td>
                                        <td>{{ $venta->dVenFecha->format('Y-m-d') }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalDetalles{{ $venta->iVentID }}">
                                                <i class="fas fa-eye"></i> Detalles
                                            </button>

                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-eliminar-{{ $venta->iVentID }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('venta.delete')
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIN TABLA -->

<!-- MODAL PARA DETALLES-->
@include('venta.show', ['ventas' => $ventas])

<!--MODAL UPDATE-->
<div class="modal fade" id="modal-action" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-xl">
        <!-- Aquí se cargará el contenido del modal -->
    </div>
</div>

@endsection

@push('scripts')
<script>
    function nuevo() {
        $.ajax({
            method: 'get',
            url: `{{ url('venta/create') }}`,
            success: function(res) {
                $('#modal-action').find('.modal-dialog').html(res);
                $("#textoBoton").text("Guardar");
                $('#modal-action').modal("show");
            }
        });
    }
</script>
@endpush
