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
    background: #829982;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center; 
    position: relative; 
  }
  .nav-link:hover {
    color: white;
  }
  .logo {
    font-size: 24px; 
    font-weight: bold; 
    position: absolute;
    left: 10px; 
    color: black; 
    top: 13px;
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
    background-color: #A9B2AC; /
  }
</style>

<header>
  <ul class="nav nav-underline">
    <li>
      <span class="logo">EcoSales</span>
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
