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
        iDisplayLength: 5 
    });
}
$(function () {
    $('#formulario_update').hide();
    listarTodasCampanas();
});

function listarCampanasEnCards() {
    $.ajax({
        url: '../controllers/campanaController.php?op=listar_campanas_activas',
        type: 'get',
        dataType: 'json',
        success: function(response) {
            console.log(response); 
            let cards = '';
            if (response.aaData) {
                response.aaData.forEach(function(campana) {
                    const modalId = `modal${campana[0]}`;
                    cards += `
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="${campana[4]}" class="card-img-top" style="object-fit: cover; height: 200px;" alt="Imagen de la campaña">
                                <div class="card-body text-center">
                                    <h5 class="card-title">${campana[1]}</h5>
                                    <p class="card-text">${campana[2]}</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#${modalId}">
                                        Información
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="modalLabel${campana[0]}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">${campana[1]}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            <strong>Lugar:</strong> ${campana[2]}<br/>
                                            <strong>Fecha:</strong> ${campana[3]}<br/>
                                            <strong>Descripcion de la actividad:</strong> Esta campaña tiene como objetivo educar a la comunidad sobre prácticas de reciclaje efectivas y sostenibles.
                                        </p>
                                        <div>
                                            <iframe src="${campana[5]}" width="465" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $('#listado').html(cards);
            } else {
                console.error('La respuesta no contiene "aaData"');
            }
        },
        error: function(e) {
            console.log('Error en la petición:', e.responseText);
        }
    });
}
$(document).ready(function() {
    listarCampanasEnCards();
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
            var response = datos.trim(); 
            if (response == '1') {
                toastr.success('Usuario registrado');
                $('#campana_add')[0].reset();
                tabla.api().ajax.reload();
            } else if (response == '2') {
                toastr.error('El usuario ya existe.');
            } else if (response == '3') {
                toastr.error('Ingrese una campaña con nombre diferente.');
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