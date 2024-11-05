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
                        <h5 class="m-0">Clientes
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

                        @if(count($clientes) == 0)
                        <div class="alert alert-secondary mt-2" role="alert">
                            No hay registros para mostrar
                        </div>
                        @endif

                        <div class="mt-2 table-responsive">
                            <table id="tableClientes" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 15%">Nombre</th>
                                        <th style="width: 15%">Apellido</th>
                                        <th style="width: 9%">DNI</th>
                                        <th style="width: 15%">Email</th>
                                        <th style="width: 10%">Fecha Nacimiento</th>
                                        <th style="width: 9%">Telefono</th>
                                        <th style="width: 15%">Direccion</th>
                                        <th style="width: 5%">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($clientes) == 0)
                                    <tr>
                                        <td colspan="9">No hay resultados</td>
                                    </tr>
                                    @else
                                    @foreach($clientes as $cli)
                                    <tr>
                                        <td>{{ $cli->iCliID }}</td>
                                        <td>{{ $cli->persona->cPerNombre }}</td>
                                        <td>{{ $cli->persona->cPerApellido }}</td>
                                        <td>{{ $cli->persona->cPerDNI }}</td>
                                        <td>{{ $cli->persona->cPerEmail }}</td>
                                        <td>{{ $cli->persona->cPerFNacimiento->format('Y-m-d') }}</td>
                                        <td>{{ $cli->persona->cPerTelefono }}</td>
                                        <td>{{ $cli->persona->cPerDireccion }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" onclick="editar('{{ $cli->iCliID }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#modal-eliminar-{{ $cli->iCliID }}" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('cliente.delete')
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

<!--MODAL UPDATE-->
<div class="modal fade" id="modal-action" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
    </div>
</div>

@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('#tableClientes').DataTable({
            "lengthMenu": [
                [5, 10, 25, 50],
                [5, 10, 25, 50]
            ],
            "pageLength": 5,
            "language": {
                "decimal": ",",
                "thousands": ".",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(filtrado de _MAX_ registros en total)",
                "search": "Buscar:",
                "paginate": {
                    "next": ">",
                    "previous": "<"
                },
            }
        });
    });
    function nuevo() {
        $.ajax({
            method: 'get',
            url: `{{ url('cliente/create') }}`,
            success: function(res) {
                $('#modal-action').find('.modal-dialog').html(res);
                $("#textoBoton").text("Guardar");
                $('#modal-action').modal("show");
            }
        });
    }


    function editar(iCliID) {
        $.ajax({
            method: 'get',
            url: `{{ url('cliente') }}/${iCliID}/edit`,
            success: function(res) {
                $('#modal-action').find('.modal-dialog').html(res);
                $("#textoBoton").text("Editar");
                $('#modal-action').modal("show");
            }
        });
    }

</script>
@endpush
