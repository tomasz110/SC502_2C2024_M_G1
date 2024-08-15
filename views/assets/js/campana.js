function limpiarForms() {
    $('#campana_add').trigger('reset');
    $('#campana_update').trigger('reset');
}

function cancelarForm() {
    limpiarForms();
    $('#formulario_add').show();
    $('#formulario_update').hide();
}

function listarTodasCampanas() {
    tabla = $('#tbllistado').dataTable({
        aProcessing: true, 
        aServerSide: true, 
        dom: 'Bfrtip', 
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        ajax: {
            url: '../controllers/campanaController.php?op=listar_para_tabla',
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
    listarTodasCampanas();
});

$('#campana_add').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistrar').prop('disabled', true);
    var formData = new FormData($('#campana_add')[0]);
    $.ajax({
        url: '../controllers/campanaController.php?op=insertar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            var response = JSON.parse(datos);
            if (response == 1) {
                toastr.success('Campaña registrada');
                $('#campana_add')[0].reset();
                tabla.api().ajax.reload();
            } else {
                toastr.error('Hubo un error al tratar de ingresar los datos.');
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
    bootbox.confirm('¿Está seguro de activar la campaña?', function (result) {
        if (result) {
            $.post('../controllers/campanaController.php?op=activar', { idCampana: id }, function (data) {
                if (data == '1') {
                    toastr.success('Campaña activada');
                    tabla.api().ajax.reload();
                } else {
                    toastr.error('Error: No se pudo activar la campaña.');
                }
            });
        }
    });
}

function desactivar(id) {
    bootbox.confirm('¿Está seguro de desactivar la campaña?', function (result) {
        if (result) {
            $.post('../controllers/campanaController.php?op=desactivar', { idCampana: id }, function (data) {
                if (data == '1') {
                    toastr.success('Campaña desactivada');
                    tabla.api().ajax.reload();
                } else {
                    toastr.error('Error: No se pudo desactivar la campaña.');
                }
            });
        }
    });
}

$('#tbllistado tbody').on('click', 'button[id="modificarCampana"]', function () {
    var data = $('#tbllistado').DataTable().row($(this).parents('tr')).data();
    limpiarForms();
    $('#formulario_add').hide();
    $('#formulario_update').show();
    $('#EId').val(data[0]);
    $('#Enombre').val(data[1]);
    $('#Edescripcion').val(data[2]);
    $('#Efecha').val(data[3]);
    $('#Eruta_imagen').val(data[4]);
    $('#Eruta_mapa').val(data[5]);
    $('#Eactivo').val(data[6]);
    return false;
});

$('#campana_update').on('submit', function (event) {
    event.preventDefault();
    bootbox.confirm('¿Desea modificar los datos?', function (result) {
        if (result) {
            var formData = new FormData($('#campana_update')[0]);
            $.ajax({
                url: '../controllers/campanaController.php?op=editar',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos) {
                    if (datos.trim() == '1') {
                        toastr.success('Campaña actualizada exitosamente');
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