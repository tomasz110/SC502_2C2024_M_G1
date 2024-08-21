<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>
<body>
<header>
    <?php include 'headerAdmin.php'; ?>
</header>

<section>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12" id="formulario_update">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Modificar un Usuario</h3>
                    </div>
                    <div class="card-body">
                        <form id="usuario_update" method="POST">
                            <input type="hidden" class="form-control" id="EId" name="id">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="Enombre">Nombre del Usuario</label>
                                    <input type="text" class="form-control" id="Enombre" name="nombre" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Ecorreo">Correo</label>
                                    <input type="email" class="form-control" id="Ecorreo" name="correo" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Epassword">Contraseña</label>
                                    <input type="password" class="form-control" id="Epassword" name="password">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Eid_estado">Estado</label>
                                    <select class="form-control" id="Eid_estado" name="id_estado" required>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Eid_rol">Rol</label>
                                    <select class="form-control" id="Eid_rol" name="id_rol" required>
                                        <option value="1">Usuario</option>
                                        <option value="2">Administrador</option>
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
    
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios existentes</h3>
                    </div>
                    <div class="card-body p-0">
                        <table id="tbllistado" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                           
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="plugins/DataTables/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/bootbox/bootbox.min.js"></script>
<script src="plugins/toastr/toastr.js"></script>
<script src="assets/js/usuario.js"></script>

</body>
</html>
