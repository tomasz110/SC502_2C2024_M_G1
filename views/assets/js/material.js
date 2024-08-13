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
        aProcessing: true, // activamos el procesamiento de datatables
        aServerSide: true, // paginación y filtrado del lado del servidor
        dom: 'Bfrtip', // definimos los elementos del control de tabla
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
        iDisplayLength: 5 // cantidad de registros por página
    });
}


$(function () {
    $('#formulario_update').hide();
    listarMaterialesTodos();
});


/* Función para agregar un material */
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
            var response = JSON.parse(datos);
            switch (response.error) {
                case undefined:
                    toastr.success('Material registrado');
                    $('#material_add')[0].reset();
                    tabla.api().ajax.reload();
                    break;

                case 'El material ya existe':
                    toastr.error('El material ya existe... Corrija e inténtelo nuevamente...');
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

/* Función para modificar los datos de un material */
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
                    console.log('Respuesta del servidor:', datos); // Agrega esta línea para depuración
                    if (datos.trim() == '1') {
                        toastr.success('Material actualizado exitosamente');
                        tabla.api().ajax.reload(); // Asegúrate de que tabla esté definido y tenga el método api
                        limpiarForms(); // Asegúrate de que limpiarForms esté definido
                        $('#formulario_update').hide(); // Asegúrate de que los IDs sean correctos
                        $('#formulario_add').show(); // Asegúrate de que los IDs sean correctos
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