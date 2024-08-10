/*Funcion para limpieza de los formularios*/
function limpiarForms() {
  $('#modulos_add').trigger('reset');
  $('#modulos_update').trigger('reset');
}

/*Funcion para cancelacion del uso de formulario de modificación*/
function cancelarForm() {
  limpiarForms();
  $('#formulario_add').show();
  $('#formulario_update').hide();
}

/*Funcion para cargar el listado en el Datatable*/
function listarProductosTodos() {
  tabla = $('#tbllistado').dataTable({
      aProcessing: true, //activamos el procesamiento de datatables
      aServerSide: true, //paginacion y filtrado del lado del servidor
      dom: 'Bfrtip', //definimos los elementos del control de tabla
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
      iDisplayLength: 5, //Paginacion
  }).DataTable();
}

/*
Funcion Principal
*/
$(function () {
  $('#formulario_update').hide();
  listarProductosTodos();
});

/*
CRUD
*/

/* Función para insertar un nuevo producto */
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
          switch (datos) {
              case '1':
                  toastr.success('Producto registrado');
                  $('#producto_add')[0].reset();
                  tabla.ajax.reload();
                  break;
              case '2':
                  toastr.error('El producto ya existe... Corrija e inténtelo nuevamente...');
                  break;
              case '3':
                  toastr.error('Hubo un error al tratar de ingresar los datos.');
                  break;
              default:
                  toastr.error(datos);
                  break;
          }
          $('#btnRegistrar').removeAttr('disabled');
      }
  });
});

/* Función para activación de productos */
function activar(id) {
  bootbox.confirm('¿Está seguro de activar el producto?', function (result) {
      if (result) {
          $.post('../controllers/productoController.php?op=activar', { idProducto: id }, function (data) {
              if (data == '1') {
                  toastr.success('Producto activado');
                  tabla.ajax.reload();
              } else {
                  toastr.error('Error: El producto no puede activarse. Consulte con el administrador...');
              }
          });
      }
  });
}

/* Función para desactivación de productos */
function desactivar(id) {
  bootbox.confirm('¿Está seguro de desactivar el producto?', function (result) {
      if (result) {
          $.post('../controllers/productoController.php?op=desactivar', { idProducto: id }, function (data) {
              if (data == '1') {
                  toastr.success('Producto desactivado');
                  tabla.ajax.reload();
              } else {
                  toastr.error('Error: El producto no puede desactivarse. Consulte con el administrador...');
              }
          });
      }
  });
}

/* Habilitación de formulario de modificación al presionar el botón en la tabla */
$('#tbllistado tbody').on('click', 'button[id="modificarProducto"]', function () {
  var data = $('#tbllistado').DataTable().row($(this).parents('tr')).data();
  limpiarForms();
  $('#formulario_add').hide();
  $('#formulario_update').show();
  $('#EId').val(data[0]);
  $('#Enombre').val(data[1]);
  $('#Edescripcion').val(data[2]);
  $('#Eprecio').val(data[3]);
  $('#Eimagen').val(data[4]);
  $('#Ecategoria').val(data[5]);
  $('#Ematerial').val(data[6]);
  $('#Eestado').val(data[7]);
});

/* Función para modificación de datos del producto */
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
                  switch (datos) {
                      case '1':
                          toastr.success('Producto actualizado exitosamente');
                          tabla.ajax.reload();
                          limpiarForms();
                          $('#formulario_update').hide();
                          $('#formulario_add').show();
                          break;
                      case '0':
                          toastr.error('Error: No se pudieron actualizar los datos');
                          break;
                      case '2':
                          toastr.error('Error: El producto ya existe.');
                          break;
                  }
              }
          });
      }
  });
});
