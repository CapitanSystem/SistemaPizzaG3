<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">
            <i class="fas fa-shopping-cart me-2"></i>
            </i>
            Nueva Compra
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ route('compra.store') }}" method="post">
            @csrf

            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-8">
                        <div class="text-white bg-primary p-1 text-center">
                            Detalles de Compra
                        </div>
                        <div class="p-3 border border-3 border-primary">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <select name="iDetComProductoID" id="iDetComProductoID" class="form-control selectpicker" data-live-search="true">
                                        <option value="" data-precio="0" disabled selected>Seleccione un producto</option>
                                        @foreach($productos as $pro)
                                        <option value="{{$pro->iProID}}" data-precio="{{$pro->fProPrecioCompra}}">{{$pro->cProNombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="iDetComCantidad" class="form-label">Cantidad</label>
                                    <input type="number" name="iDetComCantidad" id="iDetComCantidad" class="form-control" value="">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="precio" class="form-label">Precio</label>
                                    <input type="text" name="precio" id="precio" class="form-control" value="" readonly>
                                </div>
                                <div class="col-md-12 mb-2 mt-2 text-center">
                                    <button id="btnAgregar" class="btn btn-primary" type="button">Agregar</button>
                                </div>


                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="tablaDetalle" class="table table-hover">
                                            <thead class="bg-success text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio</th>
                                                    <th>Sub Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>
                                                        Total
                                                    </th>
                                                    <th><span id="sumas">0</span></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-white bg-success p-1 text-center">
                            Datos de Compra
                        </div>
                        <div class="p-3 border border-3 border-success">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="iComProveedorID" class="form-label">Proveedor</label>
                                    <select name="iComProveedorID" id="iComProveedorID" class="form-control">
                                        @foreach ($proveedores as $prove)
                                        <option value="{{$prove->iProID}}">{{$prove->cProEmpresa}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="fComTotal" class="form-label">Total Compra</label>
                                    <input readonly type="text" name="fComTotal" id="fComTotal" class="form-control border-success" value="">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="dComFecha" class="form-label">Fecha</label>
                                    <input readonly type="date" name="dComFecha" id="dComFecha" class="form-control border-success" value="<?php echo date('Y-m-d') ?>">
                                </div>
                                <div class="col-md-12 mb-2 text-center">
                                    <button type="submit" class="btn btn-success" id="guardar">
                                        <i class="fas fa-save"></i> Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times"></i> Cerrar
        </button>
    </div>
</div>

<script>
    document.addEventListener('shown.bs.modal', function(event) {
        const modal = event.target;
        const productoSelect = modal.querySelector('#iDetComProductoID');
        const precioInput = modal.querySelector('#precio');

        function actualizarPrecio() {
            const selectedOption = productoSelect.options[productoSelect.selectedIndex];
            const precio = parseFloat(selectedOption.getAttribute('data-precio')).toFixed(2);
            precioInput.value = precio;
            console.log('Precio actualizado:', precio);
        }

        actualizarPrecio();
        productoSelect.addEventListener('change', actualizarPrecio);
    });


    $(document).ready(function() {
        $('#btnAgregar').click(function() {
            agregarProducto();
        });

        desactivarBotones();


    });
    let cont = 0;
    let subTotal = [];
    let suma = 0;

    function desactivarBotones() {
        if (suma === 0) {
            $('#guardar').hide();
        } else {
            $('#guardar').show();
        }
    }

    function agregarProducto() {
        let idProducto = $('#iDetComProductoID').val();
        let nombrePorducto = $('#iDetComProductoID option:selected').text();
        let cantidad = $('#iDetComCantidad').val();
        let precio = $('#precio').val();

        if (nombrePorducto != "Seleccione un producto" && cantidad != '' && precio != '0.00') {
            if (parseInt(cantidad) > 0 && (cantidad % 1 == 0)) {
                subTotal[cont] = round(cantidad * precio);

                suma += subTotal[cont];

                $('#fComTotal').val(round(suma));

                let fila = '<tr id="fila' + cont + '">' +
                    '<th>' + (cont + 1) + '</th>' +
                    '<th><input type="hidden" name="idArrayProducto[]" value="'+idProducto+'">' + nombrePorducto + '</th>' +
                    '<th><input type="hidden" name="ArrayCantidad[]" value="'+cantidad+'">' + cantidad + '</th>' +
                    '<th>' + precio + '</th>' +
                    '<th><input type="hidden" name="Arraysubtotal[]" value="'+subTotal[cont]+'">' + subTotal[cont] + '</th>' +
                    '<th><button class="btn btn-danger" type="button" onClick="eliminarProducto(' + cont + ')"><i class="fas fa-trash-alt"></i></button></th>' +
                    '</tr>';

                $('#tablaDetalle').append(fila);
                limpiarCampos();
                cont++;
                desactivarBotones();
                $('#sumas').html(round(suma).toFixed(2));
            } else {
                showModal('La Cantidad debe ser mayor de 0');
            }

        } else {
            showModal('Te faltan campos por llenar');
        }
    }

    function eliminarProducto(indice) {
        suma -= subTotal[indice]

        $('#sumas').html(round(suma).toFixed(2));

        $('#fila' + indice).remove();
        if ($('#tablaDetalle tbody tr').length === 0) {
            suma = 0;
            $('#fComTotal').val(round(suma).toFixed(2));
            desactivarBotones();
        } else {
            $('#fComTotal').val(round(suma).toFixed(2));
        }
        desactivarBotones();
    }

    function limpiarCampos() {
        let select = $('#iDetComProductoID');
        select.val('');
        select.prop('selectedIndex', 0);
        $('#iDetComCantidad').val('');
        $('#precio').val('0.00')
    }

    function round(num, decimales = 2) {
        var signo = (num >= 0 ? 1 : -1);
        num = num * signo;
        if (decimales === 0) //con 0 decimales
            return signo * Math.round(num);
        // round(x * 10 ^ decimales)
        num = num.toString().split('e');
        num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
        // x * 10 ^ (-decimales)
        num = num.toString().split('e');
        return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
    }

    function showModal(message, icon = 'error') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        Toast.fire({
            icon: icon,
            title: message
        });
    }
</script>
