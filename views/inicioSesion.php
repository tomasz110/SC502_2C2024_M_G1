<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <style>
        table{
            border 1px;
        }
    </style>
</head>
<body>
    
   
  <header>
  <?php
    include 'header.php';

    
    ?>

  </header>
  <section id="inicioSesion">
    <div class="d-flex justify-content-center align-items-center mt-5 mb-5">
        <div class="card bg-light shadow-sm" style="width: 310px; height: 400px;">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Inicio sesion</h4>
                <form>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            <input name="email" class="form-control" placeholder="Correo electrónico" type="email" autocomplete="off">
                        </div>
                    </div> 
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            <input class="form-control" name="password" placeholder="Crea una contraseña" type="password">
                        </div>
                    </div> 
                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-block"> Iniciar sesion </button>
                    </div>      
                    <p class="text-center mt-3">¿No tienes una cuenta? <a href="./registro.php">Registrate aqui</a></p>                                                                 
                </form>
            </article>
        </div>
    </div>
</section>


  <footer>
  <?php
    include 'footer.php';

    
    ?>
  </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>