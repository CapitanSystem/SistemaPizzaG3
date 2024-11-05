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
                        <h5 class="m-0">Categorias
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



                        @if(count($categorias) == 0)
                        <div class="alert alert-secondary mt-2" role="alert">
                            No hay registros para mostrar
                        </div>
                        @endif

                        <div class="mt-2 table-responsive">
                            <table id="tableCategorias" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>

                                        <th style="width: 5%">#</th>
                                        <th style="width: 15%">Nombre</th>
                                        <th style="width: 45%">Descripcion</th>
                                        <th style="width: 8%">Tipo</th>
                                        <th style="width: 8%">Estado</th>
                                        <th style="width: 5%">Opciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($categorias) == 0)
                                    <tr>
                                        <td colspan="8">No hay resultados</td>
                                    </tr>
                                    @else
                                    @foreach($categorias as $cat)
                                    <tr>

                                        <td>{{ $cat->iCatID }}</td>
                                        <td>{{ $cat->cCatNombre }}</td>
                                        <td>{{ $cat->cCatDescripcion }}</td>
                                        <td>
                                            @if($cat->cCatTipo === 'C')
                                            Compra
                                            @elseif($cat->cCatTipo === 'V')
                                            Venta
                                            @elseif($cat->cCatTipo === 'A')
                                            Compra y Venta
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $cat->cCatEstado === 'A' ? 'success' : 'danger' }}">
                                                {{ $cat->cCatEstado === 'A' ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" onclick="editar( '{{ $cat->iCatID }}' )"><i class="fas fa-edit"></i> </button>
                                            <button type="button" data-toggle="modal" data-target="#modal-eliminar-{{ $cat->iCatID }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @include('categoria.delete')
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
        $('#tableCategorias').DataTable({
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
            url: `{{url('categoria/create')}}`, //Alt + 96 `
            success: function(res) {
                $('#modal-action').find('.modal-dialog').html(res);
                $("#textoBoton").text("Guardar");
                $('#modal-action').modal("show");

            }
        });
    }


    function editar(iCatID) {
        $.ajax({
            method: 'get',
            url: `{{url('categoria')}}/${iCatID}/edit`,
            success: function(res) {
                $('#modal-action').find('.modal-dialog').html(res);
                $("#textoBoton").text("Editar");
                $('#modal-action').modal("show");
            }
        });
    }
</script>
@endpush
