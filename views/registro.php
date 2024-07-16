<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
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
                    <form>
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                <input name="nombreCompleto" class="form-control" placeholder="Nombre completo" type="text">
                            </div>
                        </div> 
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                <input name="email" class="form-control" placeholder="Correo electrónico" type="email" autocomplete="off">
                            </div>
                        </div> 
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                
                                <input name="telefono" class="form-control" placeholder="Número de teléfono" type="text">
                            </div>
                        </div>  
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                <input class="form-control" name="password" placeholder="Crea una contraseña" type="password">
                            </div>
                        </div> 
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                <input class="form-control" name="password" placeholder="Repite la contraseña" type="password">
                            </div>
                        </div>                                      
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-block"> Crear Cuenta </button>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>