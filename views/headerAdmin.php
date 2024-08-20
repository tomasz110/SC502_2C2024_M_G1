
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  
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
                <a class="logo" href="./campañasAdmin.php">EcoSales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./campañasAdmin.php">Campañas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./materialesAdmin.php">Materiales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./productosAdmin.php">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./conozcanosAdmin.php">Conózcanos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./carrito.php">Carrito</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Administración
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./adminCampana.php">adminCampana</a></li>
                    <li><a class="dropdown-item" href="./adminMateriales.php">adminMateriales</a></li>
                    <li><a class="dropdown-item" href="./adminProducto.php">adminProducto</a></li>
                    <li><a class="dropdown-item" href="./adminEmprendedores.php">adminEmprendedores</a></li>
                    <li><a class="dropdown-item" href="./adminUsuario.php">adminUsuario</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="inicioSesion" href="./inicioSesion.php">Cerrar sesión</a>
            </li>
        </ul>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   

