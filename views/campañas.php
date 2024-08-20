<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoSales</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.css">
</head>

<body>
  <header>
    <?php include 'header.php'; ?>
  </header>

  <section class="mt-5 text-center">
    <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide mx-auto" style="width: 1200px;">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./assets/img/carrusel/3.png" class="d-block h-100 w-100" alt="Imagen 1">
          </div>
          <div class="carousel-item">
            <img src="./assets/img/carrusel/1.png" class="d-block h-100 w-100" alt="Imagen 2">
          </div>
          <div class="carousel-item">
            <img src="./assets/img/carrusel/2.png" class="d-block h-100 w-100" alt="Imagen 3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bg-black" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon bg-black" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>

  <div class="container">
    <h1 class="text-center font-weight-bold py-4" style="color:#6B8F71">
      Conocé nuestras campañas en todo el país y ayudanos a tener un país más limpio y un futuro más sostenible! :)
    </h1>
    <hr style="color:#6B8F71">
  </div>

  <section id="campanas" class="pt-md-5">
    <div class="container-fluid">
      <div class="row justify-content-center" id="listado">
      
      </div>
    </div>
  </section>

  <footer>
    <?php include 'footer.php'; ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/DataTables/datatables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/bootbox/bootbox.min.js"></script>
  <script src="plugins/toastr/toastr.js"></script>
  <script src="assets/js/campana.js"></script>
</body>

</html>
