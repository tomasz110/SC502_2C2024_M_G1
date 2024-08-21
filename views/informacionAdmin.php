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
    margin: 0 10px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border: 2px shadow #28a745; 
}

        .section {
            margin-bottom: 20px;
        }
        .section-title {
            text-align: center;
            font-weight: bold;
            color: #6B8F71;
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
                    <img src="./assets/img/reciclaje-de-residuos.jpg" alt="Imagen relacionada con la historia del proyecto" style="border-radius: 5%;">
                </div>
                <p style="text-align: center;"><strong>Cómo surgió este proyecto</strong></p>
                <p>El emprendimiento surgió de la observación de la creciente acumulación de basura en las calles y espacios públicos de Costa Rica, lo cual no solo afecta la estética del entorno, sino que también representa un riesgo significativo para la salud pública y la biodiversidad. Este problema refleja una necesidad urgente de actuar para mitigar el impacto ambiental negativo de los desechos mal gestionados.
                <p>La motivación principal de la iniciativa es la preocupación por la contaminación de suelos, ríos y océanos, así como el daño a la fauna y flora locales. Además, se ha identificado una falta de conciencia general sobre la importancia del reciclaje y la gestión responsable de los residuos. Por lo tanto, el emprendimiento busca llenar este vacío ofreciendo una solución viable y sostenible.</p>
                <p>Nuestro objetivo es contribuir a un Costa Rica más limpio y sostenible mediante la recolección de basura y el reciclaje de materiales como envases, cartón y plásticos. Deseamos reducir la cantidad de residuos que terminan en vertederos y espacios naturales. Asimismo, queremos educar a la comunidad sobre la importancia del reciclaje y fomentar prácticas responsables que se integren en la vida diaria. En última instancia, aspiramos a fomentar una cultura ambiental más consciente y activa, donde cada ciudadano se sienta responsable del cuidado de su entorno.</p>
                </p>
                </div>
        </div>
        <div class="column">
            <div class="section">
                <h2 class="section-title">Convenios</h2>
                <div class="image-container">
                    <img src="./assets/img/convenio_colectivo-940x584.jpg" alt="Imagen relacionada con los convenios" style="border-radius: 5%;">
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
    include 'footerAdmin.php';

    
    ?>
  </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
