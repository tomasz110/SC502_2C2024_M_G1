<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <style>
        .content {
            display: flex;
            justify-content: center;
            margin: 20px;
        }
        .column {
            flex: 1;
            padding: 20px;
            text-align: left;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            text-align: center;
        }
        .image-container {
            text-align: center;
            margin: 20px 0;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
            width: 500px; 
            height: 400px; 
            object-fit: cover; 
        }
    </style>
</head>
<body>
    <header>
        <?php include 'headerAdmin.php'; ?>
    </header>
    <section class="content">
        <div class="column">
            <div class="section">
                <h2 class="section-title">Historia</h2>
                <div class="image-container">
                    <img src="./assets/img/reciclaje-de-residuos.jpg" alt="Imagen relacionada con la historia del proyecto">
                </div>
                <h6 class="text-body-secondary">Cómo surgió este proyecto</h6>
                <p>El emprendimiento nació de la observación diaria de la creciente cantidad de basura en las calles y espacios públicos de Costa Rica. Esta situación no solo afecta la estética de nuestro entorno, sino que también representa un riesgo significativo para la salud pública y la biodiversidad. Vimos la necesidad de actuar.</p>
                <p>La motivación detrás de esta iniciativa es la preocupación por el impacto ambiental negativo que los desechos no gestionados adecuadamente tienen en nuestro país. La contaminación de suelos, ríos y océanos, así como los daños a la fauna y flora locales, son problemas graves que necesitan una solución inmediata. Además, hay una falta de conciencia generalizada sobre la importancia del reciclaje y la gestión responsable de los residuos. Este emprendimiento busca llenar ese vacío, ofreciendo una alternativa viable y sostenible.</p>
                <p>Nuestro principal objetivo es contribuir a la construcción de un Costa Rica más limpio y sostenible. A través de la recolección de basura y el reciclaje de materiales como envases, cartón y plásticos, queremos reducir la cantidad de residuos que terminan en vertederos y espacios naturales. Asimismo, buscamos educar a la comunidad sobre la importancia del reciclaje y fomentar prácticas responsables que se integren en la vida diaria de las personas. En última instancia, aspiramos a crear una cultura ambiental más consciente y activa, donde cada ciudadano se sienta responsable del cuidado de su entorno.</p>
            </div>
        </div>
        <div class="column">
            <div class="section">
                <h2 class="section-title">Convenios</h2>
                <div class="image-container">
                    <img src="./assets/img/convenio_colectivo-940x584.jpg" alt="Imagen relacionada con los convenios">
                </div>
                <p>Para asegurar el éxito y la sostenibilidad de nuestro emprendimiento, es fundamental establecer convenios estratégicos con diversas entidades. Estos convenios no solo nos permitirán ampliar nuestro alcance y eficiencia, sino que también contribuirán a la creación de una red sólida de colaboración del medio ambiente.</p>
                <p><strong>1. Convenios con Empresas Privadas</strong></p>
                <p>Las empresas privadas pueden jugar un papel importante al integrarse en la cadena de reciclaje y apoyar financieramente las iniciativas ambientales.</p>
                <p><strong>2. Convenios con Instituciones Educativas</strong></p>
                <p>Las instituciones educativas son aliados clave en la formación de una cultura de reciclaje y cuidado ambiental.</p>
                <p><strong>3. Convenios con Comunidades y Asociaciones Vecinales</strong></p>
                <p>Involucrar directamente a las comunidades es esencial para el éxito del emprendimiento.</p>
            </div>
        </div>
    </section>
    <footer>
  <?php
    include 'footer.php';

    
    ?>
  </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
