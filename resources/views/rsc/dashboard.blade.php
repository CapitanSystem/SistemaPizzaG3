@extends('plantilla.app')

@section('contenido')
<!-- CONTENIDO -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Tarjeta de Estadísticas 1 -->
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-primary mb-4">
                    <div class="card-header">Usuarios Registrados</div>
                    <div class="card-body">
                        <h5 class="card-title">150</h5>
                        <p class="card-text">Cantidad total de usuarios registrados en el sistema.</p>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de Estadísticas 2 -->
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-success mb-4">
                    <div class="card-header">Ventas del Mes</div>
                    <div class="card-body">
                        <h5 class="card-title">$5,000</h5>
                        <p class="card-text">Ventas realizadas en el mes actual.</p>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de Estadísticas 3 -->
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-warning mb-4">
                    <div class="card-header">Productos Disponibles</div>
                    <div class="card-body">
                        <h5 class="card-title">75</h5>
                        <p class="card-text">Total de productos disponibles en el inventario.</p>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de Estadísticas 4 -->
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-danger mb-4">
                    <div class="card-header">Órdenes Pendientes</div>
                    <div class="card-body">
                        <h5 class="card-title">10</h5>
                        <p class="card-text">Órdenes que están esperando ser procesadas.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin de Tarjetas -->

        <!-- Gráfico de Ventas -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">Gráfico de Ventas</div>
                    <div class="card-body">
                        <p>Aquí puedes incluir un gráfico que muestre las ventas a lo largo del tiempo.</p>
                        <!-- Reemplaza este texto con un gráfico real utilizando librerías como Chart.js -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Últimas Órdenes -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">Últimas Órdenes</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Juan Perez</td>
                                    <td>Hamburguesa</td>
                                    <td>2</td>
                                    <td>Completada</td>
                                    <td>01/11/2024</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Maria Lopez</td>
                                    <td>Pizza</td>
                                    <td>1</td>
                                    <td>En Proceso</td>
                                    <td>02/11/2024</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Carlos Ruiz</td>
                                    <td>Ensalada</td>
                                    <td>3</td>
                                    <td>Completada</td>
                                    <td>03/11/2024</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- FIN CONTENIDO -->
@endsection

@push('scripts')
<script>
    $('#liDashboard').addClass("menu-open");
    $('#liEstadisticas').addClass("active");
    $('#aDashboard').addClass("active");
</script>
@endpush

