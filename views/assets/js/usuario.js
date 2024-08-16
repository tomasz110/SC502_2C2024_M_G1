function limpiarForms() {
    $('#usuario_add').trigger('reset');
    $('#usuario_update').trigger('reset');
}

function cancelarForm() {
    limpiarForms();
    $('#formulario_add').show();
    $('#formulario_update').hide();
}

function listarTodosUsuarios() {
    tabla = $('#tbllistado').dataTable({
        aProcessing: true,
        aServerSide: true,
        dom: 'Bfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        ajax: {
            url: '../controllers/usuarioController.php?op=listar_para_tabla',
            type: 'get',
            dataType: 'json',
            error: function (e) {
                console.log(e.responseText);
            }
        },
        bDestroy: true,
        iDisplayLength: 10 // cantidad de registros por página
    });
}

$(function () {
    $('#formulario_update').hide();
    listarTodosUsuarios();
});

$('#usuario_add').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistrar').prop('disabled', true);
    var formData = new FormData($('#usuario_add')[0]);
    $.ajax({
        url: '../controllers/usuarioController.php?op=insertar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            var response = datos.trim(); // Ajustado para verificar la respuesta
            if (response == '1') {
                toastr.success('Usuario registrado');
                $('#usuario_add')[0].reset();
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
    bootbox.confirm('¿Está seguro de activar el usuario?', function (result) {
        if (result) {
            $.post('../controllers/usuarioController.php?op=activar', { idUsuario: id }, function (data) {
                if (data == '1') {
                    toastr.success('Usuario activado');
                    tabla.api().ajax.reload();
                } else {
                    toastr.error('Error: No se pudo activar el usuario.');
                }
            });
        }
    });
}

function desactivar(id) {
    bootbox.confirm('¿Está seguro de desactivar el usuario?', function (result) {
        if (result) {
            $.post('../controllers/usuarioController.php?op=desactivar', { idUsuario: id }, function (data) {
                if (data == '1') {
                    toastr.success('Usuario desactivado');
                    tabla.api().ajax.reload();
                } else {
                    toastr.error('Error: No se pudo desactivar el usuario.');
                }
            });
        }
    });
}

$('#tbllistado tbody').on('click', 'button[id="modificarUsuario"]', function () {
    var data = $('#tbllistado').DataTable().row($(this).parents('tr')).data();
    limpiarForms();
    $('#formulario_add').hide();
    $('#formulario_update').show();
    $('#EId').val(data[0]);
    $('#Enombre').val(data[1]);
    $('#Ecorreo').val(data[2]);
    $('#Epassword').val(data[6]);
    $('#Eestado').val(data[3] == '<span class="label bg-success"> Activado </span>' ? 1 : 0);
    $('#Erol').val(data[4]); // Ajusta según tu implementación de roles
    return false;
});

$('#usuario_update').on('submit', function (event) {
    event.preventDefault();
    bootbox.confirm('¿Desea modificar los datos?', function (result) {
        if (result) {
            var formData = new FormData($('#usuario_update')[0]);
            $.ajax({
                url: '../controllers/usuarioController.php?op=editar',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos) {
                    if (datos.trim() == '1') {
                        toastr.success('Usuario actualizado exitosamente');
                        tabla.api().ajax.reload();
                        limpiarForms();
                        $('#formulario_update').hide();
                        $('#formulario_add').show();
                    } else {
                        toastr.error('Error: No se pudieron actualizar los datos. Respuesta del servidor: ' + datos);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error('Error de comunicación: ' + textStatus + ' - ' + errorThrown);
                }
            });
        }
    });
});
