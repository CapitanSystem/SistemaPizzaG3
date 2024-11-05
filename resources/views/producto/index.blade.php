@extends('plantilla.app')
@section('contenido')
<!--CONTENIDO-->
<!-- TABLA -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Productos <button class="btn btn-primary" onclick="nuevo()"><i class="fas fa-file"></i> Nuevo</button>
                        </h5>
                    </div>
                    <div class="card-body">

                        @if(Session::has('mensaje'))
                        <div class="alert alert-info alert-dismissible fade show mt-2">
                            <span class="alert-icon"><i class="fa fa-info"></i></span>
                            <span class="alert-text">{{Session::get('mensaje')}}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @else
                        @endif

                        @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-2">
                            <span class="alert-icon"><i class="fa fa-info"></i></span>
                            <span class="alert-text">{{Session::get('mensaje')}}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @else
                        @endif

                        @if(count($productos)== 0)
                        <div class="alert alert-secondary mt-2" role="alert">
                            No hay registros para mostrar
                        </div>
                        @endif
                        <div class="mt-2 table-responsive-md">
                            <table id="tableProductos" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">ID</th>
                                        <th style="width: 15%">Nombre</th>
                                        <th style="width: 10%">Tamanaño</th>
                                        <th style="width: 15%">Categoría</th>
                                        <th style="width: 8%">P.Compra</th>
                                        <th style="width: 8%">P.Venta</th>
                                        <th style="width: 8%">Stock</th>
                                        <th style="width: 10%">Imagen</th>
                                        <th style="width: 8%">Estado</th>
                                        <th style="width: 8%">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($productos)==0)
                                    <tr>
                                        <td colspan="11">No hay resultados</td>
                                    </tr>
                                    @else
                                    @foreach($productos as $pro)
                                    <tr>

                                        <td>{{$pro->iProID}}</td>
                                        <td>{{$pro->cProNombre}}</td>
                                        <td>{{$pro->cProTamanio}}</td>
                                        <td>{{$pro->cCatNombre}}</td>
                                        <td>{{$pro->fProPrecioCompra}}</td>
                                        <td>{{$pro->fProPrecioVenta}}</td>
                                        <td>{{$pro->iProStock}}</td>
                                        <td>
                                            <img class="img-rounded  border border-2 rounded" src="{{asset('productos/'.$pro->cProImagen)}}"
                                                width="100" height="100" alt="{{$pro->cProImagen}}">
                                        </td>

                                        <td><span class="badge badge-{{ $pro->cProEstado === 'A' ? 'success' : 'danger' }}">
                                                {{ $pro->cProEstado === 'A' ? 'Activo' : 'Inactivo' }}
                                            </span></td>
                                        <td><button class="btn btn-warning btn-sm" onclick="editar('{{$pro->iProID}}')"><i class="fas fa-edit"></i> </button>
                                            <button type="button" data-toggle="modal" data-target="#modal-eliminar-{{$pro->iProID}}"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @include('producto.delete')
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- FIN TABLA -->
<!--MODAL UPDATE-->
<div class="modal fade" id="modal-action" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
    </div>
</div>
<!--FIN MODAL UPDATE-->

<!--FIN CONTENIDO-->
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#tableProductos').DataTable({
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
            url: `{{url('producto/create')}}`, //Alt + 96 `
            success: function(res) {
                $('#modal-action').find('.modal-dialog').html(res);
                $("#textoBoton").text("Guardar");
                $('#modal-action').modal("show");
            }
        });
    }

    function editar(id) {
        $.ajax({
            method: 'get',
            url: `{{url('producto')}}/${id}/edit`,
            success: function(res) {
                $('#modal-action').find('.modal-dialog').html(res);
                $("#textoBoton").text("Editar");
                $('#modal-action').modal("show");
            }
        });
    }
</script>
@endpush
