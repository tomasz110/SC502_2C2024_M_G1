<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
  <header>
  <?php include 'header.php'; ?>
  </header>
  <section id="conozcanos" class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <h1 class="mb-4">Conózcanos</h1>
          <p><strong>EcoSales</strong> se centra en abordar la problemática actual del reciclaje, promoviendo prácticas 
            sostenibles y ayudando al país a mejorar su gestión de residuos. 
            La iniciativa surge como una respuesta para enfrentar los desafíos ambientales que 
            afectan tanto a nivel global como local. A través de esta plataforma, se busca informar y movilizar 
            a la comunidad hacia un futuro más verde y consciente.</p>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-6">
          <h2>Nuestra Misión</h2>
          <p>En la actualidad, el reciclaje se ha convertido en una necesidad urgente para abordar la creciente problemática ambiental que enfrenta nuestro planeta. A medida que los residuos van en aumento, la correcta gestión de estos materiales es esencial para reducir la contaminación y preservar nuestros recursos naturales. 
            Con este propósito, presentamos la creación de una página web dedicada al reciclaje <strong>EcoSales</strong>, diseñada 
            para promover prácticas sostenibles y apoyar los esfuerzos del país en la mejora de la gestión de residuos.</p>
        </div>
        <div class="col-md-6">
          <h2>Nuestra Visión</h2>
          <p><strong>EcoSales</strong>no solo busca generar una moda o algo que sea temporal, sino que se quiere reutilizar recursos y generar conciencia en los habitantes de nuestro país sobre los beneficios que puede traer implementar este estilo de vida mediante prácticas interactivas e innovadoras.</p>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-lg-8 mx-auto text-center">
          <h2>Valores Fundamentales</h2>
          <ul class="list-unstyled">
        <li>Compromiso con la sostenibilidad ambiental y la reducción de la huella ecológica.</li>
        <li>Promoción de la educación y concienciación sobre el reciclaje y la gestión de residuos.</li>
        <li>Apoyo al desarrollo económico local a través del comercio justo y sostenible.</li>
        <li>Innovación continua en prácticas y tecnologías para mejorar la eficiencia del reciclaje.</li>
        <li>Transparencia y responsabilidad en todas nuestras operaciones y comunicaciones.</li>
    </ul>
        </div>
      </div>
    </div>
  </section>

    <hr>

  <section class="contactanos">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <h1>Contactanos:</h1>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email:</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Asunto:</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <button type="button" class="btn btn-outline-secondary">
            Send
          </button>
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