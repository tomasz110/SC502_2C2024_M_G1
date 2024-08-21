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

    <div class="container mt-4">
        <h2 class="text-center py-4" style="color:#6B8F71">
            En este apartado encontrarás la lista de todos los materiales recolectados en las campañas que te ofrecemos para que puedas utilizar para tus emprendedurismos y creaciones.
        </h2>
    </div>

    <section>
        <div class="container">
            <div class="row justify-content-center mt-5" id="listadoMateriales">
            
            </div>
        </div>
    </section>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9tnb6shWgtF8rf1wbl1a1G4I8ra/4yNi0GJ52a0CrTVA/g2r25s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/DataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/bootbox/bootbox.min.js"></script>
    <script src="plugins/toastr/toastr.js"></script>
    <script src="assets/js/material.js"></script>
    <script src="assets/js/producto.js"></script>
</body>

</html>
