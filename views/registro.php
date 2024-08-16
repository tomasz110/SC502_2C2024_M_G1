<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.css">
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header> 
    <section id="crearCuenta">
        <div class="container mt-5">
            <div class="card bg-light shadow-sm">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Crear Cuenta</h4>
                    <p class="text-center">Ayuda al medio ambiente registrandote aquí :)</p>
                    <p class="divididor">
                        <span class="bg-light">O</span>
                    </p>
                    <form id="usuario_add" method="POST">
                    <input type="hidden" id="existeUsuario" name="existeUsuario">
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                <input name="nombre" id="nombre" class="form-control" placeholder="Nombre completo" type="text">
                            </div>
                        </div> 
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                <input name="correo" id="correo" class="form-control" placeholder="Correo electrónico" type="email" autocomplete="off">
                            </div>
                        </div> 
                     
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                <input class="form-control" id="password" name="password" placeholder="Crea una contraseña" type="password">
                            </div>
                        </div> 
                                                             
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" id="btnRegistrar" class="btn btn-primary btn-block"> Crear Cuenta </button>
                        
                        </div>      
                        <p class="text-center mt-3">¿Ya tienes una cuenta? <a href="./inicioSesion.php">Inicia sesión</a></p>                                                                 
                    </form>
                </article>
            </div>
        </div>
    </section>
    <footer>
    <?php include 'footer.php'; ?>
</footer>
</body>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="plugins/DataTables/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/bootbox/bootbox.min.js"></script>
<script src="plugins/toastr/toastr.js"></script>
<script src="assets/js/usuario.js"></script>

</html>