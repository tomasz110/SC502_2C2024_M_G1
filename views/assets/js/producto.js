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
        aProcessing: true, // activamos el procesamiento de datatables
        aServerSide: true, // paginación y filtrado del lado del servidor
        dom: 'Bfrtip', // definimos los elementos del control de tabla
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
        iDisplayLength: 5 // cantidad de registros por página
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
            var response = JSON.parse(datos);
            switch (response.error) {
                case undefined:
                    toastr.success('Producto registrado');
                    $('#producto_add')[0].reset();
                    tabla.api().ajax.reload();
                    break;

                case 'El producto ya existe':
                    toastr.error('El producto ya existe... Corrija e inténtelo nuevamente...');
                    break;

                default:
                    toastr.error('Hubo un error al tratar de ingresar los datos: ' + response.error);
                    break;
            }
            $('#btnRegistrar').removeAttr('disabled');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastr.error('Error: ' + textStatus + ' - ' + errorThrown);
            $('#btnRegistrar').removeAttr('disabled');
        }
    });
});

// Función para cargar el listado de productos en las cards
function listarProductosEnCards() {
    $.ajax({
        url: '../controllers/productoController.php?op=listar_para_tabla',
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
                            <button class="btn btn-primary">Añadir al carrito</button>
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

// Función Principal
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
    $('#Eactivo').val(data[6]);
    return false;
});

/* Función para modificar los datos de un producto */
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
                    console.log('Respuesta del servidor:', datos); // Agrega esta línea para depuración
                    if (datos.trim() == '1') {
                        toastr.success('Producto actualizado exitosamente');
                        tabla.api().ajax.reload(); // Asegúrate de que tabla esté definido y tenga el método api
                        limpiarForms(); // Asegúrate de que limpiarForms esté definido
                        $('#formulario_update').hide(); // Asegúrate de que los IDs sean correctos
                        $('#formulario_add').show(); // Asegúrate de que los IDs sean correctos
                    } else {
                        toastr.error('Error: No se pudieron actualizar los datos. Respuesta del servidor: ' + datos);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Error AJAX:', jqXHR.responseText); // Agrega esta línea para depuración
                    toastr.error('Error de comunicación: ' + textStatus + ' - ' + errorThrown);
                }
            });
        }
    });
});