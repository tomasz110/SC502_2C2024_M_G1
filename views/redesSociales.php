<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redes Sociales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>
<body>
<?php include 'header.php'?>



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