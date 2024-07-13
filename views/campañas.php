<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
  <header>
    <?php include 'header.php'; ?>
  </header>
  <section>
    <div class="container mt-5">
      <div id="carouselExampleIndicators" class="carousel slide mx-auto" style="width: 1200px;">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <a href="">
              <img
                src="./assets/img/carou_recicl.webp"
                class="d-block h-100 w-100" alt="...">
            </a>
          </div>
          <div class="carousel-item">
            <a href="">
              <img src="./assets/img/carrou_recicl.jpg"
                class="d-block h-100 w-100" alt="...">
            </a>
          </div>
          <div class="carousel-item">
            <a href="">
              <img src="./assets/img/carrou_recicl3.jpg" class="d-block h-100 w-100"
                alt="...">
            </a>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon bg-black" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next">
          <span class="carousel-control-next-icon bg-black" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>

  <section id="campañas" class="pt-md-5">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
          <div class="card">
            <img
              src="./assets/img/campa_recli1.png"
              class="card-img-top" style="object-fit: cover; height: 200px;" alt="Imagen de la campaña">
            <div class="card-body text-center">
              <h5 class="card-title">Campaña General de Reciclaje en San José Centro</h5>
              <p class="card-text">Participa en nuestra campaña general de reciclaje para contribuir al cuidado del medio ambiente. Aprende sobre la importancia del reciclaje y cómo puedes hacer la diferencia</p>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">
                Información
              </button>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modalLabel1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Campaña General de Reciclaje en San José Centro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Esta campaña tiene como objetivo educar a la comunidad costarricense sobre prácticas de reciclaje efectivas y sostenibles. Incluye actividades de recolección, talleres educativos y actividades comunitarias.</p>

                <div>Ubicación, detalles, etc.</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="./assets/img/campa_recli2.jpg" class="card-img-top"
              style="object-fit: cover; height: 200px;" alt="Imagen de la campaña">
            <div class="card-body text-center">
              <h5 class="card-title">Campaña de Reciclaje de Latas en Puntarenas</h5>
              <p class="card-text">Únete a nuestra campaña de reciclaje de latas para reducir el impacto ambiental de los desechos metálicos. Descubre cómo puedes reciclar y reutilizar latas de manera efectiva.</p>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">
                Información
              </button>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modalLabel1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Campaña de Reciclaje de Latas en Puntarenas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Esta campaña se centra en la recolección masiva de latas de aluminio en áreas específicas de Puntarenas. El evento incluye incentivos para motivar la participación y acciones para concienciar sobre la importancia del reciclaje de metales.</p>

                <div>Ubicación, detalles, etc.</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
          <div class="card">
            <img
              src="./assets/img/campa_recli3.webp"
              class="card-img-top" style="object-fit: cover; height: 200px;" alt="Imagen de la campaña">
            <div class="card-body text-center">
              <h5 class="card-title">Campaña de Reciclaje de Latas en Cartago</h5>
              <p class="card-text">Participa en nuestra campaña de reciclaje de latas para continuar promoviendo prácticas sostenibles. Ayuda a mantener nuestro entorno limpio y saludable.</p>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">
                Información
              </button>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modalLabel1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Campaña de Reciclaje de Latas en Cartago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Esta campaña amplía las iniciativas de reciclaje de latas, enfocándose en comunidades y centros urbanos de Cartago. Incluye programas educativos y actividades para involucrar a empresas locales a que se unan a esta causa.</p>

                <div>Ubicación, detalles, etc.</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="./assets/img/campa_recli4.jpg" class="card-img-top"
              style="object-fit: cover; height: 200px;" alt="Imagen de la campaña">
            <div class="card-body text-center">
              <h5 class="card-title">Campaña de Reciclaje de Botellas Plásticas y de Vidrio en San José</h5>
              <p class="card-text">Únete a nuestra campaña de reciclaje de botellas plásticas y de vidrio para reducir la contaminación y promover un estilo de vida más sostenible.</p>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">
                Información
              </button>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modalLabel1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Campaña de Reciclaje de Botellas Plásticas y de Vidrio en San José</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Esta campaña aborda específicamente la gestión de residuos de botellas plásticas y de vidrio en San José. Incluye puntos de recolección, métodos de reciclaje y consejos para minimizar el consumo de envases desechables.</p>

                <div>Ubicación, detalles, etc.</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>