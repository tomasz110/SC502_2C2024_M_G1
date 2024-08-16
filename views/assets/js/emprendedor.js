function limpiarForms() {
    $('#emprendedor_add').trigger('reset');
    $('#emprendedor_update').trigger('reset');
}


function cancelarForm() {
    limpiarForms();
    $('#formulario_add').show();
    $('#formulario_update').hide();
}


function listarTodosEmprendedores() {
    tabla = $('#tbllistado').dataTable({
        aProcessing: true, 
        aServerSide: true, 
        dom: 'Bfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        ajax: {
            url: '../controllers/emprendedorController.php?op=listar_para_tabla',
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
    listarTodosEmprendedores();
});


$('#emprendedor_add').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistrar').prop('disabled', true);
    var formData = new FormData($('#emprendedor_add')[0]);
    $.ajax({
        url: '../controllers/emprendedorController.php?op=insertar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            var response = datos.trim(); 
            if (response == '1') {
                toastr.success('Usuario registrado');
                $('#emprendedor_add')[0].reset();
                tabla.api().ajax.reload();
            } else if (response == '2') {
                toastr.error('El usuario ya existe.');
            } else if (response == '3') {
                toastr.error('Hubo un error al tratar de ingresar los datos.');
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
    bootbox.confirm('¿Está seguro de activar el emprendedor?', function (result) {
        if (result) {
            $.post('../controllers/emprendedorController.php?op=activar', { idEmprendedor: id }, function (data, textStatus, xhr) {
                if (data == '1') {
                    toastr.success('Emprendedor activado');
                    tabla.api().ajax.reload();
                } else {
                    toastr.error('Error: No se pudo activar el emprendedor.');
                }
            });
        }
    });
}


function desactivar(id) {
    bootbox.confirm('¿Está seguro de desactivar el emprendedor?', function (result) {
        if (result) {
            $.post('../controllers/emprendedorController.php?op=desactivar', { idEmprendedor: id }, function (data, textStatus, xhr) {
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


$('#tbllistado tbody').on('click', 'button[id="modificarEmprendedor"]', function () {
    var data = $('#tbllistado').DataTable().row($(this).parents('tr')).data();
    limpiarForms();
    $('#formulario_add').hide();
    $('#formulario_update').show();
    $('#EId').val(data[0]);
    $('#Enombre').val(data[1]);
    $('#Etelefono').val(data[2]);
    $('#Ecorreo').val(data[3]);
    $('#Eactivo').val(data[4]);
    return false;
});


$('#emprendedor_update').on('submit', function (event) {
    event.preventDefault();
    bootbox.confirm('¿Desea modificar los datos?', function (result) {
        if (result) {
            var formData = new FormData($('#emprendedor_update')[0]);
            $.ajax({
                url: '../controllers/emprendedorController.php?op=editar',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos) {
                    console.log('Respuesta del servidor:', datos); 
                    if (datos.trim() == '1') {
                        toastr.success('Emprendedor actualizado exitosamente');
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