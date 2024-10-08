<?php
session_start();
?>

  
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
        <li  class="logo">
            <a href="./campañasAdmin.php">
                <img src="./assets/img/planta.png"alt="Logo de Anggelus Estética" style="width: 50px; height: 45px;"> 
            </a>
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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Administración
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./adminCampana.php">Gestionar Campañas</a></li>
                    <li><a class="dropdown-item" href="./adminMateriales.php">Gestionar Materiales</a></li>
                    <li><a class="dropdown-item" href="./adminProducto.php">Gestionar Productos</a></li>
                    <li><a class="dropdown-item" href="./adminEmprendedores.php">Gestionar Emprendedores</a></li>
                    <li><a class="dropdown-item" href="./adminUsuario.php">Gestionar Usuarios</a></li>
                </ul>
            </li>
            <li class="nav-item">
            <?php if (isset($_SESSION['id_usuario'])): ?>
                    <a class="inicioSesion" href="./inicioSesion.php">Cerrar sesión</a>
                <?php else: ?>
                    <a class="inicioSesion" href="./inicioSesion.php">Iniciar sesión</a>
                <?php endif; ?>
            </li>
        </ul>
    </header>
    
   

