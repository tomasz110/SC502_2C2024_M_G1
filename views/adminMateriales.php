<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Materiales</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">        
    <link rel="stylesheet" href="plugins/toastr/toastr.css">
</head>
<body>

<header>
    <?php include 'header.php'; ?>
</header>

 
<section>
    <div class="container mt-4">
    <div class="row">
        <!-- Formulario de creación de Material -->
        <div class="col-md-12" id="formulario_add">
            <div class="card card-dark">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">Agregar un Material</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <form name="material_add" id="material_add" method="POST">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input type="number" class="form-control" id="precio" name="precio" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="precio">Existencias</label>
                                            <input type="number" class="form-control" id="existencias" name="existencias" required>
                                        </div>
                                    </div>
                                   
                                  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select name="estado" id="estado" class="form-control">
                                                <option value="1" selected>Activado</option>
                                                <option value="0">Desactivado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="submit" id="btnRegistrar" class="btn btn-info" value="Registrar">
                                        <input type="reset" class="btn btn-danger" value="Borrar datos">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Formulario de modificación de Materiales -->
        <div class="col-md-12" id="formulario_update">
            <div class="card card-dark">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">Modificar un Material</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <form name="material_update" id="material_update" method="POST">
                                <input type="hidden" class="form-control" id="EId" name="id_materiales_pk">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre_material">Nombre</label>
                                            <input type="text" class="form-control" id="nombre_material" name="nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="descripcion_material">Descripción</label>
                                            <input type="text" class="form-control" id="descripcion_material" name="descripcion" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="precio_producto">Precio</label>
                                            <input type="number" class="form-control" id="precio_producto" name="precio" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="existencias_producto">Existencias</label>
                                            <input type="number" class="form-control" id="existencias_producto" name="existencias" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="submit" class="form-control btn btn-warning" value="Modificar">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="button" class="form-control btn btn-info" value="Cancelar" onclick="cancelarForm()">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Listado de Materiales -->
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">Materiales existentes</h3>
                </div>
                <div class="card-body p-0">
                    <div class="row mt-2">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table id="tbllistado" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <th>ID</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Existencias</th>
                                    <th>Imagen</th>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <th>ID</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Existencias</th>
                                    <th>Imagen</th>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<footer>
    <?php include 'footer.php'; ?>
</footer>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="plugins/DataTables/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/bootbox/bootbox.min.js"></script>
<script src="plugins/toastr/toastr.js"></script>
<script src="assets/js/materiales.js"></script>
</body>
</html>
