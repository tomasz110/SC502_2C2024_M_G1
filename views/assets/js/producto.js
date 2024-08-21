function limpiarForms() {
    $('#producto_add').trigger('reset');
    $('#producto_update').trigger('reset');
}

function cancelarForm() {
    limpiarForms();
    $('#formulario_add').show();
    $('#formulario_update').hide();
}

function listarProductosTodos() {
    tabla = $('#tbllistado').dataTable({
        aProcessing: true, 
        aServerSide: true, 
        dom: 'Bfrtip', 
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        ajax: {
            url: '../controllers/productoController.php?op=listar_para_tabla',
            type: 'get',
            dataType: 'json',
            error: function (e) {
                console.log(e.responseText);
            }
        },
        bDestroy: true,
        iDisplayLength: 5 
    });
}

$(function () {
    $('#formulario_update').hide();
    listarProductosTodos();
});

$('#producto_add').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistrar').prop('disabled', true);
    var formData = new FormData($('#producto_add')[0]);
    $.ajax({
        url: '../controllers/productoController.php?op=insertar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            var response = datos.trim(); 
            if (response == '1') {
                toastr.success('Usuario registrado');
                $('#producto_add')[0].reset();
                tabla.api().ajax.reload();
            } else if (response == '2') {
                toastr.error('El usuario ya existe.');
            } else if (response == '3') {
                toastr.error('Ingresar un producto con nombre diferente.');
            } else {
                toastr.error('Respuesta del servidor inesperada: ' + response);
            }
            $('#btnRegistrar').removeAttr('disabled');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastr.error('Error: ' + textStatus + ' - ' + errorThrown);
            $('#btnRegistrar').removeAttr('disabled');
        }
    });
});

function listarProductosEnCards() {
    $.ajax({
        url: '../controllers/productoController.php?op=listar_activos',
        type: 'get',
        dataType: 'json',
        success: function(response) {
            let cards = '';
            response.aaData.forEach(function(producto) {
                cards += `
                    <div class="col-md-3 mb-4">
                      <div class="card">
                        <img src="${producto[5]}" class="card-img-top" alt="${producto[1]}" height="200">
                        <div class="card-body text-center">
                            <h5 class="card-title">${producto[1]}</h5>
                            <p class="card-text">${producto[2]}</p>
                            <p class="card-text">Precio: $${producto[3]}</p>
                            <p class="card-text">Existencias: ${producto[4]}</p>
                            <button class="btn btn-primary" onclick="agregarAlCarrito(${producto[0]}, '${producto[1]}', ${producto[3]}, 1)">Añadir al carrito</button>
                        </div>
                    </div>
                    </div>
                `;
            });
            $('#listadoProductos').html(cards);
        },
        error: function(e) {
            console.log(e.responseText);
        }
    });
}



$(function () {
    listarProductosEnCards();
});

function activar(id) {
    bootbox.confirm('¿Está seguro de activar el producto?', function (result) {
        if (result) {
            $.post('../controllers/productoController.php?op=activar', { idProducto: id }, function (data, textStatus, xhr) {
                if (data == '1') {
                    toastr.success('Producto activado');
                    tabla.api().ajax.reload();
                } else {
                    toastr.error('Error: No se pudo activar el producto.');
                }
            });
        }
    });
}

function desactivar(id) {
    bootbox.confirm('¿Está seguro de desactivar el producto?', function (result) {
        if (result) {
            $.post('../controllers/productoController.php?op=desactivar', { idProducto: id }, function (data, textStatus, xhr) {
                if (data == '1') {
                    toastr.success('Producto desactivado');
                    tabla.api().ajax.reload();
                } else {
                    toastr.error('Error: No se pudo desactivar el producto.');
                }
            });
        }
    });
}

$('#tbllistado tbody').on('click', 'button[id="modificarProducto"]', function () {
    var data = $('#tbllistado').DataTable().row($(this).parents('tr')).data();
    limpiarForms();
    $('#formulario_add').hide();
    $('#formulario_update').show();
    $('#EId').val(data[0]);
    $('#Enombre').val(data[1]);
    $('#Edescripcion').val(data[2]);
    $('#Eprecio').val(data[3]);
    $('#Eexistencias').val(data[4]);
    $('#Eruta_imagen').val(data[5]);
    $('#Eid_emprendedor_fk').val(data[6]);
    $('#Eactivo').val(data[7]);
    return false;
});

