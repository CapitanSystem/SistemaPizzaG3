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
                        <h5 class="m-0">Empleados
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

                        @if(count($empleados) == 0)
                        <div class="alert alert-secondary mt-2" role="alert">
                            No hay registros para mostrar
                        </div>
                        @endif

                        <div class="mt-2 table-responsive">
                            <table id="tableEmpleados" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 10%">Nombre</th>
                                        <th style="width: 10%">Apellido</th>
                                        <th style="width: 9%">DNI</th>
                                        <th style="width: 9%">F.Inicio</th>
                                        <th style="width: 9%">F.Fin</th>
                                        <th style="width: 7%">Sueldo</th>
                                        <th style="width: 5%">Extra</th>
                                        <th style="width: 5%">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($empleados) == 0)
                                    <tr>
                                        <td colspan="12">No hay resultados</td>
                                    </tr>
                                    @else
                                    @foreach($empleados as $emp)
                                    <tr>
                                        <td>{{ $emp->iEmpID }}</td>
                                        <td>{{ $emp->persona->cPerNombre }}</td>
                                        <td>{{ $emp->persona->cPerApellido }}</td>
                                        <td>{{ $emp->persona->cPerDNI }}</td>
                                        <td>{{ $emp->dEmpFechaInicio->format('Y-m-d') }}</td>
                                        <td>{{ $emp->dEmpFechaFin->format('Y-m-d') }}</td>
                                        <td>{{ $emp->fEmpSueldo }}</td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-detalle-{{ $emp->iEmpID }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Ver
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" onclick="editar('{{ $emp->iEmpID }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#modal-eliminar-{{ $emp->iEmpID }}" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('empleado.delete')
                                    @include('empleado.detalle')
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
        $('#tableEmpleados').DataTable({
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
                }
            }
        });
    });
    function nuevo() {
        $.ajax({
            method: 'get',
            url: `{{ url('empleado/create') }}`,
            success: function(res) {
                $('#modal-action').find('.modal-dialog').html(res);
                $("#textoBoton").text("Guardar");
                $('#modal-action').modal("show");
            }
        });
    }


    function editar(iEmpID) {
        $.ajax({
            method: 'get',
            url: `{{ url('empleado') }}/${iEmpID}/edit`,
            success: function(res) {
                $('#modal-action').find('.modal-dialog').html(res);
                $("#textoBoton").text("Editar");
                $('#modal-action').modal("show");
            }
        });
    }

</script>
@endpush
