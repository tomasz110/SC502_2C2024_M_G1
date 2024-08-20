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
                <a class="nav-link" href="./carrito.php">Carrito</a>
            </li>
            <li class="nav-item">
                <a class="inicioSesion" href="./inicioSesion.php">Cerrar sesión</a>
            </li>
        </ul>
    </header>

  
</body>
</html>
