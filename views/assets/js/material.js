function limpiarForms() {
    $('#material_add').trigger('reset');
    $('#material_update').trigger('reset');
}


function cancelarForm() {
    limpiarForms();
    $('#formulario_add').show();
    $('#formulario_update').hide();
}


function listarMaterialesTodos() {
    tabla = $('#tbllistado').dataTable({
        aProcessing: true, 
        aServerSide: true, 
        dom: 'Bfrtip', 
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        ajax: {
            url: '../controllers/materialController.php?op=listar_para_tabla',
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
    listarMaterialesTodos();
});

function listarMaterialesEnCards() {
    $.ajax({
        url: '../controllers/materialController.php?op=listar_activos',
        type: 'get',
        dataType: 'json',
        success: function(response) {
            let cards = '';
            response.aaData.forEach(function(material) {
                cards += `
                    <div class="col-md-3 mb-4">
                      <div class="card">
                        <img src="${material[5]}" class="card-img-top" alt="${material[1]}" height="200">
                        <div class="card-body text-center">
                            <h5 class="card-title">${material[1]}</h5>
                            <p class="card-text">${material[2]}</p>
                            <p class="card-text">Precio: $${material[3]}</p>
                            <p class="card-text">Existencias: ${material[4]}</p>
                            <button class="btn btn-primary" onclick="agregarAlCarrito(${material[0]}, '${material[1]}', ${material[3]}, 1, ${material[0]})">Añadir al carrito</button>
                        </div>
                      </div>
                    </div>
                `;
            });
            $('#listadoMateriales').html(cards);
        },
        error: function(e) {
            console.log(e.responseText);
        }
    });
}

function agregarAlCarrito(idProducto, nombreProducto, precioProducto, cantidad, idMaterial = null) {
    console.log('Llamada a agregarAlCarrito:', { idProducto, nombreProducto, precioProducto, cantidad, idMaterial });
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
            toastr.success('Producto o material añadido al carrito');
        },
        error: function(e) {
            toastr.error('No se pudo añadir el producto o material al carrito');
        }
    });
}


$(document).ready(function() {
    listarMaterialesEnCards();
});




$('#material_add').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistrar').prop('disabled', true);
    var formData = new FormData($('#material_add')[0]);
    $.ajax({
        url: '../controllers/materialController.php?op=insertar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            var response = datos.trim(); 
            if (response == '1') {
                toastr.success('Usuario registrado');
                $('#material_add')[0].reset();
                tabla.api().ajax.reload();
            } else if (response == '2') {
                toastr.error('El usuario ya existe.');
            } else if (response == '3') {
                toastr.error('Ingrese un material con un nombre diferente.');
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



function activar(id) {
    bootbox.confirm('¿Está seguro de activar el material?', function (result) {
        if (result) {
            $.post('../controllers/materialController.php?op=activar', { idMaterial: id }, function (data, textStatus, xhr) {
                if (data == '1') {
                    toastr.success('Material activado');
                    tabla.api().ajax.reload();
                } else {
                    toastr.error('Error: No se pudo activar el material.');
                }
            });
        }
    });
}


function desactivar(id) {
    bootbox.confirm('¿Está seguro de desactivar el material?', function (result) {
        if (result) {
            $.post('../controllers/materialController.php?op=desactivar', { idMaterial: id }, function (data, textStatus, xhr) {
                if (data == '1') {
                    toastr.success('Material desactivado');
                    tabla.api().ajax.reload();
                } else {
                    toastr.error('Error: No se pudo desactivar el material.');
                }
            });
        }
    });
}


$('#tbllistado tbody').on('click', 'button[id="modificarMaterial"]', function () {
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


$('#material_update').on('submit', function (event) {
    event.preventDefault();
    bootbox.confirm('¿Desea modificar los datos?', function (result) {
        if (result) {
            var formData = new FormData($('#material_update')[0]);
            $.ajax({
                url: '../controllers/materialController.php?op=editar',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos) {
                    console.log('Respuesta del servidor:', datos); 
                    if (datos.trim() == '1') {
                        toastr.success('Material actualizado exitosamente');
                        tabla.api().ajax.reload();
                        limpiarForms(); 
                        $('#formulario_update').hide(); 
                        $('#formulario_add').show(); 
                    } else {
                        toastr.error('Error: No se pudieron actualizar los datos.Respuesta del servidor: ' + datos);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error('Error de comunicación: ' + textStatus + ' - ' + errorThrown);
                }
            });
        }
    });
});