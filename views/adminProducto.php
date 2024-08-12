<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.css">
</head>
<body>
    <div class="container mt-4">
        <!-- Formulario de creación de producto -->
        <div class="row">
            <div class="col-md-12" id="formulario_add">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Agregar un Producto</h3>
                    </div>
                    <div class="card-body">
                        <form id="producto_add" method="POST">
                            <input type="hidden" id="existeProducto" name="existeProducto">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nombre">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="precio">Precio</label>
                                    <input type="text" class="form-control" id="precio" name="precio" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="existencias">Existencias</label>
                                    <input type="number" class="form-control" id="existencias" name="existencias" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="ruta_imagen">Ruta de Imagen</label>
                                    <input type="text" class="form-control" id="ruta_imagen" name="ruta_imagen">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="activo">Activo</label>
                                    <select class="form-control" id="activo" name="activo" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="1">Sí</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="submit" id="btnRegistrar" class="btn btn-success" value="Registrar">
                                    <input type="reset" class="btn btn-warning" value="Borrar datos">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Formulario de modificación de producto -->
        <div class="row">
            <div class="col-md-12" id="formulario_update" style="display: none;">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Modificar un Producto</h3>
                    </div>
                    <div class="card-body">
                        <form id="producto_update" method="POST">
                            <input type="hidden" class="form-control" id="EId" name="id">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="Enombre">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="Enombre" name="nombre" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Edescripcion">Descripción</label>
                                    <input type="text" class="form-control" id="Edescripcion" name="descripcion" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Eprecio">Precio</label>
                                    <input type="text" class="form-control" id="Eprecio" name="precio" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Eexistencias">Existencias</label>
                                    <input type="number" class="form-control" id="Eexistencias" name="existencias" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Eruta_imagen">Ruta de Imagen</label>
                                    <input type="text" class="form-control" id="Eruta_imagen" name="ruta_imagen">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Eactivo">Activo</label>
                                    <select class="form-control" id="Eactivo" name="activo" required>
                                        <option value="1">Sí</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="submit" class="btn btn-warning" value="Modificar">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="button" class="btn btn-info" value="Cancelar" onclick="cancelarForm()">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Listado de productos -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Productos existentes</h3>
                    </div>
                    <div class="card-body p-0">
                        <table id="tbllistado" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Existencias</th>
                                    <th>Imagen</th>
                                    <th>Activo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Los datos serán llenados por DataTables -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Existencias</th>
                                    <th>Imagen</th>
                                    <th>Activo</th>
                                    <th>Opciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="plugins/DataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/bootbox/bootbox.min.js"></script>
    <script src="plugins/toastr/toastr.js"></script>
    <script src="assets/js/producto.js"></script>
</body>
</html>
