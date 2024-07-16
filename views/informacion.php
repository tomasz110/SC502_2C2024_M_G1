<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/styles.css">

    <style>
  .card-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 600px;
    
  }
 
  .card-body {
     margin: 20px;
    }
    .container{
        margin:20px;
        gap: 90px;
        
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
    <div class="container mt-8 card-container">
      <div class="card text-center" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Historia</h5>
          <h6 class="card-subtitle mb-2 text-body-secondary">Como surgio este proyecto</h6>
          <p class="card-text">El emprendimiento nació de la observación diaria de la creciente cantidad de basura en las calles y espacios públicos de Costa Rica. Esta situación no solo afecta la estética de nuestro entorno, sino que también representa un riesgo significativo para la salud pública y la biodiversidad. Vimos la necesidad de actuar.</p>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalHistoria">
            Saber más
          </button>
        </div>
      </div>
      <div class="card text-center" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Convenios</h5>
          <p class="card-text">Para asegurar el éxito y la sostenibilidad de nuestro emprendimiento, es fundamental establecer convenios estratégicos con diversas entidades. Estos convenios no solo nos permitirán ampliar nuestro alcance y eficiencia, sino que también contribuirán a la creación de una red sólida de colaboración del medio ambiente.</p>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConvenios">
            Saber más
          </button>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="modalHistoria" tabindex="-1" aria-labelledby="modalLabelHistoria" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabelHistoria">Historia</h5>
        </div>
        <div class="modal-body">
          <p>La motivación detrás de esta iniciativa es la preocupación por el impacto ambiental negativo que los desechos no gestionados adecuadamente tienen en nuestro país. La contaminación de suelos, ríos y océanos, así como los daños a la fauna y flora locales, son problemas graves que necesitan una solución inmediata. Además, hay una falta de conciencia generalizada sobre la importancia del reciclaje y la gestión responsable de los residuos. Este emprendimiento busca llenar ese vacío, ofreciendo una alternativa viable y sostenible.</p>
          <p>Nuestro principal objetivo es contribuir a la construcción de un Costa Rica más limpio y sostenible. A través de la recolección de basura y el reciclaje de materiales como envases, cartón y plásticos, queremos reducir la cantidad de residuos que terminan en vertederos y espacios naturales. Asimismo, buscamos educar a la comunidad sobre la importancia del reciclaje y fomentar prácticas responsables que se integren en la vida diaria de las personas. En última instancia, aspiramos a crear una cultura ambiental más consciente y activa, donde cada ciudadano se sienta responsable del cuidado de su entorno.   
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalConvenios" tabindex="-1" aria-labelledby="modalLabelConvenios" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabelConvenios">Convenios a llevar a cabo</h5>
        </div>
        <div class="modal-body">
          <p>1. Convenios con Empresas Privadas</p>
          <p>Las empresas privadas pueden jugar un papel importante al integrarse en la cadena de reciclaje y apoyar financieramente las iniciativas ambientales. </p>
        <p>2. Convenios con Instituciones Educativas</p>
        <p>Las instituciones educativas son aliados clave en la formación de una cultura de reciclaje y cuidado ambiental. </p>
        <p>3. Convenios con Comunidades y Asociaciones Vecinales</p>
        <p>Involucrar directamente a las comunidades es esencial para el éxito del emprendimiento. </p>
    
    </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>