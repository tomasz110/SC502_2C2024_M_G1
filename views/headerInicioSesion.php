<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <style>
        .nav-item {
            margin-right: 15px;
        }
        .nav-link {
            font-size: 18px;
            color: black;
            text-decoration: none;
        }
        .nav {
            background: #6B8F71;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .nav-link:hover {
            color: white;
        }
        .nav-link.active {
            color: white;
            background-color: white;
            border-radius: 5px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            position: absolute;
            left: 10px;
            color: black;
            top: 13px;
            text-decoration: none;
        }
        .inicioSesion {
            position: absolute;
            font-weight: bold;
            right: 10px;
            color: black;
            text-decoration: none;
            top: 10px;
            font-size: 18px;
            background-color: #BCD0C7;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
        }
        .inicioSesion:hover {
            color: white;
            background-color: #A9B2AC;
        }
    </style>
</head>
<body>
    <header>
        <ul class="nav">
            <li>
                <a class="logo" href="./campañas.php">EcoSales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./campañas.php">Campañas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./materiales.php">Materiales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./productos.php">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./conozcanos.php">Conózcanos</a>
            </li>
            <li class="nav-item">
                <a class="inicioSesion" href="./inicioSesion.php">Iniciar sesión</a>
            </li>
        </ul>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
</body>
</html>