function agregarAlCarrito(idProducto, nombreProducto, precioProducto, cantidad, idMaterial = null) {
    console.log(`Agregando al carrito: Producto ID: ${idProducto}, Material ID: ${idMaterial}, Nombre: ${nombreProducto}, Precio: ${precioProducto}, Cantidad: ${cantidad}`);
    $.ajax({
        url: '../controllers/carritoController.php?op=agregar',
        type: 'post',
        data: {
            id_producto: idProducto,
            id_material: idMaterial,
            nombre_producto: nombreProducto,
            precio_producto: precioProducto,
            cantidad: cantidad
        },
        success: function(response) {
            console.log('Respuesta del servidor:', response);
            toastr.success('Producto o material añadido al carrito');
        },
        error: function(e) {
            console.log('Error:', e.responseText);
            toastr.error('No se pudo añadir el producto o material al carrito');
        }
    });
}


function mostrarCarrito() {
    $.ajax({
        url: '../controllers/carritoController.php?op=mostrar',
        type: 'get',
        dataType: 'json',
        success: function(response) {
            let carritoHTML = '';
            let total = 0;

            if (response && Object.keys(response).length) {
                for (let key in response) {
                    let producto = response[key];
                    carritoHTML += `
                        <tr>
                            <td>${producto.nombre}</td>
                            <td>${producto.precio}</td>
                            <td>${producto.cantidad}</td>
                            <td>${producto.precio * producto.cantidad}</td>
                            <td><button class="btn btn-danger" onclick="eliminarDelCarrito('${key}')">Eliminar</button></td>
                        </tr>
                    `;
                    total += producto.precio * producto.cantidad;
                }
            } else {
                carritoHTML = '<tr><td colspan="5" class="text-center">El carrito está vacío.</td></tr>';
            }

            $('#carrito tbody').html(carritoHTML);
            $('#total').text('Total: $' + total);
        },
        error: function(e) {
            toastr.error('Error al mostrar el carrito');
        }
    });
}

function eliminarDelCarrito(key) {
    $.ajax({
        url: '../controllers/carritoController.php?op=eliminar',
        type: 'post',
        data: { id_producto: key.split('-')[0], id_material: key.split('-')[1] || null },
        success: function(response) {
            toastr.success('Producto o material eliminado del carrito');
            mostrarCarrito();
        },
        error: function(e) {
            toastr.error('No se pudo eliminar el producto o material del carrito');
        }
    });
}

function procederAlPago() {
    $.ajax({
        url: '../controllers/facturaController.php?op=generar',
        type: 'post',
        dataType: 'json',
        success: function(response) {
            console.log('Respuesta del servidor:', response); 
            if (response.success) {
                var cleanedHtml = response.html.replace(/(\r\n|\n|\r)/gm, " ");
                $('#detalleFactura').html(cleanedHtml);
                $('#totalFactura').text('Total: $' + response.total);
                $('#nombreUsuario').text('Comprador: ' + response.nombre_usuario);
                
                $('#facturaModal').modal('show'); 
                toastr.success('Factura generada exitosamente.');
            } else {
                toastr.error('Error al generar la factura.');
            }
        },
        error: function(e) {
            toastr.error('No se pudo procesar el pago.');
        }
    });
}

function confirmarPago() {
    $.ajax({
        url: '../controllers/carritoController.php?op=vaciar',
        type: 'post',
        success: function(response) {
            if (response.trim() === '1') {
                toastr.success('Pago confirmado y carrito vaciado.');
                $('#facturaModal').modal('hide'); 

               
                setTimeout(function() {
                   
                    $('#carrito tbody').html('<tr><td colspan="5" class="text-center">El carrito está vacío.</td></tr>');
                    $('#total').text('Total: $0'); 
                    location.reload(); 
                }, 300); 
            } else {
                toastr.success('Pago Procesado');
            }
        },
        error: function(e) {
            toastr.error('No se pudo procesar la solicitud.');
        }
    });
}







$('#producto_update').on('submit', function (event) {
    event.preventDefault();
    bootbox.confirm('¿Desea modificar los datos?', function (result) {
        if (result) {
            var formData = new FormData($('#producto_update')[0]);
            $.ajax({
                url: '../controllers/productoController.php?op=editar',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos) {
                    console.log('Respuesta del servidor:', datos); 
                    if (datos.trim() == '1') {
                        toastr.success('Producto actualizado exitosamente');
                        tabla.api().ajax.reload(); 
                        limpiarForms(); 
                        $('#formulario_update').hide(); 
                        $('#formulario_add').show(); 
                    } else {
                        toastr.error('Error: No se pudieron actualizar los datos. Respuesta del servidor: ' + datos);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Error AJAX:', jqXHR.responseText); 
                    toastr.error('Error de comunicación: ' + textStatus + ' - ' + errorThrown);
                }
            });
        }
    });
});
