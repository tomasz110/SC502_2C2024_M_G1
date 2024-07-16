<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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





  <section>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <!-- Tarjeta 1 -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="ruta/a/tu/imagen1.jpg" class="card-img-top" style="object-fit: cover; height: 250px;" alt="Descripción de tu imagen 1"/>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Nombre Accesorio 1</h5>
                        <p class="card-text">Descripción de tu accesorio 1.</p>
                        <p class="card-text">Precio: $XX | Existencias: YY</p>
                        <form>
                          
                            <button class="btn btn-primary btn-block" type="button">Añadir al carrito</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 2 -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="ruta/a/tu/imagen2.jpg" class="card-img-top" style="object-fit: cover; height: 250px;" alt="Descripción de tu imagen 2"/>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Nombre Accesorio 2</h5>
                        <p class="card-text">Descripción de tu accesorio 2.</p>
                        <p class="card-text">Precio: $XX | Existencias: YY</p>
                        <form>
                            <input type="hidden" name="idAccesorio2" value="id2" />
                            <button class="btn btn-primary btn-block" onclick="addCard(this.form)" type="button">Añadir al carrito</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 3 -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="ruta/a/tu/imagen3.jpg" class="card-img-top" style="object-fit: cover; height: 250px;" alt="Descripción de tu imagen 3"/>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Nombre Accesorio 3</h5>
                        <p class="card-text">Descripción de tu accesorio 3.</p>
                        <p class="card-text">Precio: $XX | Existencias: YY</p>
                        <form>
                            <input type="hidden" name="idAccesorio3" value="id3" />
                            <button class="btn btn-primary btn-block" onclick="addCard(this.form)" type="button">Añadir al carrito</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="ruta/a/tu/imagen3.jpg" class="card-img-top" style="object-fit: cover; height: 250px;" alt="Descripción de tu imagen 3"/>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Nombre Accesorio 3</h5>
                        <p class="card-text">Descripción de tu accesorio 3.</p>
                        <p class="card-text">Precio: $XX | Existencias: YY</p>
                        <form>
                            <input type="hidden" name="idAccesorio3" value="id3" />
                            <button class="btn btn-primary btn-block" onclick="addCard(this.form)" type="button">Añadir al carrito</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="ruta/a/tu/imagen3.jpg" class="card-img-top" style="object-fit: cover; height: 250px;" alt="Descripción de tu imagen 3"/>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Nombre Accesorio 3</h5>
                        <p class="card-text">Descripción de tu accesorio 3.</p>
                        <p class="card-text">Precio: $XX | Existencias: YY</p>
                        <form>
                            <input type="hidden" name="idAccesorio3" value="id3" />
                            <button class="btn btn-primary btn-block" onclick="addCard(this.form)" type="button">Añadir al carrito</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="ruta/a/tu/imagen3.jpg" class="card-img-top" style="object-fit: cover; height: 250px;" alt="Descripción de tu imagen 3"/>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Nombre Accesorio 3</h5>
                        <p class="card-text">Descripción de tu accesorio 3.</p>
                        <p class="card-text">Precio: $XX | Existencias: YY</p>
                        <form>
                            <input type="hidden" name="idAccesorio3" value="id3" />
                            <button class="btn btn-primary btn-block" onclick="addCard(this.form)" type="button">Añadir al carrito</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="ruta/a/tu/imagen3.jpg" class="card-img-top" style="object-fit: cover; height: 250px;" alt="Descripción de tu imagen 3"/>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Nombre Accesorio 3</h5>
                        <p class="card-text">Descripción de tu accesorio 3.</p>
                        <p class="card-text">Precio: $XX | Existencias: YY</p>
                        <form>
                            <input type="hidden" name="idAccesorio3" value="id3" />
                            <button class="btn btn-primary btn-block" onclick="addCard(this.form)" type="button">Añadir al carrito</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 4 -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="ruta/a/tu/imagen4.jpg" class="card-img-top" style="object-fit: cover; height: 250px;" alt="Descripción de tu imagen 4"/>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Nombre Accesorio 4</h5>
                        <p class="card-text">Descripción de tu accesorio 4.</p>
                        <p class="card-text">Precio: $XX | Existencias: YY</p>
                        <form>
                            <input type="hidden" name="idAccesorio4" value="id4" />
                            <button class="btn btn-primary btn-block" onclick="addCard(this.form)" type="button">Añadir al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





  <footer>
  <?php
    include 'footer.php';

    
    ?>
  </footer>
 


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>