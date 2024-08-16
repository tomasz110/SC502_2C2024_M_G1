<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoSales</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.css">
</head>

<body>
  <header>
    <?php include 'headerAdmin.php'; ?>
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
                           
                                <img src="./assets/img/carrusel/3.png" class="d-block h-100 w-100" alt="...">
                            
                        </div>
                        <div class="carousel-item">
                            
                                <img src="./assets/img/carrusel/1.png" class="d-block h-100 w-100" alt="...">
                            
                        </div>
                        <div class="carousel-item">
                           
                                <img src="./assets/img/carrusel/2.png" class="d-block h-100 w-100" alt="...">
                           
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
  <hr>
  Conocé nuestras campañas en todo el país y ayudanos a tener un país más limpio y un futuro más sostenible! :)</h1>
  </div>
  <hr style="color:#6B8F71">
  <section id="campañas" class="pt-md-5">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="./assets/img/campa_recli1.png" class="card-img-top" style="object-fit: cover; height: 200px;" alt="Imagen de la campaña">
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
            <p>
          <strong>Lugar:</strong><br/>
          <strong>Fecha:</strong><br/>
          <strong>Patrocinadores:</strong> <br/>
          <strong>Organizadores:</strong><br/>
          <strong>Descripcion de la actividad:</strong> Esta campaña tiene como objetivo educar a la comunidad costarricense sobre prácticas de reciclaje efectivas y sostenibles. Incluye actividades de recolección, talleres educativos y actividades comunitarias.</p>
              <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62879.69464419138!2d-84.11334505!3d9.93554565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0e342c50d15c5%3A0xe6746a6a9f11b882!2zU2FuIEpvc8Op!5e0!3m2!1ses!2scr!4v1721159382629!5m2!1ses!2scr" width="465" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>


      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="./assets/img/campa_recli2.jpg" class="card-img-top" style="object-fit: cover; height: 200px;" alt="Imagen de la campaña">
          <div class="card-body text-center">
            <h5 class="card-title">Campaña de Reciclaje de Latas en Puntarenas</h5>
            <p class="card-text">Únete a nuestra campaña de reciclaje de latas para reducir el impacto ambiental de los desechos metálicos. Descubre cómo puedes reciclar y reutilizar latas de manera efectiva.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal2">
              Información
            </button>
          </div>
        </div>
      </div>
    
      <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modalLabel2" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Campaña de Reciclaje de Latas en Puntarenas</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <p>
          <strong>Lugar:</strong><br/>
          <strong>Fecha:</strong><br/>
          <strong>Patrocinadores:</strong> <br/>
          <strong>Organizadores:</strong><br/>
          <strong>Descripcion de la actividad:</strong><br/>
                Esta campaña se centra en la recolección masiva de latas de aluminio en áreas específicas de Puntarenas. El evento incluye incentivos para motivar la participación y acciones para concienciar sobre la importancia del reciclaje de metales.</p>
              <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31435.700825105334!2d-84.84282054041536!3d9.978592384643143!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa02eb96dada6b7%3A0x3f48bd110f83d5ec!2sProvincia%20de%20Puntarenas%2C%20Puntarenas!5e0!3m2!1ses!2scr!4v1721159497344!5m2!1ses!2scr" width="465" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
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
          <img src="./assets/img/campa_recli3.webp" class="card-img-top" style="object-fit: cover; height: 200px;" alt="Imagen de la campaña">
          <div class="card-body text-center">
            <h5 class="card-title">Campaña de Reciclaje de Latas en Cartago</h5>
            <p class="card-text">Participa en nuestra campaña de reciclaje de latas para continuar promoviendo prácticas sostenibles. Ayuda a mantener nuestro entorno limpio y saludable.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal3">
              Información
            </button>
          </div>
        </div>
      </div>
     
      <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modalLabel3" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Campaña de Reciclaje de Latas en Cartago</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <p>
          <strong>Lugar:</strong><br/>
          <strong>Fecha:</strong><br/>
          <strong>Patrocinadores:</strong> <br/>
          <strong>Organizadores:</strong><br/>
          <strong>Descripcion de la actividad:</strong><br/>  
              Esta campaña amplía las iniciativas de reciclaje de latas, enfocándose en comunidades y centros urbanos de Cartago. Incluye programas educativos y actividades para involucrar a empresas locales a que se unan a esta causa.</p>
              <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d503219.80901325436!2d-84.02967408305297!3d9.816331308254293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0d69b084d750d%3A0x115b1ac11b9a1990!2sProvincia%20de%20Cartago!5e0!3m2!1ses!2scr!4v1721159544334!5m2!1ses!2scr" width="465" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="./assets/img/campa_recli4.jpg" class="card-img-top" style="object-fit: cover; height: 200px;" alt="Imagen de la campaña">
          <div class="card-body text-center">
            <h5 class="card-title">Campaña de Botellas Plásticas y de Vidrio en San José</h5>
            <p class="card-text">Únete a nuestra campaña de reciclaje de botellas plásticas y de vidrio para reducir la contaminación y promover un estilo de vida más sostenible.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal4">
              Información
            </button>
          </div>
        </div>
      </div>
    
      <div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="modalLabel4" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Campaña de Botellas Plásticas y de Vidrio en San José</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <p>
          <strong>Lugar:</strong><br/>
          <strong>Fecha:</strong><br/>
          <strong>Patrocinadores:</strong> <br/>
          <strong>Organizadores:</strong><br/>
          <strong>Descripcion de la actividad:</strong><br/>  
              Esta campaña aborda específicamente la gestión de residuos de botellas plásticas y de vidrio en San José. Incluye puntos de recolección, métodos de reciclaje y consejos para minimizar el consumo de envases desechables.</p>
              <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7859.961154629086!2d-84.1139781774772!3d9.935573777277318!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0fcab0a0197a5%3A0x6ede71a0096b9231!2sSan%20Jos%C3%A9%2C%20Sabana!5e0!3m2!1ses!2scr!4v1721159627598!5m2!1ses!2scr" width="465" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
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
    <?php include 'footerAdmin.php'; ?>
  </footer>



</body>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="plugins/DataTables/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/bootbox/bootbox.min.js"></script>
<script src="plugins/toastr/toastr.js"></script>

</html>